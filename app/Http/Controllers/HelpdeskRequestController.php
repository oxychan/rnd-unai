<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\RequestItem;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UserReqRevise;
use App\Http\Requests\UserReqCloseTask;
use App\Http\Requests\UserReqUpdateSpv;
use App\DataTables\DoneRequestDataTable;
use App\Models\Request as ModelsRequest;
use App\DataTables\IncommingRequestDataTable;
use App\DataTables\ProcessedRequestDataTable;

class HelpdeskRequestController extends Controller
{
    public function incommingRequest(IncommingRequestDataTable $dataTable)
    {
        return $dataTable->render('request.helpdesk.incomming.index');
    }

    public function processedRequest(ProcessedRequestDataTable $dataTable)
    {
        return $dataTable->render('request.helpdesk.processed.index');
    }

    public function doneRequest(DoneRequestDataTable $dataTable)
    {
        return $dataTable->render('request.helpdesk.done.index');
    }

    public function duplicateRequest($id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $helpdesk = auth()->user();

            $newReq = $currentReq->replicate();
            $newReq->id_helpdesk = $helpdesk->id;
            $newReq->status = 1;
            $newReq->is_duplicated = 0;
            $newReq->is_data_duplicate = 1;

            $newReq->save();

            $currentReq->id_helpdesk = $helpdesk->id;
            $currentReq->status = 1;
            $currentReq->is_duplicated = 1;
            $currentReq->save();

            $items = $currentReq->items;
            foreach ($items as $item) {
                $newItems = $item->replicate();
                $newItems->id_request = $newReq->id;
                $newItems->save();
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Duplikasi data gagal!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Duplikasi data berhasil!',
        ], 201);
    }

    public function showResult($id)
    {
        $currentReq = ModelsRequest::findOrFail($id);
        $spvs = Role::findOrFail(3)->users;
        return view('request.helpdesk.done.detail', compact('currentReq', 'spvs'));
    }

    public function showHelpdeskSide($id)
    {
        $currentReq = ModelsRequest::find($id);
        $spvs = Role::find(3)->users;
        return view('request.helpdesk.detail', compact('currentReq', 'spvs'));
    }

    public function updateRequestRevise(UserReqRevise $request, $id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $helpdesk = auth()->user();

            $currentReq->revise_note = $request["revise_note"];
            $currentReq->is_revised = 1;
            $currentReq->status = 2;
            $currentReq->id_helpdesk = $helpdesk->id;
            $currentReq->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal mengirimm revisi!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Revisi berhasil dikirim!',
        ], 200);
    }

    public function forwardToSpv(UserReqUpdateSpv $request, $id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $helpdesk = auth()->user();

            $currentReq->id_helpdesk = $helpdesk->id;
            $currentReq->id_spv = $request['spv'];
            $currentReq->status = 1;
            $currentReq->save();
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal meneruskan ke helpdesk!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil meneruskan permohonan ke helpdesk!',
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            if ($currentReq) {
                $tmpTitle = $currentReq->title;
                RequestItem::where('id_request', $currentReq->id)->delete();
                $currentReq->delete();

                $counter = ModelsRequest::where('title', $tmpTitle)->count();
                if ($counter == 1) {
                    $req = ModelsRequest::where('title', $tmpTitle)->first();
                    $req->is_duplicated = 0;
                    $req->save();
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus permohonan!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Permohonan berhasil dihapus!',
        ], 200);
    }

    public function closeTask(UserReqCloseTask $request, $id)
    {
        try {
            $currentReq = ModelsRequest::findOrFail($id);
            $helpdesk = auth()->user();

            $currentReq->status = 3;
            $currentReq->id_helpdesk = $helpdesk->id;
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
