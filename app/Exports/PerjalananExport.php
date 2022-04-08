<?php

namespace App\Exports;

use App\Models\Perjalanan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PerjalananExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $nik;

    public function __construct($nik)
    {
        $this->nik = $nik;
    }

    public function collection()
    {
        return Perjalanan::where("nik", $this->nik)->get();
    }
}
