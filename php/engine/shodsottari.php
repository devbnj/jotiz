<?php
// --------------------------------------
// Shodsottari Dasa
//

class ShodsottariDasa {
	public $dasaSeq = array(
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
	0=>"Pusyami",
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
	"Mrigashira",
	"Ardra",
	"Punarvasu"
	);
	private $drange = array (
			array(93.33, 106.67),
			array(106.67, 120.00),
			array(120.00, 133.33),
			array(133.33, 146.67),
			array(146.67, 160.00),
			array(160.00, 173.33),
			array(173.33, 186.67),
			array(186.67, 200.00),
			array(200.00, 213.33),
			array(213.33, 226.67),
			array(226.67, 240.00),
			array(240.00, 253.33),
			array(253.33, 266.67),
			array(266.67, 280.00),
			array(280.00, 293.33),
			array(293.33, 306.67),
			array(306.67, 320.00),
			array(320.00, 333.33),
			array(333.33, 346.67),
			array(346.67, 360.00),
			array(0.00, 13.33),
			array(13.33, 26.67),
			array(26.67, 40.00),
			array(40.00, 53.33),
			array(53.33, 66.67),
			array(66.67, 80.00),
			array(80.00, 93.33),
	);
	
	public $dasaPeriods = array(11.0, 12.0, 13.0, 14.0, 15.0, 16.0, 17.0, 18.0);
	public $dasaGrahas = array("Sun", "Mars", "Jupiter", "Saturn",  "Ketu", "Moon", "Mercury", "Venus");
	
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
	
	
	public function doDasas( $zday, $zmonth, $zyear, $daySearch ) {
		$d0 = 0.0;
		$day1 = $this->maind;
		$month1 = $this->mainm;
		$year1 = $this->mainy;
		
		$d0 = $this->planet[7]; // Moon position (Nakshatra)
		$mnak = $d0;
		
		$nk = floor($mnak);
		// print "<br />Moon ".$d0;
		// print "<br />Nak ".$mnak;
		for ($i = 0; $i < count($this->drange); $i++) {
			if (($mnak >= $this->drange[$i][0]) && ($mnak < $this->drange[$i][1])) {  
				// print "<br />".$this->drange[$i][0]." - ".$this->drange[$i][1];
				$nk = $i; 	
				// print "<br />".$nk;
				break;
			}
		}
		// print "<br />Nak Fixed ".$nk;
		// print "<br />Nakshatra ".$this->naks[$nk];

		$degsused = $mnak - $this->drange[$nk][0];
		$degsleft = $this->drange[$nk][1] - $mnak;
		$pcntused = $degsused / ($this->drange[$nk][1] - $this->drange[$nk][0]);
		$pcntremain = ($this->drange[$nk][1] - $mnak) / ($this->drange[$nk][1] - $this->drange[$nk][0]);
		$trvlrate = $this->dasaPeriods[$nk % 8] / ($this->drange[$nk][1] - $this->drange[$nk][0]);
		
		// print "<br />Nakshatra Ruler ".$this->dasaGrahas[$nk % 8];
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
		$this->dasaSeq[1][$dcount] = $this->dasaGrahas[$nk % 8];
		$this->dasaSeq[2][$dcount] = $this->toDateString($pday_start);
		$this->dasaSeq[3][$dcount++] = $this->toDateString($pday_end);
		
		for ( $i = 1; $i < 9; $i++ ) {
			$pday_start = $pday_end;
			$pday_end = $pday_start + $this->dasaPeriods[($nk + $i) % 8];
			$this->dasaSeq[1][$dcount] = $this->dasaGrahas[($nk + $i) % 8];
			$this->dasaSeq[2][$dcount] = $this->toDateString($pday_start);
			$this->dasaSeq[3][$dcount++] =	$this->toDateString($pday_end);
		}
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
		return sprintf("%4d", $year1)."-".$month1 ."-".$day1;
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