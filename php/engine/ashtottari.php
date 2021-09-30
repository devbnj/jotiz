<?php
// --------------------------------------
// Ashtottari Dasa
//

class AshtottariDasa {
	public $dasaSeq = array(
			1 => array(1=>"","",""),
			2 => array(1=>"","",""),
			3 => array(1=>"","",""),
			4 => array(1=>"","",""),
			5 => array(1=>"","",""),
			6 => array(1=>"","",""),
			7 => array(1=>"","",""),
			8 => array(1=>"","",""),
			9 => array(1=>"","","")
	);

	public $antarSeq = array(
			1 => array(1=>"","",""),
			2 => array(1=>"","",""),
			3 => array(1=>"","",""),
			4 => array(1=>"","",""),
			5 => array(1=>"","",""),
			6 => array(1=>"","",""),
			7 => array(1=>"","",""),
			8 => array(1=>"","","")
			);
	
	public $mdasa = array();
	public $bhukti = array();
	public $startDate = array();
	public $endDate = array();
	
	private $naks = array(
	0=>"Ardra",
	"Punarvasu",
	"Pusyami",
	"Ashlesha",
	"Magha",
	"P-Phalguni",
	"U-Phalguni",
	"Hasta",
	"Chitra",
	"Swati",
	"Visakha",
	"Anuradha",
	"Jyestha",
	"Moola",
	"P-Ashada",
	"U-Ashada",
	"Abhijit",
	"Sravana",
	"Dhanista",
	"Shatabishta",
	"P-Bhadra",
	"U-Bhadra",
	"Revati",
	"Aswini",
	"Bharani",
	"Krittika",
	"Rohini",
	"Mrigashira"	
	);
	private $drange = array (
	0 => array(66.67 , 80.00),
	1 => array(80.00 , 93.33),
	2 => array(93.33 , 106.67),
	3 => array(106.67 , 120.00),
	4 => array(120.00 , 133.33),
	5 => array(133.33 , 146.67),
	6 => array(146.67 , 160.00),
	7 => array(160.00 , 173.33),
	8 => array(173.33 , 186.67),
	9 => array(186.67 , 200.00),
	10 => array(200.00 , 213.33),
	11 => array(213.33 , 226.67),
	12 => array(226.67 , 240.00),
	13 => array(240.00 , 253.33),
	14 => array(253.33 , 266.67),
	15 => array(266.67 , 276.67),
	16 => array(276.67 , 280.89),
	17 => array(280.89 , 293.33),
	18 => array(293.33 , 306.67),
	19 => array(306.67 , 320.00),
	20 => array(320.00 , 333.33),
	21 => array(333.33 , 346.67),
	22 => array(346.67 , 360.00),
	23 => array(0.00 , 13.33),
	24 => array(13.33 , 26.67),
	25 => array(26.67 , 40.00),
	26 => array(40.00 , 53.33),
	27 => array(53.33 , 66.67)
	);
	private $drrange = array(
	array(66.67 , 120.00),
	array(120.00 , 160.00),
	array(160.00 , 213.33),
	array(213.33 , 253.33),
	array(253.33 , 293.33),
	array(293.33 , 333.33),
	array(333.33 , 360.00),
	array(0,  26.67),
	array(26.67 , 66.67)
	);
	private $drgrahas = array("Sun", "Moon", "Mars", "Mercury", "Saturn", "Jupiter", "Rahu", "Rahu", "Venus");
	public $dperiods = array(6.0, 15.0, 8.0, 17.0, 10.0, 19.0, 6.0, 6.0, 21.0);
	
	public $dasaPeriods = array(6.0, 15.0, 8.0, 17.0, 10.0, 19.0, 12.0, 21.0);
	public $dasaGrahas = array("Sun", "Moon", "Mars", "Mercury", "Saturn", "Jupiter", "Rahu", "Venus");
	
	private $line = 0;
	private $planet = array();
	private $key = "";
	private $lagdeg = 0;
	
           
	public function __construct() {
	}
	public function setValues($d, $m, $y, $p, $k, $l=0) {
		$this->maind = $d;
		$this->mainm = $m;
		$this->mainy = $y;
		$this->planet = $p;
		$this->key = $k;
		$this->lagdeg = $l;
	}
	private function fractionReal($x) {
   		return $x - (int)($x);
	}
	
	
	public function doDasas( $zday, $zmonth, $zyear, $daySearch, $moondasa=true ) {
		$d0 = 0.0;
		$day1 = $this->maind;
		$month1 = $this->mainm;
		$year1 = $this->mainy;
		
		if ($moondasa)
			$d0 = $this->planet[7]; // Moon position (Nakshatra)
		else
			$d0 = $this->lagdeg; // Ascendant Pos

		$mnak = $d0;
		$nk = floor($mnak);
		for ($i = 0; $i < count($this->drange); $i++) {
			if (($mnak >= $this->drange[$i][0]) && ($mnak < $this->drange[$i][1])) {  
				$nk = $i; 	
				break;
			}
		}
		$nkr = 0;
		for ($i = 0; $i < count($this->drrange); $i++) {
			if (($mnak >= $this->drrange[$i][0]) && ($mnak < $this->drrange[$i][1])) {  
				$nkr = $i; 	
				break;
			}
		}
		$degsused = $mnak - $this->drrange[$nkr][0];
		$degsleft = $this->drrange[$nkr][1] - $mnak;
		$pcntused = $degsused / ($this->drrange[$nkr][1] - $this->drrange[$nkr][0]);
		$pcntremain = ($this->drrange[$nkr][1] - $mnak) / ($this->drrange[$nkr][1] - $this->drrange[$nkr][0]);
		$trvlrate = $this->dperiods[$nkr] / ($this->drrange[$nkr][1] - $this->drrange[$nkr][0]);
		// print "<br />Nakshatra Ruler ".$this->drgrahas[$nkr];
		// print "<br />Degrees used up ".($degsused); 		
		// print "<br />Percentage used up ".($pcntused); 		
		// print "<br />Percentage remaining ".($pcntremain); 	
		$pday = $zyear + $zmonth/12 + $zday/360;
		$pday_start = $pday - $trvlrate * $degsused;
		$pday_end = $pday + $trvlrate * $degsleft;
		// print "<br />Travel Rate ".($trvlrate); 	
		// print "<br />Pday ".($pday); 	
		// print "<br />Pday_Start ".($this->toDateString($pday_start)); 	
		// print "<br />Pday_End ".($this->toDateString($pday_end)); 	
		$dcount = 1;
		$this->dasaSeq[1][$dcount] = $this->drgrahas[$nkr];
		$this->dasaSeq[2][$dcount] = $this->toDateString($pday_start);
		$this->dasaSeq[3][$dcount++] = $this->toDateString($pday_end);
		
		for ( $i = 0; $i < 9; $i++ ) {
			$pday_start = $pday_end;
			$nkr = ( $nkr + 1 ) % 9;
			$pday_end = $pday_start + $this->dperiods[$nkr];
			$this->dasaSeq[1][$dcount] = $this->drgrahas[$nkr];
			$this->dasaSeq[2][$dcount] = $this->toDateString($pday_start);
			$this->dasaSeq[3][$dcount++] =	$this->toDateString($pday_end);
		}
	}

	public function doAntarDasas( $nkr, $pday ) {
		// if ($nkr % 2 == 0) $degs = 40; else $degs = 53.3333;
		$nxt = 0;
		for ( $i = 0; $i < 8; $i++ ) {
			if ($this->dasaSeq[1][$nkr] == $this->dasaGrahas[$i]) {
				$nxt = $i;
				break;
			}
		}
		$pday_start = $pday;
		$stdy = $this->dasaPeriods[$nxt];
		print "<br />Stdy = ".$stdy;
		$dcount = 1;
		print "<br />Antardasa of ".$this->dasaGrahas[$nxt]." ".$pday_start;
		for ( $i = 0; $i < 8; $i++ ) {
			$antar = $this->dasaPeriods[$nxt] / 108 * $stdy; 
			print "<br />Antar = ".$antar;
			print "<br />To add = ".$this->toDateDouble($pday_start)."+".$antar;
			$pday_end = $this->toDateDouble($pday_start) + $antar;
			print "<br />Resulting Day = ".$pday_end;
			$this->antarSeq[1][$dcount] = $this->dasaGrahas[$nxt];
			$this->antarSeq[2][$dcount] = $pday_start;
			$this->antarSeq[3][$dcount++] = $this->toDateString($pday_end);
			$pday_start = $this->toDateString($pday_end);
			if (++$nxt >= 8) $nxt = $nxt - 8;
		}
	}
	
	private function toDateDouble($pday) {
		$yr = substr($pday,0,4);
		$mo = substr($pday,5,2);
		$dy = substr($pday,8,2);
		print "<br />------".$yr . " ".$mo." ".$dy;
		return ($yr + ($mo / 12) + ($dy /365.25));		
	}
	
	private function toDateString($pday) {
		$year1 = floor($pday);
		$month1 = floor(12 * $this->fractionReal($pday));
		$day1 = floor(30 * $this->fractionReal(12 * $this->fractionReal($pday)) + 1);
		if ( $month1 == 0 ) {
			$year1 = $year1 - 1;
			$month1 = 12;
		}
		else if (($month1 == 12) && ($day1 > 28)) {
			$day1 = $day1 - 28;
			$month1 = 3;
		}
		return sprintf("%4d", $year1)."-".sprintf("%2.0f", $month1) ."-".sprintf("%2.0f", $day1);
	}
	
	private function julianDay($d, $m, $y) {
		$a = 0;
		$jd = 0;
		$l = 0;
		$b = 0.0;
		if ($m < 3) {
			$m = $m + 12;
			$y = $y - 1;
		}
		$a = floor($y / 100);
		$b = 30.6 * ($m + 1.0);
		$l = floor($b);
		$jd = 365 * $y + floor($y/4) + $l + 2 - $a + floor($a/4) + $d;
		return $jd;
	}
	
	private function julDate ($date, $month, $year) {
		$A = 0.0;
		$B = 0.0;
		$Mjd = 0.0;
		$A = 10000.0 * $year + 100.0 * $month + $date;
		if ($month <= 2) {
			$month = $month + 12;
			$year = $year - 1;
		}
		if ($A <= 15821004.1)
		$B = -2 + floor(($year + 4716)/4) - 1179;
		else
		$B = floor($year/400) - floor($year/100) + floor($year/4);
		$A = 365.0 * $year - 679004.0;
		$Mjd = $A + $B + floor(30.6001 * ($month+1)) + $date;
		return ($Mjd + 2400000.5);
	}
	
}
?>