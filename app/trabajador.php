<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trabajador extends Model
{
    //

    protected $table = 'trabajador';
    //public $timestamps = false;
    public $incrementing = false;

    const CREATED_AT = 'fec_ing';
    const UPDATED_AT = null;
    protected $primaryKey = 'clv_trab';
}