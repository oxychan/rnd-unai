<?php

namespace App\Http\Controllers;

use App\DataTables\UserRequestDataTable;
use App\Http\Requests\UserReqRequest;
use App\Models\Request as ModelsRequest;
use App\Models\RequestType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRequestController extends Controller
{
    public function index(UserRequestDataTable $dataTable)
    {
        $user = Auth::user();
        $requestTypes = RequestType::all();
        // display the data tables with data from current user
        return $dataTable->with(['user' => $user])->render('request.user.index', compact('requestTypes'));
    }

    public function create()
    {
    }

    public function store(UserReqRequest $request)
    {
        // dd($request->all());
        try {
            $currentUser = Auth::user();

            $defaultValue = [
                'id_user' => $currentUser->id,
                'id_type' => $request->input('request_type'),
                'status' => 0,
            ];

            $newRequest = array_merge($request->except('request_type'), $defaultValue);

            $requestUser =  ModelsRequest::create($newRequest);

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
}
