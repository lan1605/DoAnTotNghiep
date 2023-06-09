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
// class CauHoiImport implements ToModel, WithHeadingRow
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        
        $req = request()->all();
        foreach($rows as $row){
            $data =[
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
                'created_at'=>now(),
            ];
            CauHoi::insert($data);
        }
        
    }

    

    public function headingRow(): int
    {
        return 1;
    }
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
