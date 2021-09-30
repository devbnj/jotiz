<?php

class Dasa {
	public $dasaSeq = array(
			1 => array(1=>"",""),
			2 => array(1=>"",""),
			3 => array(1=>"",""),
			4 => array(1=>"",""),
			5 => array(1=>"",""),
			6 => array(1=>"",""),
			7 => array(1=>"",""),
			8 => array(1=>"",""),
			9 => array(1=>"","")
			);

	public $mdasa = array();
	public $bhukti = array();
	public $startDate = array();
	public $endDate = array();
	public $dasaPeriods = array(7.0, 20.0, 6.0, 10.0,
           7.0, 18.0, 16.0, 19.0, 17.0);
	public $dasaGrahas = array("Ketu", "Venus", "Sun", "Moon",
           "Mars", "Rahu", "Jupiter", "Saturn", "Mercury");
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
	
	public function doVimsottari( $zday, $zmonth, $zyear, $daySearch, $moondasa=true ) {
		$d0 = 0.0;
		$n0 = 0.0;
		$LongAscNode = 0.0;  // this variable got messed up
		$ninetyDays = 0.0;
		$balanceDasa = 0.0;
		$qzz = 0;
		$c = 0;
		$d = 0;
		$e = 0;
		$n = 0;
		$g = 0;
		$year2 = 0;
		$month2 = 0;
		$day4 = 0;
		$f = 0;
		$day3 = 0;
		$month1 = 0;
		$year1 = 0;
		$ast = 0;
		$day4mp = "";
		$pday = $zday;
		$pmonth = $zmonth;
		$pyear = $zyear;
		$counter = 1;

		$ast = 1;
		$day3 = $this->maind;
		$month1 = $this->mainm;
		$year1 = $this->mainy;
		$vimdate2 = sprintf("%4d", $year1)."-".$month1 ."-".$day3;
		
		if ($moondasa)
			$d0 = $this->planet[7]; // Moon position (Nakshatra)
		else
			$d0 = $this->lagdeg; // Ascendant Pos
		$d0 = 9.0 * $this->fractionReal($d0/120);
		$n0 = $this->fractionReal($d0);
		$qzz = floor($d0);
		$balanceDasa = ((1-$n0) * $this->dasaPeriods[$qzz])*365 - floor((1-$n0)*$this->dasaPeriods[$qzz])*365;
		$LongAscNode = $n0 * $this->dasaPeriods[$qzz];
		$pday = $pyear + $pmonth/12 + $pday/360;
		$ninetyDays = $pday + 90.0;
		$pmonth = $pday - $LongAscNode;

		$c = $qzz;
		$scount = 1;
		$dcount = 1;
		$exitcnt = 0;
		do {
			$scount++;
			$exitcnt++;
			if ($c > 8) $c = $c - 9;
			for ($d = 0; $d < 9; $d++) {
				$n = $c + $d;
				if ($n > 8) $n = $n - 9;
				$vimdate = $month1 ."/".$day3."/".sprintf("%4d", $year1);
				$vimdate3 = "";
				for ($e = 0; $e < 9; $e++) {
					$g = $n + $e;
					if ($g > 8) $g = $g - 9;
					$pmonth += ($this->dasaPeriods[$c] * $this->dasaPeriods[$n] * $this->dasaPeriods[$g]) / 14400;
					if ($pmonth < $pday) continue;
					$vimdate2 = $this->toDateString($pmonth);
					$year2 = floor($pmonth);
					$month2 = floor(12 * $this->fractionReal($pmonth));
					$day4 = floor(30 * $this->fractionReal(12 * $this->fractionReal($pmonth)) + 1);
					if ( $month2 == 0 ) {
						$year2 = $year2 - 1;
						$month2 = 12;
					}
					else if (($month2 == 12) && ($day4 > 28)) {
						$day4 = $day4 - 28;
						$month2 = 3;
					}
					$day3 = $day4;
					$month1 = $month2;
					$year1 = $year2;
				}
				$this->mdasa[] = $this->dasaGrahas[$c];
				$this->bhukti[] = $this->dasaGrahas[$n];
				$this->startDate[] = $vimdate;
				$this->endDate[] = $vimdate2;
				
			}
			$f = $c + 1;
			if ($f > 8) $f = $f - 9;
			$this->dasaSeq[1][$dcount++] = $this->dasaGrahas[$c];
			$this->dasaSeq[2][$dcount] = $vimdate2;
			++$c;
		} while ($exitcnt <= 9); // while ($c != $qzz+9);
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
	
	public function doDasas( $zday, $zmonth, $zyear, $daySearch, $moondasa=true ) {
		$d0 = 0.0;
		$n0 = 0.0;
		$LongAscNode = 0.0;  // this variable got messed up
		$ninetyDays = 0.0;
		$balanceDasa = 0.0;
		$qzz = 0;
		$c = 0;
		$d = 0;
		$e = 0;
		$n = 0;
		$g = 0;
		$year2 = 0;
		$month2 = 0;
		$day4 = 0;
		$f = 0;
		$day3 = 0;
		$month1 = 0;
		$year1 = 0;
		$ast = 0;
		$day4mp = "";
		$pday = $zday;
		$pmonth = $zmonth;
		$pyear = $zyear;
		$counter = 1;

		$ast = 1;
		$day3 = $this->maind;
		$month1 = $this->mainm;
		$year1 = $this->mainy;
		$vimdate2 = sprintf("%4d", $year1)."-".$month1 ."-".$day3;
		
		if ($moondasa)
			$d0 = $this->planet[7]; // Moon position (Nakshatra)
		else
			$d0 = $this->lagdeg; // Ascendant Pos
		// print "<br />Moon ".$d0;	
		$d0 = 9.0 * $this->fractionReal($d0/120);
		// print "<br />Moon Fraction ".$d0;	
		$n0 = $this->fractionReal($d0);
		$qzz = floor($d0);
		$balanceDasa = ((1-$n0) * $this->dasaPeriods[$qzz])*365 - floor((1-$n0)*$this->dasaPeriods[$qzz])*365;
		$LongAscNode = $n0 * $this->dasaPeriods[$qzz];
		$pday = $pyear + $pmonth/12 + $pday/360;
		$ninetyDays = $pday + 90.0;
		$pmonth = $pday - $LongAscNode;

		$c = $qzz;
		$scount = 1;
		$dcount = 1;
		$exitcnt = 0;
		do {
			$scount++;
			$exitcnt++;
			if ($c > 8) $c = $c - 9;
			for ($d = 0; $d < 9; $d++) {
				$n = $c + $d;
				if ($n > 8) $n = $n - 9;
				$vimdate = $month1 ."/".$day3."/".sprintf("%4d", $year1);
				$vimdate3 = "";
				for ($e = 0; $e < 9; $e++) {
					$g = $n + $e;
					if ($g > 8) $g = $g - 9;
					$pmonth += ($this->dasaPeriods[$c] * $this->dasaPeriods[$n] * $this->dasaPeriods[$g]) / 14400;
					if ($pmonth < $pday) continue;
					$year2 = floor($pmonth);
					$month2 = floor(12 * $this->fractionReal($pmonth));
					$day4 = floor(30 * $this->fractionReal(12 * $this->fractionReal($pmonth)) + 1);
					if ( $month2 == 0 ) {
						$year2 = $year2 - 1;
						$month2 = 12;
					}
					else if (($month2 == 12) && ($day4 > 28)) {
						$day4 = $day4 - 28;
						$month2 = 3;
					}
					$vimdate3 = sprintf("%4d", $year1)."-".$month1 ."-".$day3;
					$vimdate2 = sprintf("%4d", $year2)."-".$month2 ."-".$day4;
					$this->bhukti[] = $this->dasaGrahas[$c]." - ".$this->dasaGrahas[$n]." - ".$this->dasaGrahas[$g]." ".$vimdate3." - ".$vimdate2;
					// $vimdate2 = $month2 ."/".$day4."/".sprintf("%4d", $year2);
					$day3 = $day4;
					$month1 = $month2;
					$year1 = $year2;
				}
				$this->mdasa[] = $this->dasaGrahas[$c];
				// $this->bhukti[] = $this->dasaGrahas[$n]." - ".$this->dasaGrahas[$g];
				$this->startDate[] = $vimdate;
				$this->endDate[] = $vimdate2;
				
			}
			$f = $c + 1;
			if ($f > 8)
			$f = $f - 9;
			$this->dasaSeq[1][$dcount++] = $this->dasaGrahas[$c];
			$this->dasaSeq[2][$dcount] = $vimdate2;
			++$c;
		} while ($exitcnt < 9); // while ($c != $qzz+9);
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
	
	public function findDatesInDasa( $sday, $smonth, $syear ) {
		$count = count($this->startDate);
		$jf = $this->julDate($sday, $smonth, $syear);
		for ($i = 0; $i < $count; $i++) {
			$dmy = null;
			$dmy = array();
			$dmy1 = explode('/', $this->startDate[$i], 3);
			$js = $this->julDate($dmy1[1], $dmy1[0], $dmy1[2]);
			$dmy1 = explode('/', $this->endDate[$i], 3);
			$je = $this->julDate($dmy1[1], $dmy1[0], $dmy1[2]);
			if (($jf <= $je) && ($jf >= $js)) {
				return $i;
				$break;
			}
		}
	}
}

?>