<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\VoucherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Get voucher statistics
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $type = $request->get('type');
        $search = $request->get('search');

        // Build query for vouchers with details
        $query = Voucher::with(['details' => function ($query) {
            $query->orderBy('line_number');
        }]);

        // Apply filters
        if ($dateFrom && $dateTo) {
            $query->whereBetween('date', [$dateFrom, $dateTo]);
        }

        if ($type && in_array($type, ['receive', 'payment'])) {
            $query->where('type', $type);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('voucher_number', 'like', "%{$search}%")
                    ->orWhere('from_to', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('reference_number', 'like', "%{$search}%");
            });
        }

        // Get paginated vouchers
        $vouchers = $query->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Calculate statistics
        $stats = $this->getVoucherStatistics($dateFrom, $dateTo);

        // Get all voucher details for the current page (flattened view)
        $voucherDetails = $this->getFlattenedVoucherData($vouchers);

        return view('welcome', compact('vouchers', 'voucherDetails', 'stats', 'dateFrom', 'dateTo', 'type', 'search'));
    }

    /**
     * Get voucher statistics
     */
    private function getVoucherStatistics($dateFrom = null, $dateTo = null)
    {
        $query = Voucher::query();

        if ($dateFrom && $dateTo) {
            $query->whereBetween('date', [$dateFrom, $dateTo]);
        }

        $stats = [
            'total_vouchers' => $query->count(),
            'receive_vouchers' => (clone $query)->where('type', 'receive')->count(),
            'payment_vouchers' => (clone $query)->where('type', 'payment')->count(),
            'total_receive_amount' => (clone $query)->where('type', 'receive')->sum('total_amount'),
            'total_payment_amount' => (clone $query)->where('type', 'payment')->sum('total_amount'),
        ];

        $stats['net_amount'] = $stats['total_receive_amount'] - $stats['total_payment_amount'];

        return $stats;
    }

    /**
     * Get flattened voucher data (each row represents a voucher detail)
     * Group details by voucher but show delete button only on first detail row
     */
    private function getFlattenedVoucherData($vouchers)
    {
        $flattenedData = [];

        foreach ($vouchers as $voucher) {
            $detailCount = $voucher->details->count();

            foreach ($voucher->details as $index => $detail) {
                $flattenedData[] = [
                    'voucher' => $voucher,
                    'detail' => $detail,
                    'is_first_detail' => $index === 0, // Only show action buttons on first detail
                    'detail_count' => $detailCount, // For rowspan if needed
                    'detail_index' => $index
                ];
            }
        }

        return collect($flattenedData);
    }

    /**
     * Export voucher data to Excel
     */
    public function exportExcel(Request $request)
    {
        try {
            // Get filter parameters
            $dateFrom = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $type = $request->get('type');

            // Build query
            $query = VoucherDetail::with('voucher');

            if ($dateFrom && $dateTo) {
                $query->whereHas('voucher', function ($q) use ($dateFrom, $dateTo) {
                    $q->whereBetween('date', [$dateFrom, $dateTo]);
                });
            }

            if ($type && in_array($type, ['receive', 'payment'])) {
                $query->whereHas('voucher', function ($q) use ($type) {
                    $q->where('type', $type);
                });
            }

            $voucherDetails = $query->orderBy('id')->get();

            // Create output stream
            $output = fopen('php://temp', 'w');

            // Add BOM for UTF-8 Excel compatibility
            fwrite($output, "\xEF\xBB\xBF");

            // **Company Header (Optional - can be skipped if not needed)**
            fputcsv($output, ['PT EDVISOR PRIME SOLUTION']);
            fputcsv($output, []); // Empty row

            // **Main Header Row - Matching the provided layout exactly**
            fputcsv($output, [
                'Date',
                'No. Voucher',
                'Ref. No.',
                'Receive From',
                'Description',
                'Cash/Bank',
                'Acc. No.',
                'Acc. Name',
                'Debit',
                'Kredit'
            ]);

            $totalDebit = 0;
            $totalKredit = 0;

            // **Data rows - Following the exact format from the image**
            foreach ($voucherDetails as $detail) {
                $voucher = $detail->voucher;
                $isReceive = $voucher->type == 'receive';

                // Determine debit/credit placement
                $debitAmount = $isReceive ? $detail->amount : 0;
                $kreditAmount = !$isReceive ? $detail->amount : 0;

                // Add to totals
                $totalDebit += $debitAmount;
                $totalKredit += $kreditAmount;

                // Format amounts - show only if > 0, otherwise empty
                $debitFormatted = $debitAmount > 0 ? number_format($debitAmount, 0, ',', '.') : '';
                $kreditFormatted = $kreditAmount > 0 ? number_format($kreditAmount, 0, ',', '.') : '';

                fputcsv($output, [
                    $voucher->date->format('d M Y'), // Format: 21 Mei 2025
                    $voucher->voucher_number,        // RV-3/2025/06/0001 or PV-2/2025/06/001
                    $voucher->reference_number ?: '-', // Reference or dash
                    $voucher->from_to,               // PT Edvisor Profina Visindo
                    $voucher->description,           // Penerimaan Modal Disetor dari PT Edvisor...
                    $voucher->bank_name,             // Bank Mandiri, BNI, etc.
                    $detail->account_number,         // 1-10001, 3-30001, etc.
                    $detail->account_name,           // Bank Mandiri, Modal Disetor, etc.
                    $debitFormatted,                 // 200,000,000 or empty
                    $kreditFormatted                 // 200,000,000 or empty
                ]);
            }

            // **Add totals row if needed**
            if ($voucherDetails->count() > 0) {
                fputcsv($output, []); // Empty row
                fputcsv($output, [
                    'TOTAL:',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    number_format($totalDebit, 0, ',', '.'),
                    number_format($totalKredit, 0, ',', '.')
                ]);
            }

            // Get CSV content
            rewind($output);
            $csvContent = stream_get_contents($output);
            fclose($output);

            // Generate filename
            $filename = 'PT_EDVISOR_VOUCHER_REPORT';
            if ($type) {
                $filename .= '_' . strtoupper($type);
            }
            if ($dateFrom && $dateTo) {
                $filename .= '_' . str_replace('-', '', $dateFrom) . '_to_' . str_replace('-', '', $dateTo);
            }
            $filename .= '_' . date('Ymd_His') . '.csv';

            return response($csvContent)
                ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
                ->header('Content-Disposition', "attachment; filename=\"{$filename}\"")
                ->header('Cache-Control', 'no-cache, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        } catch (\Exception $e) {
            Log::error('Export Excel failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'filters' => $request->all()
            ]);

            return back()->withErrors(['error' => 'Failed to export data: ' . $e->getMessage()]);
        }
    }

    // **Alternative: Excel export with more detailed formatting to match exactly**
    public function exportExcelDetailed(Request $request)
    {
        try {
            // Get filter parameters
            $dateFrom = $request->get('date_from');
            $dateTo = $request->get('date_to');
            $type = $request->get('type');

            // Build query
            $query = VoucherDetail::with('voucher');

            if ($dateFrom && $dateTo) {
                $query->whereHas('voucher', function ($q) use ($dateFrom, $dateTo) {
                    $q->whereBetween('date', [$dateFrom, $dateTo]);
                });
            }

            if ($type && in_array($type, ['receive', 'payment'])) {
                $query->whereHas('voucher', function ($q) use ($type) {
                    $q->where('type', $type);
                });
            }

            $voucherDetails = $query->orderBy('id')->get();

            // **Create formatted CSV exactly matching the image**
            $csvLines = [];

            // Company header
            $csvLines[] = "PT EDVISOR PRIME SOLUTION";
            $csvLines[] = ""; // Empty line

            // Header row
            $csvLines[] = "Date,No. Voucher,Ref. No.,Receive From,Description,Cash/Bank,Acc. No.,Acc. Name,Debit,Kredit";

            $totalDebit = 0;
            $totalKredit = 0;

            foreach ($voucherDetails as $detail) {
                $voucher = $detail->voucher;
                $isReceive = $voucher->type == 'receive';

                // Calculate amounts
                $debitAmount = $isReceive ? $detail->amount : 0;
                $kreditAmount = !$isReceive ? $detail->amount : 0;

                $totalDebit += $debitAmount;
                $totalKredit += $kreditAmount;

                // Format date to match "21 Mei 2025"
                $dateFormatted = $voucher->date->format('d M Y');

                // Format amounts - only show if > 0
                $debitFormatted = $debitAmount > 0 ? number_format($debitAmount, 0, ',', '.') : '';
                $kreditFormatted = $kreditAmount > 0 ? number_format($kreditAmount, 0, ',', '.') : '';

                // Escape CSV values properly
                $row = [
                    $dateFormatted,
                    $voucher->voucher_number,
                    $voucher->reference_number ?: '-',
                    '"' . str_replace('"', '""', $voucher->from_to) . '"',
                    '"' . str_replace('"', '""', $voucher->description) . '"',
                    $voucher->bank_name,
                    $detail->account_number,
                    '"' . str_replace('"', '""', $detail->account_name) . '"',
                    $debitFormatted,
                    $kreditFormatted
                ];

                $csvLines[] = implode(',', $row);
            }

            // Add totals if there's data
            if (count($csvLines) > 3) { // More than just headers
                $csvLines[] = ""; // Empty line
                $csvLines[] = sprintf(
                    'TOTAL:,,,,,,,,%s,%s',
                    number_format($totalDebit, 0, ',', '.'),
                    number_format($totalKredit, 0, ',', '.')
                );
            }

            // Join all lines
            $csvContent = "\xEF\xBB\xBF" . implode("\n", $csvLines);

            // Generate filename
            $filename = 'PT_EDVISOR_VOUCHER_' . date('d_M_Y_His') . '.csv';

            return response($csvContent)
                ->header('Content-Type', 'application/vnd.ms-excel; charset=UTF-8')
                ->header('Content-Disposition', "attachment; filename=\"{$filename}\"")
                ->header('Cache-Control', 'no-cache, must-revalidate');
        } catch (\Exception $e) {
            Log::error('Detailed Export Excel failed', [
                'error' => $e->getMessage(),
                'filters' => $request->all()
            ]);

            return back()->withErrors(['error' => 'Failed to export data: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete voucher detail only
     */
    public function deleteVoucherDetail($id)
    {
        try {
            $voucherDetail = VoucherDetail::findOrFail($id);
            $voucher = $voucherDetail->voucher;
            $detailInfo = $voucherDetail->account_number . ' - ' . $voucherDetail->account_name;
            $voucherNumber = $voucher->voucher_number;
            Log::info('Attempting to delete voucher detail', [
                'detail_id' => $id,
                'voucher_id' => $voucher->id,
                'account_number' => $voucherDetail->account_number
            ]);

            // Check if this is the last detail
            if ($voucher->details()->count() <= 1) {
                $voucherDetail->delete();
                $voucher->delete();
                if (request()->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => "Last detail deleted. Voucher {$voucherNumber} has been automatically deleted.",
                        'voucher_deleted' => true
                    ]);
                }

                return back()->with('success', "Last detail deleted. Voucher {$voucherNumber} has been automatically deleted.");
            }

            $voucherDetail->delete();

            // Recalculate voucher total
            $voucher->updateTotal();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Detail {$detailInfo} deleted successfully."
                ]);
            }

            return back()->with('success', "Detail {$detailInfo} deleted successfully.");
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete detail: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Failed to delete detail: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete entire voucher
     */
    public function deleteVoucher($id)
    {
        try {
            $voucher = Voucher::findOrFail($id);
            $voucherNumber = $voucher->voucher_number;

            $voucher->delete(); // Will also delete details due to cascade

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Voucher {$voucherNumber} deleted successfully."
                ]);
            }

            return back()->with('success', "Voucher {$voucherNumber} deleted successfully.");
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete voucher: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Failed to delete voucher: ' . $e->getMessage()]);
        }
    }

    /**
     * Get voucher data for editing
     */
    public function getVoucherData($id)
    {
        try {
            $voucher = Voucher::with('details')->findOrFail($id);

            return response()->json([
                'success' => true,
                'voucher' => $voucher
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher not found.'
            ], 404);
        }
    }

    /**
     * Get dashboard statistics for AJAX
     */
    public function getStatistics(Request $request)
    {
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $stats = $this->getVoucherStatistics($dateFrom, $dateTo);

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }

    /**
     * Search vouchers
     */
    public function searchVouchers(Request $request)
    {
        $search = $request->get('q', '');
        $type = $request->get('type', '');

        $query = Voucher::with('details');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('voucher_number', 'like', "%{$search}%")
                    ->orWhere('from_to', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('reference_number', 'like', "%{$search}%");
            });
        }

        if (!empty($type)) {
            $query->where('type', $type);
        }

        $vouchers = $query->orderBy('date', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'vouchers' => $vouchers
        ]);
    }
}
