<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Voucher Management Dashboard - PT EDVISOR PRIME SOLUTION</title>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

        .btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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

        .filters-section {
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .filter-input {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .filter-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .stats-section {
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #10b981;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
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
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

        .pagination-container {
            padding: 20px 30px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: center;
        }

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

        .loading {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state h3 {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
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

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-container {
                padding: 20px;
            }

            .report-table {
                font-size: 12px;
            }

            .report-table th,
            .report-table td {
                padding: 8px 10px;
            }
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

        <!-- Filters Section -->
        <div class="filters-section">
            <form id="filterForm" method="GET">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Date From</label>
                        <input type="date" name="date_from" class="filter-input" value="{{ $dateFrom }}"
                            onchange="applyFilters()">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Date To</label>
                        <input type="date" name="date_to" class="filter-input" value="{{ $dateTo }}"
                            onchange="applyFilters()">
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Type</label>
                        <select name="type" class="filter-input" onchange="applyFilters()">
                            <option value="">All Types</option>
                            <option value="receive" {{ $type == 'receive' ? 'selected' : '' }}>Receive</option>
                            <option value="payment" {{ $type == 'payment' ? 'selected' : '' }}>Payment</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" name="search" class="filter-input" placeholder="Search vouchers..."
                            value="{{ $search }}" onkeyup="debounceSearch(this.value)">
                    </div>
                </div>
            </form>
        </div>

        <!-- Statistics Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['total_vouchers'] }}</div>
                    <div class="stat-label">Total Vouchers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['receive_vouchers'] }}</div>
                    <div class="stat-label">Receive Vouchers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $stats['payment_vouchers'] }}</div>
                    <div class="stat-label">Payment Vouchers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Rp {{ number_format($stats['net_amount'], 0, ',', '.') }}</div>
                    <div class="stat-label">Net Amount</div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error') || $errors->any())
            <div class="alert alert-error">
                {{ session('error') ?: $errors->first() }}
            </div>
        @endif

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
                @if ($voucherDetails->count() > 0)
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>No. Voucher</th>
                                <th>Ref. No.</th>
                                <th>From/To</th>
                                <th>Description</th>
                                <th>Cash/Bank</th>
                                <th>Detail ID</th>
                                <th>Acc. No</th>
                                <th>Acc. Name</th>
                                <th class="amount-header">Debit</th>
                                <th class="amount-header">Credit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voucherDetails as $item)
                                @php
                                    $voucher = $item['voucher'];
                                    $detail = $item['detail'];
                                    $isReceive = $voucher->type == 'receive';
                                @endphp
                                <tr>
                                    <td>{{ $voucher->date->format('d M Y') }}</td>
                                    <td
                                        class="voucher-number {{ $isReceive ? 'receive-voucher' : 'payment-voucher' }}">
                                        {{ $voucher->voucher_number }}
                                    </td>
                                    <td>{{ $voucher->reference_number ?: '-' }}</td>
                                    <td>{{ $voucher->from_to }}</td>
                                    <td>{{ Str::limit($voucher->description, 40) }}</td>
                                    <td><span class="bank-name">{{ $voucher->bank_name }}</span></td>
                                    <td class="account-code">{{ $detail->id }}</td>
                                    <td class="account-code">{{ $detail->account_number }}</td>
                                    <td>{{ $detail->account_name }}</td>

                                    {{-- Debit Column - Show amount if type is 'receive' --}}
                                    <td class="amount debit">
                                        @if ($isReceive && $detail->amount > 0)
                                            {{ number_format($detail->amount, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    {{-- Credit Column - Show amount if type is NOT 'receive' (payment) --}}
                                    <td class="amount credit">
                                        @if (!$isReceive && $detail->amount > 0)
                                            {{ number_format($detail->amount, 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td class="action-buttons-cell">
                                        <button class="action-btn edit-btn" onclick="editVoucher(this)"
                                            data-voucher-id="{{ $voucher->id }}"
                                            data-voucher-type="{{ $voucher->type }}" title="Edit">
                                            ✏️
                                        </button>
                                        <button class="action-btn delete-btn"
                                            onclick="deleteVoucher({{ $detail->id }}, '{{ $voucher->voucher_number }}')"
                                            title="Delete">
                                            🗑️
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        {{-- Optional: Add totals row --}}
                        @if ($voucherDetails->count() > 0)
                            @php
                                $totalDebit = 0;
                                $totalCredit = 0;

                                foreach ($voucherDetails as $item) {
                                    $voucher = $item['voucher'];
                                    $detail = $item['detail'];

                                    if ($voucher->type == 'receive') {
                                        $totalDebit += $detail->amount;
                                    } else {
                                        $totalCredit += $detail->amount;
                                    }
                                }
                            @endphp

                            <tfoot>
                                <tr class="totals-row">
                                    <td colspan="9" class="totals-label"><strong>TOTALS:</strong></td>
                                    <td class="amount debit total-debit">
                                        <strong>{{ number_format($totalDebit, 0, ',', '.') }}</strong>
                                    </td>
                                    <td class="amount credit total-credit">
                                        <strong>{{ number_format($totalCredit, 0, ',', '.') }}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                @else
                    <div class="empty-state">
                        <h3>No vouchers found</h3>
                        <p>No voucher data matches your current filters.</p>
                    </div>
                @endif
            </div>


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
        });

        // Apply filters
        function applyFilters() {
            document.getElementById('filterForm').submit();
        }

        // Debounced search
        let searchTimeout;

        function debounceSearch(value) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                applyFilters();
            }, 500);
        }

        // Simple and efficient edit function
        function editVoucher(element) {
            const voucherId = element.getAttribute('data-voucher-id');
            const voucherType = element.getAttribute('data-voucher-type');
            console.log('Voucher Type', voucherType);

            if (voucherType === 'receive') {
                window.location.href = `/receive-voucher/${voucherId}/edit`;
                console.log('Type', voucherType);
            } else {
                window.location.href = `/payment-voucher/${voucherId}/edit`;
                console.log('Type', voucherType);
            }
        }
        // Delete voucher function
        function deleteVoucher(voucherId, voucherNumber) {
            if (confirm(`Are you sure you want to delete voucher ${voucherNumber}?`)) {
                $.ajax({
                    url: `/dashboard/voucher-detail/${voucherId}`,
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            showNotification(response.message, 'success');
                            // Reload page after 1 second
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            showNotification(response.message || 'Failed to delete voucher', 'error');
                        }
                    },
                    error: function(xhr) {
                        let message = 'Failed to delete voucher';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        showNotification(message, 'error');
                    }
                });
            }
        }

        // Export function
        function exportData() {
            showNotification('Preparing export...', 'info');

            // Get current filter values
            const dateFrom = $('input[name="date_from"]').val();
            const dateTo = $('input[name="date_to"]').val();
            const type = $('select[name="type"]').val();

            // Build export URL with filters
            let exportUrl = '/dashboard/export';
            const params = new URLSearchParams();

            if (dateFrom) params.append('date_from', dateFrom);
            if (dateTo) params.append('date_to', dateTo);
            if (type) params.append('type', type);

            if (params.toString()) {
                exportUrl += '?' + params.toString();
            }

            // Create temporary link and click it
            const link = document.createElement('a');
            link.href = exportUrl;
            link.download = '';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            showNotification('Export started! Download will begin shortly.', 'success');
        }

        // Notification system
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            $('.notification').remove();

            const notification = $(`
                <div class="notification notification-${type}">
                    ${message}
                </div>
            `);

            // Add notification styles
            notification.css({
                position: 'fixed',
                top: '20px',
                right: '20px',
                background: type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6',
                color: 'white',
                padding: '15px 20px',
                borderRadius: '8px',
                boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
                zIndex: 1000,
                maxWidth: '400px',
                animation: 'slideIn 0.3s ease-out'
            });

            $('body').append(notification);

            // Auto remove after 4 seconds
            setTimeout(() => {
                notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 4000);
        }

        // Add slideIn animation
        $('<style>')
            .prop('type', 'text/css')
            .html(`
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
                
                .notification {
                    animation: slideIn 0.3s ease-out;
                }
            `)
            .appendTo('head');

        // Auto-hide alerts after 5 seconds
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut(500);
            }, 5000);
        });

        // Refresh statistics
        function refreshStatistics() {
            const dateFrom = $('input[name="date_from"]').val();
            const dateTo = $('input[name="date_to"]').val();

            $.ajax({
                url: '/dashboard/statistics',
                method: 'GET',
                data: {
                    date_from: dateFrom,
                    date_to: dateTo
                },
                success: function(response) {
                    if (response.success && response.stats) {
                        const stats = response.stats;
                        $('.stat-card:nth-child(1) .stat-number').text(stats.total_vouchers);
                        $('.stat-card:nth-child(2) .stat-number').text(stats.receive_vouchers);
                        $('.stat-card:nth-child(3) .stat-number').text(stats.payment_vouchers);
                        $('.stat-card:nth-child(4) .stat-number').text('Rp ' + new Intl.NumberFormat('id-ID')
                            .format(stats.net_amount));
                    }
                }
            });
        }

        // Initialize tooltips for action buttons
        $(document).ready(function() {
            $('.action-btn').hover(
                function() {
                    const title = $(this).attr('title');
                    if (title) {
                        const tooltip = $(`<div class="tooltip">${title}</div>`);
                        tooltip.css({
                            position: 'absolute',
                            background: '#1e293b',
                            color: 'white',
                            padding: '4px 8px',
                            borderRadius: '4px',
                            fontSize: '12px',
                            zIndex: 1001,
                            whiteSpace: 'nowrap'
                        });

                        $('body').append(tooltip);

                        const rect = this.getBoundingClientRect();
                        tooltip.css({
                            left: rect.left + (rect.width / 2) - (tooltip.outerWidth() / 2),
                            top: rect.top - tooltip.outerHeight() - 5
                        });

                        $(this).data('tooltip', tooltip);
                    }
                },
                function() {
                    const tooltip = $(this).data('tooltip');
                    if (tooltip) {
                        tooltip.remove();
                    }
                }
            );
        });

        // Print functionality
        function printReport() {
            window.print();
        }

        // Add print styles
        $('<style>')
            .prop('type', 'text/css')
            .html(`
                @media print {
                    body {
                        background: white !important;
                        padding: 0 !important;
                    }
                    
                    .page-header,
                    .filters-section,
                    .stats-section,
                    .action-buttons-cell,
                    .pagination-container {
                        display: none !important;
                    }
                    
                    .container {
                        box-shadow: none !important;
                        border: 1px solid #000 !important;
                    }
                    
                    .report-table {
                        font-size: 12px !important;
                    }
                    
                    .report-table th,
                    .report-table td {
                        padding: 6px !important;
                    }
                }
            `)
            .appendTo('head');
    </script>
</body>

</html>
