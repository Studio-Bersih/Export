<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends Controller
{
    public function exportExcel(){
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $judul  = ['Nama','Skill'];
        $data   = [
            [
                "NAMA"  => "Vergil",
                "SKILL" => "Dark Slayer"
            ],[
                "NAMA"  => "Dante",
                "SKILL" => "Trickster"
            ],
        ];

        $abjad = 'A';

        for($i = 0; $i < 2; $i++){
            $worksheet->getColumnDimension($abjad)->setWidth(22);
            $worksheet->getStyle($abjad.'1')->getFont()->setBold(TRUE);
            $worksheet->getStyle('A:B')->getAlignment()->setHorizontal('center');
            $worksheet->getCell($abjad.'1')->setValue($judul[$i]);
            $abjad++;
        }

        $indeks = 2;

        foreach($data as $data){
            $worksheet->getCell('A'.$indeks)->setValue($data['NAMA']);
            $worksheet->getCell('B'.$indeks)->setValue($data['SKILL']);
            $indeks++;
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Disposition: attachment;filename="Devil May Cry.xlsx"'); 
        header('Content-Type: application/vnd.ms-excel');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
