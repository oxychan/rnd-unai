<?php

namespace App\Http\Controllers\Management;

use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserManagementRequest;
use App\Http\Requests\UserManagementUpdateRequest;

class UserManagementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTables)
    {
        return $dataTables->render('management.user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $user = null;
        return view('management.userCreateUpdate', compact('roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserManagementRequest $request)
    {
        $defaultValue = [
            'avatar' => 'default.jpg',
            'password' => Hash::make('password')
        ];

        $newUser = User::make(array_merge($request->except('role'), $defaultValue));

        try {
            $newUser->save();
            $newUser->assignRole($request->role);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan user!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil menambahkan user!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('management.userCreateUpdate', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserManagementUpdateRequest $request, User $user)
    {
        try {
            $user->update($request->except('role'));
            $user->syncRoles($request->role);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui user!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil memperbarui user!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data user gagal dihapus!'
            ], 500);
        }

        return response()->json([
            'message' => 'Data user berhasil dihapus!'
        ], 204);
    }
}
