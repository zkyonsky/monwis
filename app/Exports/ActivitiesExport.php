<?php

namespace App\Exports;

use App\Activity;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ActivitiesExport implements 
    FromCollection, 
    ShouldAutoSize, 
    WithMapping, 
    WithHeadings,
    WithEvents
{
    use Exportable;

    public function collection()
    {
        return Activity::with('trainers')->get();
    }

    public function map($activity): array
    {
        $trainers = array();
        foreach($activity->trainers as $trainer){
            array_push($trainers, $trainer->full_name);
        }
        return [
            $activity->event,
            $trainers,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Kegiatan',
            'Widyaiswara yang ditugaskan',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $event->sheet->getStyle('A1:B1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                ]);
            }
        ];
    }
}
