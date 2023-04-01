<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{

    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        // dd($request->all());
        try {
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'The current password is incorrect.',
                ], 422);
            }

            $user->password = Hash::make($request->password);
            $user->save();
        } catch (\Exception $e) {
            // Handle the exception here
            return response()->json([
                'message' => 'An error occurred while updating the password.',
            ], 500);
        }

        return response()->json([
            'message' => 'Password updated successfully!',
        ], 200);
    }

    public function index()
    {
        $user = Auth::user();
        return view('user.profileAccount', compact('user'));
    }

    // public function edit(Request $request)
    // {
    //     // Get the authenticated user
    //     $user = Auth::user();

    //     // Validate the form data
    //     $request->validate([
    //         'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'name' => 'required|string|max:255',
    //         'company' => 'required|email|string|max:255|unique:users,email,' . $user->id,
    //         'phone' => 'nullable|string|max:20',
    //     ]);

    //     // Update the user's details
    //     $user->name = $request->name;
    //     $user->email = $request->company;
    //     $user->no_telp = $request->phone;

    //     // Handle avatar upload
    //     if ($request->hasFile('avatar')) {
    //         $avatar = $request->file('avatar');
    //         $filename = time() . '.' . $avatar->getClientOriginalExtension();
    //         $avatar->move(public_path('uploads/avatars'), $filename);
    //         $user->avatar = $filename;
    //     } elseif ($request->has('avatar_remove')) {
    //         $user->avatar = null;
    //     }

    //     $user->save();

    //     // Redirect the user back with a success message
    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }
}
