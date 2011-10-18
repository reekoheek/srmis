<?php
$graph = new PieGraph(500,300,"auto");
$graph->SetShadow();
//$graph->title->Set($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][title]);
//$graph->title->SetFont(FF_FONT1,FS_BOLD);

$p1 = new PiePlot3D($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][jml]);
$p1->ExplodeAll();
$p1->SetCenter(0.5);
$p1->SetLabels($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][nama]);
//$p1->SetLegends($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][kode]);
$graph->Add($p1);
$graph->Stroke();
?>