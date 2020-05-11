<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("Data_Mahasiswa");
$sheet		->setCellvalue( "A1","NPM")
			->setCellvalue( "A2","19402110")
			->setCellvalue( "B1","nama_mahasiswa")
			->setCellvalue( "B2","Admin")
			->setCellvalue( "C1","tempat_lahir")
			->setCellvalue( "C2","Bandung")
			->setCellvalue( "D1","tanggal_lahir")
			->setCellvalue( "D2","1989-09-23")
			->setCellvalue( "E1","jenis_kelamin: L/P")
			->setCellvalue( "E2","L")
			->setCellvalue( "F1","id_agama: 1=Islam;2=Kristen")
			->setCellvalue( "F2","1")
			->setCellvalue( "G1","NIK")
			->setCellvalue( "G2","16 Digit NIK")
			->setCellvalue( "H1","kewarganegaraan")
			->setCellvalue( "H2","ID")
			->setCellvalue( "I1","jalan")
			->setCellvalue( "J1","dusun")
			->setCellvalue( "K1","rt")
			->setCellvalue( "L1","rw")
			->setCellvalue( "M1","kelurahan")
			->setCellvalue( "N1","kode_pos")
			->setCellvalue( "O1","id_wilayah")
			->setCellvalue( "P1","handphone")
			->setCellvalue( "Q1","email")
			->setCellvalue( "R1","penerima_kps")
			->setCellvalue( "S1","nomor_kps")
			->setCellvalue( "T1","nama_ayah")
			->setCellvalue( "T2","Somad")
			->setCellvalue( "U1","nama_ibu_kandung")			
			->setCellvalue( "U2","Anah")			
			->setCellvalue( "V1","id_jenis_daftar:1= Baru,2=Pindahan")
			->setCellvalue( "V2","1")
			->setCellvalue( "W1","id_jalur_daftar:6=Selesksi PT Mandiri")
			->setCellvalue( "W2","6")
			->setCellvalue( "X1","id_periode_masuk")
			->setCellvalue( "X2","20162")
			->setCellvalue( "Y1","Jenjang")
			->setCellvalue( "Y2","D4")
			->setCellvalue( "Z1","Nama Prodi")
			->setCellvalue( "Z2","Manajemen Informatika")
			->setCellvalue( "AA1","sks_diakui:Jika Jenis daftar=2")
			->setCellvalue( "AB1","nama_perguruan_tinggi_asal")
			->setCellvalue( "AC1","nama_prodi_asal")
			->setCellvalue( "AD1","pembiayaan:1=Mandiri,2=Beasiswa")
			->setCellvalue( "AE1","tanggal_daftar");
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
$sheet->getStyle("M1")->applyFromArray($danger);
$sheet->getStyle("O1")->applyFromArray($danger);
$sheet->getStyle("R1")->applyFromArray($danger);
$sheet->getStyle("U1")->applyFromArray($danger);
$sheet->getStyle("V1")->applyFromArray($danger);
$sheet->getStyle("W1")->applyFromArray($danger);
$sheet->getStyle("X1")->applyFromArray($danger);
$sheet->getStyle("Y1")->applyFromArray($danger);
$sheet->getStyle("Z1")->applyFromArray($danger);
$sheet->getStyle("AA1")->applyFromArray($danger);
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