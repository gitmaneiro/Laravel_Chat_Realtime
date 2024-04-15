<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversacion extends Model
{
    use HasFactory;

    protected $fillable=[
        'remitente_id',
        'receptor_id',
        'last_time_message'
    ];


    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
