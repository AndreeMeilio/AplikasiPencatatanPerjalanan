<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    use HasFactory;

    protected $table = "perjalanan";
    protected $primaryKey = "id_perjalanan";
    public $incrementing = false;

    protected $fillable = array(
        "id_perjalanan",
        "nik", 
        "tanggal",
        "waktu",
        "suhu",
        "lokasi",
    );
}
