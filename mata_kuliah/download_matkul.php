<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("mata_kuliah");
$sheet		->setCellvalue( "A1","Kode_mata_kuliah")
			->setCellvalue( "B1","nama_mata_kuliah")
			->setCellvalue( "C1","nama_prodi")
			->setCellvalue( "D1","jenjang")
			->setCellvalue( "E1","id_jenis_mata_kuliah")
			->setCellvalue( "F1","id_kelompok_mata_kuliah")
			->setCellvalue( "G1","sks_mata_kuliah")						
			->setCellvalue( "H1","sks_tatap_muka")
			->setCellvalue( "I1","sks_praktek")						
			->setCellvalue( "J1","sks_praktek_lapangan")
			->setCellvalue( "K1","sks_simulasi")				
			->setCellvalue( "L1","metode_kuliah")
			->setCellvalue( "M1","ada_sap")					
			->setCellvalue( "N1","ada_silabus")
			->setCellvalue( "O1","ada_bahan_ajar")
			->setCellvalue( "P1","ada_acara_praktek")
			->setCellvalue( "Q1","ada_diktat")				
			->setCellvalue( "R1","tanggal_mulai_efektif")
			->setCellvalue( "S1","tanggal_akhir_efektif");
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
$sheet2->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","Kode_mata_kuliah kolom wajib diisi")
		->setCellvalue("A3","nama_mata_kuliah kolom wajib diisi")
		->setCellvalue("A4","nama_prodi kolom wajib diisi")
		->setCellvalue("A5","jenjang kolom wajib diisi")
		->setCellvalue("A6","id_jenis_mata_kuliah kolom wajib diisi : A=Wajib, B=Pilihan, C=Wajib Peminatan, D=Pilihan Peminatan, S=Tugas akhir/Skripsi/Tesis/Disertasi")
		->setCellvalue("A7","id_kelompok_mata_kuliah kolom wajib diisi :A=MPK, B=MKK, C=MKB, D=MPB, E=MBB, F=MKU/MKDU, G=MKDK, H=MKK ")
		->setCellvalue("B8"," kolom wajib diisi : ");
$sheet2->getStyle("A8")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="mata_kuliah.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>