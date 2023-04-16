<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'title', 'description', 'telp', 'file_name', 'id_type', 'id_user',
        'id_helpdesk', 'id_spv', 'id_worker', 'status'
    ];

    public function items()
    {
        return $this->hasMany(RequestItem::class, 'id_request');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function helpdesk()
    {
        return $this->belongsTo(User::class, 'id_helpdesk');
    }

    public function spv()
    {
        return $this->belongsTo(User::class, 'id_spv');
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'id_worker');
    }

    public function type()
    {
        return $this->belongsTo(RequestType::class, 'id_type');
    }
}
