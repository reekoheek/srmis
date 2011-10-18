<?php
// Create the graph. These two calls are always required
$graph = new Graph(800,250,"auto");	
$graph->img->SetMargin(40,40,40,40);
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->yaxis->SetColor("blue");
//$graph->title->Set($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][title]);
$graph->xaxis->title->Set($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][label_x]);
$graph->xaxis->SetTickLabels($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][label_tick]);
$graph->yaxis->title->Set("Jumlah");
//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$warna = array(
"red","green", "blue", "yellow", "brown", "aqua", "orange", "chartreuse", "AntiqueWhite1", "aquamarine", "chocolate", "aquamarine4", "gray8"
);

// Create the linear plot
for($i=0;$i<sizeof($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][cb]);$i++) {
	$lineplot[$i]=new LinePlot($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][jml][$i]);
	$lineplot[$i]->SetColor($warna[$i]);
	$lineplot[$i]->SetWeight(2);
	$lineplot[$i]->mark->SetType(MARK_UTRIANGLE);
	$lineplot[$i]->mark->SetFillColor($warna[$i]);
	$lineplot[$i]->mark->SetWidth(8);
	$lineplot[$i]->SetLegend($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][cb][$i]);
	$graph->Add($lineplot[$i]);
}
// Display the graph
$graph->Stroke();
?>
