<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable=[
        'remitente_id',
        'receptor_id',
        'conversacion_id',
        'body',
        'read',
        'type'
    ];


    public function conversacion(){

        return $this->belongsTo(Conversacion::class);

    }

    public function user(){

        return $this->belongsTo(User::class, 'remitente_id');

    }


}
