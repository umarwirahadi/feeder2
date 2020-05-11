<?php 
header("content-type: application/vnd-ms-excel");
header("content-disposition:attachment; filename=List_mata_kuliah.xls");
include("export_matakuliah.php");
 ?>