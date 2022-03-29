<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = "pengguna";
    protected $primaryKey = "nik";
    public $incrementing = false;

    protected $fillable = array("nik", "nama_lengkap", "password");
}
