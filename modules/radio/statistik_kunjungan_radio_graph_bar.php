<?php
$graph = new Graph(800,300,'auto');	
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->img->SetMargin(40,70,40,70);

//$graph->title->Set($_SESSION[radio][statistik_kunjungan_radio][title]);

$graph->xaxis->SetTickLabels($_SESSION[radio][statistik_kunjungan_radio][radioel_tick]);
$graph->xaxis->SetLabelAngle(50);

$graph->xaxis->title->Set($_SESSION[radio][statistik_kunjungan_radio][radioel_x]);
$graph->yaxis->title->Set("Jumlah");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

$bplot[0] = new BarPlot($_SESSION[radio][statistik_kunjungan_radio][jml_lama]);
$bplot[0]->SetLegend("Lama");
$bplot[0]->SetFillColor("red");
//$bplot[0]->value->Show();

$bplot[1] = new BarPlot($_SESSION[radio][statistik_kunjungan_radio][jml_baru]);
$bplot[1]->SetLegend("Baru");
$bplot[1]->SetFillColor("green"); 
//$bplot[1]->value->Show();

$lineplot = new LinePlot($_SESSION[radio][statistik_kunjungan_radio][jml_igd]);
$lineplot->SetLegend("IRD");
$lineplot->SetColor("blue");
$lineplot->SetWeight(2); 
$lineplot->value->Show();

$lineplot2 = new LinePlot($_SESSION[radio][statistik_kunjungan_radio][jml_rajal]);
$lineplot2->SetLegend("Rawat Jalan");
$lineplot2->SetColor("black");
$lineplot2->SetWeight(2); 
$lineplot2->value->Show();

$lineplot3 = new LinePlot($_SESSION[radio][statistik_kunjungan_radio][jml_ranap]);
$lineplot3->SetLegend("Rawat Inap");
$lineplot3->SetColor("yellow");
$lineplot3->SetWeight(2); 
$lineplot3->value->Show();


$graph->legend->Pos(0.02,0.5,"right","center");

$gbarplot = new GroupBarPlot($bplot);
$gbarplot->SetWidth(0.6);
$graph->Add($gbarplot);
$graph->Add($lineplot);
$graph->Add($lineplot2);
$graph->Add($lineplot3);

$graph->Stroke();
?>