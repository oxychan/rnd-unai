<?php

namespace App\Http\Controllers;

use App\DataTables\UserRequestDataTable;
use App\Http\Requests\UserReqRequest;
use App\Models\Request as ModelsRequest;
use App\Models\RequestType;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                $fileName = $currentUser->name . '_' . Carbon::now()->format('d-m-Y') . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/media/files/permohonan/'), $fileName);
                $requestUser->file_name = $fileName;
                $requestUser->save();
            }

            return response()->json([
                'message' => 'Berhasil mengirimkan permohonan!',
                'request_id' => $requestUser->id
            ], 201);
        } catch (Exception $e) {
            dd($e->getMessage());
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

    public function update()
    {
    }
}
