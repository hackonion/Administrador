<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    //

    protected $table = 'catalogo';
    //public $timestamps = false;
    public $incrementing = false;

    const CREATED_AT = 'fec_alt';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
