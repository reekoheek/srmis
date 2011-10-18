<?php
$graph = new Graph(800,300,'auto');	
$graph->SetScale("textlin");
//$graph->SetY2Scale("lin");
$graph->SetShadow();
$graph->img->SetMargin(40,150,40,70);

//$graph->title->Set($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][title]);

$graph->xaxis->SetTickLabels($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][label_tick]);
$graph->xaxis->SetLabelAngle(50);

$graph->xaxis->title->Set($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][label_x]);
$graph->yaxis->title->Set("Jumlah");
//$graph->y2axis->title->Set("Jumlah TT");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->y2axis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$warna = array(
"red","green", "blue", "yellow", "brown", "aqua", "orange", "chartreuse", "AntiqueWhite1", "aquamarine", "chocolate", "aquamarine4", "gray8"
);
for($i=0;$i<sizeof($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][nama]);$i++) {
	$bplot[$i] = new BarPlot($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][jml][$i]);
	//$bplot[$i]->SetShadow();
	$bplot[$i]->SetLegend($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][nama][$i]);
	$bplot[$i]->SetFillColor($warna[$i]);
/*
	$lineplot[$i]=new LinePlot($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][jml_tt][$i]);
	$lineplot[$i]->SetColor($warna[$i]);
	$lineplot[$i]->SetWeight(2);
	$lineplot[$i]->SetBarCenter();
	$lineplot[$i]->SetLegend("Jml TT " . $_SESSION[rekmed][rekap_kunjungan_antar_bangsal][nama][$i]);
	//$lineplot[$i]->SetStyle('dashed');
	$graph->Add($lineplot[$i]);
*/
}

//$graph->y2axis->SetColor("orange");
$graph->legend->Pos(0.01,0.5,"right","center");

$gbarplot = new GroupBarPlot($bplot);
$gbarplot->SetWidth(0.6);
$graph->Add($gbarplot);
$graph->Stroke();
?>