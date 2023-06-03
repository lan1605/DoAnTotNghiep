<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\CauHoi;
use Illuminate\Http\Request;

use Auth;

class CauHoiImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $req = request()->all();
        foreach($rows as $row){
            $data=[
                'ten_cauhoi' =>  $row['ten_cauhoi'],
                'noi_dung' =>  $row['noi_dung'],
                'dap_an_1' =>  $row['dap_an_1'],
                'dap_an_2' =>  $row['dap_an_2'],
                'dap_an_3' =>  $row['dap_an_3'],
                'dap_an_4' =>  $row['dap_an_4'],
                'dap_an_dung' =>  $row['dap_an_dung'],
                // 'id_loaicauhoi' =>  $row['id_loaicauhoi'],
                'id_loaicauhoi' =>  $req['id_loaicauhoi_excel'],
                // 'id_baihoc' =>  $row['id_baihoc'],
                'id_baihoc' =>  $req['id_baihoc_excel'],
                'id_admin' => Auth::user()->id_admin,
            ];
            
        }
        CauHoi::insert($data);
    }

    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $row) 
    //     {
    //         CauHoi::create([
    //             'ten_cauhoi' =>  $row[0],
    //         'noi_dung' =>  $row[1],
    //         'dap_an_1' =>  $row[2],
    //         'dap_an_2' =>  $row[3],
    //         'dap_an_3' =>  $row[4],
    //         'dap_an_4' =>  $row[5],
    //         'dap_an_dung' =>  $row[6],
    //         'id_loaicauhoi' =>  $row[7],
    //         'id_baihoc' =>  $row[8],
    //         'id_admin' => Auth::user()->id_admin,
    //         ]);
    //     }
    // }
    public function rules(): array
    {
        return[
            'ten_cauhoi' => 'required',
            'noi_dung' => 'required',
            'dap_an_1' => 'required',
            'dap_an_2' => 'required',
            'dap_an_3' => 'required',
            'dap_an_4' => 'required',
            'dap_an_dung' => 'required',

        ];
    }
}
