@extends('layouts.user-dashboard')

<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<style>
    /* Calendar Container */
    .calendar-container {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Calendar Styling */
    #calendar {
        font-family: 'Inter', sans-serif;
        min-width: 900px; /* Minimum width for desktop layout */
        padding: 1rem;
    }
    
    /* Ensure calendar takes full width */
    .fc {
        width: 100% !important;
        max-width: 100%;
    }
    
    /* Day cell styling */
    .fc-daygrid-day {
        min-width: 120px;
        height: 100px;
    }
    
    /* Header styling */
    .fc-col-header {
        width: 100% !important;
    }
    
    .fc-toolbar-title {
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .fc-button {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #212529;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
    }
    
    .fc-button:hover {
        background-color: #e9ecef;
    }
    
    .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .fc-day-today {
        background-color: #f8f9fa !important;
    }
    
    .fc-day-today .fc-daygrid-day-number {
        background-color: #0d6efd;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 2px;
    }
    
    .fc-event {
        border: none;
        border-radius: 4px;
        padding: 2px 4px;
        font-size: 0.8rem;
        margin: 1px 0;
    }
    /* Status Badges - Dark Theme */
    .badge-present {
        background-color: #28a745;
        color: white;
        border: none;
    }
    
    .badge-absent {
        background-color: #dc3545;
        color: white;
        border: none;
    }
    
    .fc-event-present {
        background-color: #28a745;
        color: white;
        border: none;
    }
    
    .fc-event-absent {
        background-color: #dc3545;
        color: white;
        border: none;
    }
    
    .fc-event-leave {
        background-color: #17a2b8;
        color: white;
        border: none;
    }
</style>

<!-- Statistics Cards -->
    <style>
        /* Base Card Styles */
        .attendance-card {
            transition: all 0.3s ease;
            height: 100%;
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .attendance-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
        }
        
        /* Card Content */
        .card-body {
            padding: 2rem 1.25rem; /* add more breathing room */
        }

        /* Ensure text blocks have slight side inset */
        .attendance-card .card-body .d-flex {
            padding-inline: 0.25rem;
        }
        .attendance-card .card-body .card-title,
        .attendance-card .card-body .card-value,
        .attendance-card .card-body .card-subtitle {
            padding-inline: 0.125rem;
        }
        
        .card-icon {
            font-size: 1.5rem !important;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }
        
        .card-title {
            font-size: 0.8rem;
            letter-spacing: 0.3px;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .card-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0.25rem 0;
            line-height: 1.2;
        }
        
        .card-subtitle {
            font-size: 0.8rem;
            color: #6c757d !important;
            margin-bottom: 0;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 2rem; /* increase on mobile so text is not tight */
            }
            
            .card-value {
                font-size: 1.75rem;
            }
            
            .card-icon {
                width: 44px;
                height: 44px;
                font-size: 1.3rem !important;
            }
        }

        /* Enhanced Calendar Styles */
        #calendar {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border: 1px solid #f0f0f0;
        }
        
        /* Calendar Header */
        .fc .fc-toolbar {
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 1.5rem;
        }
        
        .fc .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
        }
        
        /* Calendar Buttons */
        .fc .fc-button {
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #4a5568;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        
        .fc .fc-button:hover {
            background: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
        }
        
        /* Calendar Header Cells */
        .fc .fc-col-header-cell {
            background: #f8fafc;
            padding: 0.75rem 0;
        }
        
        .fc .fc-col-header-cell-cushion {
            color: #4a5568;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.5rem;
        }
        
        /* Day Cells */
        .fc .fc-daygrid-day {
            padding: 0.5rem;
            border: 1px solid #f1f5f9;
            position: relative;
        }
        
        .fc .fc-daygrid-day-number {
            color: #2d3748;
            font-weight: 500;
            padding: 0.5rem;
            font-size: 0.9rem;
            z-index: 1;
            position: relative;
        }
        
        /* Today's Date */
        .fc-day-today {
            background-color: #f0f7ff !important;
        }
        
        /* Remove blue highlight from today's date number */
        .fc-day-today .fc-daygrid-day-number {
            background: transparent !important;
            color: #2d3748 !important;
            border-radius: 0;
            width: auto;
            height: auto;
            display: inline;
            margin: 0;
        }
        
        /* Fix for blue line */
        .fc .fc-daygrid-day.fc-day-today {
            background-color: transparent !important;
        }
        
        /* Event Styling */
        .fc-event {
            border: none !important;
            border-radius: 6px;
            padding: 4px 8px !important;
            margin: 2px 0 !important;
            font-size: 0.75rem !important;
            font-weight: 500 !important;
            cursor: pointer;
            color: inherit !important;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        
        .fc-event .fc-event-main {
            color: inherit !important;
            display: flex;
            align-items: center;
        }
        
        .fc-event .mdi {
            font-size: 0.9em !important;
            margin-right: 4px !important;
        }
        
        /* Attendance Status Colors */
        .attendance-present {
            background-color: #d1fae5;
            color: #059669;
            border-left: 3px solid #10b981;
        }
        
        .attendance-absent {
            background-color: #fee2e2;
            color: #dc2626;
            border-left: 3px solid #ef4444;
        }
        
        /* Event Dot Indicator */
        .fc-daygrid-day-events {
            min-height: 1.5em;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            #calendar {
                padding: 1rem 0.5rem;
            }
            
            .fc .fc-toolbar {
                gap: 8px;
                margin-bottom: 1rem;
            }
            
            .fc .fc-toolbar-title {
                font-size: 1.1rem;
            }
            
            .fc .fc-button {
                padding: 0.35rem 0.75rem;
                font-size: 0.85rem;
            }
            
            .fc .fc-col-header-cell-cushion {
                font-size: 0.7rem;
                padding: 0.5rem 0.25rem;
            }
            
            .fc .fc-daygrid-day-number {
                font-size: 0.8rem;
                padding: 0.25rem;
            }
        }
    </style>

@section('content')
<div class="container-fluid px-3 px-md-4">
    <div class="row mb-3 mb-md-4">
        <div class="col-12">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                <h2 class="h4 mb-2 mb-md-0 font-weight-bold text-dark">Attendance Dashboard</h2>
                <div class="d-flex">
                    <span class="badge bg-white border text-dark p-2">
                        <i class="mdi mdi-calendar-month-outline me-1"></i>
                        <span class="d-none d-sm-inline">{{ now()->format('d D F Y') }}</span>
                        <span class="d-inline d-sm-none">{{ now()->format('d M y') }}</span>
                    </span>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <!-- First Row - 2 Cards -->
    <div class="row g-3 mb-3">
        <!-- Present Card -->
        <div class="col-12 col-md-6 col-xl-4 mb-3">
            <div class="card attendance-card border-left-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-success font-weight-bold card-title mb-2">Present</h6>
                            <div class="card-value text-dark">{{ $stats['present'] ?? 0 }}</div>
                            <p class="text-muted card-subtitle mb-0">Days Present</p>
                        </div>
                        <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                            <i class="mdi mdi-account-check card-icon text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance % Card -->
        <div class="col-12 col-md-6 col-xl-4 mb-3">
            <div class="card attendance-card border-left-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-info font-weight-bold card-title mb-2">Attendance</h6>
                            <div class="card-value text-dark">{{ $stats['attendance_percentage'] ?? 0 }}%</div>
                            <p class="text-muted card-subtitle mb-0">OverAll</p>
                        </div>
                        <div class="bg-info bg-opacity-10 p-2 rounded-circle ms-2">
                            <i class="mdi mdi-chart-arc card-icon text-info" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Absent Card -->
        <div class="col-12 col-md-6 col-xl-4 mb-3">
            <div class="card attendance-card border-left-danger h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-danger font-weight-bold card-title mb-2">Absent</h6>
                            <div class="card-value text-dark">{{ $stats['absent'] ?? 0 }}</div>
                            <p class="text-muted card-subtitle mb-0">Days Absent</p>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-2 rounded-circle ms-2">
                            <i class="mdi mdi-account-remove card-icon text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-dark">Attendance Calendar</h5>
                </div>
                <div class="card-body p-0">
                    <div class="calendar-container">
                        <div id="calendar"></div>
                    </div>
                </div>
                
                @push('scripts')
                <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var calendarEl = document.getElementById('calendar');
                        
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            eventDidMount: function(info) {
                                // Add custom class based on status
                                if (info.event.extendedProps.status) {
                                    info.el.classList.add('attendance-' + info.event.extendedProps.status);
                                }
                                
                                // Add tooltip for events
                                if (info.event.extendedProps.notes) {
                                    info.el.setAttribute('data-bs-toggle', 'tooltip');
                                    info.el.setAttribute('title', info.event.extendedProps.notes);
                                    new bootstrap.Tooltip(info.el);
                                }
                            },
                            initialView: 'dayGridMonth',
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,dayGridWeek,dayGridDay'
                            },
                            views: {
                                dayGridMonth: {
                                    dayMaxEventRows: 3,
                                    dayHeaderFormat: { weekday: 'short', day: 'numeric' },
                                },
                                dayGridWeek: {
                                    dayHeaderFormat: { weekday: 'short', day: 'numeric' },
                                },
                                dayGridDay: {
                                    dayHeaderFormat: { weekday: 'long', month: 'short', day: 'numeric', year: 'numeric' },
                                }
                            },
                            firstDay: 1, // Start week on Monday
                            height: 'auto',
                            dayMaxEvents: true,
                            allDaySlot: false, // Hide the all-day slot
                            slotMinTime: '00:00:00',
                            slotMaxTime: '24:00:00',
                            slotLabelFormat: {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: false
                            },
                            slotLabelInterval: { hours: 24 }, // Show only one time slot per day
                            slotDuration: '24:00:00', // Set slot duration to one day
                            slotLabelContent: function(arg) {
                                // Return empty string to hide time slots
                                return '';
                            },
                            events: {!! json_encode($attendanceData->map(function($item) {
                                $title = $item['status'] === 'holiday' ? 'Holiday' : ucfirst($item['status']);
                                $className = 'attendance-' . $item['status'];
                                
                                return [
                                    'title' => $title,
                                    'start' => $item['date'],
                                    'allDay' => true,
                                    'className' => $className,
                                    'extendedProps' => [
                                        'status' => $item['status'],
                                        'notes' => $item['notes'] ?? null
                                    ]
                                ];
                            })) !!},
                            eventContent: function(arg) {
                                // Custom event rendering
                                let icon = '';
                                switch(arg.event.title.toLowerCase()) {
                                    case 'present':
                                        icon = '<i class="mdi mdi-check-circle me-1"></i>';
                                        break;
                                    case 'absent':
                                        icon = '<i class="mdi mdi-close-circle me-1"></i>';
                                        break;
                                }
                                
                                return { 
                                    html: icon + arg.event.title 
                                };
                            },
                            dateClick: function(info) {
                                // Handle date click if needed
                                console.log('Clicked on: ' + info.dateStr);
                            }
                        });
                        
                        calendar.render();
                        
                        // Update calendar size on window resize
                        window.addEventListener('resize', function() {
                            calendar.updateSize();
                        });
                    });
                </script>
                @endpush
            </div>
        </div>
    </div>

    <!-- Notes Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-dark">Notes</h5>
                </div>
                <div class="card-body p-0">
                    @php
                        $userAttendances = \App\Models\Attendance::where('user_id', auth()->id())
                                ->whereNotNull('notes')
                                ->orderBy('date', 'desc')
                                ->take(10)
                                ->get();
                    @endphp
                    
                    <!-- Desktop View -->
                    <div class="d-none d-md-block">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="attendanceNotesTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Get all holiday notes (where user_id is null)
                                        $holidayNotes = \App\Models\Attendance::whereNull('user_id')
                                            ->whereNotNull('notes')
                                            ->orderBy('date', 'desc')
                                            ->take(10) // Limit to 10 most recent holidays
                                            ->get()
                                            ->keyBy(function($item) {
                                                return $item->date->format('Y-m-d');
                                            });
                                        
                                        // Merge user notes and holiday notes
                                        $allNotes = [];
                                        
                                        // Add user notes
                                        foreach ($userAttendances as $attendance) {
                                            $dateKey = $attendance->date->format('Y-m-d');
                                            $allNotes[$dateKey] = [
                                                'date' => $dateKey,
                                                'status' => $attendance->status,
                                                'notes' => $attendance->notes,
                                                'is_holiday' => false
                                            ];
                                            
                                            // Add holiday note for this date if exists
                                            if (isset($holidayNotes[$dateKey])) {
                                                $allNotes[$dateKey . '-holiday'] = [
                                                    'date' => $dateKey,
                                                    'status' => 'holiday',
                                                    'notes' => $holidayNotes[$dateKey]->notes,
                                                    'is_holiday' => true
                                                ];
                                            }
                                        }
                                        
                                        // Add any holiday notes that don't have user notes
                                        foreach ($holidayNotes as $dateKey => $holiday) {
                                            if (!isset($allNotes[$dateKey])) {
                                                $allNotes[$dateKey] = [
                                                    'date' => $dateKey,
                                                    'status' => 'holiday',
                                                    'notes' => $holiday->notes,
                                                    'is_holiday' => true
                                                ];
                                            }
                                        }
                                        
                                        // Sort by date descending
                                        krsort($allNotes);
                                        $allNotes = array_slice($allNotes, 0, 10); // Limit to 10 most recent
                                    @endphp
                                    
                                    @forelse($allNotes as $note)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($note['date'])->format('M d, Y') }}</td>
                                            <td>
                                                @php
                                                    $status = $note['status'] ?? 'present';
                                                    $statusClass = [
                                                        'holiday' => 'bg-info',
                                                        'absent' => 'bg-danger',
                                                        'leave' => 'bg-warning',
                                                        'present' => 'bg-success',
                                                    ][$status] ?? 'bg-secondary';
                                                @endphp
                                                <span class="badge {{ $statusClass }}">
                                                    {{ ucfirst($status) }}
                                                    @if($note['is_holiday'])
                                                        <i class="mdi mdi-star ms-1"></i>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="notes-content">
                                                {{ $note['notes'] }}
                                                @if($note['is_holiday'])
                                                    <span class="badge bg-light text-dark ms-2">Holiday</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-4">No attendance or holiday notes found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Mobile View -->
                    <div class="d-md-none">
                        @php
                            // Get holiday notes for mobile view
                            $mobileHolidayNotes = \App\Models\Attendance::whereNull('user_id')
                                ->whereNotNull('notes')
                                ->whereIn('date', $userAttendances->pluck('date')->map(function($date) {
                                    return $date->format('Y-m-d');
                                }))
                                ->get()
                                ->keyBy(function($item) {
                                    return $item->date->format('Y-m-d');
                                });
                                
                            // Create a combined collection for mobile view
                            $mobileNotes = collect();
                            
                            // Add user notes
                            foreach ($userAttendances as $attendance) {
                                $dateKey = $attendance->date->format('Y-m-d');
                                $mobileNotes->push((object)[
                                    'date' => $dateKey,
                                    'status' => $attendance->status,
                                    'notes' => $attendance->notes,
                                    'is_holiday' => false
                                ]);
                                
                                // Add holiday note for this date if exists
                                if (isset($mobileHolidayNotes[$dateKey])) {
                                    $mobileNotes->push((object)[
                                        'date' => $dateKey,
                                        'status' => 'holiday',
                                        'notes' => $mobileHolidayNotes[$dateKey]->notes,
                                        'is_holiday' => true
                                    ]);
                                }
                            }
                            
                            // Add any holiday notes that don't have user notes
                            foreach ($mobileHolidayNotes as $dateKey => $holiday) {
                                $hasUserNote = $userAttendances->contains(function($item) use ($dateKey) {
                                    return $item->date->format('Y-m-d') === $dateKey;
                                });
                                
                                if (!$hasUserNote) {
                                    $mobileNotes->push((object)[
                                        'date' => $dateKey,
                                        'status' => 'holiday',
                                        'notes' => $holiday->notes,
                                        'is_holiday' => true
                                    ]);
                                }
                            }
                            
                            // Sort by date descending and take 10 most recent
                            $mobileNotes = $mobileNotes->sortByDesc('date')->take(10);
                        @endphp
                        
                        @forelse($mobileNotes as $note)
                            @php
                                $statusClass = [
                                    'present' => 'bg-success',
                                    'absent' => 'bg-danger',
                                    'holiday' => 'bg-info',
                                    'leave' => 'bg-warning',
                                ][$note->status] ?? 'bg-secondary';
                            @endphp
                            <div class="border-bottom p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted small">{{ \Carbon\Carbon::parse($note->date)->format('M d, Y') }}</span>
                                    <div>
                                        @if($note->is_holiday)
                                            <span class="badge bg-light text-dark me-1">Holiday</span>
                                        @endif
                                        <span class="badge {{ $statusClass }}">
                                            {{ ucfirst($note->status) }}
                                            @if($note->is_holiday)
                                                <i class="mdi mdi-star ms-1"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="notes-content">
                                    {{ $note->notes }}
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">No attendance or holiday notes found.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        /* Mobile styles */
        @media (max-width: 767.98px) {
            .notes-content {
                font-size: 0.9rem;
                line-height: 1.5;
                color: #333;
            }
            
            .card-body {
                padding: 0 !important;
            }
            
            .border-bottom:last-child {
                border-bottom: none !important;
            }
        }
        
        /* Desktop styles */
        @media (min-width: 768px) {
            .table th, .table td {
                padding: 0.75rem 1.5rem;
            }
        }
    </style>

    @push('styles')
    <style>
        #attendanceNotesTable {
            font-size: 0.9rem;
        }
        #attendanceNotesTable th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        #attendanceNotesTable td {
            vertical-align: middle;
        }
        .badge {
            font-size: 0.8em;
            padding: 0.35em 0.65em;
        }
    </style>
    @endpush
</div>
@endsection
