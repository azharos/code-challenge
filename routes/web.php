<?php

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $data = [
        'data'  => Student::latest()->get()
    ];

    return view('student', $data);
})->name('index');

Route::get('downloadExcel', function () {
    return response()->download(public_path('data.xlsx'));
})->name('downloadExcel');

Route::post('/', function () {
    // return request();

    try {
        $file = request()->file('file');

        $spreadsheet    = IOFactory::load($file->getRealPath());
        $sheet          = $spreadsheet->getActiveSheet();
        $total_row      = $sheet->getHighestDataRow();
        $row_range      = range(2, $total_row);

        DB::beginTransaction();
        foreach ($row_range as $rowData) {
            $data = array(
                'name'  => $sheet->getCell('A' . $rowData)->getValue(),
                'level'  => $sheet->getCell('B' . $rowData)->getValue(),
                'class'  => $sheet->getCell('C' . $rowData)->getValue(),
                'parent'  => $sheet->getCell('D' . $rowData)->getValue(),
            );

            Student::create($data);
        }
        DB::commit();

        return redirect()->route('index')->with('success', 'Import Excel berhasil');
    } catch (\Throwable $th) {
        return redirect()->route('index')->with('error', 'Import Excel gagal');
    }
})->name('excelStore');
