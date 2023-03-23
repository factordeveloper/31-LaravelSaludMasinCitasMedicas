<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    use HasFactory;

    protected $table ="users";

    protected $fillable = [

     'name','email', 'password', 'id_consultorio', 'sexo', 'documento', 'telefono', 'rol'

    ];

    public function Consultorio(){
        return $this->belongsTo(Consultorio::class, 'id_consultorio');
    }

}
