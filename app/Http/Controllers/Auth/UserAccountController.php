<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileUserRequest;

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

    public function edit(UpdateProfileUserRequest $request, User $user)
    {
        try {
            // Update the user's details
            $user->name = $request->name;
            $user->telp = $request->telp;

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = $user->username . '.' . $avatar->getClientOriginalExtension();

                // Delete old avatar file if it exists
                if ($user->avatar != "default.jpg") {
                    if (File::exists(public_path('assets/media/avatars/' . $user->avatar))) {
                        File::delete(public_path('assets/media/avatars/' . $user->avatar));
                    }
                }

                $avatar->move(public_path('assets/media/avatars/'), $filename);
                $user->avatar = $filename;
            }

            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Profile failed to update!');
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
