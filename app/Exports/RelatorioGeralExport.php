<?php

namespace App\Exports;

use App\Models\proedi\Proedi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class RelatorioGeralExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromView,  WithStyles
{
    public function __construct($empresas)
    {
        $this->empresas = $empresas;
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
        return view('admin.reports.proedi.geral.excel_geral', [
            'empresas' => $this->empresas]);
    }
    
}
