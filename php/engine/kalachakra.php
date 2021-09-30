<?php

class KalaChakra {
	// ---------------------Ar  Ta Ge  Ca Le Vi  Li Sc  Sa Aq Cp  Pi ----
	public $G_KCZodPeriods = array( 7, 16, 9, 21, 5, 9, 16, 7, 10, 4, 4, 10 );
	public $G_KCPlanets = array( "Sun", "Moon", "Mars", "Mercury",
                      "Jupiter", "Venus", "Saturn");
	public $G_KCPlanetPeriods = array(5, 21, 7, 9, 10, 16, 4);
	public $G_KCAmsa = array (8, 7, 6, 5, 4, 3, 2, 1, 12, 10, 11, 9 );
	public $G_Amsa = -1;

	public $savya1 = array(1, 3, 7, 9, 13, 15, 19, 21, 25, 27);
	public $savya1Pada1 = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
	public $savya1Pada1Str = "Aries(Deha), Taurus, Gemini, Cancer, Leo, Virgo, Libra, Scorpio, Sagittarius(Jeeva)";
	public $savya1Pada1Param = 100;
	public $savya1Pada2 = array(10, 11, 12, 8, 7, 6, 4, 5, 3);
	public $savya1Pada2Str = "Capricorn(Deha), Aquarius, Pisces, Scorpio, Libra, Virgo, Cancer, Leo, Gemini(Jeeva)";
	public $savya1Pada2Param = 85;
	public $savya1Pada3 = array(2, 1, 12, 11, 10, 9, 1, 2, 3);
	public $savya1Pada3Str = "Taurus(Deha), Aries, Pisces, Aquarius, Capricorn, Sagittarius, Aries, Taurus, Gemini(Jeeva)";
	public $savya1Pada3Param = 83;
	public $savya1Pada4 = array(4, 5, 6, 7, 8, 9, 10, 11, 12);
	public $savya1Pada4Str = "Cancer(Deha), Leo, Virgo, Libra, Scorpio, Sagittarius, Capricorn, Aquarius, Pisces(Jeeva)";
	public $savya1Pada4Param = 86;

	public $savya2 = array(2, 8, 14, 20, 26);
	public $savya2Pada1 = array(8, 7, 6, 4, 5, 3, 2, 1, 12);
	public $savya2Pada1Str = "Scorpio(Deha), Libra, Virgo, Cancer, Leo, Gemini, Taurus, Aries, Pisces(Jeeva)";
	public $savya2Pada1Param = 100;
	public $savya2Pada2 = array(11, 10, 9, 1, 2, 3, 4, 5, 6);
	public $savya2Pada2Str = "Aquarius(Deha), Capricorn, Sagittarius, Aries, Taurus, Gemini, Cancer, Leo, Virgo(Jeeva)";
	public $savya2Pada2Param = 85;
	public $savya2Pada3 = array(7, 8, 9, 10, 11, 12, 8, 7, 6);
	public $savya2Pada3Str = "Libra(Deha), Scorpio, Sagittarius, Capricorn, Aquarius, Pisces, Scorpio, Libra, Virgo(Jeeva)";
	public $savya2Pada3Param = 83;
	public $savya2Pada4 = array(4, 5, 3, 2, 1, 12, 11, 10, 9);
	public $savya2Pada4Str = "Cancer(Deha), Leo, Gemini, Taurus, Aries, Pisces, Aquarius, Capricorn, Sagittarius(Jeeva)";
	public $savya2Pada4Param = 86;

	public $apasavya1 = array(4, 10, 16, 22);
	public $apasavya1Pada1 = array(9, 10, 11, 12, 1, 2, 3, 5, 4);
	public $apasavya1Pada1Str = "Sagittarius(Jeeva), Capricorn, Aquarius, Pisces, Aries, Taurus, Gemini, Leo, Cancer(Deha)";
	public $apasavya1Pada1Param = 86;
	public $apasavya1Pada2 = array(6, 7, 8, 12, 11, 10, 9, 8, 7);
	public $apasavya1Pada2Str = "Virgo(Jeeva), Libra, Scorpio, Pisces, Aquarius, Capricorn, Sagittarius, Scorpio, Libra(Deha)";
	public $apasavya1Pada2Param = 83;
	public $apasavya1Pada3 = array(6, 5, 4, 3, 2, 1, 9, 10, 11);
	public $apasavya1Pada3Str = "Virgo(Jeeva), Leo, Cancer, Gemini, Taurus, Aries, Sagittarius, Capricorn, Aquarius(Deha)";
	public $apasavya1Pada3Param = 85;
	public $apasavya1Pada4 = array(12, 1, 2, 3, 5, 4, 6, 7, 8);
	public $apasavya1Pada4Str = "Pisces(Jeeva), Aries, Taurus, Gemini, Leo, Cancer, Virgo, Libra, Scorpio(Deha)";
	public $apasavya1Pada4Param = 100;

	public $apasavya2 = array(5, 6, 11, 12, 17, 18, 23, 24);
	public $apasavya2Pada1 = array(12, 11, 10, 9, 8, 7, 6, 5, 4);
	public $apasavya2Pada1Str = "Pisces(Jeeva), Aquarius, Capricorn, Sagittarius, Scorpio, Libra, Virgo, Leo, Cancer(Deha)";
	public $apasavya2Pada1Param = 86;
	public $apasavya2Pada2 = array(3, 2, 1, 9, 10, 11, 12, 1, 2);
	public $apasavya2Pada2Str = "Gemini(Jeeva), Taurus, Aries, Sagittarius, Capricorn, Aquarius, Pisces, Aries, Taurus(Deha)";
	public $apasavya2Pada2Param = 83;
	public $apasavya2Pada3 = array(3, 5, 4, 6, 7, 8, 12, 11, 10);
	public $apasavya2Pada3Str = "Gemini(Jeeva), Leo, Cancer, Virgo, Libra, Scorpio, Pisces, Aquarius, Capricorn(Deha)";
	public $apasavya2Pada3Param = 85;
	public $apasavya2Pada4 = array(9, 8, 7, 6, 5, 4, 3, 2, 1);
	public $apasavya2Pada4Str = "Sagittarius(Jeeva), Scorpio, Libra, Virgo, Leo, Cancer, Gemini, Taurus, Aries(Deha)";
	public $apasavya2Pada4Param = 100;

	private $plnt = array();
	private $z_year = 0;
	private $z_month = 0;
	private $z_day = 0;
	public $results = array();
	
	public $G_Nakshatra_No;
	public $G_Nakshatra_Pada;
	public $ascpos;
	public $eras;
	public $bsav1;
	public $bsav2; 
	public $basav1;
	public $basav2;
	public $nakp;
	public $nakm;
	public $fracpada;
	public $drem;
	
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
		$d0 = $this->plnt[7];
		// Moon is in Nakshatra No, Pada
		$this->nakm = $this->G_Nakshatra_No+1;
		$this->nakp = $this->G_Nakshatra_Pada;
		$ij = 0;
		$this->bsav1 = false;
		for ($ij = 0; $ij < count($this->savya1); $ij++)
		if ($this->nakm == $this->savya1[$ij]) $this->bsav1 = true;
		$this->bsav2 = false;
		for ($ij = 0; $ij < count($this->savya2); $ij++)
		if ($this->nakm == $this->savya2[$ij]) $this->bsav2 = true;
		$this->basav1 = false;
		for ($ij = 0; $ij < count($this->apasavya1); $ij++)
		if ($this->nakm == $this->apasavya1[$ij]) $this->basav1 = true;
		$this->basav2 = false;
		for ($ij = 0; $ij < count($this->apasavya2); $ij++)
		if ($this->nakm == $this->apasavya2[$ij]) $this->basav2 = true;

		$frac0 = (int)($d0 / 3.3333);
		// Degrees still left in Pada
		$this->fracpada = ($frac0+1.0)*3.3333 - $d0;
		// Percentage still left in Pada
		$this->drem = (3.3333 - $this->fracpada)/3.3333;
	}
	
	public function CalcKalaChakra($aspadastr, $yrs, $savya) {
		$this->results = array();
		$this->results[] =  "<strong>Zodiac Dasa Sequence</strong><br /> ".$aspadastr."<br /><strong>Paramayush</strong> ".$yrs." Years<br />&nbsp;";
		$yrsleft = 0;
		$this->amsa = ( ($this->nakm-1) % 3  ) * 4 + ($this->nakp-1);
		if ((!$this->bsav1) && (!$this->bsav2)) $this->amsa = $this->G_KCAmsa[$this->amsa];
		$this->G_Amsa = $this->amsa;
		$yrsleft = $yrs - ($yrs * $this->drem);
		$this->results[] = "<strong>Amsa</strong> ".MysticConstants::$eras[$this->G_Amsa].
							"<br />years still left ".number_format($yrsleft, 2, '.',',').
							"<br />used up years ".number_format($yrs - $yrsleft, 2, '.',',')."<br />&nbsp;";
		$ik = 0;
		$sum = 0;
		$summer = array();
		for ($ik=0; $ik < count($savya); $ik++) {
			$jk = $savya[$ik] - 1;
			$sum += $this->G_KCZodPeriods[$jk];
			$summer[$ik] = $sum;
		}
		$startzod = 0;
		$yrsused = $yrs - $yrsleft;
		for ($ik=0; $ik < count($summer); $ik++) {
			if ($yrsused < $summer[$ik]) {
				$startzod = $ik;
				break;
			}
		}

		$yrsbal = $summer[$startzod] - ($yrs - $yrsleft);

		$kyears = floor($yrsbal);
		$kmonths = floor(($yrsbal - $kyears) * 12);
		$kdays = floor(((($yrsbal - $kyears) * 12) - $kmonths) * 30);
		$this->G_KCBalDasa = sprintf("%2.2d Yrs %2.2d Mos %2.2d Days",
		$kyears, $kmonths,$kdays);
		$mainm  = $this->z_month;
		$maind  = $this->z_day;
		$mainy  = $this->z_year;

		$this->results[] = sprintf("%4.2d-%2.2d-%2.2d %s",
			$mainy, $mainm, $maind, MysticConstants::$eras[$savya[$startzod]-1]);
		
		if ($startzod < count($savya)) {    // Still in the same Savya Sequence

			$maind  += $kdays;
			$mainm  += $kmonths;
			$mainy  += $kyears;
			if ($maind > 30) {
				++$mainm;
				$maind = ($maind - 30);
			}
			if ($mainm > 12) {
				++$mainy;
				$mainm = ($mainm - 12);
				if (($mainm == 2) && ($maind > 28)) {
					++$mainm;
					$maind = ($maind - 28);
				}
			}
			if ($startzod+1 < count($savya)) {
				$this->results[] = sprintf("%4.2d-%2.2d-%2.2d %s",
					$mainy, $mainm, $maind, MysticConstants::$eras[$savya[$startzod+1]-1]);
				$jk = $savya[$startzod+1] - 1;
				// echo "<br>".$G_KCZodPeriods[$jk];
				$mainy += $this->G_KCZodPeriods[$jk];
			}
		}

		// Set the remaining from savya
		for ($ik=$startzod+2; $ik < count($savya); $ik++) {
			$this->results[] = sprintf("%4.2d-%2.2d-%2.2d %s",
				$mainy, $mainm, $maind, MysticConstants::$eras[$savya[$ik]-1]);
			$jk = $savya[$ik] - 1;
			$mainy += $this->G_KCZodPeriods[$jk];
		}


		// Figure out the next savya sequence
		$newsavya = array();
		if ($this->bsav1) {
			switch ($this->nakp) {
				case 1: $newsavya = $this->savya1Pada2; break;
				case 2: $newsavya = $this->savya1Pada3; break;
				case 3: $newsavya = $this->savya1Pada4; break;
				case 4: $newsavya = $this->savya2Pada1; break;
			}
		}
		if ($this->bsav2) {
			switch ($this->nakp) {
				case 1: $newsavya = $this->savya2Pada2; break;
				case 2: $newsavya = $this->savya2Pada3; break;
				case 3: $newsavya = $this->savya2Pada4; break;
				case 4: $newsavya = $this->savya1Pada1; break;
			}
		}
		if ($this->basav1) {
			switch ($this->nakp) {
				case 1: $newsavya = $this->apasavya1Pada2; break;
				case 2: $newsavya = $this->apasavya1Pada3; break;
				case 3: $newsavya = $this->apasavya1Pada4; break;
				case 4: $newsavya = $this->apasavya2Pada1; break;
			}
		}
		if ($this->basav2) {
			switch ($this->nakp) {
				case 1: $newsavya = $this->apasavya2Pada2; break;
				case 2: $newsavya = $this->apasavya2Pada3; break;
				case 3: $newsavya = $this->apasavya2Pada4; break;
				case 4: $newsavya = $this->apasavya1Pada1; break;
			}
		}
		$this->results[] = "<strong>Next Savya Sequence...</strong><br />&nbsp;";
		for ($ik=0; $ik < count($newsavya); $ik++) {
			$this->results[] = sprintf("%4.2d-%2.2d-%2.2d %s",
				$mainy, $mainm, $maind, MysticConstants::$eras[$newsavya[$ik]-1]);
			$jk = $newsavya[$ik] - 1;
			$mainy += $this->G_KCZodPeriods[$jk];
		}
	}

}
?>