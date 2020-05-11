<?php
$nama_kurikulum=$_GET['idkurikulum'];  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("mata_kuliah_kurikulum");
$sheet		->setCellvalue( "A1","nama_kurikulum")
			->setCellvalue( "A2",$nama_kurikulum)
			->setCellvalue( "B1","id_semester")
			->setCellvalue( "C1","nama_prodi")
			->setCellvalue( "D1","jenjang")
			->setCellvalue( "E1","kode_mata_kuliah")
			->setCellvalue( "F1","nama_mata_kuliah")
			->setCellvalue( "G1","sks")
			->setCellvalue( "H1","semester")
			->setCellvalue( "I1","sks_mata_kuliah")
			->setCellvalue( "J1","apakah_wajib(1/0)");
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$sheet->getStyle("A1")->applyFromArray($danger);
$sheet->getStyle("B1")->applyFromArray($danger);
$sheet->getStyle("C1")->applyFromArray($danger);
$sheet->getStyle("D1")->applyFromArray($danger);
$sheet->getStyle("E1")->applyFromArray($danger);
$sheet->getStyle("F1")->applyFromArray($danger);
$sheet->getStyle("G1")->applyFromArray($danger);
$sheet->getStyle("H1")->applyFromArray($danger);
$sheet->getStyle("I1")->applyFromArray($danger);
$sheet->getStyle("J1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$sheet2->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","Nama Kurikulum di Feeder wajib sama")
		->setCellvalue("A3","Kode mata kuliah")
		->setCellvalue("A4","nama mata kuliah")
		->setCellvalue("A5","sks")
		->setCellvalue("A6","semester belajar : 1,2,3")
		->setCellvalue("A7","apakah wajib (1=wajib, 0=pilihan")
		->setCellvalue("B8","Warna kolom wajib diisi");
$sheet2->getStyle("A8")->applyFromArray($danger);

$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="mata_kuliah_kurikulum.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>