<?php

class Yogini {
/*
  Moon 1
  Sun 2
  Jupiter 3
  Mars 4
  Mercury 5
  Satyrn 6
  Venus 7
  Rahu 8
*/

	public $G_Yogini = array("Moon","Sun","Jupiter","Mars","Mercury","Saturn","Venus","Rahu");
	public $G_YogAnt = array("Sun","Moon","Mars","Mercury","Jupiter","Venus","Saturn","Rahu");
	public $G_YoginiNames = array("Mangala","Pingala","Dhanya","Brhamari","Bhadrika","Ulka","Siddha", "Sankata");
	public $dasa_dur = array( 1, 2, 3, 4, 5, 6, 7, 8 );
	public $lord_map = array( 1, 0, 3, 4, 2, 6, 5, 7 );
	public $G_YogStart;
	private $G_Nakshatra_No;
	private $G_Nakshatra_Pada;
	private $plnt = array();
	private $z_year = 0;
	private $z_month = 0;
	private $z_day = 0;
	public $G_YogBalDasa;
	public $YogBalDasa;
	public $mainm = 0;
	public $maind = 0;
	public $mainy = 0;
	public $results = "";
	
	public function __construct() {
	}
	
	public function setValues($plnt, $G_Nakshatra, $G_NakPada, $z_year, $z_month, $z_day) {
		$this->plnt = $plnt;
		$this->G_Nakshatra_No = $G_Nakshatra;
		$this->G_Nakshatra_Pada = $G_NakPada;
		$this->z_day = $z_day;
		$this->z_month = $z_month;
		$this->z_year = $z_year;
	}
	public function compute() {
		$this->G_YogStart = ($this->G_Nakshatra_No + 1 + 3) % 8;
		if ($this->G_YogStart == 0) $this->G_YogStart = 1;
		$d0 = $this->plnt[7];
		$asc = ($d0 - (floor($d0 / 13.333)*13.333));

		$this->YogBalDasa = ((13.333 - $asc) / 13.333) * $this->G_YogStart; // remaining
		$kyears = floor($this->YogBalDasa);
		$kmonths = floor(($this->YogBalDasa - $kyears) * 12);
		$kdays = floor(((($this->YogBalDasa - $kyears) * 12) - $kmonths) * 30);
		$this->G_YogBalDasa = sprintf("%2.2d yrs %2.2d mos %2.2d dys",
			$kyears, $kmonths, $kdays);
		$this->mainm  = $this->z_month;
		$this->maind  = $this->z_day;
		$this->mainy  = $this->z_year;
		$this->maind  += $kdays;
		$this->mainm  += $kmonths;
		$this->mainy  += $kyears;
		$this->fixMonthYear($this->mainm, $this->maind, $this->mainy);
	}
	
	public function fixMonthYear(&$m, &$d, &$y) {
		if ($d > 30) {
			++$m;
			$d = ($d - 30);
		}
		if ($m > 12) {
			++$y;
			$m = ($m - 12);
			if (($m == 2) && ($d > 28)) {
				++$m;
				$d = ($d - 28);
			}
		}
	}
	
	public function GetNextYoginiLevel($dlen, $dlord, &$dd, &$mm, &$yy) {
		$this->results = "";
		$dasa_len = $dlen;
		$stpoint = 7 - floor($dlen / $this->dasa_dur[$dlord] * 7);
		if ($stpoint <= 0) $alord = $dlord;
		else $alord = $this->lord_map[$stpoint];
		$flag = false;
		$rri = 0;

		for( $rri = $stpoint; $rri < 8; $rri++ ) {
			$this->results .= "<tr>";
			$this->results .= "<td>&nbsp;</td>";
			$this->results .= "<td>&nbsp;</td>";
			if (!$flag) $antar_len = ( $dlen * $this->dasa_dur[$alord] ) / 36;
			else $antar_len = ( $this->dasa_dur[$dlord] * $this->dasa_dur[$alord] ) / 36;
			$flag = true;
			$this->results .= "<td>".$this->G_Yogini[$alord]."</td>";
			$kyears = floor($antar_len);
			$kmonths = floor(($antar_len - $kyears) * 12);
			$kdays = floor(((($antar_len - $kyears) * 12) - $kmonths) * 30);
			$this->results .= "<td>".sprintf("%3.2f", $antar_len)." yrs</td>";
			$antarm  = $mm;
			$antard  = $dd;
			$antary  = $yy;
			$antard  += $kdays;
			$antarm  += $kmonths;
			$antary  += $kyears;
			$this->fixMonthYear($antarm, $antard, $antary);
			$this->results .= "<td>".sprintf("%4.2d-%2.2d-%2.2d",$yy,$mm,$dd)."</td>";
			$yendate = sprintf("%4.2d-%2.2d-%2.2d",$antary,$antarm,$antard);
			$this->results .= "<td>".$yendate."</td>";
			$ystdate = $yendate;
			$dd = $antard;
			$mm = $antarm;
			$yy = $antary;
			$alord = ( $alord + 1 ) % 8;
			$this->results .= "</tr>";
		}
	}

}