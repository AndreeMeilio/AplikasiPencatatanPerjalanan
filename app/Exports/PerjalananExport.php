<?php

namespace App\Exports;

use App\Models\Perjalanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class PerjalananExport implements FromCollection, WithColumnWidths, WithHeadings, WithEvents
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

    public function columnWidths(): array
    {
        return ["A" => 25,"1" => 25,"B" => 25,"C" => 15,"D" => 10,"E" => 10,"F" => 50,"G" => 35,"H" => 35];
    }

    public function headings(): array
    {
        return ["ID PERJALANAN", "NIK", "TANGGAL", "WAKTU", "SUHU", "LOKASI", "CREATED AT", "UPDATED AT"];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highest_row = $event->sheet->getDelegate()->getHighestRow();
                $table = "A1:H". $highest_row;
                
                $event->sheet->getDelegate()->getStyle($table)
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            },
        ];
    }
}
