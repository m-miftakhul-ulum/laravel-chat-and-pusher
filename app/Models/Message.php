<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'message',
        'receiver_id',
    ];

    // Relasi ke User sebagai pengirim
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relasi ke User sebagai penerima
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
