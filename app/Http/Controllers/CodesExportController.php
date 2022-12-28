<?php

namespace App\Http\Controllers;

use App\Exports\CodesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CodesExportController extends Controller
{
    public function export(){
        return Excel::download(new CodesExport, 'codes.xlsx');
    }
}
