<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // protected $table = "files";
    // protected $fillable = ['folder', 'nm_file', 'ukuran', 'file'];
    protected $guarded = [];

    protected $primaryKey = "id_file";

}
