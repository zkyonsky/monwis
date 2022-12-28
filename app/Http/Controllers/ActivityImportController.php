<?php

namespace App\Http\Controllers;

use App\Imports\ActivityImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ActivityImportController extends Controller
{
    public function store(Request $request)
    {
        try{
            $file = $request->file('file')->store('import');
        (new ActivityImport)->import($file);

//     } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
//         $failures = $e->failures();
        
//         foreach ($failures as $failure) {
//             $failure->row(); // row that went wrong
//             $failure->attribute(); // either heading key (if using heading row concern) or column index
//             $failure->errors(); // Actual error messages from Laravel validator
//             $failure->values(); // The values of the row that has failed.
//             return redirect()->back()->withError($failure->row);
//         }
//    }

        } catch(\Exception $ex){
            return redirect()->back()->withError('Terjadi kesalahan! periksa kembali file excel yang di import, pastikan sesuai dengan template yang disediakan');
        }

        
        return redirect()->back()->withStatus('Data berhasil di import');
    }
}
