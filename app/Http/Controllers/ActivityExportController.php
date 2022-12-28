<?php

namespace App\Http\Controllers;

use App\Exports\ActivitiesExport;
use Maatwebsite\Excel\Excel;

class ActivityExportController extends Controller
{
    private $excel;
    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function export(){
        return $this->excel->download(new ActivitiesExport, 'activities.xlsx', Excel::XLSX);
    }
}
