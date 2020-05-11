<?php  
session_start();
require_once("../assets/PHPexcel/classes/PHPexcel.php");
require_once("../CONFIG.PHP");
require_once("../config/koneksi.php");
$token=$_SESSION['token'];
				$data2 =["act"=>"GetJenisKeluar","token"=>$token,"filter"=>"","limit"=>"30"];
				$result2=json_decode(runWS($data2));
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("mahasiswa_lulus");
$sheet		->setCellvalue( "A1","NIM")
			->setCellvalue( "B1","nama_mahasiswa")
			->setCellvalue( "C1","jenjang")
			->setCellvalue( "D1","program_studi")			
			->setCellvalue( "E1","jenis_keluar")
			->setCellvalue( "F1","tanggal_keluar")
			->setCellvalue( "G1","keterangan")
			->setCellvalue( "H1","nomor_sk_yudisium")
			->setCellvalue( "I1","tanggal_sk_yudisium")
			->setCellvalue( "J1","ipk")
			->setCellvalue( "K1","nomor_ijazah")						
			->setCellvalue( "L1","jalur_skripsi")						
			->setCellvalue( "M1","judul_skripsi")						
			->setCellvalue( "N1","bulan_awal_bimbingan(yyy-MM-dd)")
			->setCellvalue( "O1","bulan_akhir_bimbingan(yyy-MM-dd)");
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#6B8365')));		
$sheet->getStyle("A1")->applyFromArray($danger);
$sheet->getStyle("B1")->applyFromArray($danger);
$sheet->getStyle("C1")->applyFromArray($danger);
$sheet->getStyle("D1")->applyFromArray($danger);
$sheet->getStyle("E1")->applyFromArray($danger);
$sheet->getStyle("F1")->applyFromArray($danger);
$sheet2 =$file->createSheet(1);
$sheet2 =$file->setActiveSheetIndex(1);
$sheet2	=$file->getActiveSheet();
$sheet2->setTitle("Keterangan");
$no=3;		
$sheet2	->setCellvalue("B1","Kolom Wajib diisi")
		->setCellvalue("A2","Jenis Keluar lihat menu : Utilitas->jenis keluar ");
$sheet2->getStyle("A1")->applyFromArray($danger);
$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="mahasiswa_lulus_do.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>