<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Voucher - PT EDVISOR PRIME SOLUTION</title>
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

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn.add { 
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .btn.add:hover { 
            background: linear-gradient(135deg, #059669, #047857);
        }

        .btn.edit { 
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .btn.edit:hover { 
            background: linear-gradient(135deg, #d97706, #b45309);
        }

        .btn.submit { 
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        .btn.submit:hover { 
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .btn.delete { 
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
        .btn.delete:hover { 
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
            align-items: center;
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
        }

        .form-colon {
            font-weight: 600;
            color: #6b7280;
        }

        .form-input {
            border: 1px solid #e2e8f0;
            outline: none;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input[readonly] {
            background-color: #f9fafb;
            color: #6b7280;
        }

        .bank-group {
            display: flex;
            gap: 8px;
            flex: 1;
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

        .account-table .account-code {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            color: #059669;
            font-weight: 600;
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

            .add-row-btn {
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
                <h1>Payment Voucher</h1>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn submit" onclick="submitVoucher()">
                    📤 Submit
                </button>
            </div>
        </div>

        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="logo">A</div>
                <div class="company-name">PT EDVISOR PRIME SOLUTION</div>
            </div>

            <!-- Form Title -->
            <div class="form-title">PAYMENT VOUCHER</div>

            <!-- Form Content -->
            <div class="form-content">
                <!-- Form Grid -->
                <div class="form-grid">
                    <!-- No. Voucher -->
                    <div class="form-field">
                        <label class="form-label">No. Voucher</label>
                        <span class="form-colon">:</span>
                        <input type="text" class="form-input" placeholder="Enter voucher number">
                    </div>

                    <!-- Referensi No. -->
                    <div class="form-field">
                        <label class="form-label">Referensi No.</label>
                        <span class="form-colon">:</span>
                        <input type="text" class="form-input" placeholder="Enter reference number">
                    </div>

                    <!-- Date -->
                    <div class="form-field">
                        <label class="form-label">Date</label>
                        <span class="form-colon">:</span>
                        <input type="date" class="form-input">
                    </div>

                    <!-- Cash / Bank -->
                    <div class="form-field">
                        <label class="form-label">Cash / Bank</label>
                        <span class="form-colon">:</span>
                        <div class="bank-group">
                            <input type="text" class="bank-code" id="bankCode" readonly placeholder="Code">
                            <select class="bank-select" id="bankSelect" onchange="updateBankCode()">
                                <option value="">Select Cash/Bank</option>
                                <option value="10001">Cash</option>
                                <option value="10101">Bank Mandiri</option>
                                <option value="10102">Bank BCA</option>
                                <option value="10103">Bank BNI</option>
                                <option value="10104">Bank BRI</option>
                                <option value="10105">Bank CIMB Niaga</option>
                                <option value="10106">Bank Danamon</option>
                                <option value="10107">Bank Permata</option>
                                <option value="10108">Bank Maybank</option>
                                <option value="10109">Bank OCBC NISP</option>
                                <option value="10110">Bank Panin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Payment To -->
                    <div class="form-field full-width">
                        <label class="form-label">Payment To</label>
                        <span class="form-colon">:</span>
                        <input type="text" class="form-input" placeholder="Enter payee name">
                    </div>

                    <!-- Description -->
                    <div class="form-field full-width">
                        <label class="form-label">Description</label>
                        <span class="form-colon">:</span>
                        <input type="text" class="form-input" placeholder="Enter description">
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
                            </tr>
                        </thead>
                        <tbody id="accountTableBody">
                            <tr>
                                <td><input type="text" placeholder="Account No." style="border: none; width: 100%; background: transparent;"></td>
                                <td><input type="text" placeholder="Account Name" style="border: none; width: 100%; background: transparent;"></td>
                                <td><input type="number" placeholder="0" style="border: none; width: 100%; background: transparent; text-align: right;" onchange="calculateTotal()"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="add-row-btn" onclick="addAccountRow()">
                        ➕ Add Account Row
                    </button>
                </div>

                <!-- Total Section -->
                <div class="total-section">
                    <div class="total-field">
                        <label class="total-label">Terbilang</label>
                        <span class="total-colon">:</span>
                        <div class="total-content">
                            <input type="text" class="total-words-input" placeholder="Enter amount in words (e.g., Dua Ratus Juta Rupiah)" id="totalWordsInput">
                            <div class="total-amount">
                                <span id="totalAmount">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to update bank code based on selection
        function updateBankCode() {
            const bankSelect = document.getElementById('bankSelect');
            const bankCode = document.getElementById('bankCode');
            
            bankCode.value = bankSelect.value;
        }

        // Function to add new account row
        function addAccountRow() {
            const tableBody = document.getElementById('accountTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="text" placeholder="Account No." style="border: none; width: 100%; background: transparent;"></td>
                <td><input type="text" placeholder="Account Name" style="border: none; width: 100%; background: transparent;"></td>
                <td><input type="number" placeholder="0" style="border: none; width: 100%; background: transparent; text-align: right;" onchange="calculateTotal()"></td>
            `;
            
            // Insert before the last empty rows
            const emptyRows = tableBody.querySelectorAll('tr');
            const insertIndex = Math.max(0, emptyRows.length - 2);
            tableBody.insertBefore(newRow, emptyRows[insertIndex]);
        }

        // Function to calculate total
        function calculateTotal() {
            const amounts = document.querySelectorAll('#accountTableBody input[type="number"]');
            let total = 0;
            
            amounts.forEach(input => {
                if (input.value) {
                    total += parseFloat(input.value);
                }
            });

            // Update total display
            document.getElementById('totalAmount').textContent = total.toLocaleString('id-ID');
        }

        // Action button functions
        function submitVoucher() {
            if (confirm('Submit this voucher for approval?')) {
                alert('Voucher submitted successfully!');
            }
        }

        // Auto-generate voucher number
        function generateVoucherNumber() {
            const date = new Date();
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            
            return `PV-3/${year}/${month}/${day}01`;
        }

        // Set today's date on page load
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('input[type="date"]');
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        });
    </script>
</body>
</html>