<?php

namespace App\Http\Controllers\Management;

use App\DataTables\RequestTypesDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTypeRequest;
use App\Models\RequestType;

class RequestTypeController extends Controller
{
    public function index(RequestTypesDataTable $dataTables)
    {
        return $dataTables->render('management.requestType');
    }

    public function create()
    {
        $requestType = null;
        return view('management.requestTypeCreateUpdate', compact('requestType'));
    }

    public function store(RequestTypeRequest $request)
    {
        try {
            RequestType::create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menambahkan jenis permohonan!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil menambahkan jenis permohonan!'
        ], 201);
    }

    public function edit(RequestType $requestType)
    {
        return view('management.requestTypeCreateUpdate', compact('requestType'));
    }

    public function update(RequestTypeRequest $request, RequestType $requestType)
    {
        try {
            $requestType->update($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui jenis permohonan!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil memperbarui jenis permohonan!'
        ], 200);
    }

    public function destroy(RequestType $requestType)
    {
        try {
            $requestType->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus jenis permohonan!'
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil menghapus jenis permohonan!'
        ], 200);
    }
}
