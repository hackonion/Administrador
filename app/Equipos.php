<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    //
    protected $table = 'equipos';
    const CREATED_AT = 'fec_alt';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
