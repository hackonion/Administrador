<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class puestos extends Model
{
    //
    protected $table = 'puestos';
    public $timestamps = false;
    
    protected $primaryKey = 'ident_puestos';
}
