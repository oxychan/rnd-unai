<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\IncommingRequestSpvDataTable;

class SpvRequestController extends Controller
{
    public function incommingRequest(IncommingRequestSpvDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.supervisor.incomming.index');
    }
}
