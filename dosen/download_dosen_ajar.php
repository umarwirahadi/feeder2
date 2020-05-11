<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("dosen_mengajar");
$sheet		->setCellvalue( "A1","nidn")
			->setCellvalue( "B1","nama_dosen")
			->setCellvalue( "C1","id_semester")
			->setCellvalue( "D1","jenjang")
			->setCellvalue( "E1","program_studi")
			->setCellvalue( "F1","kode_mata_kuliah")
			->setCellvalue( "G1","nama_mata_kuliah")
			->setCellvalue( "H1","rencana_tatap_muka")
			->setCellvalue( "I1","realisasi_tatap_muka")
			->setCellvalue( "J1","jenis_evaluasi");						
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
		->setCellvalue("A2","NIDN Dosen")
		->setCellvalue("A3","Nama Dosen")
		->setCellvalue("A4","Semester exp : 20171")
		->setCellvalue("A5","Jenjang D3/D4")
		->setCellvalue("A6","Nama Prodi")
		->setCellvalue("A7","Kode matakuliah")
		->setCellvalue("A8","Nama mata kuliah")
		->setCellvalue("A9","Rencana tatap muka : 14")
		->setCellvalue("A10","jenis evaluasi : Evaluasi Akademik")
		->setCellvalue("B11","Kolom Wajib diisi");
$sheet2->getStyle("A11")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="dosen_mengajar.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>