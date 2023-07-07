<?php

namespace App\Http\Controllers;

use App\DataTables\DoneRequestSpvDataTable;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserReqCloseTask;
use App\Http\Requests\UserReqUpdateSpv;
use App\Models\Request as ModelsRequest;
use App\DataTables\IncommingRequestSpvDataTable;
use App\DataTables\ProcessedRequestSpvDataTable;
use App\Http\Requests\UserReqUpdateWorker;
use App\Http\Requests\UserReqWeightRequest;
use App\Models\Weight;

class SpvRequestController extends Controller
{
    public function incommingRequest(IncommingRequestSpvDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.supervisor.incomming.index');
    }

    public function processedRequest(ProcessedRequestSpvDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.supervisor.processed.index');
    }

    public function doneRequest(DoneRequestSpvDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.supervisor.done.index');
    }

    public function acceptTask($id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $currentReq->is_spv_approved = 1;
            $currentReq->save();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Menerima task gagal!',
            ], 500);
        }

        return response()->json([
            'message' => 'Task diterima!',
        ], 200);
    }

    public function rejectTask($id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $currentReq->id_spv = null;
            $currentReq->is_spv_approved = 0;
            $currentReq->save();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Menolak task gagal!',
            ], 500);
        }

        return response()->json([
            'message' => 'Task ditolak!',
        ], 200);
    }

    public function showSpvSide($id)
    {
        $currentReq = ModelsRequest::find($id);
        $workers = Role::find(4)->users;
        $weights = Weight::all();
        return view('request.supervisor.detail', compact('currentReq', 'workers', 'weights'));
    }

    public function closeTask(UserReqCloseTask $request, $id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);

            $currentReq->status = 3;
            $currentReq->close_note = $request['close_note'];
            $currentReq->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menutup permohonan!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Permohonan telah diselesaikan!',
        ], 200);
    }

    public function forwardToWorker(UserReqUpdateWorker $request, $id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $spv = auth()->user();

            $currentReq->id_spv = $spv->id;
            $currentReq->id_worker = $request['worker'];
            $currentReq->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal meneruskan ke worker!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil meneruskan permohonan ke worker!',
        ], 200);
    }

    public function requestWeight(UserReqWeightRequest $request, $id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);

            $currentReq->id_weight = $request['weight'];
            $currentReq->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal melakukan pembobotan!!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil melakukan pembobotan!',
        ], 200);
    }
}
