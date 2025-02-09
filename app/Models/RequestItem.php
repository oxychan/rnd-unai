<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function request()
    {
        return $this->belongsTo(Request::class, 'id_request');
    }
}
