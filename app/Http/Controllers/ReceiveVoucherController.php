<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ReceiveVoucherController extends Controller
{
    public function index()
    {
        return view('receive.index');
    }
    public function store(Request $request)
    {
        // Validation rules sesuai dengan struktur database
        $validator = Validator::make($request->all(), [
            'voucher_number' => 'required|string|max:255|unique:vouchers,voucher_number',
            'type' => 'required|in:payment,receive',
            'date' => 'required|date',
            'bank_name' => 'required|string|max:100',
            'bank_code' => 'required|string|max:20',
            'from_to' => 'required|string|max:255',
            'description' => 'required|string',
            'terbilang' => 'required|string',
            'reference_number' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'details' => 'required|array|min:1',
            'details.*.account_number' => 'required|string|max:50',
            'details.*.account_name' => 'required|string|max:255',
            'details.*.amount' => 'required|numeric|min:0.01',
        ], [
            'voucher_number.required' => 'Voucher number is required.',
            'voucher_number.unique' => 'Voucher number already exists. Please use a different number.',
            'voucher_number.max' => 'Voucher number cannot exceed 255 characters.',
            'type.required' => 'Voucher type is required.',
            'type.in' => 'Voucher type must be either payment or receive.',
            'date.required' => 'Date is required.',
            'date.date' => 'Date must be a valid date.',
            'bank_name.required' => 'Bank selection is required.',
            'bank_code.required' => 'Bank code is required.',
            'from_to.required' => 'Receive From field is required.',
            'description.required' => 'Description is required.',
            'terbilang.required' => 'Amount in words is required.',
            'total_amount.required' => 'Total amount is required.',
            'total_amount.numeric' => 'Total amount must be a number.',
            'total_amount.min' => 'Total amount must be greater than 0.',
            'details.required' => 'At least one account detail is required.',
            'details.min' => 'At least one account detail is required.',
            'details.*.account_number.required' => 'Account number is required for all rows.',
            'details.*.account_name.required' => 'Account name is required for all rows.',
            'details.*.amount.required' => 'Amount is required for all rows.',
            'details.*.amount.numeric' => 'Amount must be a number.',
            'details.*.amount.min' => 'Amount must be greater than 0.',
        ]);

        // Check validation
        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Validate total amount matches sum of details
        $detailsSum = collect($request->details)->sum('amount');
        if (abs($detailsSum - $request->total_amount) > 0.01) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total amount does not match the sum of detail amounts.'
                ], 422);
            }

            return back()
                ->withErrors(['total_amount' => 'Total amount does not match the sum of detail amounts.'])
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Use voucher number from request (user input)
            $voucherNumber = $request->voucher_number;

            // Create voucher sesuai dengan struktur database
            $voucher = Voucher::create([
                'voucher_number' => $voucherNumber,
                'reference_number' => $request->reference_number,
                'date' => $request->date,
                'from_to' => $request->from_to,
                'description' => $request->description,
                'bank_code' => $request->bank_code,
                'bank_name' => $request->bank_name,
                'terbilang' => $request->terbilang,
                'total_amount' => $request->total_amount,
                'type' => $request->type,
            ]);

            // Create voucher details sesuai dengan struktur database
            foreach ($request->details as $index => $detail) {
                VoucherDetail::create([
                    'voucher_id' => $voucher->id,
                    'account_number' => $detail['account_number'],
                    'account_name' => $detail['account_name'],
                    'amount' => $detail['amount'],
                    'line_number' => $index + 1,
                ]);
            }

            // Recalculate total to ensure accuracy
            $calculatedTotal = VoucherDetail::where('voucher_id', $voucher->id)->sum('amount');
            $voucher->update(['total_amount' => $calculatedTotal]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => ucfirst($request->type) . ' voucher created successfully.',
                    'voucher' => $voucher->load('details'),
                    'redirect_url' => route('dashboard') // redirect ke dashboard
                ], 201);
            }

            return redirect()
                ->route('dashboard')
                ->with('success', ucfirst($request->type) . ' voucher created successfully.');
        } catch (Exception $e) {
            DB::rollback();

            Log::error('Error creating voucher: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'error' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating the voucher. Please try again.'
                ], 500);
            }

            return back()
                ->withErrors(['error' => 'An error occurred while creating the voucher. Please try again.'])
                ->withInput();
        }
    }
    public function edit($id)
    {
        try {
            $voucher = Voucher::with('details')->findOrFail($id);

            // Debug
            Log::info('Edit voucher loaded:', [
                'voucher_id' => $voucher->id,
                'voucher_number' => $voucher->voucher_number,
                'voucher_date' => $voucher->date,
                'voucher_bank' => $voucher->bank_name,
                'voucher_from_to' => $voucher->from_to,
                'details_count' => $voucher->details->count(),
                'details' => $voucher->details->toArray()
            ]);

            // Return view dengan path yang tepat
            return view('receive.edit', compact('voucher'));
        } catch (\Exception $e) {
            Log::error('Error loading voucher for edit: ' . $e->getMessage());

            return redirect()->route('dashboard')
                ->withErrors(['error' => 'Voucher not found.']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // **DEBUG: Log raw request data**
            Log::info('=== RAW REQUEST DATA ===', [
                'method' => $request->method(),
                'all_data' => $request->all(),
                'details_raw' => $request->input('details'),
                'details_type' => gettype($request->input('details')),
                'deleted_details_raw' => $request->input('deleted_details'),
            ]);

            // **FIX 1: Handle details array properly**
            $details = $request->input('details', []);

            // Ensure details is an array
            if (!is_array($details)) {
                Log::error('Details is not an array', [
                    'details_type' => gettype($details),
                    'details_value' => $details
                ]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid details format. Expected array.',
                        'error_code' => 'INVALID_DETAILS_FORMAT'
                    ], 422);
                }
                return back()->withErrors(['details' => 'Invalid details format'])->withInput();
            }

            // **FIX 2: Clean and validate details array**
            $cleanDetails = [];
            foreach ($details as $index => $detail) {
                if (is_array($detail)) {
                    $cleanDetails[] = [
                        'id' => isset($detail['id']) ? (string) $detail['id'] : null,
                        'account_number' => isset($detail['account_number']) ? (string) $detail['account_number'] : '',
                        'account_name' => isset($detail['account_name']) ? (string) $detail['account_name'] : '',
                        'amount' => isset($detail['amount']) ? (float) $detail['amount'] : 0,
                    ];
                } else {
                    Log::warning("Detail at index {$index} is not an array", [
                        'detail_type' => gettype($detail),
                        'detail_value' => $detail
                    ]);
                }
            }

            // **FIX 3: Handle deleted_details array**
            $deletedDetails = $request->input('deleted_details', []);
            if (!is_array($deletedDetails)) {
                $deletedDetails = [];
            }

            // Clean deleted_details - ensure they are integers
            $cleanDeletedDetails = [];
            foreach ($deletedDetails as $deletedId) {
                if (is_numeric($deletedId) && $deletedId > 0) {
                    $cleanDeletedDetails[] = (int) $deletedId;
                }
            }

            Log::info('=== CLEANED DATA ===', [
                'clean_details' => $cleanDetails,
                'clean_deleted_details' => $cleanDeletedDetails,
                'details_count' => count($cleanDetails)
            ]);

            // **FIX 4: Enhanced validation with proper array handling**
            $validationData = $request->all();
            $validationData['details'] = $cleanDetails;
            $validationData['deleted_details'] = $cleanDeletedDetails;

            $validator = Validator::make($validationData, [
                'date' => 'required|date',
                'bank_name' => 'required|string|max:255',
                'bank_code' => 'required|string|max:50',
                'from_to' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'terbilang' => 'required|string|max:500',
                'reference_number' => 'nullable|string|max:255',
                'details' => 'required|array|min:1',
                'details.*.account_number' => 'required|string|max:50',
                'details.*.account_name' => 'required|string|max:255',
                'details.*.amount' => 'required|numeric|min:0.01',
                'details.*.id' => 'nullable|string', // Changed to string to handle empty values
                'deleted_details' => 'nullable|array',
                'deleted_details.*' => 'integer|min:1'
            ], [
                'details.required' => 'At least one detail is required',
                'details.array' => 'Details must be an array',
                'details.min' => 'At least one detail is required',
                'details.*.account_number.required' => 'Account number is required for all details',
                'details.*.account_name.required' => 'Account name is required for all details',
                'details.*.amount.required' => 'Amount is required for all details',
                'details.*.amount.numeric' => 'Amount must be a valid number',
                'details.*.amount.min' => 'Amount must be greater than 0',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', [
                    'errors' => $validator->errors()->toArray(),
                    'input_data' => $validationData
                ]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors' => $validator->errors()
                    ], 422);
                }
                return back()->withErrors($validator)->withInput();
            }

            // **FIX 5: Safe calculation with array handling**
            try {
                $validAmounts = [];
                foreach ($cleanDetails as $detail) {
                    if (isset($detail['amount']) && is_numeric($detail['amount']) && $detail['amount'] > 0) {
                        $validAmounts[] = (float) $detail['amount'];
                    }
                }

                if (empty($validAmounts)) {
                    throw new \Exception('No valid amounts found in details');
                }

                $calculatedTotal = array_sum($validAmounts);
                $calculatedTotal = round($calculatedTotal, 2);

                Log::info('=== CALCULATION SUCCESS ===', [
                    'valid_amounts' => $validAmounts,
                    'calculated_total' => $calculatedTotal,
                    'amount_count' => count($validAmounts)
                ]);
            } catch (\Exception $calcError) {
                Log::error('Calculation failed', [
                    'error' => $calcError->getMessage(),
                    'clean_details' => $cleanDetails
                ]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to calculate total: ' . $calcError->getMessage(),
                        'error_code' => 'CALCULATION_ERROR'
                    ], 422);
                }
                return back()->withErrors(['total_amount' => 'Failed to calculate total'])->withInput();
            }

            // Validasi minimum total
            if ($calculatedTotal <= 0) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Total amount must be greater than 0',
                        'error_code' => 'INVALID_TOTAL'
                    ], 422);
                }
                return back()->withErrors(['total_amount' => 'Total amount must be greater than 0'])->withInput();
            }

            // **FIX 6: Safe voucher lookup**
            $voucher = Voucher::find($id);
            if (!$voucher) {
                Log::error('Voucher not found', ['voucher_id' => $id]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Voucher not found',
                        'error_code' => 'VOUCHER_NOT_FOUND'
                    ], 404);
                }
                return redirect()->route('dashboard')->withErrors(['error' => 'Voucher not found']);
            }

            $oldTotal = $voucher->total_amount;

            // **FIX 7: Database Transaction with proper error handling**
            DB::transaction(function () use ($request, $voucher, $calculatedTotal, $cleanDetails, $cleanDeletedDetails) {

                // Update voucher dengan calculated total
                $voucher->update([
                    'date' => (string) $request->input('date'),
                    'bank_name' => (string) $request->input('bank_name'),
                    'bank_code' => (string) $request->input('bank_code'),
                    'from_to' => (string) $request->input('from_to'),
                    'description' => (string) $request->input('description'),
                    'terbilang' => (string) $request->input('terbilang'),
                    'reference_number' => $request->input('reference_number') ? (string) $request->input('reference_number') : null,
                    'total_amount' => $calculatedTotal,
                ]);

                Log::info('Voucher updated successfully', [
                    'voucher_id' => $voucher->id,
                    'new_total' => $calculatedTotal
                ]);

                // Handle deleted details
                if (!empty($cleanDeletedDetails)) {
                    $deletedCount = VoucherDetail::whereIn('id', $cleanDeletedDetails)
                        ->where('voucher_id', $voucher->id)
                        ->delete();

                    Log::info("Deleted {$deletedCount} details", [
                        'deleted_ids' => $cleanDeletedDetails
                    ]);
                }

                // Handle detail updates/inserts
                $processedDetails = [];

                foreach ($cleanDetails as $index => $detailData) {
                    // Skip invalid details
                    if (
                        empty($detailData['account_number']) ||
                        empty($detailData['account_name']) ||
                        $detailData['amount'] <= 0
                    ) {
                        Log::warning("Skipping invalid detail at index {$index}", $detailData);
                        continue;
                    }

                    $detailAttributes = [
                        'voucher_id' => $voucher->id,
                        'account_number' => trim((string) $detailData['account_number']),
                        'account_name' => trim((string) $detailData['account_name']),
                        'amount' => round((float) $detailData['amount'], 2),
                    ];

                    try {
                        if (!empty($detailData['id']) && is_numeric($detailData['id'])) {
                            // Update existing detail
                            $detail = VoucherDetail::where('id', $detailData['id'])
                                ->where('voucher_id', $voucher->id)
                                ->first();

                            if ($detail) {
                                $detail->update($detailAttributes);
                                $processedDetails[] = [
                                    'action' => 'updated',
                                    'id' => $detail->id,
                                    'attributes' => $detailAttributes
                                ];
                                Log::info("Updated detail ID: {$detail->id}");
                            } else {
                                Log::warning("Detail ID {$detailData['id']} not found or belongs to different voucher");
                            }
                        } else {
                            // Create new detail
                            $newDetail = VoucherDetail::create($detailAttributes);
                            $processedDetails[] = [
                                'action' => 'created',
                                'id' => $newDetail->id,
                                'attributes' => $detailAttributes
                            ];
                            Log::info("Created new detail ID: {$newDetail->id}");
                        }
                    } catch (\Exception $detailError) {
                        Log::error("Failed to process detail at index {$index}", [
                            'error' => $detailError->getMessage(),
                            'detail_data' => $detailData
                        ]);
                        throw $detailError; // Re-throw to rollback transaction
                    }
                }

                Log::info("Processed " . count($processedDetails) . " details for voucher {$voucher->id}");
            });

            // **STEP: VERIFICATION**
            $finalDetailsSum = VoucherDetail::where('voucher_id', $voucher->id)->sum('amount');
            $finalDetailsSum = round($finalDetailsSum, 2);

            if (abs($finalDetailsSum - $calculatedTotal) > 0.01) {
                $voucher->update(['total_amount' => $finalDetailsSum]);
                Log::warning('Total amount adjusted after save', [
                    'voucher_id' => $voucher->id,
                    'calculated_total' => $calculatedTotal,
                    'final_details_sum' => $finalDetailsSum,
                    'difference' => abs($finalDetailsSum - $calculatedTotal)
                ]);
                $calculatedTotal = $finalDetailsSum;
            }

            // Reload voucher
            $voucher->load('details');

            Log::info('Voucher update completed successfully', [
                'voucher_id' => $voucher->id,
                'voucher_number' => $voucher->voucher_number,
                'old_total' => $oldTotal,
                'new_total' => $calculatedTotal,
                'details_count' => $voucher->details->count()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Voucher updated successfully!',
                    'data' => [
                        'voucher' => $voucher,
                        'calculated_total' => $calculatedTotal,
                        'final_details_sum' => $finalDetailsSum,
                        'details_count' => $voucher->details->count(),
                        'total_changed' => abs($calculatedTotal - $oldTotal) > 0.01,
                        'old_total' => $oldTotal,
                        'new_total' => $calculatedTotal
                    ]
                ]);
            }

            return redirect()->route('dashboard')
                ->with('success', 'Voucher updated successfully! Total: Rp ' . number_format($calculatedTotal, 0, ',', '.'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Voucher not found', [
                'voucher_id' => $id,
                'error' => $e->getMessage()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Voucher not found',
                    'error_code' => 'VOUCHER_NOT_FOUND'
                ], 404);
            }

            return redirect()->route('dashboard')
                ->withErrors(['error' => 'Voucher not found']);
        } catch (\Exception $e) {
            Log::error('Voucher update failed', [
                'voucher_id' => $id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_summary' => [
                    'method' => $request->method(),
                    'has_details' => $request->has('details'),
                    'details_type' => gettype($request->input('details')),
                    'details_count' => is_array($request->input('details')) ? count($request->input('details')) : 'not_array'
                ]
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Update failed: ' . $e->getMessage(),
                    'error_code' => 'VOUCHER_UPDATE_ERROR',
                    'debug_info' => [
                        'error_type' => get_class($e),
                        'error_line' => $e->getLine(),
                        'error_file' => basename($e->getFile())
                    ]
                ], 500);
            }

            return back()
                ->withErrors(['error' => 'Update failed: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
