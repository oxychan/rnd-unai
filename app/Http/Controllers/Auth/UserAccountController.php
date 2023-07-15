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
use App\Models\Menu;
use App\Models\Request as ModelsRequest;
use App\Models\RequestType;
use Spatie\Permission\Models\Role;

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

    public function dashboard()
    {
        $user = Auth::user();
        $jumlah_user = 0;
        $jumlah_jenis_permohonan = 0;
        $jumlah_role = 0;
        $jumlah_menu = 0;
        $diajukan = 0;
        $diproses = 0;
        $ditolak = 0;
        $selesai = 0;

        // role admin 
        if ($user->roles[0]->id == 1) {
            $jumlah_user = User::count();
            $jumlah_jenis_permohonan = RequestType::count();
            $jumlah_role = Role::count();
            $jumlah_menu = Menu::count();
        }

        // role user
        if ($user->roles[0]->id == 2) {
            $diajukan = ModelsRequest::where('id_user', $user->id)->where('status', 0)->count();
            $diproses = ModelsRequest::where('id_user', $user->id)->where('status', 1)->count();
            $ditolak = ModelsRequest::where('id_user', $user->id)->where('status', 2)->count();
            $selesai = ModelsRequest::where('id_user', $user->id)->where('status', 3)->count();
        }

        // role helpdesk
        if ($user->roles[0]->id == 5) {
            $diajukan = ModelsRequest::where('status', 0)->count();
            $diproses = ModelsRequest::where('id_helpdesk', $user->id)->where('status', 1)->count();
            $ditolak = ModelsRequest::where('id_helpdesk', $user->id)->where('status', 2)->count();
            $selesai = ModelsRequest::where('id_helpdesk', $user->id)->where('status', 3)->count();
        }

        // role spv
        if ($user->roles[0]->id == 3) {
            $diajukan = ModelsRequest::where('id_spv', $user->id)->where('status', 0)->count();
            $diproses = ModelsRequest::where('id_spv', $user->id)->where('status', 1)->count();
            $selesai = ModelsRequest::where('id_spv', $user->id)->where('status', 3)->count();
        }

        // role worker
        if ($user->roles[0]->id == 4) {
            $diajukan = ModelsRequest::where('id_worker', $user->id)->where('status', 0)->count();
            $diproses = ModelsRequest::where('id_worker', $user->id)->where('status', 1)->count();
            $selesai = ModelsRequest::where('id_worker', $user->id)->where('status', 3)->count();
        }

        $data = [
            'name' => $user->name,
            'diajukan' => $diajukan,
            'diproses' => $diproses,
            'selesai' => $selesai,
            'ditolak' => $ditolak,
            'jumlah_user' => $jumlah_user,
            'jumlah_jenis_permohonan' => $jumlah_jenis_permohonan,
            'jumlah_role' => $jumlah_role,
            'jumlah_menu' => $jumlah_menu,
        ];

        return view('dashboard.index', compact('data'));
    }
}
