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
    
    <!-- Select2 CSS & JS -->
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
            vertical-align: middle;
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

        .account-table input[type="text"] {
            border: 1px solid #e2e8f0;
            width: 100%;
            background: #f9fafb;
            outline: none;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 4px;
            color: #6b7280;
            font-weight: 600;
        }

        .account-table input[type="number"] {
            border: 1px solid #e2e8f0;
            width: 100%;
            background: white;
            outline: none;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 4px;
            text-align: right;
            font-family: 'Courier New', monospace;
        }

        .account-table input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        .account-table input.error {
            background: #fef2f2;
            border: 1px solid #ef4444;
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
            padding: 6px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .delete-row-btn:hover {
            background: #dc2626;
            transform: translateY(-1px);
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

        /* Select2 Custom Styles untuk Table */
        .account-table .select2-container {
            width: 100% !important;
        }

        .account-table .select2-container--default .select2-selection--single {
            height: 40px !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 4px !important;
            padding: 0 !important;
        }

        .account-table .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
            padding-left: 12px !important;
            font-size: 14px !important;
            color: #374151 !important;
        }

        .account-table .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            right: 8px !important;
        }

        .account-table .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
        }

        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }

        .select2-results__option {
            font-size: 14px !important;
            padding: 8px 12px !important;
        }

        .select2-results__option--highlighted {
            background-color: #3b82f6 !important;
        }

        .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 4px !important;
            padding: 8px 12px !important;
            font-size: 14px !important;
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

            .account-table {
                font-size: 12px;
            }

            .account-table th,
            .account-table td {
                padding: 8px;
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
            <div class="form-title">EDIT PAYMENT VOUCHER</div>

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
                                    value="{{ $voucher->reference_number ?? '' }}" placeholder="Enter reference number">
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
                                        <option value="Cash" data-code="1-10001"
                                            {{ ($voucher->bank_name ?? '') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Bank Mandiri" data-code="1-10002"
                                            {{ ($voucher->bank_name ?? '') == 'Bank Mandiri' ? 'selected' : '' }}>Bank
                                            Mandiri</option>
                                        <option value="Bank BNI" data-code="1-10003"
                                            {{ ($voucher->bank_name ?? '') == 'Bank BNI' ? 'selected' : '' }}>Bank BNI
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Payment From -->
                        <div class="form-field full-width">
                            <label class="form-label">Payment To</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="from_to" class="form-input" required
                                    value="{{ $voucher->from_to ?? '' }}" placeholder="Enter payer name">
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-field full-width">
                            <label class="form-label">Description</label>
                            <span class="form-colon">:</span>
                            <div class="form-input-wrapper">
                                <input type="text" name="description" class="form-input" required
                                    value="{{ $voucher->description ?? '' }}" placeholder="Enter description">
                            </div>
                        </div>
                    </div>

                    <!-- Account Table dengan Select2 -->
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
                                    
                                    // Fallback data jika database kosong
                                    if ($accounts->isEmpty()) {
                                        $accounts = collect([
                                            (object)['nomor_akun' => '1-10001', 'nama_akun' => 'Cash'],
                                            (object)['nomor_akun' => '1-10002', 'nama_akun' => 'Bank Mandiri'],
                                            (object)['nomor_akun' => '1-10003', 'nama_akun' => 'Bank BNI'],
                                            (object)['nomor_akun' => '2-20001', 'nama_akun' => 'Accounts Receivable'],
                                            (object)['nomor_akun' => '3-30001', 'nama_akun' => 'Inventory'],
                                            (object)['nomor_akun' => '4-40001', 'nama_akun' => 'Sales Revenue'],
                                            (object)['nomor_akun' => '5-50001', 'nama_akun' => 'Office Expense'],
                                            (object)['nomor_akun' => '5-50002', 'nama_akun' => 'Marketing Expense']
                                        ]);
                                    }
                                @endphp

                                @if (isset($voucher) && $voucher->details && $voucher->details->count() > 0)
                                    @foreach ($voucher->details as $index => $detail)
                                        <tr class="account-row" data-detail-id="{{ $detail->id }}">
                                            <td>
                                                <input type="hidden" name="details[{{ $index }}][id]"
                                                    value="{{ $detail->id }}">
                                                <!-- Account Number Display (Read-only) -->
                                                <input type="text" class="account-number-display"
                                                    value="{{ $detail->account_number }}" readonly>
                                                <!-- Hidden input untuk form submission -->
                                                <input type="hidden" name="details[{{ $index }}][account_number]"
                                                    class="account-number-hidden" value="{{ $detail->account_number }}">
                                            </td>
                                            <td>
                                                <!-- Select2 Account Name Dropdown -->
                                                <select name="details[{{ $index }}][account_name]"
                                                    class="account-name-select" required>
                                                    <option value="">-- Pilih Account Name --</option>
                                                    @foreach ($accounts as $account)
                                                        <option value="{{ $account->nama_akun }}"
                                                            data-account-number="{{ $account->nomor_akun }}"
                                                            data-search="{{ strtolower($account->nomor_akun . ' ' . $account->nama_akun) }}"
                                                            {{ $detail->account_name == $account->nama_akun ? 'selected' : '' }}>
                                                            {{ $account->nomor_akun }} - {{ $account->nama_akun }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="details[{{ $index }}][amount]"
                                                    value="{{ $detail->amount }}" placeholder="0"
                                                    class="amount-input" step="0.01" min="0" required>
                                            </td>
                                            <td>
                                                <button type="button" class="delete-row-btn"
                                                    onclick="deleteAccountRow(this)">🗑️</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="account-row">
                                        <td>
                                    <tr class="account-row">
                                        <td>
                                            <input type="hidden" name="details[0][id]" value="">
                                            <!-- Account Number Display (Read-only) -->
                                            <input type="text" class="account-number-display"
                                                placeholder="-- Otomatis Terisi --" readonly>
                                            <!-- Hidden input untuk form submission -->
                                            <input type="hidden" name="details[0][account_number]"
                                                class="account-number-hidden">
                                        </td>
                                        <td>
                                            <!-- Select2 Account Name Dropdown -->
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
                                    Rp <span
                                        id="totalAmount">{{ isset($voucher) ? number_format($voucher->total_amount, 0, ',', '.') : '0' }}</span>
                                    <input type="hidden" name="total_amount" id="totalAmountInput"
                                        value="{{ $voucher->total_amount ?? '0' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Data accounts untuk JavaScript dengan fallback yang robust
        let accounts = [];
        
        try {
            accounts = @json($accounts ?? []);
            console.log('✅ Accounts loaded from backend:', accounts);
            console.log('📊 Total accounts available:', accounts.length);
            
            if (accounts.length > 0) {
                console.log('🔍 Sample accounts:', accounts.slice(0, 3));
            }
        } catch (e) {
            console.error('❌ Error loading accounts from backend:', e);
        }

        // Jika masih kosong, gunakan hardcoded fallback
        if (!accounts || accounts.length === 0) {
            console.warn('⚠️ Using fallback accounts data');
            accounts = [
                {nomor_akun: '1-10001', nama_akun: 'Cash'},
                {nomor_akun: '1-10002', nama_akun: 'Bank Mandiri'},
                {nomor_akun: '1-10003', nama_akun: 'Bank BNI'},
                {nomor_akun: '2-20001', nama_akun: 'Accounts Receivable'},
                {nomor_akun: '3-30001', nama_akun: 'Inventory'},
                {nomor_akun: '4-40001', nama_akun: 'Sales Revenue'},
                {nomor_akun: '5-50001', nama_akun: 'Office Expense'},
                {nomor_akun: '5-50002', nama_akun: 'Marketing Expense'}
            ];
        }

        $(document).ready(function() {
            console.log('🚀 Document ready - initializing form');
            
            // Set CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Debug existing data
            console.log('🔍 Checking existing form data...');
            $('.account-row').each(function(index) {
                const accountNumber = $(this).find('.account-number-display').val();
                const accountName = $(this).find('.account-name-select').val();
                const amount = $(this).find('.amount-input').val();
                
                console.log(`Row ${index + 1}:`, {
                    accountNumber: accountNumber,
                    accountName: accountName,
                    amount: amount
                });
            });

            // Force rebuild options dan mapping
            rebuildAllSelectOptions();

            // Initialize Select2
            initializeSelect2();

            // Initialize form validation
            initializeValidation();

            // Event handlers
            $('#bankSelect').on('change', updateBankCode);
            $(document).on('input', '.amount-input', calculateTotal);
            $(document).on('change', '.account-name-select', updateAccountNumber);
            $('#updateBtn').on('click', updateVoucher);

            // Initialize calculations
            calculateTotal();
            updateBankCode();

            // Auto-fix account mappings after delay


            console.log('✅ Form initialization completed');
        });

        // Function untuk rebuild semua select options
        function rebuildAllSelectOptions() {
            console.log('🔧 Rebuilding all select options...');
            
            $('.account-name-select').each(function() {
                const $select = $(this);
                const currentValue = $select.val();
                const row = $select.closest('.account-row');
                const accountNumber = row.find('.account-number-display').val();
                
                console.log(`   Rebuilding select: ${$select.attr('name')}`);
                console.log(`   Current value: "${currentValue}"`);
                console.log(`   Account number: "${accountNumber}"`);
                
                // Keep only placeholder option
                $select.find('option:not(:first)').remove();
                
                // Add accounts dari JavaScript
                let optionsAdded = 0;
                let matchedAccount = null;
                
                accounts.forEach(function(account) {
                    if (account.nama_akun && account.nomor_akun) {
                        const isMatchedByNumber = accountNumber && account.nomor_akun === accountNumber;
                        const isMatchedByName = currentValue === account.nama_akun;
                        const isSelected = isMatchedByNumber || isMatchedByName;
                        
                        if (isMatchedByNumber) {
                            matchedAccount = account;
                            console.log(`   🎯 Found matching account: ${account.nomor_akun} - ${account.nama_akun}`);
                        }
                        
                        const option = new Option(
                            `${account.nomor_akun} - ${account.nama_akun}`,
                            account.nama_akun,
                            isSelected,
                            isSelected
                        );
                        
                        $(option).attr('data-account-number', account.nomor_akun);
                        $(option).attr('data-search', (account.nomor_akun + ' ' + account.nama_akun).toLowerCase());
                        $select.append(option);
                        optionsAdded++;
                    }
                });
                
                // Auto-select matching account
                if (matchedAccount && !currentValue) {
                    $select.val(matchedAccount.nama_akun);
                    console.log(`   🔄 Auto-selected: ${matchedAccount.nama_akun}`);
                    row.find('.account-number-hidden').val(matchedAccount.nomor_akun);
                }
                
                console.log(`   ✅ Added ${optionsAdded} options`);
            });
        }

        // Initialize Select2 untuk semua account name selects
        function initializeSelect2() {
            console.log('🎨 Initializing Select2 for all selects...');
            
            $('.account-name-select').each(function(index) {
                const $element = $(this);
                console.log(`   Initializing Select2 for element ${index + 1}: ${$element.attr('name')}`);
                initializeSelect2ForElement($element);
            });
        }

        // Initialize Select2 untuk element tertentu
        function initializeSelect2ForElement($element) {
            // Destroy existing Select2 if exists
            if ($element.hasClass('select2-hidden-accessible')) {
                $element.select2('destroy');
            }

            const optionsCount = $element.find('option').length;
            console.log(`   🔧 Select2 init: ${$element.attr('name')} (${optionsCount} options)`);

            $element.select2({
                placeholder: '-- Pilih Account Name --',
                allowClear: true,
                width: '100%',
                dropdownParent: $element.closest('td'),
                language: {
                    noResults: function() {
                        return "Tidak ada hasil ditemukan";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                },
                matcher: function(params, data) {
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    if (!data.id || data.id === '') {
                        return null;
                    }

                    const searchData = $(data.element).data('search');
                    if (searchData && searchData.indexOf(params.term.toLowerCase()) > -1) {
                        return data;
                    }

                    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                        return data;
                    }

                    return null;
                }
            });

            console.log(`   ✅ Select2 initialized for: ${$element.attr('name')}`);
        }

        // Update account number ketika account name dipilih
        function updateAccountNumber() {
            const $select = $(this);
            const selectedOption = $select.find('option:selected');
            const accountNumber = selectedOption.data('account-number');
            const row = $select.closest('.account-row');

            console.log(`🔄 Account selected: ${selectedOption.text()} (${accountNumber})`);

            // Update account number display dan hidden input
            row.find('.account-number-display').val(accountNumber || '');
            row.find('.account-number-hidden').val(accountNumber || '');

            // Visual feedback
            if (accountNumber) {
                row.find('.account-number-display').css('background-color', '#e8f5e8');
                setTimeout(() => {
                    row.find('.account-number-display').css('background-color', '#f9fafb');
                }, 1000);
            }
        }

   
        // Add new account row
        function addAccountRow() {
            const tableBody = $('#accountTableBody');
            const rowCount = tableBody.find('.account-row').length;

            console.log(`➕ Adding new row. Current count: ${rowCount}`);

            if (accounts.length === 0) {
                showAlert('Data accounts tidak tersedia. Silakan refresh halaman.', 'error');
                return;
            }

            // Buat options untuk select
            let accountOptions = '<option value="">-- Pilih Account Name --</option>';
            accounts.forEach(function(account) {
                if (account.nama_akun && account.nomor_akun) {
                    accountOptions += `<option value="${account.nama_akun}" 
                                             data-account-number="${account.nomor_akun}"
                                             data-search="${(account.nomor_akun + ' ' + account.nama_akun).toLowerCase()}">
                                        ${account.nomor_akun} - ${account.nama_akun}
                                      </option>`;
                }
            });

            const newRow = $(`
                <tr class="account-row">
                    <td>
                        <input type="hidden" name="details[${rowCount}][id]" value="">
                        <input type="text" class="account-number-display"
                            placeholder="-- Otomatis Terisi --" readonly>
                        <input type="hidden" name="details[${rowCount}][account_number]"
                            class="account-number-hidden">
                    </td>
                    <td>
                        <select name="details[${rowCount}][account_name]" class="account-name-select" required>
                            ${accountOptions}
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
            const newSelect = newRow.find('.account-name-select');
            initializeSelect2ForElement(newSelect);

            // Add validation untuk row baru
            addAccountRowValidation();

            // Focus pada select yang baru ditambahkan
            setTimeout(() => {
                newSelect.select2('open');
            }, 100);

            console.log(`✅ New row added with ${newSelect.find('option').length} options`);
        }

        // Delete account row
        function deleteAccountRow(button) {
            const row = $(button).closest('.account-row');
            const tableBody = $('#accountTableBody');

            if (tableBody.find('.account-row:visible').length <= 1) {
                showAlert('Minimal harus ada satu baris account', 'warning');
                return;
            }

            const detailId = row.find('input[name*="[id]"]').val();
            if (detailId && detailId !== '') {
                if (!confirm('Apakah Anda yakin ingin menghapus detail account ini?')) {
                    return;
                }
                row.append(`<input type="hidden" name="deleted_details[]" value="${detailId}">`);
                row.hide();
            } else {
                row.find('.account-name-select').select2('destroy');
                row.remove();
            }

            updateRowIndices();
            calculateTotal();
        }

        // Update row indices after deletion
        function updateRowIndices() {
            $('#accountTableBody .account-row:visible').each(function(index) {
                $(this).find('input[name*="[id]"]').attr('name', `details[${index}][id]`);
                $(this).find('.account-number-hidden').attr('name', `details[${index}][account_number]`);
                $(this).find('.account-name-select').attr('name', `details[${index}][account_name]`);
                $(this).find('.amount-input').attr('name', `details[${index}][amount]`);
            });
        }

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
                        required: "Tanggal wajib diisi",
                        date: "Masukkan tanggal yang valid"
                    },
                    bank_name: {
                        required: "Pilih Cash/Bank"
                    },
                    from_to: {
                        required: "Payment From wajib diisi",
                        minlength: "Minimal 2 karakter",
                        maxlength: "Maksimal 255 karakter"
                    },
                    description: {
                        required: "Deskripsi wajib diisi",
                        minlength: "Minimal 5 karakter"
                    },
                    terbilang: {
                        required: "Terbilang wajib diisi",
                        minlength: "Minimal 5 karakter"
                    },
                    reference_number: {
                        maxlength: "Maksimal 255 karakter"
                    },
                    total_amount: {
                        required: "Total amount wajib diisi",
                        number: "Masukkan angka yang valid",
                        min: "Total harus lebih dari 0"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass('bank-select')) {
                        error.insertAfter(element.closest('.bank-group'));
                    } else if (element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter(element.next('.select2-container'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass('error');
                    if ($(element).hasClass('select2-hidden-accessible')) {
                        $(element).next('.select2-container').find('.select2-selection').addClass('error');
                    }
                },
                unhighlight: function(element) {
                    $(element).removeClass('error');
                    if ($(element).hasClass('select2-hidden-accessible')) {
                        $(element).next('.select2-container').find('.select2-selection').removeClass('error');
                    }
                },
                submitHandler: function(form) {
                    return false;
                }
            });

            addAccountRowValidation();
        }

        function addAccountRowValidation() {
            $('.account-name-select').each(function() {
                $(this).rules('add', {
                    required: true,
                    messages: {
                        required: "Nama account wajib dipilih"
                    }
                });
            });

            $('.amount-input').each(function() {
                $(this).rules('add', {
                    required: true,
                    number: true,
                    min: 0.01,
                    messages: {
                        required: "Amount wajib diisi",
                        number: "Masukkan angka yang valid",
                        min: "Amount harus lebih dari 0"
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

        // Calculate total amount
        function calculateTotal() {
            let total = 0;

            $('.account-row:visible .amount-input').each(function() {
                const value = parseFloat($(this).val()) || 0;
                total += value;
            });

            total = Math.round(total * 100) / 100;

            $('#totalAmount').text(total.toLocaleString('id-ID'));
            $('#totalAmountInput').val(total);
        }

        // Update voucher
        function updateVoucher() {
            calculateTotal();

            const voucherId = $('input[name="voucher_id"]').val();
            if (!voucherId) {
                showAlert('Voucher ID tidak ditemukan. Silakan refresh halaman.', 'error');
                return;
            }

            if (!$('#voucherForm').valid() || !validateAccountRows()) {
                showAlert('Silakan perbaiki error validasi sebelum menyimpan.', 'warning');
                return;
            }

            const updateUrl = `/payment-voucher/${voucherId}`;
            const formElement = document.getElementById('voucherForm');
            const formData = new FormData(formElement);

            const total = parseFloat($('#totalAmountInput').val()) || 0;
            formData.set('total_amount', total.toString());

            $('#updateBtn').prop('disabled', true).addClass('loading');

            $.ajax({
                url: updateUrl,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        showAlert(response.message || 'Voucher berhasil diupdate!', 'success');
                        setTimeout(function() {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 2000);
                    } else {
                        showAlert(response.message || 'Gagal mengupdate voucher.', 'error');
                    }
                },
                error: function(xhr) {
                    let message = 'Update gagal: ';
                    if (xhr.status === 405) {
                        message = 'Method tidak diizinkan. Silakan cek route Laravel.';
                    } else if (xhr.status === 404) {
                        message = 'Voucher tidak ditemukan.';
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        message += xhr.responseJSON.message;
                    } else {
                        message += `HTTP ${xhr.status} error occurred.`;
                    }

                    showAlert(message, 'error');
                },
                complete: function() {
                    $('#updateBtn').prop('disabled', false).removeClass('loading');
                }
            });
        }

        // Delete voucher
        function deleteVoucher() {
            const voucherId = $('input[name="voucher_id"]').val();
            const voucherNumber = $('input[name="voucher_number"]').val();

            if (!voucherId) {
                showAlert('Voucher ID tidak ditemukan.', 'error');
                return;
            }

            if (confirm(`Apakah Anda yakin ingin MENGHAPUS voucher ${voucherNumber}?\n\nTindakan ini tidak dapat dibatalkan.`)) {
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
                            showAlert(response.message || 'Gagal menghapus voucher', 'error');
                        }
                    },
                    error: function(xhr) {
                        let message = 'Gagal menghapus voucher';
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
                showAlert('Minimal harus ada satu baris account.', 'warning');
                return false;
            }

            visibleRows.each(function() {
                const accountNumber = $(this).find('.account-number-hidden').val().trim();
                const accountName = $(this).find('.account-name-select').val().trim();
                const amount = parseFloat($(this).find('.amount-input').val()) || 0;

                if (!accountNumber || !accountName || amount <= 0) {
                    valid = false;
                    return false;
                }
            });

            if (!valid) {
                showAlert('Semua baris account harus memiliki nomor account, nama, dan amount yang valid.', 'warning');
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

        // Debug functions
        window.debugAccountData = function() {
            console.log('=== PAYMENT VOUCHER DEBUG ===');
            console.log('Accounts array:', accounts);
            console.log('Total accounts:', accounts.length);
            
            $('.account-name-select').each(function(index) {
                const $select = $(this);
                const $row = $select.closest('.account-row');
                console.log(`Select ${index + 1}:`, {
                    name: $select.attr('name'),
                    optionsCount: $select.find('option').length,
                    accountNumber: $row.find('.account-number-display').val(),
                    accountNameValue: $select.val(),
                    hasSelect2: $select.hasClass('select2-hidden-accessible')
                });
            });
        };

       
    </script>
</body>

</html>