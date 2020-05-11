<?php  
require_once("../../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("aktivitaskuliah");
$sheet		->setCellvalue( "A1","NPM")
			->setCellvalue( "B1","Nama_lengkap")
			->setCellvalue( "C1","jenjang")
			->setCellvalue( "D1","program_studi")			
			->setCellvalue( "E1","id_semester");			
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$sheet->getStyle("A1")->applyFromArray($danger);
$sheet->getStyle("B1")->applyFromArray($danger);
$sheet->getStyle("C1")->applyFromArray($danger);
$sheet->getStyle("D1")->applyFromArray($danger);
$sheet->getStyle("E1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$sheet2	->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","1. NPM")
		->setCellvalue("A3","2. Nama Mahasiswa")
		->setCellvalue("A4","3. Jenjang")
		->setCellvalue("A5","4. Program Studi")
		->setCellvalue("A6","5. id semester : 20171");
$sheet2->getStyle("A10")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="Hapusaktivitaskuliah.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>