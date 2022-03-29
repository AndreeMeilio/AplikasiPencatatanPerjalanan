<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = "log";
    protected $primaryKey = "id_log";
    public $incrementing = false;

    protected $fillable = array("id_log", "id_table", "nik", "desc");
}