<?
Class BJ {
	var $gambar;

	var $lebar;
	var $tinggi;
	var $top = 50;
	var $right = 50;
	var $bottom = 50;
	var $left = 50;
	var $min;
	var $max;
	var $show_legend = false;

	var $param = array();

	var $title = "Grafik Barber Johnson\n";

	function __construct($lebar = 500, $tinggi = 800) {
		header("Content-type: image/png");
		$this->tinggi = $tinggi;
		$this->lebar = $lebar-100;
		if($this->show_legend) $this->gambar = imagecreate($lebar+$this->left+$this->right, $tinggi+$this->top+$this->bottom);
		else $this->gambar = imagecreate($lebar, $tinggi+$this->top+$this->bottom);
		//bikin background
		$this->getColor("putih");
		$this->y_max = $tinggi/25;
		$this->x_max = $lebar/50;

		$this->min[x] = 0; 
		$this->min[y] = 0;
		$this->setTitle();
	}

	function BJ($lebar, $tinggi) {
		return $this->__construct($lebar, $tinggi);
	}

	function setTitle() {
		$title = $this->title ."";
		$this->drawText($title, 24, 0, 1.9, 32.2, "hitam", "trebuc.ttf");
		imagepolygon($this->gambar, array(
			0,0,
			0,898,
			598,898,
			598,0), 4, $this->getColor("hitam"));
		//tantos
		//$this->drawText("http://tantos.web.id/grafik_barber_johnson/", 10, 0, 5, 0.1, "hitam", "ariali.ttf");
	}
	
	//membuat grid
	function showHorizontalGrid() {
		$hor_grid = floor($this->tinggi/50);
		for($i=0;$i<=$hor_grid;$i++) {
			$n = $i+1;
			imageline($this->gambar, $this->left, $n*50, $this->lebar+$this->left, $n*50, $this->getColor("abu"));
			//imageline ( resource image, int x1, int y1, int x2, int y2, int color )
			$angka = abs((($n*50)-$this->tinggi)/25-2);
			imagestring($this->gambar, 2, $this->left-15,$n*50, $angka, $this->getColor("biru"));
		}
		$this->max[y] = $angka;
	}

	function showVerticalGrid() {
		$ver_grid = floor($this->lebar/50);
		for($i=0;$i<=$ver_grid;$i++) {
			//create horizontal grids
			$n=$i+1;
			imageline($this->gambar, $n*50, $this->top, $n*50, $this->tinggi+$this->top, $this->getColor("abu"));
			//imageline($gambar, $margin_y, $i*50, 500+$margin_y, $i*50, $abu);
			$angka = abs(((($n*50))/25-2)/2);
			imagestring($this->gambar, 2, $n*50, $this->tinggi+$this->top, $angka, $this->getColor("biru"));
		}
		$this->max[x] = $angka;
	}

	function drawLine($x1, $y1, $x2, $y2, $warna = "merah") {
		$start = $this->transform($x1, $y1);
		$end = $this->transform($x2, $y2);
		imageline($this->gambar, $start[x], $start[y], $end[x], $end[y], $this->getColor($warna));
		//imageline($this->gambar, 0, 0, 100, 100, $this->getColor($warna));
		
		$start2 = $this->transform($x1+0.001, $y1+0.001);
		$end2 = $this->transform($x2+0.001, $y2+0.001);
		imageline($this->gambar, $start2[x], $start2[y], $end2[x], $end2[y], $this->getColor($warna));

		$start3 = $this->transform($x1-0.001, $y1-0.001);
		$end3 = $this->transform($x2-0.001, $y2-0.001);
		imageline($this->gambar, $start3[x], $start3[y], $end3[x], $end3[y], $this->getColor($warna));
	}

	function relatif($x1,$y1,$x2,$y2) {
		//$start = titik mulai
		//$end = titik selesai
		if($x1 > 10) {
			$x1 = 10;
			if($y1 > 32) {
				
			} else {
			
			}
		}
	}

	function drawText($teks = "", $ukuran = 10, $sudut = 0, $x = 10, $y = 20, $warna = "hitam", $font = "arial.ttf") {
		$warna = $this->getColor($warna);
		$font = TTF_DIR . $font;
		$pos = $this->transform($x, $y);
		imagettftext($this->gambar, $ukuran, $sudut, $pos[x], $pos[y], $warna, $font, $teks);
	}

	function drawPolygon($koordinat = array(), $sudut, $warna) {
		$i=0;
		while($i<sizeof($koordinat)) {
			$transform = $this->transform($koordinat[$i], $koordinat[$i+1]);
			$t[] = $transform[x];
			$t[] = $transform[y];
			$i +=2;
		}
		imagefilledpolygon($this->gambar, $t, 4,$warna);
	}

	function drawStandarBJ() {
		//daerah efisien
		$arr_efisien = array(
							1,3,
							3,9,
							3,32,
							1,32
						);
		$this->drawPolygon($arr_efisien, 4, $this->getColor('abu3'));
		//TOI 1 HARI
		
		$this->drawText("DAERAH EFISIEN", 20, 90, 2, 14);
		$this->drawLine(1,3,1,32, "hitam");
		$this->drawLine(3,9,3,32, "hitam");
		$this->drawLine(1,3,3,9, "hitam");
		/*
		//BOR 75%
		$this->drawText("BOR (75%)", 13, 0, 9, 28);
		$this->drawLine(0,0,10,30, "biru");
		//BTO
		$this->drawText("BTO (30)", 13, 0, 9, 4);
		$this->drawLine(12.16,0,0,12.16, "biru");
		*/
		//label x
		$this->drawText("Turn Over Interval (hari)", 15, 0, 3, -1.5, "hitam", "georgia.ttf");
		//label y
		$this->drawText("Average Length of Stay (hari)", 15, 90, -0.5, 10, "hitam", "georgia.ttf");
		
		
	}

	function drawUserBJ() {
		$this->drawBOR();
		$this->drawBTO();
		$this->drawAvlosAndToi();
		$this->drawNamaRS();
		$this->drawPeriode();
	}

	function drawBOR() {
		$param = $this->param;
		/*
		BOR=80%
		0	= 80/100 A
		L	= 0 X 365/D
			= 80/100 A X 365/D
		L X D = 80/100 A X 365
		100/80 L X D = A X 365

		T	= (A-0) X 365/D
			= (A- 80/100) X365/D
		T X D = 20/100 A
		10/8 L = 10/2 T
		80% = 1, 8/2
		*/
		$x = 10;
		$selisih = 100-$param[bor];
		$y = @round($param[bor]/$selisih,2)*10;
		$this->drawLine(0, 0, $x, $y);
		if($this->show_legend) $this->drawText("BOR : " . $param[bor] . " %", 13, 0, 10.2, 20, "merah");
	}

	function drawBTO() {
		$param = $this->param;
		$nilai = @round($param[periode]/$param[bto], 2);
		$this->drawLine($nilai, 0, 0, $nilai, "hijau");
		if($this->show_legend) $this->drawText("BTO : " . $param[bto] . " kali", 13, 0, 10.2, 19.3, "hijau");
	}

	function drawAvlosAndToi() {
		$param = $this->param;
		//garis avlos
		if($param[toi] > 10) $batas_toi = 10; else $batas_toi = $param[toi];
		$this->drawLine(0, $param[avlos], $batas_toi, $param[avlos], "coklat");
		if($this->show_legend) $this->drawText("AvLOS : " . $param[avlos] . " hari", 13, 0, 10.2, 18.7, "coklat");
		//garis toi
		if($param[avlos] > 32) $batas_avlos = 32; else $batas_avlos = $param[avlos];
		$this->drawLine($param[toi], 0, $param[toi], $batas_avlos, "biru");
		if($this->show_legend) $this->drawText("TOI : " . $param[toi] . " hari", 13, 0, 10.2, 18, "biru");
	}

	function drawNamaRS() {
		//nama RS
		$this->drawText($this->param[rs], 18, 0, 3, 33);
	}

	function drawPeriode() {
		//nama RS
		if($this->show_legend) $this->drawText("Periode : " . $this->param[periode] . " hari", 13, 0, 10.2, 16, "hitam");
	}
/*

	function unTransform($x, $y) {
		fungsi untuk transformasi titik	dari pixel ke grafik
		0,0 -> -1,-33
		50,850 -> 0,0
		100,850 -> 1,0
		50,800 -> 0,2
		100,800 -> 1,2
		
		16->2
		17->0

		$ret[x] = $x/50-1;
		$ret[y] = $this->xabs($y/25-34);
		return $ret;
	}
*/

	function transform($x, $y) {
		//transformasi dari grafik ke pixel
		/*
		Y
		-2->900
		0->850
		2->800
		4->750
		y=0 x = 12
		
		12y+x = 0
		12x+y = 0
		
		12x - 12y = 0
		x = 10
		102 + y2 = 2
		*/
		/*
		if($x < $this->min[x]) $x = $this->min[x];
		if($y < $this->min[y]) $y = $this->min[y];

		if($x > $this->max[x]) $x = $this->max[x];
		if($y > $this->max[y]) $y = $this->max[y];
		*/
		$ret[x] = ($x+1)*50;
//		if($ret[x])>$this->max_x) $ret[x] = $this->
		$ret[y] = (($this->xabs($y)+34))*25;
		/*
		if($ret[x] > 10) {
			$ret[x] = 10;
		}*/

		return $ret;
	}

	function xabs($angka) {
		//mambalik angka absolute
		$ret = $angka * -1;
		return $ret;
	}


	function getColor($color) {
		switch(strtolower($color)) {
			case "merah" :
				$warna = imagecolorallocate($this->gambar, 255, 0, 0);
			break;
			case "hitam" :
				$warna = imagecolorallocate($this->gambar, 0, 0, 0);
			break;
			case "abu" :
				$warna = imagecolorallocate($this->gambar, 192, 192, 192);
			break;
			case "abu2" :
				$warna = imagecolorallocate($this->gambar, 204, 204, 204);
			break;
			case "abu3" :
				$warna = imagecolorallocate($this->gambar, 220, 220, 220);
			break;
			case "biru" :
				$warna = imagecolorallocate($this->gambar, 0, 0, 255);
			break;
			case "hijau" :
				$warna = imagecolorallocate($this->gambar, 50, 100, 50);
			break;
			case "kuning" :
				$warna = imagecolorallocate($this->gambar, 255, 255, 0);
			break;
			case "coklat" :
				$warna = imagecolorallocate($this->gambar, 204, 204, 51);
			break;
			default :
				$warna = imagecolorallocate($this->gambar, 255, 255, 255);
			break;
		}
		return $warna;
	}

	function build() {
		imagepng($this->gambar);
		imagedestroy($this->gambar);
	}
}
?>