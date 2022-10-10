<?php

namespace App\Exports\Rngas;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class EspecificoExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromView,  WithStyles
{
    public function __construct($especificos)
    {
        $this->especificos = $especificos;
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
               
        return view('admin.reports.rngas.especifico.form', [
            'especificos' => $this->especificos]);
    }    
}
