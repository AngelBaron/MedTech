<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitasExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Cita::with('paciente.user','medico.user');

         return $query->get()->map(function ($cita) {
            return [
                'ID' => $cita->id,
                'Paciente' => $cita->paciente->user->name ?? '',
                'Médico' => $cita->medico->user->name ?? '',
                'Fecha' => $cita->fecha,
                'Hora' => $cita->hora,
                'Estado' => $cita->estado,
                'Motivo de la cita' => $cita->motivo_cita,
            ];
        });
    }


    public function headings(): array
    {
        return ['ID', 'Paciente', 'Médico', 'Fecha', 'Hora', 'Estado','Motivo de la cita'];
    }
}
