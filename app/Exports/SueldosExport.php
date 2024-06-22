<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
class SueldosExport implements FromView, WithColumnWidths
{
    protected $empleadosCalculados;

    public function __construct($empleadosCalculados)
    {
        $this->empleadosCalculados = $empleadosCalculados;
    }

    public function view(): View
    {
        return view('PDF.sueldos', [
            'empleadosCalculados' => $this->empleadosCalculados
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 25,
            'D' => 20,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 10,
            'L' => 20,
            'M' => 15,
        ];
    }
}
