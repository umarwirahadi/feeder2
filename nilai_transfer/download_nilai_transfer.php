<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$filenilai=new PHPexcel();
$filenilai->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$s1=$filenilai->getActiveSheet(0);
$s1->setTitle("Nilaitransfer");
$s1			->setCellvalue( "A1","NPM")
			->setCellvalue( "B1","Nama_mahasiswa")
			->setCellvalue( "C1","jenjang")
			->setCellvalue( "D1","jurusan")
			->setCellvalue( "E1","kode_matkul_asal")
			->setCellvalue( "F1","nama_matkul_asal")
			->setCellvalue( "G1","sks_mata_kuliah_asal")
			->setCellvalue( "H1","nilai_huruf_asal")
			->setCellvalue( "I1","sks_mata_kuliah_diakui")
			->setCellvalue( "J1","nilai_huruf_diakui")
			->setCellvalue( "K1","nilai_angka_diakui");			
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$s1->getStyle("A1")->applyFromArray($danger);
$s1->getStyle("B1")->applyFromArray($danger);
$s1->getStyle("C1")->applyFromArray($danger);
$s1->getStyle("D1")->applyFromArray($danger);
$s1->getStyle("E1")->applyFromArray($danger);
$s1->getStyle("F1")->applyFromArray($danger);
$s1->getStyle("G1")->applyFromArray($danger);
$s1->getStyle("H1")->applyFromArray($danger);
$s1->getStyle("I1")->applyFromArray($danger);
$s1->getStyle("J1")->applyFromArray($danger);
$s1->getStyle("K1")->applyFromArray($danger);
$s2 =$filenilai->createSheet(1);
$s2 =$filenilai->setActiveSheetIndex(1);
$s2	=$filenilai->getActiveSheet();
$s2->setTitle("Keterangan");
$s2->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","Semua kolom wajib diisi")
		->setCellvalue("B2","Background wajib diisi");
$s2->getStyle("A2")->applyFromArray($danger);

$filenilai->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="Nilaitransfer.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($filenilai,'Excel5');
$writer->Save('php://output');
?>