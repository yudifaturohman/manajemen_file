<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = "folders";
    protected $fillable = ['id_user', 'nm_folder'];

    protected $primaryKey = "id_folder";
}
