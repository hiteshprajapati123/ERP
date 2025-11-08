<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = Event::upcoming()
            ->orderBy('event_date', 'asc')
            ->paginate(6);  // Show 6 events per page

        return view('events.index', compact('events'));
    }
    

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = new Event($validated);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $event->image_url = Storage::url($path);
        }

        $event->save();

        return redirect()->route('events.show', $event->slug)
            ->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified event.
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        
        $registrationsCount = \App\Models\Registration::where('event_id', $event->id)->count();

        // Format event data for the view
        $rawPath = $event->image_url ? ltrim($event->image_url, '/') : null;
        if ($rawPath) {
            // Normalize to just the filename relative to private/events
            $patterns = [
                'private/events/',
                'events/',
                'storage/app/private/events/',
                'app/private/events/',
            ];
            foreach ($patterns as $prefix) {
                if (str_starts_with($rawPath, $prefix)) {
                    $rawPath = substr($rawPath, strlen($prefix));
                    break;
                }
            }
            // If path still contains directories, keep as relative under private/events
        }
        $formattedEvent = [
            'title' => $event->title,
            'description' => $event->description,
            'date' => $event->event_date->format('F j, Y'),
            'time' => $event->start_time ? $event->start_time->format('h:i A') : 'TBD',
            'end_time' => $event->end_time ? $event->end_time->format('h:i A') : null,
            'location' => $event->location,
            'address' => $event->address,
            'image' => $rawPath ? route('events.image', ['path' => $rawPath]) : null,
            'images' => $rawPath ? [route('events.image', ['path' => $rawPath])] : [],
            'category' => $event->is_featured ? 'Featured Event' : 'Event',
            'details' => [
                'Event will start at ' . ($event->start_time ? $event->start_time->format('h:i A') : 'TBD'),
                $event->end_time ? 'Ends at ' . $event->end_time->format('h:i A') : 'Time TBD',
                'Location: ' . $event->location,
                $event->address ? 'Address: ' . $event->address : '',
                $event->registration_required ? 'Registration is required' : 'Open to all',
                $event->max_attendees ? 'Maximum attendees: ' . $event->max_attendees : ''
            ],
            'registration_required' => (bool) $event->registration_required,
            'max_attendees' => $event->max_attendees,
            'registrations_count' => $registrationsCount,
            'contact_person' => 'Event Organizer',
            'contact_email' => 'info@example.com',
            'contact_phone' => '+1 234 567 8900',
            'registration_link' => $event->registration_required ? '#' : null
        ];

        // Get related events
        $relatedEvents = Event::where('id', '!=', $event->id)
            ->upcoming()
            ->take(3)
            ->get()
            ->map(function($relatedEvent) {
                return [
                    'title' => $relatedEvent->title,
                    'date' => $relatedEvent->event_date->format('M d, Y'),
                    'category' => $relatedEvent->is_featured ? 'Featured Event' : 'Event',
                    'image' => $relatedEvent->image_url,
                    'slug' => $relatedEvent->slug
                ];
            });

        return view('events.details', [
            'event' => $formattedEvent,
            'relatedEvents' => $relatedEvents
        ]);
    }

    /**
     * Serve private-stored event images securely.
     */
    public function image(string $path)
    {
        $fullPath = 'private/events/' . ltrim($path, '/');
        if (!Storage::disk('local')->exists($fullPath)) {
            abort(404);
        }

        $mime = Storage::disk('local')->mimeType($fullPath) ?: 'image/jpeg';
        $stream = Storage::disk('local')->readStream($fullPath);
        return response()->stream(function () use ($stream) {
            fpassthru($stream);
        }, 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $event->fill($validated);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image_url) {
                $oldImage = str_replace('/storage', 'public', $event->image_url);
                Storage::delete($oldImage);
            }
            
            $path = $request->file('image')->store('events', 'public');
            $event->image_url = Storage::url($path);
        }

        $event->save();

        return redirect()->route('events.show', $event->slug)
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image_url) {
            $imagePath = str_replace('/storage', 'public', $event->image_url);
            Storage::delete($imagePath);
        }
        
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }
    
    /**
     * Display a listing of featured events.
     */
    public function featured()
    {
        $events = Event::featured()
            ->upcoming()
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        return $events;
    }
}
