@extends('layouts.user-dashboard')

@section('title', 'Fees')

@push('styles')
<style>
    /* Custom styles for better mobile experience */
    @media (max-width: 768px) {
        .card-header h5 {
            font-size: 1.1rem;
        }
        .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }
        .table-responsive {
            border: 0;
            margin: 0 -1rem;
            width: calc(100% + 2rem);
        }
        .table {
            margin-bottom: 0;
        }
        .table th, .table td {
            padding: 0.5rem;
            font-size: 0.85rem;
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.3em 0.6em;
        }
        .modal-dialog {
            margin: 0.5rem;
        }
    }
    
    /* Card hover effect for desktop only */
    @media (min-width: 769px) {
        .card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
        }
    }
    
    /* Better spacing for mobile */
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        .card {
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .card-body {
            padding: 1rem;
        }
    }
    
    /* Status badges */
    .badge {
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    /* Action buttons */
    .btn-action {
        min-width: 90px;
    }
    
    /* Table improvements */
    .table th {
        white-space: nowrap;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Payment summary cards */
    .summary-card {
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary-color);
    }
    .summary-card .card-body {
        padding: 1rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0 px-md-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center py-3">
                    <h5 class="mb-2 mb-md-0">Fee Payment</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 mb-4">
                        <!-- Total Fees -->
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="card h-100 summary-card border-start-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Total Fees</h6>
                                            <h3 class="mb-0">₹{{ number_format($totalFees) }}</h3>
                                            <p class="text-muted small mb-0">For Academic Year {{ date('Y') }}-{{ date('Y')+1 }}</p>
                                        </div>
                                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-receipt text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Paid Fees -->
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="card h-100 summary-card border-start-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Paid Amount</h6>
                                            <h3 class="text-success mb-0">₹{{ number_format($paidFees) }}</h3>
                                            <p class="text-muted small mb-0">{{ $fees->where('status', 'paid')->count() }} installments</p>
                                        </div>
                                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Fees (all pending fees regardless of due date) -->
                        <div class="col-12 col-md-6 col-xl-3">
                            @php
                                $pendingFees = $fees->where('status', 'pending');
                                $pendingAmount = $pendingFees->sum('amount');
                                $pendingCount = $pendingFees->count();
                            @endphp
                            <div class="card h-100 summary-card border-start-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Pending Fees</h6>
                                            <h3 class="text-warning mb-0">₹{{ number_format($pendingAmount) }}</h3>
                                            <p class="text-muted small mb-0">{{ $pendingCount }} installments</p>
                                        </div>
                                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-clock text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Overdue Fees (only explicitly overdue fees) -->
                        <div class="col-12 col-md-6 col-xl-3">
                            @php
                                $overdueFees = $fees->where('status', 'overdue')->sum('amount');
                                $overdueCount = $fees->where('status', 'overdue')->count();
                            @endphp
                            <div class="card h-100 summary-card border-start-danger">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-muted text-uppercase small fw-bold mb-1">Overdue</h6>
                                            <h3 class="text-danger mb-0">₹{{ number_format($overdueFees) }}</h3>
                                            <p class="text-muted small mb-0">{{ $overdueCount }} installments</p>
                                        </div>
                                        <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                                            <i class="fas fa-exclamation-circle text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Table -->
                    <div class="d-none d-md-block">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Month</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Paid Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fees as $index => $fee)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($fee->due_date)->format('F Y') }}</td>
                                        <td style="max-width: 250px;">{{ $fee->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') }}</td>
                                        <td class="fw-medium">₹{{ number_format($fee->amount) }}</td>
                                        <td>
                                            @if($fee->status === 'paid')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i> Paid
                                                </span>
                                            @elseif($fee->status === 'pending')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i> Pending
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-exclamation-circle me-1"></i> {{ ucfirst($fee->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $fee->paid_date ? $fee->paid_date->format('M d, Y') : 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="d-md-none">
                        @forelse($fees as $index => $fee)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">#{{ $index + 1 }}</span>
                                    <span class="badge 
                                        {{ $fee->status === 'paid' ? 'bg-success' : 
                                          ($fee->status === 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ ucfirst($fee->status) }}
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <div class="text-muted small">Month</div>
                                    <div>{{ \Carbon\Carbon::parse($fee->due_date)->format('F Y') }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="text-muted small">Description</div>
                                    <div>{{ $fee->description }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-muted small">Due Date</div>
                                        <div>{{ \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small">Amount</div>
                                        <div class="fw-medium">₹{{ number_format($fee->amount) }}</div>
                                    </div>
                                </div>
                                @if($fee->paid_date)
                                <div class="mt-2">
                                    <div class="text-muted small">Paid On</div>
                                    <div>{{ $fee->paid_date->format('M d, Y') }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @empty
                            <div class="text-center py-4">No fee records found.</div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Payment Instructions</h6>
                            <ul class="mb-0">
                                <li>Please pay your fees at the school office during working hours (9:00 AM - 3:00 PM, Monday to Saturday).</li>
                                <li>Make sure to pay before the due date to avoid late fees.</li>
                                <li>Bring your student ID or fee receipt for reference.</li>
                                <li>For any payment related queries, please contact the accounts department.</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Make table responsive on mobile
        function makeTableResponsive() {
            const tables = document.querySelectorAll('table:not(.responsive-processed)');
            
            tables.forEach(table => {
                // Skip if already processed
                if (table.classList.contains('responsive-processed')) return;
                
                // Check if screen is mobile
                if (window.innerWidth <= 768) {
                    // Add responsive wrapper if not exists
                    if (!table.parentElement.classList.contains('table-responsive')) {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'table-responsive';
                        table.parentNode.insertBefore(wrapper, table);
                        wrapper.appendChild(table);
                    }
                    
                    // Add data-label attributes for mobile view
                    const headers = [];
                    table.querySelectorAll('thead th').forEach((th, index) => {
                        headers[index] = th.textContent.trim();
                    });
                    
                    table.querySelectorAll('tbody tr').forEach(row => {
                        row.querySelectorAll('td').forEach((cell, index) => {
                            if (headers[index]) {
                                cell.setAttribute('data-label', headers[index]);
                            }
                        });
                    });
                }
                
                table.classList.add('responsive-processed');
            });
        }
        
        // Call on load and window resize
        makeTableResponsive();
        
        // Debounce resize events
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(makeTableResponsive, 250);
        });
    });
</script>
@endpush

<style>
    /* Additional responsive styles */
    @media (max-width: 768px) {
        .table thead {
            display: none;
        }
        
        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }
        
        .table tr {
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .table td {
            padding: 0.75rem;
            text-align: right;
            position: relative;
            padding-left: 50%;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table td:last-child {
            border-bottom: 0;
        }
        
        .table td:before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            width: 45%;
            text-align: left;
            font-weight: 600;
            color: #6c757d;
        }
        
        /* Hide action label on mobile */
        .table td[data-label="Action"]:before {
            display: none;
        }
        
        .table td[data-label="Action"] {
            text-align: center;
            padding-left: 0.75rem;
        }
        
        /* Make buttons full width on mobile */
        .btn-action {
            width: 100%;
            margin: 0.25rem 0;
        }
    }
    
    /* Animation for table rows */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .table tbody tr {
        animation: fadeIn 0.3s ease-out forwards;
    }
    
    /* Custom scrollbar for table */
    .table-responsive::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>