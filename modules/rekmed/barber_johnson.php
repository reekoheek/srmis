<?

$grafik = new BJ(600,800);
$grafik->param[bor] = $_SESSION[rekmed][performance][bj][bor];
$grafik->param[bto] = $_SESSION[rekmed][performance][bj][bto];
$grafik->param[toi] = $_SESSION[rekmed][performance][bj][toi];
$grafik->param[avlos] = $_SESSION[rekmed][performance][bj][avlos];
$grafik->param[periode] = $_SESSION[rekmed][performance][bj][selisih_hari];
//$grafik->param[rs] = $_GET[rs];
$grafik->showHorizontalGrid();
$grafik->showVerticalGrid();
$grafik->drawStandarBJ();
$grafik->drawUserBJ();
$grafik->build();
?>