<?php
// Create the graph. These two calls are always required
$graph = new Graph(800,300,"auto");	
$graph->img->SetMargin(40,40,40,40);
$graph->SetScale("textlin");
$graph->SetY2Scale("lin");
$graph->SetShadow();

// Create the linear plot
$lineplot=new LinePlot($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][jml_dokter]);
$lineplot2=new LinePlot($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][jml_px]);
$lineplot3=new LinePlot($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][rata]);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->mark->SetFillColor("cyan");
$lineplot->mark->SetWidth(8);
$lineplot->SetLegend("Jumlah Dokter yang Merawat");
$lineplot->value->Show();

$lineplot3->SetColor("darkgreen");
$lineplot3->SetWeight(2);
$lineplot3->mark->SetType(MARK_SQUARE);
$lineplot3->mark->SetFillColor("green");
$lineplot3->mark->SetWidth(8);
$lineplot3->SetLegend("Rata-rata Jumlah Pasien yang Dirawat/Dokter");
$lineplot3->value->Show();

$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);
$lineplot2->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot2->mark->SetFillColor("pink");
$lineplot2->mark->SetWidth(6);
$lineplot2->SetLegend("Jumlah Pasien yang Dirawat");
$lineplot2->value->Show();

// Add the plot to the graph
$graph->Add($lineplot3);
$graph->Add($lineplot);
$graph->AddY2($lineplot2);
$graph->y2axis->SetColor("red");

//$graph->title->Set($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][title]);
$graph->xaxis->title->Set($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][label_x]);
$graph->xaxis->SetTickLabels($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][label_tick]);
$graph->yaxis->title->Set("Jumlah");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);


$graph->yaxis->SetColor("blue");

// Display the graph
$graph->Stroke();
?>
