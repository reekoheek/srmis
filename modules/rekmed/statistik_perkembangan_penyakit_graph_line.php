<?php
// Create the graph. These two calls are always required
$graph = new Graph(800,250,"auto");	
//$graph->img->SetMargin(40,40,60,40);
$graph->img->SetMargin(40,40,40,40);
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->yaxis->SetColor("blue");
//$graph->title->Set($_SESSION[rekmed][statistik_perkembangan_penyakit][title]);
$graph->xaxis->title->Set($_SESSION[rekmed][statistik_perkembangan_penyakit][label_x]);
$graph->xaxis->SetTickLabels($_SESSION[rekmed][statistik_perkembangan_penyakit][label_tick]);
$graph->yaxis->title->Set("Jumlah");
//$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($_SESSION[rekmed][statistik_perkembangan_penyakit][jml]);
$lineplot->SetColor("red");
$lineplot->SetWeight(2);
$lineplot->value->Show();
$lineplot->mark->SetType(MARK_UTRIANGLE);
$lineplot->mark->SetFillColor("red");
$lineplot->mark->SetWidth(8);
$graph->Add($lineplot);

// Display the graph
$graph->Stroke();
?>
