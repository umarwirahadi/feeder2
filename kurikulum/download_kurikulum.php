<?php
require_once("../assets/PHPexcel/classes/PHPexcel.php");
$file=new PHPexcel();
$file->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$sheet=$file->getActiveSheet(0);
$sheet->setTitle("Kurikulum");
$sheet		->setCellvalue( "A1","nama_kurikulum")
			->setCellvalue( "B1","nama_prodi")
			->setCellvalue( "C1","jenjang")
			->setCellvalue( "D1","id_semester")
			->setCellvalue( "E1","jumlah_sks_lulus")
			->setCellvalue( "F1","jumlah_sks_wajib")
			->setCellvalue( "G1","jumlah_sks_pilihan");
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
		->setCellvalue("A2","Semua kolom wajib diisi")
		->setCellvalue("C2","Background wajib diisi");
$sheet2->getStyle("A2")->applyFromArray($danger);

$file->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="mata_kuliah.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($file,'Excel5');
$writer->Save('php://output');
?>
