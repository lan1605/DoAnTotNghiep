<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\CauHoi;
use Auth;

class CauHoiImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){
            $data=[
                'ten_cauhoi' =>  $row['ten_cauhoi'],
                'noi_dung' =>  $row['noi_dung'],
                'dap_an_1' =>  $row['dap_an_1'],
                'dap_an_2' =>  $row['dap_an_2'],
                'dap_an_3' =>  $row['dap_an_3'],
                'dap_an_4' =>  $row['dap_an_4'],
                'dap_an_dung' =>  $row['dap_an_dung'],
                'id_loaicauhoi' =>  $row['id_loaicauhoi'],
                'id_baihoc' =>  $row['id_baihoc'],
                'id_admin' => Auth::user()->id_admin,
            ];
            CauHoi::create($data);
        }
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
            'id_loaicauhoi' => 'required',
            'id_baihoc' => 'required',
        ];
    }
}
