<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("kelaskuliah");
$sheet		->setCellvalue( "A1","nama_prodi")
			->setCellvalue( "B1","jenjang")
			->setCellvalue( "C1","semester")
			->setCellvalue( "D1","nama_kurikulum")
			->setCellvalue( "E1","kode_mata_kuliah")
			->setCellvalue( "F1","nama_mata_kuliah")
			->setCellvalue( "G1","nama_kelas_kuliah")
			->setCellvalue( "H1","pembahasan")
			->setCellvalue( "I1","tanggal_mulai_efektif")
			->setCellvalue( "J1","tanggal_akhir_efektif");						
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$sheet->getStyle("A1")->applyFromArray($danger);
$sheet->getStyle("B1")->applyFromArray($danger);
$sheet->getStyle("C1")->applyFromArray($danger);
$sheet->getStyle("D1")->applyFromArray($danger);
$sheet->getStyle("E1")->applyFromArray($danger);
$sheet->getStyle("F1")->applyFromArray($danger);
$sheet->getStyle("G1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$sheet2	->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","A1 Nama Prodi")
		->setCellvalue("A3","A2 jenjang")
		->setCellvalue("A4","A3 Semester")
		->setCellvalue("A5","A4 Nama Kurikulum yang berlaku sesuai jurusan")
		->setCellvalue("A6","A5 Kode Mata Kuliah")
		->setCellvalue("A7","A6 Nama Mata Kuliah")
		->setCellvalue("A8","A7 nama_kelas kuliah")
		->setCellvalue("B9","Kolom Wajib diisi");
$sheet2->getStyle("A9")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="kelas_kuliah.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>