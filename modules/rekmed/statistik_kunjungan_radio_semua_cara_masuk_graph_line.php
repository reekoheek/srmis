<?php
$graph = new Graph(800,300,'auto');	
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->img->SetMargin(40,120,40,70);

//$graph->title->Set($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][title]);

$graph->xaxis->SetTickLabels($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][radioel_tick]);
$graph->xaxis->SetLabelAngle(50);

$graph->xaxis->title->Set($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][radioel_x]);
$graph->yaxis->title->Set("Jumlah");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$lineplot = new LinePlot($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][jml_igd]);
$lineplot->SetLegend("IRD");
$lineplot->SetColor("green");
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->mark->setFillColor("green");
$lineplot->SetWeight(2); 
$lineplot->value->Show();

$lineplot2 = new LinePlot($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][jml_rajal]);
$lineplot2->SetLegend("Rawat Jalan");
$lineplot2->SetColor("black");
$lineplot2->mark->SetType(MARK_SQUARE);
$lineplot2->mark->setFillColor("black");
$lineplot2->SetWeight(2); 
$lineplot2->value->Show();

$lineplot3 = new LinePlot($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][jml_ranap]);
$lineplot3->SetLegend("Rawat Inap");
$lineplot3->SetColor("yellow");
$lineplot3->mark->SetType(MARK_DTRIANGLE);
$lineplot3->mark->setFillColor("yellow");
$lineplot3->SetWeight(2); 
$lineplot3->value->Show();


$lineplot4 = new LinePlot($_SESSION[rekmed][statistik_kunjungan_radio_semua_cara_masuk][jml_luar]);
$lineplot4->SetLegend("Pasien Luar");
$lineplot4->SetColor("red");
$lineplot4->mark->SetType(MARK_DIAMOND);
$lineplot4->mark->setFillColor("red");
$lineplot4->SetWeight(2); 
$lineplot4->value->Show();


$graph->legend->Pos(0.02,0.5,"right","center");

$graph->Add($lineplot);
$graph->Add($lineplot2);
$graph->Add($lineplot3);
$graph->Add($lineplot4);

$graph->Stroke();
?>