<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';
    protected $fillable = ['nik', 'nama', 'tmp_lhr', 'tgl_lhr', 'jk'];
}
