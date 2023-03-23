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
            $menu = Menu::create($request->validated());
            $permission = Permission::create([
                [
                    'name' => 'read ' . $menu->url
                ],
                [
                    'name' => 'update ' . $menu->url
                ],
                [
                    'name' => 'create ' . $menu->url
                ],
                [
                    'name' => 'delete ' . $menu->url
                ]
            ]);

            dd($permission);

            $admin = Role::findByName('admin');
            $admin->givePermissionTo($permission);
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

            $menu->update($request->validated());
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
