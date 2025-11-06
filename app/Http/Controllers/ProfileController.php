<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     */
    public function show()
    {
        return view('user-dashboard.side-pages.profile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Format date of birth if provided
        if (isset($validated['date_of_birth'])) {
            $validated['date_of_birth'] = date('Y-m-d', strtotime($validated['date_of_birth']));
        }

        // Get the original user data before update
        $originalData = $user->getOriginal();
        $originalData = array_intersect_key($originalData, array_flip([
            'name', 'email', 'phone', 'father_name', 'mother_name', 
            'date_of_birth', 'gender', 'address', 'city', 'state', 'pincode'
        ]));

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            
            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['photo'] = $path;
        }

        // Get the changed fields
        $changedFields = [];
        foreach ($validated as $key => $value) {
            if (array_key_exists($key, $originalData) && $originalData[$key] != $value) {
                $changedFields[$key] = [
                    'from' => $originalData[$key],
                    'to' => $value
                ];
            }
        }

        // Update user
        $user->update($validated);

        // Log the profile update activity if there are changes
        if (!empty($changedFields)) {
            $changesDescription = 'Updated profile information';
            
            UserActivity::log(
                $user->id,
                UserActivity::TYPE_UPDATED,
                $changesDescription,
                UserActivity::MODEL_PROFILE,
                $user->id,
                [], // Don't store old values
                []  // Don't store new values
            );
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!',
                'photo_url' => $user->profile_photo_url ?? null
            ]);
        }

        return back()->with([
            'alertType' => 'success',
            'alertMessage' => 'Profile updated successfully!',
        ]);
    }
}
