<?php

namespace App\Http\Controllers\Management;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\DataTables\MenusDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuManagementStoreRequest;
use App\Http\Requests\MenuManagementUpdateRequest;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MenuManagementController extends Controller
{
    public function index(MenusDataTable $dataTables)
    {
        return $dataTables->render('dashboard.management.menu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::where('root', null)->get();
        $menu = null;
        return view('dashboard.management.menuCreateUpdate', compact('menu', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuManagementStoreRequest $request)
    {
        try {
            $menu = Menu::create($request->all());

            $permissions = [
                Permission::create(['name' => 'read ' . $menu->url]),
                Permission::create(['name' => 'update ' . $menu->url]),
                Permission::create(['name' => 'create ' . $menu->url]),
                Permission::create(['name' => 'delete ' . $menu->url])
            ];

            $permissions = array_column($permissions, 'name');

            $admin = Role::findByName('admin');
            $admin->givePermissionTo($permissions);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan menu!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil menambahkan menu!'
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $menus = Menu::where('root', null)->get();
        return view('dashboard.management.menuCreateUpdate', compact('menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuManagementUpdateRequest $request, Menu $menu)
    {
        if ($menu->root == null) {
            $request['root'] = null;
        }

        try {
            $oldUrl = $menu->url;
            $menu->update($request->all());
            $newUrl = $menu->url;

            if ($oldUrl != $newUrl) {
                $permissions = [
                    'read ' . $oldUrl,
                    'update ' . $oldUrl,
                    'create ' . $oldUrl,
                    'delete ' . $oldUrl,
                ];

                foreach ($permissions as $permission) {
                    $newPermissionName = str_replace($oldUrl, $newUrl, $permission);
                    $permissionModel = Permission::where('name', $permission)->first();
                    $permissionModel->name = $newPermissionName;
                    $permissionModel->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui menu!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil memperbarui menu!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        try {
            $permissions = [
                'read ' . $menu->url,
                'update ' . $menu->url,
                'create ' . $menu->url,
                'delete ' . $menu->url,
            ];
            Permission::whereIn('name', $permissions)->delete();

            $roles = Role::all();
            foreach ($roles as $role) {
                $role->revokePermissionTo($permissions);
            }

            $menu->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data menu gagal dihapus!'
            ], 500);
        }

        return response()->json([
            'message' => 'Data menu berhasil dihapus!'
        ], 200);
    }
}
