<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RequestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserReqRequest;
use Illuminate\Support\Facades\Storage;
use App\DataTables\UserRequestDataTable;
use App\Models\Request as ModelsRequest;

class UserRequestController extends Controller
{
    public function index(UserRequestDataTable $dataTable)
    {
        $user = Auth::user();

        // display the data tables with data from current user
        return $dataTable->with(['user' => $user])->render('request.user.index');
    }

    public function create()
    {
        $requestTypes = RequestType::all();
        $currentReq = null;
        return view('request.user.requestCreateUpdate', compact('currentReq', 'requestTypes'));
    }

    public function store(UserReqRequest $request)
    {
        try {
            $currentUser = Auth::user();

            $defaultValue = [
                'id_user' => $currentUser->id,
                'id_type' => $request->input('request_type'),
                'status' => 0,
            ];

            $newRequest = array_merge($request->except('request_type'), $defaultValue);

            $requestUser =  ModelsRequest::create($newRequest);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = $currentUser->name . '_' . Carbon::now()->format('d-m-Y-h-i-s') . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/media/files/permohonan/'), $fileName);
                $requestUser->file_name = $fileName;
                $requestUser->save();
            }

            return response()->json([
                'message' => 'Berhasil mengirimkan permohonan!',
                'request_id' => $requestUser->id
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal mengirimkan permohonan!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $currentReq = ModelsRequest::find($id);
        return view('request.user.requestDetail', compact('currentReq'));
    }

    public function edit($id)
    {
        $requestTypes = RequestType::all();
        $currentReq = ModelsRequest::find($id);
        return view('request.user.requestCreateUpdate', compact('currentReq', 'requestTypes'));
    }

    public function update(UserReqRequest $request, $id)
    {
        try {
            $currentUser = Auth::user();
            $requestUser = ModelsRequest::findOrFail($id);

            $oldFile = public_path('assets/media/files/permohonan/' . $requestUser->file_name);

            $updatedRequest = $request->except('request_type', 'id_user', 'id_type', 'status');


            $requestUser->update($updatedRequest);

            $requestUser->status = 0;
            $requestUser->save();

            if ($request->hasFile('file')) {
                // delete old file
                if ($requestUser->file_name && file_exists($oldFile)) {
                    unlink($oldFile);
                }

                $file = $request->file('file');
                $fileName = $currentUser->name . '_' . Carbon::now()->format('d-m-Y-h-i-s') . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/media/files/permohonan/'), $fileName);
                $requestUser->file_name = $fileName;
                $requestUser->save();
            }

            return response()->json([
                'message' => 'Permohonan berhasil diperbarui!',
                'request_id' => $requestUser->id,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui permohonan!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
