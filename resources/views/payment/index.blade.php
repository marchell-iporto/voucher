<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Voucher - PT EDVISOR PRIME SOLUTION</title>

    <!-- jQuery and Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .btn.submit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .btn.submit:hover:not(:disabled) {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .container {
            background-color: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

            .bank-code,
            .bank-select {
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

            .add-row-btn,
            .delete-row-btn {
                display: none;
            }

            .container {
                box-shadow: none;
                border: 1px solid #000;
            }
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 8px 12px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px !important;
            padding-left: 0 !important;
            color: #374151 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 8px !important;
        }

        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 4px !important;
            padding: 8px !important;
        }

        .select2-results__option {
            padding: 8px 12px !important;
            font-size: 14px !important;
        }

        .select2-results__option--highlighted {
            background-color: #3b82f6 !important;
        }

        .select2-container--default .select2-selection--single:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
        }

        /* Custom styling untuk readonly account number */
        .account-number-display {
            background-color: #f5f5f5 !important;
            pointer-events: none !important;
            color: #6b7280 !important;
            font-weight: 600 !important;
        }

        .account-number-display .select2-selection__rendered {
            color: #6b7280 !important;
        }

        /* Loading state */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #9ca3af !important;
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
                <h1>Payment Voucher</h1>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button type="button" class="btn submit" id="submitBtn">
                    📤 Submit
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
            <div class="form-title">PAYMENT VOUCHER</div>

            <!-- Form Content -->
            <form id="voucherForm" method="POST" action="{{ route('payment.store') }}">
                @csrf
                <input type="hidden" name="type" value="payment">

                <div class="form-content">
                    <!-- Form Grid -->
                    <div class="form-grid">
                        <!-- No. Voucher -->
                        <div class="form-field">
                            <label class="form-label">No. Voucher</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="voucher_number" class="form-input" required
                                    value="{{ $voucherNumber ?? '' }}" placeholder="Enter voucher number">
                            </div>
                        </div>

                        <!-- Referensi No. -->
                        <div class="form-field">
                            <label class="form-label">Referensi No.</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="reference_number" class="form-input"
                                    placeholder="Enter reference number">
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="form-field">
                            <label class="form-label">Date</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="date" name="date" class="form-input" required>
                            </div>
                        </div>

                        <!-- Cash / Bank -->
                        <div class="form-field">
                            <label class="form-label">Cash / Bank</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <div class="bank-group">
                                    <input type="text" name="bank_code" class="bank-code" id="bankCode" readonly
                                        placeholder="Code">
                                    <select name="bank_name" class="bank-select" id="bankSelect" required>
                                        <option value="">Select Cash/Bank</option>
                                        <option value="Cash" data-code="1-10001">Cash</option>
                                        <option value="Bank Mandiri" data-code="1-10002">Bank Mandiri</option>
                                        <option value="Bank BNI" data-code="1-10003">Bank BNI</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Receive From -->
                        <div class="form-field full-width">
                            <label class="form-label">Payment To</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="from_to" class="form-input" required
                                    placeholder="Enter name">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-field full-width">
                            <label class="form-label">Description</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="description" class="form-input" required
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
                                @php
                                    use App\Models\MasterVoucher;
                                    $accounts = MasterVoucher::all();
                                @endphp

                                <tr class="account-row">
                                    <td>
                                        <!-- Account Number Display (Read-only) -->
                                        <select class="account-number-select account-number-display" disabled>
                                            <option value="">-- Otomatis Terisi --</option>
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->nomor_akun }}">{{ $account->nomor_akun }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Hidden input untuk form submission -->
                                        <input type="hidden" name="details[0][account_number]"
                                            class="account-number-hidden">
                                    </td>
                                    <td>
                                        <!-- Searchable Account Name Dropdown -->
                                        <select name="details[0][account_name]" class="account-name-select" required>
                                            <option value="">-- Pilih Account Name --</option>
                                            @foreach ($accounts as $account)
                                                <option value="{{ $account->nama_akun }}"
                                                    data-account-number="{{ $account->nomor_akun }}"
                                                    data-search="{{ strtolower($account->nomor_akun . ' ' . $account->nama_akun) }}">
                                                    {{ $account->nomor_akun }} - {{ $account->nama_akun }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="details[0][amount]" placeholder="0"
                                            class="amount-input" step="0.01" min="0" required>
                                    </td>
                                    <td>
                                        <button type="button" class="delete-row-btn"
                                            onclick="deleteAccountRow(this)">🗑️</button>
                                    </td>
                                </tr>

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
                                    placeholder="Enter amount in words (e.g., Dua Ratus Juta Rupiah)"
                                    id="totalWordsInput">
                                <div class="total-amount">
                                    Rp <span id="totalAmount">0</span>
                                    <input type="hidden" name="total_amount" id="totalAmountInput" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const accounts = @json($accounts);
    </script>

    <script>
        $(document).ready(function() {
            // Set CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            initializeSelect2();

            // Set today's date
            const today = new Date().toISOString().split('T')[0];
            $('input[name="date"]').val(today);

            // Initialize form validation
            initializeValidation();

            // Event handlers
            $('#bankSelect').on('change', updateBankCode);
            $(document).on('input', '.amount-input', calculateTotal);
            $('#submitBtn').on('click', submitVoucher);

            // Initialize total calculation
            calculateTotal();
        });

        // Initialize jQuery Validation
        function initializeValidation() {
            $('#voucherForm').validate({
                rules: {
                    voucher_number: {
                        required: true,
                        maxlength: 255
                    },
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
                    voucher_number: {
                        required: "Voucher number is required",
                        maxlength: "Maximum 255 characters allowed"
                    },
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
                    // This will be handled by custom submit functions
                    return false;
                }
            });

            // Add validation for account rows
            addAccountRowValidation();
        }

        // Add validation rules for account rows
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

            bankCode.val(selectedOption.data('code') || '');
        }

        function addAccountRow() {
            const tableBody = $('#accountTableBody');
            const rowCount = tableBody.find('.account-row').length;

            const newRow = $(`
        <tr class="account-row">
            <td>
                <select class="account-number-select account-number-display" disabled>
                    <option value="">-- Otomatis Terisi --</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->nomor_akun }}">{{ $account->nomor_akun }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="details[${rowCount}][account_number]" class="account-number-hidden">
            </td>
            <td>
                <select name="details[${rowCount}][account_name]" class="account-name-select" required>
                    <option value="">-- Pilih Account Name --</option>
                    @foreach ($accounts as $account)
                        <option value="{{ $account->nama_akun }}" 
                                data-account-number="{{ $account->nomor_akun }}"
                                data-search="{{ strtolower($account->nomor_akun . ' ' . $account->nama_akun) }}">
                            {{ $account->nomor_akun }} - {{ $account->nama_akun }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="details[${rowCount}][amount]" placeholder="0" 
                       class="amount-input" step="0.01" min="0" required>
            </td>
            <td>
                <button type="button" class="delete-row-btn" onclick="deleteAccountRow(this)">🗑️</button>
            </td>
        </tr>
    `);

            tableBody.append(newRow);

            // Initialize Select2 untuk row baru
            newRow.find('.account-name-select').select2({
                placeholder: "-- Cari Account Name --",
                allowClear: true,
                width: '100%',
                dropdownParent: newRow.find('.account-name-select').parent(),
                templateResult: formatAccountOption,
                templateSelection: formatAccountSelection,
                matcher: customMatcher
            });

            // Event handler untuk row baru
            newRow.find('.account-name-select').on('select2:select', function(e) {
                updateAccountNumber(this);
            });

            newRow.find('.account-name-select').on('select2:clear', function(e) {
                const row = $(this).closest('.account-row');
                const accountNumberSelect = row.find('.account-number-select');
                const accountNumberHidden = row.find('.account-number-hidden');

                accountNumberSelect.val('');
                accountNumberHidden.val('');
            });

            // Focus ke dropdown baru
            newRow.find('.account-name-select').select2('open');

            // Add validation untuk row baru
            if (typeof addAccountRowValidation === 'function') {
                addAccountRowValidation();
            }
        }

        // Delete account row
        function deleteAccountRow(button) {
            const row = $(button).closest('.account-row');
            const tableBody = $('#accountTableBody');

            // Don't allow deletion if it's the only row
            if (tableBody.find('.account-row').length <= 1) {
                showAlert('Cannot delete the last row', 'warning');
                return;
            }

            row.remove();
            updateRowIndices();
            calculateTotal();
        }

        // Update row indices after deletion
        function updateRowIndices() {
            $('#accountTableBody .account-row').each(function(index) {
                $(this).find('.account-number-hidden').attr('name', `details[${index}][account_number]`);
                $(this).find('.account-name-select').attr('name', `details[${index}][account_name]`);
                $(this).find('.amount-input').attr('name', `details[${index}][amount]`);
            });
        }

        // Calculate total amount
        function calculateTotal() {
            let total = 0;

            $('.amount-input').each(function() {
                const value = parseFloat($(this).val()) || 0;
                total += value;
            });

            // Update total display
            $('#totalAmount').text(total.toLocaleString('id-ID'));
            $('#totalAmountInput').val(total);
        }

        // Submit voucher
        function submitVoucher() {
            // Calculate total before validation
            calculateTotal();

            if ($('#voucherForm').valid() && validateAccountRows()) {
                // Ensure total amount is updated in hidden field
                const totalAmount = parseFloat($('#totalAmountInput').val()) || 0;

                if (totalAmount <= 0) {
                    showAlert('Total amount must be greater than 0.', 'warning');
                    return;
                }

                const formData = $('#voucherForm').serialize();

                // Show loading state
                $('#submitBtn').prop('disabled', true).addClass('loading');

                $.ajax({
                    url: $('#voucherForm').attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            showAlert(response.message || 'Voucher submitted successfully!', 'success');
                            setTimeout(function() {
                                if (response.redirect_url) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    // Redirect ke dashboard atau halaman index vouchers
                                    window.location.href = "{{ route('dashboard') }}";
                                }
                            }, 2000);
                        } else {
                            showAlert(response.message || 'Failed to submit voucher.', 'error');
                        }
                    },
                    error: function(xhr) {
                        let message = 'An error occurred while submitting the voucher.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            const errorMessages = [];

                            // Handle validation errors
                            Object.keys(errors).forEach(function(field) {
                                if (Array.isArray(errors[field])) {
                                    errorMessages.push(...errors[field]);
                                } else {
                                    errorMessages.push(errors[field]);
                                }
                            });

                            message = errorMessages.join('<br>');
                        }

                        showAlert(message, 'error');
                    },
                    complete: function() {
                        $('#submitBtn').prop('disabled', false).removeClass('loading');
                    }
                });
            } else {
                showAlert('Please fill in all required fields correctly.', 'warning');
            }
        }

        // Validate account rows
        function validateAccountRows() {
            const rows = $('#accountTableBody .account-row');
            let valid = true;

            if (rows.length === 0) {
                showAlert('Please add at least one account row.', 'warning');
                return false;
            }

            rows.each(function() {
                const accountNumber = $(this).find('.account-number-hidden').val()
                    .trim(); // Ambil dari hidden input
                const accountName = $(this).find('.account-name-select').val().trim();
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

            // Auto hide after 5 seconds
            setTimeout(function() {
                $('#alertContainer').fadeOut(500, function() {
                    $(this).empty().show();
                });
            }, 5000);
        }

        function generateVoucherNumber() {
            const date = new Date();
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');

            return `RV-3/${year}/${month}/${day}01`;
        }

        function updateAccountNumber(selectElement) {
            const row = $(selectElement).closest('.account-row');
            const accountNumberSelect = row.find('.account-number-select');
            const accountNumberHidden = row.find('.account-number-hidden');

            const selectedOption = $(selectElement).find('option:selected');

            if (selectedOption.val() !== '') {
                const accountNumber = selectedOption.data('account-number');

                // Update visual select
                accountNumberSelect.val(accountNumber);
                // Update hidden input untuk form submit
                accountNumberHidden.val(accountNumber);

                // Visual feedback
                accountNumberSelect.css('background-color', '#e8f5e8');
                setTimeout(() => {
                    accountNumberSelect.css('background-color', '#f5f5f5');
                }, 1000);
            } else {
                accountNumberSelect.val('');
                accountNumberHidden.val('');
            }
        }

        // Alternatif menggunakan event delegation untuk dynamic rows
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('account-name-select')) {
                updateAccountNumber(e.target);
            }
        });
        $('form').on('submit', function() {
            $('.account-number-select').prop('disabled', false);
        });

        function initializeSelect2() {
            $('.account-name-select').select2({
                placeholder: "-- Cari Account Name --",
                allowClear: true,
                width: '100%',
                dropdownParent: $('.account-name-select').parent(),
                templateResult: formatAccountOption,
                templateSelection: formatAccountSelection,
                matcher: customMatcher
            });

            // Event handler untuk perubahan account name
            $('.account-name-select').on('select2:select', function(e) {
                updateAccountNumber(this);
            });

            $('.account-name-select').on('select2:clear', function(e) {
                const row = $(this).closest('.account-row');
                const accountNumberSelect = row.find('.account-number-select');
                const accountNumberHidden = row.find('.account-number-hidden');

                accountNumberSelect.val('').trigger('change');
                accountNumberHidden.val('');
            });
        }

        // Format tampilan option di dropdown
        function formatAccountOption(option) {
            if (!option.id) {
                return option.text;
            }

            const accountNumber = $(option.element).data('account-number');
            if (!accountNumber) {
                return option.text;
            }

            return $(`
        <div class="account-option">
            <div style="font-weight: 600; color: #3b82f6; font-size: 12px;">${accountNumber}</div>
            <div style="color: #374151; font-size: 14px;">${option.text.split(' - ')[1] || option.text}</div>
        </div>
    `);
        }

        // Format tampilan selection yang dipilih
        function formatAccountSelection(option) {
            if (!option.id) {
                return option.text;
            }

            const accountNumber = $(option.element).data('account-number');
            if (!accountNumber) {
                return option.text;
            }

            return `${accountNumber} - ${option.text.split(' - ')[1] || option.text}`;
        }

        // Custom matcher untuk pencarian yang lebih fleksibel
        function customMatcher(params, data) {
            // Jika tidak ada search term, tampilkan semua
            if ($.trim(params.term) === '') {
                return data;
            }

            // Jika tidak ada children, ini adalah option leaf
            if (typeof data.text === 'undefined') {
                return null;
            }

            // Search term
            const term = params.term.toLowerCase();

            // Ambil data search dari data attribute
            const searchData = $(data.element).data('search') || '';
            const text = data.text.toLowerCase();

            // Cari di nomor akun dan nama akun
            if (text.indexOf(term) > -1 || searchData.indexOf(term) > -1) {
                return data;
            }

            return null;
        }

        function addNativeSearchDropdown() {
            $('.account-name-select').each(function() {
                const select = this;
                const wrapper = $('<div class="custom-select-wrapper"></div>');
                const input = $('<input type="text" class="custom-select-input" placeholder="Cari account..." />');
                const dropdown = $('<div class="custom-select-dropdown"></div>');

                // Populate dropdown
                $(select).find('option').each(function() {
                    if (this.value) {
                        const item = $(
                            `<div class="custom-select-item" data-value="${this.value}">${this.text}</div>`
                            );
                        dropdown.append(item);
                    }
                });

                // Wrap and insert
                $(select).hide();
                $(select).after(wrapper);
                wrapper.append(input).append(dropdown);

                // Search functionality
                input.on('input', function() {
                    const term = this.value.toLowerCase();
                    dropdown.find('.custom-select-item').each(function() {
                        const text = $(this).text().toLowerCase();
                        $(this).toggle(text.includes(term));
                    });
                });

                // Selection
                dropdown.on('click', '.custom-select-item', function() {
                    const value = $(this).data('value');
                    const text = $(this).text();
                    input.val(text);
                    $(select).val(value).trigger('change');
                    dropdown.hide();
                });
            });
        }
    </script>
</body>

</html>
