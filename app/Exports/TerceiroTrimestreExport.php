<?php

namespace App\Exports;

use App\Models\EnviarRelatorioTerceiroTrimestre;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class TerceiroTrimestreExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromView,  WithStyles
{
    public function __construct($trimestres)
    {
        $this->trimestres = $trimestres;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'font' => ['background' => 'yellow']],

            // Styling a specific cell by coordinate.
           // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
    
    public function view(): View
    {
               
        return view('admin.reports.proedi.terceiro_trimestre.table', [
            'trimestres' => $this->trimestres]);
    }    
}