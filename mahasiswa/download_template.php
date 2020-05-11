<?php  
require_once("../../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("Data_Mahasiswa");
$sheet		->setCellvalue( "A1","NPM")
			->setCellvalue( "B1","nama_mahasiswa")
			->setCellvalue( "C1","Jenjang")
			->setCellvalue( "D1","Prodi")
			->setCellvalue( "E1","id_jenis_daftar:1= Baru,2=Pindahan")
			->setCellvalue( "F1","id_jalur_daftar:6=Selesksi PT Mandiri")
			->setCellvalue( "G1","id_periode_masuk: 20161")
			->setCellvalue( "H1","tanggal_daftar")
			->setCellvalue( "I1","sks_diakui:Jika Jenis daftar=2")
			->setCellvalue( "J1","nama_perguruan_tinggi_asal")
			->setCellvalue( "K1","nama_prodi_asal")
			->setCellvalue( "L1","pembiayaan:1=Mandiri,2=Beasiswa");
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
$sheet->getStyle("K1")->applyFromArray($danger);
$sheet->getStyle("L1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$sheet2->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","1. Kolom yang berwarna Hijau Wajib diisi")
		->setCellvalue("A3","2. Jika kolom warnah hijau wajib diisi dan tidak ada data maka beri tanda *")
		->setCellvalue("A4","3. Data Referensi bisa dilihat pada menu Utilitas")
		->setCellvalue("A5","--------------------------------")
		->setCellvalue("B6","Background wajib diisi");
$sheet2->getStyle("A6")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="Mahasiswa.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>