<?php

namespace App\Http\Controllers;

use App\DataTables\DoneRequestWorkerDataTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserReqCloseTask;
use App\Models\Request as ModelsRequest;
use App\DataTables\IncommingRequestWorkerDataTable;
use App\DataTables\ProcessedRequestWorkerDataTable;

class WorkerRequestController extends Controller
{
    public function incommingRequest(IncommingRequestWorkerDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.worker.incomming.index');
    }

    public function processedRequest(ProcessedRequestWorkerDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.worker.processed.index');
    }

    public function doneRequest(DoneRequestWorkerDataTable $dataTable)
    {
        $user = Auth::user();
        return $dataTable->with(['user' => $user])->render('request.worker.done.index');
    }

    public function acceptTask($id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $currentReq->is_worker_approved = 1;
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
            $currentReq->id_worker = null;
            $currentReq->is_worker_approved = 0;
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

    public function showWorkerSide($id)
    {
        $currentReq = ModelsRequest::find($id);
        return view('request.worker.detail', compact('currentReq'));
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
}
