<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("history_pendidikan");
$sheet		->setCellvalue( "A1","NPM")
			->setCellvalue( "B1","nama_mahasiswa")
			->setCellvalue( "C1","id_jenis_daftar")
			->setCellvalue( "D1","id_jalur_daftar")
			->setCellvalue( "E1","id_periode_masuk")
			->setCellvalue( "F1","tanggal_daftar")
			->setCellvalue( "G1","Jenjang")
			->setCellvalue( "H1","Prodi")
			->setCellvalue( "I1","sks_diakui")
			->setCellvalue( "J1","nama_perguruan_tinggi_asal")
			->setCellvalue( "K1","nama_prodi_asal")
			->setCellvalue( "L1","pembiayaan");
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$sheet->getStyle("A1")->applyFromArray($danger);
$sheet->getStyle("B1")->applyFromArray($danger);
$sheet->getStyle("C1")->applyFromArray($danger);
$sheet->getStyle("D1")->applyFromArray($danger);
$sheet->getStyle("E1")->applyFromArray($danger);
$sheet->getStyle("G1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$sheet2->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","Kolom A NPM Wajib diisi")
		->setCellvalue("A3","Kolom C Wajib diisi, Menu Utilitas Jenis Daftar")
		->setCellvalue("A4","Kolom D Wajib diisi, Menu Utilitas jalur Daftar")
		->setCellvalue("A5","Kolom E Wajib diisi, Menu Utilitas GetSemester")
		->setCellvalue("A6","Kolom G Wajib diisi, Menu Prodi")
		->setCellvalue("A7","Kolom H Wajib diisi, Menu Prodi")
		->setCellvalue("A8","--------------------------------")
		->setCellvalue("A9","Data Referensi bisa dilihat pada menu Utilitas")
		->setCellvalue("B10","Background wajib diisi");
$sheet2->getStyle("A10")->applyFromArray($danger);

$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="history_pendidikan.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>