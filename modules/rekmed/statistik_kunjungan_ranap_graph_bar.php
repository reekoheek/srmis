<?php
$graph = new Graph(800,300,'auto');	
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->img->SetMargin(40,70,40,70);

//$graph->title->Set($_SESSION[rekmed][statistik_kunjungan_ranap][title]);

$graph->xaxis->SetTickLabels($_SESSION[rekmed][statistik_kunjungan_ranap][label_tick]);
$graph->xaxis->SetLabelAngle(50);

$graph->xaxis->title->Set($_SESSION[rekmed][statistik_kunjungan_ranap][label_x]);
$graph->yaxis->title->Set("Jumlah");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$bplot[0] = new BarPlot($_SESSION[rekmed][statistik_kunjungan_ranap][jml_masuk]);
$bplot[0]->SetLegend("Px Masuk");
$bplot[0]->SetFillColor("red");
$bplot[0]->value->Show();

$bplot[1] = new BarPlot($_SESSION[rekmed][statistik_kunjungan_ranap][jml_keluar]);
$bplot[1]->SetLegend("Px Keluar");
$bplot[1]->SetFillColor("green");
$bplot[1]->value->Show();

$graph->legend->Pos(0.02,0.5,"right","center");

$gbarplot = new GroupBarPlot($bplot);
$gbarplot->SetWidth(0.6);
$graph->Add($gbarplot);

$graph->Stroke();
?>