<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Management Dashboard - PT EDVISOR PRIME SOLUTION</title>
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
            max-width: 1600px;
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

        .btn.receive { 
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .btn.receive:hover { 
            background: linear-gradient(135deg, #059669, #047857);
        }

        .btn.payment { 
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        .btn.payment:hover { 
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }

        .btn.export { 
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .btn.export:hover { 
            background: linear-gradient(135deg, #059669, #047857);
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

        .report-title {
            text-align: center;
            font-size: 28px;
            font-weight: 700;
            padding: 25px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            margin: 0;
        }

        .table-container {
            padding: 30px;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .report-table th,
        .report-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 16px;
            text-align: left;
            font-size: 14px;
        }

        .report-table th {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            font-weight: 600;
            text-align: center;
            color: #374151;
            font-size: 13px;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .report-table tbody tr:hover {
            background-color: #e0f2fe;
            transition: background-color 0.2s ease;
        }

        .voucher-number {
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }

        .receive-voucher {
            color: #059669;
        }

        .payment-voucher {
            color: #dc2626;
        }

        .amount {
            text-align: right;
            font-weight: 600;
            font-family: 'Courier New', monospace;
            color: #1e293b;
        }

        .account-code {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #2563eb;
        }

        .bank-name {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .action-buttons-cell {
            text-align: center;
            white-space: nowrap;
        }

        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px 8px;
            margin: 0 2px;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #f1f5f9;
            transform: scale(1.1);
        }

        .edit-btn:hover {
            background: #fef3c7;
        }

        .delete-btn:hover {
            background: #fee2e2;
        }

        .summary-section {
            padding: 20px 30px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .summary-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .summary-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-value {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            padding: 20px;
        }

        .pagination button {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #374151;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination button:hover {
            background: #f8fafc;
            border-color: #3b82f6;
        }

        .pagination button.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .stats-section {
            margin: 20px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 0 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-left: 4px solid #10b981;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .stat-card:nth-child(2) {
            border-left-color: #3b82f6;
        }

        .stat-card:nth-child(3) {
            border-left-color: #f59e0b;
        }

        .stat-card:nth-child(4) {
            border-left-color: #ef4444;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

            .table-container {
                padding: 20px;
            }

            .btn {
                padding: 10px 16px;
                font-size: 13px;
            }

            .report-table {
                font-size: 12px;
            }

            .report-table th,
            .report-table td {
                padding: 8px 10px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                padding: 0 15px;
            }

            .summary-section {
                flex-direction: column;
                text-align: center;
            }
        }

        .welcome-section {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 20px;
        }

        .welcome-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .welcome-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <!-- Page Header with Actions -->
        <div class="page-header">
            <div class="page-title">
                <h1>Voucher Management Dashboard</h1>
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('recieve') }}" class="btn receive">
                    📥 Receive Voucher
                </a>
                <a href="{{ route('payment') }}" class="btn payment">
                    📤 Payment Voucher
                </a>
                <button class="btn export" onclick="exportData()">
                    📊 Export Excel
                </button>
            </div>
        </div>

        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="logo">A</div>
                <div class="company-name">PT EDVISOR PRIME SOLUTION</div>
            </div>

            <!-- Report Title -->
            <div class="report-title">VOUCHER MANAGEMENT DASHBOARD</div>

            <!-- Table Container -->
            <div class="table-container">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>No. Voucher</th>
                            <th>Ref. No.</th>
                            <th>Receive From</th>
                            <th>Description</th>
                            <th>Cash/Bank</th>
                            <th>Acc. No</th>
                            <th>Acc. Name</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                        <tr>
                            <td>21 Mei 2025</td>
                            <td class="voucher-number receive-voucher">RV-3/2025/06/0001</td>
                            <td>-</td>
                            <td>PT Edvisor Profina Visindo</td>
                            <td>Penerimaan Modal Disetor dari PT Edvisor Profina Visindo</td>
                            <td><span class="bank-name">Bank Mandiri</span></td>
                            <td class="account-code">1-10001</td>
                            <td>Bank Mandiri</td>
                            <td class="amount">200,000,000</td>
                            <td class="action-buttons-cell">
                                <button class="action-btn edit-btn" onclick="editVoucher('RV-3/2025/06/0001')" title="Edit">
                                    ✏️
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteVoucher('RV-3/2025/06/0001')" title="Delete">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>21 Mei 2025</td>
                            <td class="voucher-number receive-voucher">RV-3/2025/06/001</td>
                            <td>-</td>
                            <td>PT Edvisor Profina Visindo</td>
                            <td>Penerimaan Modal Disetor dari PT Edvisor Profina Visindo</td>
                            <td><span class="bank-name">Bank Mandiri</span></td>
                            <td class="account-code">3-30001</td>
                            <td>Modal Disetor</td>
                            <td class="amount">-</td>
                            <td class="action-buttons-cell">
                                <button class="action-btn edit-btn" onclick="editVoucher('RV-3/2025/06/001')" title="Edit">
                                    ✏️
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteVoucher('RV-3/2025/06/001')" title="Delete">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>21 Mei 2025</td>
                            <td class="voucher-number payment-voucher">PV-2/2025/06/001</td>
                            <td>-</td>
                            <td>PT. Laserindo utama</td>
                            <td>Pembayaran jasa desain website tahap</td>
                            <td><span class="bank-name">BNI</span></td>
                            <td class="account-code">6-60209</td>
                            <td>Legal & Professional</td>
                            <td class="amount">3,000,000</td>
                            <td class="action-buttons-cell">
                                <button class="action-btn edit-btn" onclick="editVoucher('PV-2/2025/06/001')" title="Edit">
                                    ✏️
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteVoucher('PV-2/2025/06/001')" title="Delete">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>21 Mei 2025</td>
                            <td class="voucher-number payment-voucher">PV-2/2025/06/001</td>
                            <td>-</td>
                            <td>PT. Laserindo utama</td>
                            <td>Pembayaran jasa desain website tahap</td>
                            <td><span class="bank-name">BNI</span></td>
                            <td class="account-code">1-10003</td>
                            <td>BNI</td>
                            <td class="amount">-</td>
                            <td class="action-buttons-cell">
                                <button class="action-btn edit-btn" onclick="editVoucher('PV-2/2025/06/001')" title="Edit">
                                    ✏️
                                </button>
                                <button class="action-btn delete-btn" onclick="deleteVoucher('PV-2/2025/06/001')" title="Delete">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Edit voucher function
        function editVoucher(voucherNumber) {
            // Navigate to edit page based on voucher type
            if (voucherNumber.startsWith('RV')) {
                window.location.href = `/receive-voucher/edit/${voucherNumber}`;
            } else if (voucherNumber.startsWith('PV')) {
                window.location.href = `/payment-voucher/edit/${voucherNumber}`;
            }
            showNotification(`Editing voucher ${voucherNumber}...`, 'info');
        }

        // Delete voucher function
        function deleteVoucher(voucherNumber) {
            if (confirm(`Are you sure you want to delete voucher ${voucherNumber}?`)) {
                // Here you would implement actual delete logic
                showNotification(`Voucher ${voucherNumber} deleted successfully!`, 'success');
                
                // Remove row from table (for demo purposes)
                setTimeout(() => {
                    const rows = document.querySelectorAll('#reportTableBody tr');
                    rows.forEach(row => {
                        const voucherCell = row.querySelector('.voucher-number');
                        if (voucherCell && voucherCell.textContent === voucherNumber) {
                            row.remove();
                            updateSummary();
                        }
                    });
                }, 1000);
            }
        }

        // Export function
        function exportData() {
            showNotification('Exporting data to Excel...', 'info');
            
            // Simulate export process
            setTimeout(() => {
                showNotification('Data exported successfully!', 'success');
            }, 2000);
        }

        // Pagination functions
        function previousPage() {
            showNotification('Loading previous page...', 'info');
        }

        function nextPage() {
            showNotification('Loading next page...', 'info');
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 1000;
                animation: slideIn 0.3s ease-out;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Add slideIn animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);

        // Calculate and update summary
        function updateSummary() {
            const tbody = document.getElementById('reportTableBody');
            const rows = tbody.querySelectorAll('tr');
            
            let receiveCount = 0;
            let paymentCount = 0;
            let totalAmount = 0;
            
            rows.forEach(row => {
                const voucherCell = row.querySelector('.voucher-number');
                const amountCell = row.querySelector('.amount');
                
                if (voucherCell) {
                    if (voucherCell.textContent.startsWith('RV')) {
                        receiveCount++;
                    } else if (voucherCell.textContent.startsWith('PV')) {
                        paymentCount++;
                    }
                }
                
                if (amountCell && amountCell.textContent !== '-' && amountCell.textContent !== '') {
                    const amount = parseFloat(amountCell.textContent.replace(/,/g, ''));
                    if (!isNaN(amount)) {
                        totalAmount += amount;
                    }
                }
            });
            
            // Update table summary only
            document.getElementById('totalRecords').textContent = rows.length;
            document.getElementById('receiveCount').textContent = receiveCount;
            document.getElementById('paymentCount').textContent = paymentCount;
            document.getElementById('totalAmount').textContent = 'Rp ' + totalAmount.toLocaleString('id-ID');
        }

        // Update summary on page load
        document.addEventListener('DOMContentLoaded', updateSummary);
    </script>
</body>
</html>