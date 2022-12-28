<?php

namespace App\Imports;

use App\Activity;
use App\Trainer;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ActivityImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $activity = Activity::create([
                'code_id' => $row['code_id'],
                'event' => $row['event'],
                'batch' => $row['batch'],
                'class' => $row['class'],
                'subject' => $row['subject'],
                'volume' => $row['volume'],
                'place' => $row['place'],
                'start' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['start'])),
                'end' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['end'])),
                'status' => $row['status'],
                'created_by' => Auth::id(),
                'bahan_ajar' => $row['bahan_ajar'],
                'bahan_tayang' => $row['bahan_tayang'],
                'sap_gbpp' => $row['sap_gbpp'],
            ]);

            $trainers = explode(",",$row['name']);
            $trainerId = new Trainer;
            foreach ($trainers as $trainer) {
                $id = $trainerId->getId($trainer);
                $activity->trainers()->attach([
                    'trainer_id' => $id,
                ]);
            }
        }
    }
    
}
