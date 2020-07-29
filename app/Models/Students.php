<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'ra', 'cpf'];
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'students';
}
