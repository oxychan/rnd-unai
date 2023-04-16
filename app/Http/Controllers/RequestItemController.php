<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReqItemsRequest;
use App\Models\RequestItem;
use Exception;
use Illuminate\Http\Request;

class RequestItemController extends Controller
{
    public function store(ReqItemsRequest $request, $id)
    {
        try {
            foreach ($request['subject'] as $key => $value) {
                $reqItem = new RequestItem;
                $reqItem->subject = $request['subject'][$key];
                $reqItem->description = $request['description'][$key];
                $reqItem->id_request = $id;
                $reqItem->save();
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal mengirimkan permohonan item!',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => 'Berhasil mengirimkan permohonan Item!',
        ], 201);
    }
}
