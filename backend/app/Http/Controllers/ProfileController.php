<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $profile = $request->user()->profile;

        if (!$profile) {
            return response()->json(['message' => 'Profile not found.'], 404);
        }

        return response()->json(['profile' => $profile], 200);
    }

    public function update(Request $request)
    {
        $profile = $request->user()->profile;

        if (!$profile) {
            return response()->json(['message' => 'Profile not found.'], 404);
        }

        $fields = $request->validate([
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
        ]);

        $profile->update($fields);

        return response()->json(['message' => 'Profile updated successfully.', 'profile' => $profile], 200);
    }
}
