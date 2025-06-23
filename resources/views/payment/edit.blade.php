<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Payment Voucher - PT EDVISOR PRIME SOLUTION</title>
    
    <!-- jQuery and Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            padding: 20px;
            line-height: 1.5;
        }

        .page-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .back-btn {
            background: #64748b;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: #475569;
            transform: translateY(-1px);
        }

        .page-title h1 {
            font-size: 28px;
            color: #1e293b;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            background: #475569;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn.update { 
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .btn.update:hover:not(:disabled) { 
            background: linear-gradient(135deg, #d97706, #b45309);
        }

        .btn.delete { 
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
        .btn.delete:hover:not(:disabled) { 
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }

        .container {
            background-color: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .header {
            display: flex;
            align-items: center;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
            gap: 15px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
        }

        .logo {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, #10b981, #059669);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            font-size: 22px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .company-name {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            padding: 25px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            margin: 0;
        }

        .form-content {
            padding: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .form-field {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 15px;
        }

        .form-field.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            min-width: 100px;
            font-size: 14px;
            padding-top: 8px;
        }

        .form-colon {
            font-weight: 600;
            color: #6b7280;
            padding-top: 8px;
        }

        .form-input-wrapper {
            flex: 1;
        }

        .form-input {
            border: 1px solid #e2e8f0;
            outline: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input[readonly] {
            background-color: #f9fafb;
            color: #6b7280;
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .bank-group {
            display: flex;
            gap: 8px;
            width: 100%;
        }

        .bank-code {
            width: 80px;
            border: 1px solid #e2e8f0;
            outline: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            background-color: #f9fafb;
            color: #6b7280;
            font-weight: 600;
        }

        .bank-select {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 8px 12px;
            font-size: 14px;
            color: #374151;
            font-weight: 500;
            border-radius: 6px;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .bank-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .bank-select:hover {
            border-color: #94a3b8;
        }

        .bank-select.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .account-section {
            margin-top: 30px;
        }

        .account-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .account-table th,
        .account-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
        }

        .account-table th {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            font-weight: 600;
            text-align: center;
            color: #374151;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        .account-table .amount {
            text-align: right;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        .account-table input {
            border: none;
            width: 100%;
            background: transparent;
            outline: none;
            padding: 4px;
            font-size: 14px;
        }

        .account-table input:focus {
            background: #f8fafc;
            border-radius: 4px;
        }

        .account-table input.error {
            background: #fef2f2;
            border: 1px solid #ef4444;
            border-radius: 4px;
        }

        .account-table .amount-input {
            text-align: right;
            font-family: 'Courier New', monospace;
        }

        .add-row-btn {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            margin: 15px 0;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .add-row-btn:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .delete-row-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 4px 8px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: 600;
            margin-left: 8px;
        }

        .delete-row-btn:hover {
            background: #dc2626;
        }

        .total-section {
            border-top: 1px solid #e2e8f0;
            padding: 0;
            margin-top: 20px;
            background: #f8fafc;
            border-radius: 0 0 8px 8px;
        }

        .total-field {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            gap: 10px;
        }

        .total-label {
            font-weight: 600;
            color: #374151;
            min-width: 100px;
        }

        .total-colon {
            font-weight: 600;
            color: #6b7280;
        }

        .total-content {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .total-words-input {
            flex: 1;
            border: 1px solid #e2e8f0;
            outline: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #374151;
        }

        .total-words-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .total-words-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .total-amount {
            font-weight: 700;
            border-top: 2px solid #374151;
            padding-top: 8px;
            font-size: 16px;
            color: #1e293b;
            font-family: 'Courier New', monospace;
            min-width: 150px;
            text-align: right;
        }

        /* Validation Error Messages */
        label.error {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
            display: block;
            font-weight: normal;
        }

        /* Loading State */
        .loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #e2e8f0;
            border-top: 2px solid #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Success/Error Messages */
        .alert {
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert-warning {
            background: #fefbf2;
            border: 1px solid #fed7aa;
            color: #ea580c;
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 10px;
            }

            .page-header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .action-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }

            .header {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }

            .form-content {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .btn {
                padding: 10px 16px;
                font-size: 13px;
            }

            .bank-group {
                flex-direction: column;
                gap: 8px;
            }

            .bank-code, .bank-select {
                width: 100%;
            }

            .total-content {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
            }

            .total-amount {
                text-align: center;
            }
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .page-header {
                display: none;
            }

            .add-row-btn, .delete-row-btn {
                display: none;
            }

            .container {
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <!-- Page Header with Actions -->
        <div class="page-header">
            <div class="page-title">
                <a href="{{ route('dashboard') }}" class="back-btn">
                    ← Back to Dashboard
                </a>
                <h1>Edit Payment Voucher</h1>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" class="btn update" id="updateBtn">
                    💾 Update
                </button>
                <button type="button" class="btn delete" id="deleteBtn" onclick="deleteVoucher()">
                    🗑️ Delete
                </button>
            </div>
        </div>

        <!-- Alert Messages -->
        <div id="alertContainer"></div>

        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="logo">A</div>
                <div class="company-name">PT EDVISOR PRIME SOLUTION</div>
            </div>

            <!-- Form Title -->
            <div class="form-title">EDIT Payment VOUCHER</div>

            <!-- Form Content -->
            <form id="voucherForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="payment">
                <input type="hidden" name="voucher_id" value="{{ $voucher->id ?? '' }}">
                
                <div class="form-content">
                    <!-- Form Grid -->
                    <div class="form-grid">
                        <!-- No. Voucher -->
                        <div class="form-field">
                            <label class="form-label">No. Voucher</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="voucher_number" class="form-input" readonly
                                       value="{{ $voucher->voucher_number ?? '' }}" 
                                       style="background-color: #f9fafb; font-weight: 600; color: #059669;">
                            </div>
                        </div>

                        <!-- Referensi No. -->
                        <div class="form-field">
                            <label class="form-label">Referensi No.</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="reference_number" class="form-input" 
                                       value="{{ $voucher->reference_number ?? '' }}"
                                       placeholder="Enter reference number">
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="form-field">
                            <label class="form-label">Date</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="date" name="date" class="form-input" required
                                       value="{{ isset($voucher) && $voucher->date ? ($voucher->date instanceof \Carbon\Carbon ? $voucher->date->format('Y-m-d') : $voucher->date) : '' }}">
                            </div>
                        </div>

                        <!-- Cash / Bank -->
                        <div class="form-field">
                            <label class="form-label">Cash / Bank</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <div class="bank-group">
                                    <input type="text" name="bank_code" class="bank-code" id="bankCode" readonly 
                                           value="{{ $voucher->bank_code ?? '' }}" placeholder="Code">
                                    <select name="bank_name" class="bank-select" id="bankSelect" required>
                                        <option value="">Select Cash/Bank</option>
                                        <option value="Cash" data-code="1-10001" {{ ($voucher->bank_name ?? '') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Bank Mandiri" data-code="1-10002" {{ ($voucher->bank_name ?? '') == 'Bank Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                                        <option value="Bank BNI" data-code="1-10003" {{ ($voucher->bank_name ?? '') == 'Bank BNI' ? 'selected' : '' }}>Bank BNI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-field full-width">
                            <label class="form-label">Payment From</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="from_to" class="form-input" required 
                                       value="{{ $voucher->from_to ?? '' }}"
                                       placeholder="Enter payer name">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-field full-width">
                            <label class="form-label">Description</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="description" class="form-input" required 
                                       value="{{ $voucher->description ?? '' }}"
                                       placeholder="Enter description">
                            </div>
                        </div>
                    </div>

                    <!-- Account Table -->
                    <div class="account-section">
                        <table class="account-table">
                            <thead>
                                <tr>
                                    <th style="width: 120px;">Acc. No.</th>
                                    <th>Acc. Name</th>
                                    <th style="width: 150px;">Amount</th>
                                    <th style="width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="accountTableBody">
                                @if(isset($voucher) && $voucher->details && $voucher->details->count() > 0)
                                    @foreach($voucher->details as $index => $detail)
                                    <tr class="account-row" data-detail-id="{{ $detail->id }}">
                                        <td>
                                            <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">
                                            <input type="text" name="details[{{ $index }}][account_number]" 
                                                   value="{{ $detail->account_number }}"
                                                   placeholder="Account No." class="account-number-input" required>
                                        </td>
                                        <td>
                                            <input type="text" name="details[{{ $index }}][account_name]" 
                                                   value="{{ $detail->account_name }}"
                                                   placeholder="Account Name" class="account-name-input" required>
                                        </td>
                                        <td>
                                            <input type="number" name="details[{{ $index }}][amount]" 
                                                   value="{{ $detail->amount }}"
                                                   placeholder="0" class="amount-input" step="0.01" min="0" required>
                                        </td>
                                        <td>
                                            <button type="button" class="delete-row-btn" onclick="deleteAccountRow(this)">
                                                🗑️
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr class="account-row">
                                        <td>
                                            <input type="hidden" name="details[0][id]" value="">
                                            <input type="text" name="details[0][account_number]" 
                                                   placeholder="Account No." class="account-number-input" required>
                                        </td>
                                        <td>
                                            <input type="text" name="details[0][account_name]" 
                                                   placeholder="Account Name" class="account-name-input" required>
                                        </td>
                                        <td>
                                            <input type="number" name="details[0][amount]" 
                                                   placeholder="0" class="amount-input" step="0.01" min="0" required>
                                        </td>
                                        <td>
                                            <button type="button" class="delete-row-btn" onclick="deleteAccountRow(this)">
                                                🗑️
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <button type="button" class="add-row-btn" onclick="addAccountRow()">
                            ➕ Add Account Row
                        </button>
                    </div>

                    <!-- Total Section -->
                    <div class="total-section">
                        <div class="total-field">
                            <label class="total-label">Terbilang</label>
                            <span class="total-colon">:</span>
                            <div class="total-content">
                                <input type="text" name="terbilang" class="total-words-input" required
                                       value="{{ $voucher->terbilang ?? '' }}"
                                       placeholder="Enter amount in words (e.g., Dua Ratus Juta Rupiah)" 
                                       id="totalWordsInput">
                                <div class="total-amount">
                                    Rp <span id="totalAmount">{{ isset($voucher) ? number_format($voucher->total_amount, 0, ',', '.') : '0' }}</span>
                                    <input type="hidden" name="total_amount" id="totalAmountInput" value="{{ $voucher->total_amount ?? '0' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Set CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Initialize form validation
            initializeValidation();

            // Event handlers
            $('#bankSelect').on('change', updateBankCode);
            $(document).on('input', '.amount-input', calculateTotal);
            $('#updateBtn').on('click', updateVoucher);

            // Initialize calculations
            calculateTotal();
            updateBankCode();
            
            // Debug log
            console.log('Form initialized. Voucher ID:', $('input[name="voucher_id"]').val());
        });

        // Initialize jQuery Validation
        function initializeValidation() {
            $('#voucherForm').validate({
                rules: {
                    date: {
                        required: true,
                        date: true
                    },
                    bank_name: {
                        required: true
                    },
                    from_to: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    description: {
                        required: true,
                        minlength: 5
                    },
                    terbilang: {
                        required: true,
                        minlength: 5
                    },
                    reference_number: {
                        maxlength: 255
                    },
                    total_amount: {
                        required: true,
                        number: true,
                        min: 0.01
                    }
                },
                messages: {
                    date: {
                        required: "Date is required",
                        date: "Please enter a valid date"
                    },
                    bank_name: {
                        required: "Please select Cash/Bank"
                    },
                    from_to: {
                        required: "Payment From is required",
                        minlength: "Please enter at least 2 characters",
                        maxlength: "Maximum 255 characters allowed"
                    },
                    description: {
                        required: "Description is required",
                        minlength: "Please enter at least 5 characters"
                    },
                    terbilang: {
                        required: "Amount in words is required",
                        minlength: "Please enter at least 5 characters"
                    },
                    reference_number: {
                        maxlength: "Maximum 255 characters allowed"
                    },
                    total_amount: {
                        required: "Total amount is required",
                        number: "Please enter a valid amount",
                        min: "Total amount must be greater than 0"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('bank-select')) {
                        error.insertAfter(element.closest('.bank-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass('error');
                },
                unhighlight: function(element) {
                    $(element).removeClass('error');
                },
                submitHandler: function(form) {
                    return false;
                }
            });

            addAccountRowValidation();
        }

        function addAccountRowValidation() {
            $('.account-number-input').each(function() {
                $(this).rules('add', {
                    required: true,
                    maxlength: 50,
                    messages: {
                        required: "Account number is required",
                        maxlength: "Maximum 50 characters allowed"
                    }
                });
            });

            $('.account-name-input').each(function() {
                $(this).rules('add', {
                    required: true,
                    minlength: 2,
                    maxlength: 255,
                    messages: {
                        required: "Account name is required",
                        minlength: "Please enter at least 2 characters",
                        maxlength: "Maximum 255 characters allowed"
                    }
                });
            });

            $('.amount-input').each(function() {
                $(this).rules('add', {
                    required: true,
                    number: true,
                    min: 0.01,
                    messages: {
                        required: "Amount is required",
                        number: "Please enter a valid amount",
                        min: "Amount must be greater than 0"
                    }
                });
            });
        }

        // Update bank code based on selection
        function updateBankCode() {
            const bankSelect = $('#bankSelect');
            const bankCode = $('#bankCode');
            const selectedOption = bankSelect.find('option:selected');
            
            const code = selectedOption.data('code') || selectedOption.attr('data-code') || '';
            bankCode.val(code);
        }

        // Add new account row
        function addAccountRow() {
            const tableBody = $('#accountTableBody');
            const rowCount = tableBody.find('.account-row').length;
            
            const newRow = `
                <tr class="account-row">
                    <td>
                        <input type="hidden" name="details[${rowCount}][id]" value="">
                        <input type="text" name="details[${rowCount}][account_number]" 
                               placeholder="Account No." class="account-number-input" required>
                    </td>
                    <td>
                        <input type="text" name="details[${rowCount}][account_name]" 
                               placeholder="Account Name" class="account-name-input" required>
                    </td>
                    <td>
                        <input type="number" name="details[${rowCount}][amount]" 
                               placeholder="0" class="amount-input" step="0.01" min="0" required>
                    </td>
                    <td>
                        <button type="button" class="delete-row-btn" onclick="deleteAccountRow(this)">
                            🗑️
                        </button>
                    </td>
                </tr>
            `;
            
            tableBody.append(newRow);
            addAccountRowValidation();
            tableBody.find('.account-row:last .account-number-input').focus();
        }

        // Delete account row
        function deleteAccountRow(button) {
            const row = $(button).closest('.account-row');
            const tableBody = $('#accountTableBody');
            
            if (tableBody.find('.account-row').length <= 1) {
                showAlert('Cannot delete the last row', 'warning');
                return;
            }
            
            // Check if this is an existing detail (has ID)
            const detailId = row.find('input[name*="[id]"]').val();
            if (detailId && detailId !== '') {
                if (!confirm('Are you sure you want to delete this account detail? This action cannot be undone.')) {
                    return;
                }
                
                // Mark for deletion by adding a hidden field
                row.append(`<input type="hidden" name="deleted_details[]" value="${detailId}">`);
                row.hide();
            } else {
                // New row, just remove it
                row.remove();
            }
            
            updateRowIndices();
            calculateTotal();
        }

        // Update row indices after deletion
        function updateRowIndices() {
            $('#accountTableBody .account-row:visible').each(function(index) {
                const detailId = $(this).find('input[name*="[id]"]').val();
                $(this).find('input[name*="[id]"]').attr('name', `details[${index}][id]`);
                $(this).find('input[name*="[account_number]"]').attr('name', `details[${index}][account_number]`);
                $(this).find('input[name*="[account_name]"]').attr('name', `details[${index}][account_name]`);
                $(this).find('input[name*="[amount]"]').attr('name', `details[${index}][amount]`);
            });
        }

        // Calculate total amount
        function calculateTotal() {
            let total = 0;
            
            $('.account-row:visible .amount-input').each(function() {
                const value = parseFloat($(this).val()) || 0;
                total += value;
            });

            // Round to 2 decimal places to avoid floating point issues
            total = Math.round(total * 100) / 100;
            
            // Update display
            $('#totalAmount').text(total.toLocaleString('id-ID'));
            $('#totalAmountInput').val(total);
        }

        // Update voucher with proper URL handling
        function updateVoucher() {
            // Force calculate total
            calculateTotal();
            
            // Get voucher ID
            const voucherId = $('input[name="voucher_id"]').val();
            if (!voucherId) {
                showAlert('Voucher ID not found. Please refresh the page.', 'error');
                return;
            }
            
            // Validate form
            if (!$('#voucherForm').valid() || !validateAccountRows()) {
                showAlert('Please fix validation errors before submitting.', 'warning');
                return;
            }
            
            // Build the correct URL for Laravel PUT route
            const updateUrl = `/payment-voucher/${voucherId}`;
            
            // Manually build form data
            const formElement = document.getElementById('voucherForm');
            const formData = new FormData(formElement);
            
            // Ensure total amount is properly formatted
            const total = parseFloat($('#totalAmountInput').val()) || 0;
            formData.set('total_amount', total.toString());
            
            console.log('=== UPDATE REQUEST ===');
            console.log('Voucher ID:', voucherId);
            console.log('Update URL:', updateUrl);
            console.log('Total Amount:', total);
            console.log('Method Override:', formData.get('_method'));
            
            $('#updateBtn').prop('disabled', true).addClass('loading');
            
            $.ajax({
                url: updateUrl,
                method: 'POST', // Laravel uses POST with _method override
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('=== UPDATE SUCCESS ===', response);
                    if (response.success) {
                        showAlert(response.message || 'Voucher updated successfully!', 'success');
                        setTimeout(function() {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 2000);
                    } else {
                        showAlert(response.message || 'Failed to update voucher.', 'error');
                    }
                },
                error: function(xhr) {
                    console.log('=== UPDATE ERROR ===');
                    console.log('Status:', xhr.status);
                    console.log('Response:', xhr.responseJSON);
                    
                    let message = 'Update failed: ';
                    
                    if (xhr.status === 405) {
                        message = 'Route method not allowed. Please check your Laravel routes.';
                    } else if (xhr.status === 404) {
                        message = 'Voucher not found. It may have been deleted.';
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        message += xhr.responseJSON.message;
                    } else {
                        message += `HTTP ${xhr.status} error occurred.`;
                    }
                    
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(field) {
                            message += '\n' + field + ': ' + (Array.isArray(errors[field]) ? errors[field].join(', ') : errors[field]);
                        });
                    }
                    
                    showAlert(message, 'error');
                },
                complete: function() {
                    $('#updateBtn').prop('disabled', false).removeClass('loading');
                }
            });
        }

        // Delete entire voucher
        function deleteVoucher() {
            const voucherId = $('input[name="voucher_id"]').val();
            const voucherNumber = $('input[name="voucher_number"]').val();
            
            if (!voucherId) {
                showAlert('Voucher ID not found. Please refresh the page.', 'error');
                return;
            }
            
            if (confirm(`Are you sure you want to DELETE voucher ${voucherNumber}?\n\nThis will permanently delete the entire voucher and all its details.\n\nThis action cannot be undone.`)) {
                const deleteUrl = `/dashboard/voucher/${voucherId}`;
                
                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            showAlert(response.message, 'success');
                            setTimeout(function() {
                                window.location.href = "{{ route('dashboard') }}";
                            }, 2000);
                        } else {
                            showAlert(response.message || 'Failed to delete voucher', 'error');
                        }
                    },
                    error: function(xhr) {
                        let message = 'Failed to delete voucher';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        showAlert(message, 'error');
                    }
                });
            }
        }

        // Validate account rows
        function validateAccountRows() {
            const visibleRows = $('#accountTableBody .account-row:visible');
            let valid = true;
            
            if (visibleRows.length === 0) {
                showAlert('Please add at least one account row.', 'warning');
                return false;
            }
            
            visibleRows.each(function() {
                const accountNumber = $(this).find('.account-number-input').val().trim();
                const accountName = $(this).find('.account-name-input').val().trim();
                const amount = parseFloat($(this).find('.amount-input').val()) || 0;
                
                if (!accountNumber || !accountName || amount <= 0) {
                    valid = false;
                    return false;
                }
            });
            
            if (!valid) {
                showAlert('All account rows must have valid account number, name, and amount greater than 0.', 'warning');
            }
            
            return valid;
        }

        // Show alert messages
        function showAlert(message, type = 'info') {
            const alertClass = `alert-${type}`;
            const alertHtml = `
                <div class="alert ${alertClass}">
                    ${message}
                </div>
            `;
            
            $('#alertContainer').html(alertHtml);
            
            setTimeout(function() {
                $('#alertContainer').fadeOut(500, function() {
                    $(this).empty().show();
                });
            }, 5000);
        }
    </script>
</body>
</html>