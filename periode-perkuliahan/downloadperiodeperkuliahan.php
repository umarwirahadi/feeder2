<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("periode_kuliah");
$sheet		->setCellvalue( "A1","Nama_prodi")
			->setCellvalue( "B1","jenjang")
			->setCellvalue( "C1","id_semester")
			->setCellvalue( "D1","jumlah_target_mahasiswa_baru")
			->setCellvalue( "E1","jumlah_pendaftar_ikut_seleksi")
			->setCellvalue( "F1","jumlah_pendaftar_lulus_seleksi")
			->setCellvalue( "G1","jumlah_daftar_ulang")
			->setCellvalue( "H1","jumlah_mengundurkan_diri")
			->setCellvalue( "I1","tanggal_awal_perkuliahan")
			->setCellvalue( "J1","tanggal_akhir_perkuliahan");			
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$sheet->getStyle("A1")->applyFromArray($danger);
$sheet->getStyle("B1")->applyFromArray($danger);
$sheet->getStyle("C1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$sheet2	->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","1. Nama Prodi")
		->setCellvalue("A3","2. Jenjang")
		->setCellvalue("A4","3. id Semester ex 20162")
		->setCellvalue("B5","Kolom Wajib diisi");
$sheet2->getStyle("A5")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="periode_perkuliahan.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>