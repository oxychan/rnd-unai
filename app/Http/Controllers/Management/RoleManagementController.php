<?php

namespace App\Http\Controllers\Management;

use App\DataTables\MenusDataTable;
use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleManagementStoreRequest;
use App\Http\Requests\RoleManagementUpdateRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Menu;
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
        return $dataTables->render('dashboard.management.role');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = null;
        return view('dashboard.management.roleCreateUpdate', compact('role'));
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
            $request['name'] = strtolower($request->name);
            $role = Role::create($request->all());
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
    public function show(Role $role)
    {
        $menus = Menu::all();
        return view('dashboard.management.roleConfigurePermission', compact('role', 'menus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('dashboard.management.roleCreateUpdate', compact('role'));
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
            $request['name'] = strtolower($request->name);
            $role->update($request->all());
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

    public function updatePermissions(UpdatePermissionRequest $request, Role $role)
    {
        try {
            $menus = Menu::all();
            // Update permissions for each menu
            $permissions = [];

            foreach ($menus as $menu) {

                if ($request["{$menu->name}_read"]) {
                    $permissions[] =  "read {$menu->url}";
                }

                if ($request["{$menu->name}_update"]) {
                    $permissions[] = "update {$menu->url}";
                }

                if ($request["{$menu->name}_create"]) {
                    $permissions[] = "create {$menu->url}";
                }

                if ($request["{$menu->name}_delete"]) {
                    $permissions[] = "delete {$menu->url}";
                }

                if ($menu->root != null) {
                    $permissions[] = "read {$menu->parent->url}";
                }
            }

            $permissions = array_unique($permissions);

            $role->syncPermissions($permissions);

            return redirect()->back()->with('success', 'Role permissions updated successfully.');
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Permission gagal diperbarui!'
            ], 500);
        }

        return response()->json([
            'message' => 'Permission berhasil diperbarui!'
        ], 200);
    }
}
