<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function create(Event $event)
    {
        return view('event-registration.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'roll_number' => 'required|string|max:50',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => ['required', 'digits_between:2,10'],
        ]);

        $registration = new Registration($validated);
        $registration->event_id = $event->id;
        $registration->status = 'pending';
        $registration->save();

        return redirect()
            ->route('registration.success')
            ->with('success', 'Registration successful! We will contact you soon.');
    }

    public function success()
    {
        return view('event-registration.success');
    }
}
