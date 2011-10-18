<?php
// Create the graph. These two calls are always required
$graph = new Graph(800,300,"auto");	
$graph->img->SetMargin(40,40,40,40);
$graph->SetScale("textlin");
$graph->SetY2Scale("lin");
$graph->SetShadow();

// Create the linear plot
$lineplot=new LinePlot($_SESSION[rekmed][rekap_kunjungan_rajal_per_dokter][jml_dokter]);
$lineplot2=new LinePlot($_SESSION[rekmed][rekap_kunjungan_rajal_per_dokter][jml_px]);
$lineplot3=new LinePlot($_SESSION[rekmed][rekap_kunjungan_rajal_per_dokter][rata]);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->mark->SetFillColor("cyan");
$lineplot->mark->SetWidth(8);
$lineplot->SetLegend("Jumlah Dokter Poliklinik");
//$lineplot->value->Show();

$lineplot3->SetColor("darkgreen");
$lineplot3->SetWeight(2);
$lineplot3->mark->SetType(MARK_SQUARE);
$lineplot3->mark->SetFillColor("green");
$lineplot3->mark->SetWidth(8);
$lineplot3->SetLegend("Rata-rata Jumlah Kunjungan Poliklinik/Dokter");
$lineplot3->value->Show();

$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);
$lineplot2->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot2->mark->SetFillColor("pink");
$lineplot2->mark->SetWidth(6);
$lineplot2->SetLegend("Jumlah Kunjungan Poliklinik");
//$lineplot2->value->Show();

$graph->yaxis->SetColor("blue");
$graph->y2axis->SetColor("red");

//$graph->title->Set($_SESSION[rekmed][rekap_kunjungan_rajal_per_dokter][title]);
$graph->xaxis->title->Set($_SESSION[rekmed][rekap_kunjungan_rajal_per_dokter][label_x]);
$graph->xaxis->SetTickLabels($_SESSION[rekmed][rekap_kunjungan_rajal_per_dokter][label_tick]);
$graph->yaxis->title->Set("Jumlah");

//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Add the plot to the graph
$graph->Add($lineplot3);
$graph->Add($lineplot);
$graph->AddY2($lineplot2);

// Display the graph
$graph->Stroke();
/*
// Original data points
$xdata = array(1,3,5,7,9,12,15,17.1);
$ydata = array(5,1,9,6,4,3,19,12);

// Get the interpolated values by creating
// a new Spline object.
$spline = new Spline($xdata,$ydata);

// For the new data set we want 40 points to
// get a smooth curve.
list($newx,$newy) = $spline->Get(50);

// Create the graph
$g = new Graph(300,200);
$g->SetMargin(30,20,40,30);
$g->title->Set("Natural cubic splines");
$g->title->SetFont(FF_ARIAL,FS_NORMAL,12);
$g->subtitle->Set('(Control points shown in red)');
$g->subtitle->SetColor('darkred');
$g->SetMarginColor('lightblue');

//$g->img->SetAntiAliasing();

// We need a linlin scale since we provide both
// x and y coordinates for the data points.
$g->SetScale('linlin');

// We want 1 decimal for the X-label
$g->xaxis->SetLabelFormat('%1.1f');

// We use a scatterplot to illustrate the original
// contro points.
$splot = new ScatterPlot($ydata,$xdata);

// 
$splot->mark->SetFillColor('red@0.3');
$splot->mark->SetColor('red@0.5');

// And a line plot to stroke the smooth curve we got
// from the original control points
$lplot = new LinePlot($newy,$newx);
$lplot->SetColor('navy');

// Add the plots to the graph and stroke
$g->Add($lplot);
$g->Add($splot);
$g->Stroke();
*/
?>
