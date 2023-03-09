<?php

namespace App\Http\Controllers\Management;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleManagementStoreRequest;
use App\Http\Requests\RoleManagementUpdateRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RolesDataTable $dataTables)
    {
        return $dataTables->render('dashboard.superadmin.management.role');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = null;
        return view('dashboard.superadmin.management.roleCreateUpdate', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleManagementStoreRequest $request)
    {
        try {
            $role = Role::create($request->validated());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan role!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil menambahkan role!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('dashboard.superadmin.management.roleCreateUpdate', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleManagementUpdateRequest $request, Role $role)
    {
        try {
            $role->update($request->validated());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui role!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil memperbarui role!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $role->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data role gagal dihapus!'
            ], 500);
        }

        return response()->json([
            'message' => 'Data role berhasil dihapus!'
        ], 200);
    }
}
