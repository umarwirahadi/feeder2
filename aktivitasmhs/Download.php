<?php  
require_once("../assets/PHPexcel/classes/PHPexcel.php");
session_start();       		
require_once("../config.php");
$token=$_SESSION['token'];


$data=array('act'=>'GetJenisAktivitasMahasiswa',
'token'=>$token,
'filter'=>'',
'limit'=>'');
$res=json_decode(runWS($data));

$data_kategori=array('act'=>'GetKategoriKegiatan',
'token'=>$token,
'filter'=>'',
'limit'=>'');
$res_data_kategori=json_decode(runWS($data_kategori));



$filenilai=new PHPexcel();
$filenilai->getProperties()->setTitle("Created by: u.wirahadi10@gmail.com");
$s1=$filenilai->getActiveSheet(0);
$s1->setTitle("aktivitasmhs");
$s1			->setCellvalue( "A1","jenis_anggota")
			->setCellvalue( "B1","jenis aktivitas")
			->setCellvalue( "C1","jenjang")
			->setCellvalue( "D1","jurusan")
			->setCellvalue( "E1","id semester")
			->setCellvalue( "F1","judul")
			->setCellvalue( "G1","keterangan")
			->setCellvalue( "H1","lokasi")
			->setCellvalue( "I1","sk tugas")
			->setCellvalue( "J1","tanggal sk")
			->setCellvalue( "K1","NPM")
			->setCellvalue( "L1","Nama Mahasiswa")
			->setCellvalue( "M1","jenis_peran")
			->setCellvalue( "N1","nama dosen pembimbing")
			->setCellvalue( "O1","nidn dosen pembimbing")
			->setCellvalue( "P1","nama_kategori_kegiatan")
			->setCellvalue( "Q1","pembimbing_ke")
			->setCellvalue( "R1","nama dosen penguji")
			->setCellvalue( "S1","nidn dosen penguji")
			->setCellvalue( "T1","penguji ke");			
$danger=array('fill'=>array('type'=>PHPexcel_Style_fill::FILL_SOLID,
							'color'=>array('rgb'=>'#abc50f')));		
$s1->getStyle("A1")->applyFromArray($danger);
$s1->getStyle("B1")->applyFromArray($danger);
$s1->getStyle("C1")->applyFromArray($danger);
$s1->getStyle("D1")->applyFromArray($danger);
$s1->getStyle("E1")->applyFromArray($danger);
$s1->getStyle("F1")->applyFromArray($danger);
$s1->getStyle("G1")->applyFromArray($danger);

$s2 =$filenilai->createSheet(1);
$s2 =$filenilai->setActiveSheetIndex(1);
$s2	=$filenilai->getActiveSheet();
$s2->setTitle("Keterangan");
$s2->setCellvalue("A1","Keterangan Kolom yang wajib diisi adalah :")
		->setCellvalue("A2","Semua kolom dengan background hijau wajib diisi")
		->setCellvalue("A4","Jenis anggota")
		->setCellvalue("A5","Personal")
		->setCellvalue("A6","Kelompok")
        ->setCellvalue("A8","JENIS PERAN")
        ->setCellvalue("A9","Ketua")
        ->setCellvalue("A10","Anggota")
        ->setCellvalue("A11","Personal")
        ->setCellvalue("A13","JENIS AKTIVITAS");
        $no=14;
        foreach ($res->data as $k) {
            $s2->setCellvalue("A".$no,$k->nama_jenis_aktivitas_mahasiswa);
            $no++;
		}    

$s2->setCellvalue("B1","Data GetKategoriKegiatan :");
$noo=2;
foreach ($res_data_kategori->data as $j) {
	$s2->setCellvalue("B".$noo,$j->nama_kategori_kegiatan);
	$noo++;
} 

$s2->getStyle("A2")->applyFromArray($danger);
$s2->getStyle("A8")->applyFromArray($danger);        
$s2->getStyle("A4")->applyFromArray($danger);        
$s2->getStyle("A13")->applyFromArray($danger);        
$s2->getStyle("B1")->applyFromArray($danger);        
$filenilai->setActiveSheetIndex(0);
// $sheet=$file->setActiveSheet(0);	
header('Content-type:application/vnd.ms-excel');
header('Content-Disposition:attachment; filename="aktifitas_mhs.xls"');
header('Cahce-control:max-age=0');
$writer= PHPExcel_IOFactory::createWriter($filenilai,'Excel5');
$writer->Save('php://output');
?>