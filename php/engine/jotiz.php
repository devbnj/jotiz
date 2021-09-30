<?php
require_once "constants.php";

class Mystic {
	public $G_Tithi = "";
	public $G_Paksha = "";
	public $G_LunarDay = 0;
	public $G_LunarDate = "";
	public $G_Nakshatra = "";
	public $G_Nakshatra_No = 0;
	public $G_Nakshatra_Pada = 0;
	public $G_Nakshatra_Lord = "";
	public $G_DasaBorn = "";
	public $G_Yoga = "";
	public $G_Rashi = "";
	public $G_RashiLord = "";
	public $G_Gana = "";
	public $G_Yoni = "";
	public $G_Nadi = "";
	public $G_Rajju = "";
	public $G_Varna = "";
	public $G_Mahantarey = "";
	public $G_Lagna = "";
	public $G_LagnaLord = "";
	public $G_LagnaLordNum = 1;
	public $G_Ayanamsa = "";
	public $G_Obliquity = "";
	public $G_SiderealTime = "";
	public $G_CrudeDegrees = array(
	0 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	1 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	2 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	3 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	4 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	5 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	6 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	7 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	8 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	9 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	10 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	11 => array(0,0,0,0,0,0,0,0,0,0,0,0),
	12 => array(0,0,0,0,0,0,0,0,0,0,0,0)
	);

	// array [1..12, 1..11] of String[30];
	public $G_PlanetPos = array(
	1 => array(1=>"","","","","","","","","","","","",""),
	2 => array(1=>"","","","","","","","","","","","",""),
	3 => array(1=>"","","","","","","","","","","","",""),
	4 => array(1=>"","","","","","","","","","","","",""),
	5 => array(1=>"","","","","","","","","","","","",""),
	6 => array(1=>"","","","","","","","","","","","",""),
	7 => array(1=>"","","","","","","","","","","","",""),
	8 => array(1=>"","","","","","","","","","","","",""),
	9 => array(1=>"","","","","","","","","","","","",""),
	10 => array(1=>"","","","","","","","","","","","",""),
	11 => array(1=>"","","","","","","","","","","","",""),
	12 => array(1=>"","","","","","","","","","","","","")
	);
	// array[1..13, 1..2] of String[20];
	public $G_RashiGeneral =  array(
	1 => array(1=>"",""),
	2 => array(1=>"",""),
	3 => array(1=>"",""),
	4 => array(1=>"",""),
	5 => array(1=>"",""),
	6 => array(1=>"",""),
	7 => array(1=>"",""),
	8 => array(1=>"",""),
	9 => array(1=>"",""),
	10 => array(1=>"",""),
	11 => array(1=>"",""),
	12 => array(1=>"",""),
	13 => array(1=>"","")
	);

	public $G_Bhimsottari = array(1=>"","","","","","","","","","","","");
	// array[0..2,0..12] of double;
	public $G_chalit = array(
	0 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	1 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	2 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0)
	);
	// Placidus
	public $G_hstart = array(
            0 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
            1 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0)
    );
	public $MC = 0.00;
	// 9 x 14
	public $G_ashtak = array(
	0 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	1 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	2 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	3 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	4 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	6 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	7 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	8 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0),
	9 => array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0)
	);
	public $G_BhavaChalit =  array(
	1 => array(1=>"",""),
	2 => array(1=>"",""),
	3 => array(1=>"",""),
	4 => array(1=>"",""),
	5 => array(1=>"",""),
	6 => array(1=>"",""),
	7 => array(1=>"",""),
	8 => array(1=>"",""),
	9 => array(1=>"",""),
	10 => array(1=>"",""),
	11 => array(1=>"",""),
	12 => array(1=>"",""),
	13 => array(1=>"","")
	);
	// array [0..13,0..9] of integer;
	public $G_varga =  array(
	0 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	1 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	2 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	3 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	4 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	5 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	6 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	7 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	8 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	9 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	10 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	11 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	12 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	13 => array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),
	);

	public $G_LagnaNum = 0; //: integer;
	public $G_LagnaDeg = 0.0; //: double;
	public $G_BhimFinal = 0; // : shortint;
	public $G_HouseBhava = array("","","","","","","","","","","",""); //: array [0..11] of String[20];
	public $G_SignStart =  array(
	0 => array(0.0, 0.0, 0.0),
	1 => array(0.0, 0.0, 0.0),
	2 => array(0.0, 0.0, 0.0),
	3 => array(0.0, 0.0, 0.0),
	4 => array(0.0, 0.0, 0.0),
	5 => array(0.0, 0.0, 0.0),
	6 => array(0.0, 0.0, 0.0),
	7 => array(0.0, 0.0, 0.0),
	8 => array(0.0, 0.0, 0.0),
	9 => array(0.0, 0.0, 0.0),
	10 => array(0.0, 0.0, 0.0),
	11 => array(0.0, 0.0, 0.0)
	);
	public $G_BalDasa = ""; // : String[20];
	public $cname = ""; // : string[50];
	public $d = 0; // : longint;
	public $m = 0; // : longint;
	public $y = 0; // : longint;
	public $jul = 0; // : longint;
	public $h = 0;
	public $mt = 0; //: longint;
	public $latdeg = 0;
	public $latmt = 0;
	public $longdeg = 0;
	public $longmt = 0;
	public $ns = "";
	public $ew = "";
	public $corr = 0;

	public $maind = 0; // : LongInt;
	public $mainm = 0; // : LongInt;
	public $mainy = 0; // : LongInt;
	public $ret = 0;   // : integer;
	public $page = 0;  // : integer;
	public $line = 0;  // : integer;
	public $ashtakr3 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0); // : array [0..13] of integer;
	public $s3 = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0); // : array [0..13] of integer;

	public $plnt = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0); // : array [0..26] of double;
	public $jupc = array(0,0,0,0); // : array [0..4] of double;
	public $satc = array(0,0,0,0); // : array [0..4] of double;
	public $tt = array(0,0,0,0); // : array [0..4] of double;
	public $f2 = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0); // : array [0..12] of double;
	public $f3 = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0); // : array [0..13] of double;
	public $ps = 0.0; //: double;
	public $pt = 0.0; //: double;
	public $JulianCent = 0.0;
	public $z1 = 0.0;
	public $z2 = 0.0; //: double;
	public $s1 = 0.0; //: double;
	public $lat = 0.0; //: double;
	public $longt = 0.0; //: double;
	public $aya = 0.0; //: double;
	public $obliq = 0.0; //: double;
	public $sidtime = 0.0; //: double;
	public $h6 = 0.0; //: double;
	private $chlat = FALSE;
	
	public function setvalues(
		$z_year, $z_month, $z_day, $z_hour, $z_min,
		$z_latd, $z_latm, $z_latns,
		$z_longd, $z_longm, $z_longew, $z_tz, $z_corr) {
		$this->d      = $z_day;
		$this->m      = $z_month;
		$this->y      = $z_year;
		$this->mainm  = $z_month;
		$this->maind  = $z_day;
		$this->mainy  = $z_year;
		$this->h      = $z_hour;
		$this->mt     = $z_min;
		$this->latdeg = $z_latd;
		$this->latmt  = $z_latm;
		$this->ns     = $z_latns;
		$this->longdeg= $z_longd;
		$this->longmt = $z_longm;
		$this->ew     = $z_longew;
		$this->tzone  = $z_tz + $z_corr;
		$this->chlat = TRUE;
	}
	
	public function setvals(
		$z_year, $z_month, $z_day, $z_hour, $z_min,
		$z_lat, $z_long, $z_tz, $z_corr) {
		$this->d      = $z_day;
		$this->m      = $z_month;
		$this->y      = $z_year;
		$this->mainm  = $z_month;
		$this->maind  = $z_day;
		$this->mainy  = $z_year;
		$this->h      = $z_hour;
		$this->mt     = $z_min;
		$this->lat 	  = $z_lat;
		$this->longt  = $z_long;
		$this->tzone  = $z_tz + $z_corr;
		$this->chlat  = FALSE;
	}
	
	public function runcalc($whType=0) {
		$this->init($this->chlat);
		$this->zInitialize();
		// $this->CalcAyanamsa();

		if ($whType == 0)  $this->CalcAyanamsa();
		if ($whType == 1)  $this->FindRaman();
		if ($whType == 2)  $this->FindLahiriCorr();
		if ($whType == 3)  $this->FindKP();
		if ($whType == 4)  $this->plnt[0] = $ayanVal;
		if ($whType == 9)  $this->plnt[0] = 0;
 		
		$this->computeSun();
		$this->computeMercury();
		$this->computeVenus();
		$this->computeMars();
		$this->computeJupiter();
		$this->computeSaturn();
		$this->computeMoon();
		$this->computeUranus();
		$this->computeNeptune();
		$this->computePluto();

		$this->ret = 1;
		$this->JulianCent = $this->JulianCent + (1.0 / 24 / 36525);
		$this->computeSun();
		$this->computeMercury();
		$this->computeVenus();
		$this->computeMars();
		$this->computeJupiter();
		$this->computeSaturn();
		$this->computeMoon();
		$this->computeUranus();
		$this->computeNeptune();
		$this->computePluto();

		$jcc = $this->JulianCent - (1.0 / 24 / 36525);
		$this->JulianCent = $jcc;
		$this->doGeneral();
		$this->perturbPlanets();

		$this->FindBhavs();
		$this->CalcSaptaVarga();
		for ($m = 0; $m <= 6; $m++)
    		$this->CalcVargas($m);
		$this->FindAshtakVarga();
		$d      = $this->d;
		$m      = $this->m;
		$y      = $this->y;
		$this->FindBhimsottari($d, $m, $y);
	}

	public function __construct() {
		$z_year = 1959;
		$z_month = 11;
		$z_day = 12;
		$z_hour = 13;
		$z_min = 20;
		$z_latd = 22;
		$z_latm = 34;
		$z_latns = 'N';
		$z_longd = 88;
		$z_longm = 24;
		$z_longew = 'E';
		$z_tz = 5.5;
		$z_corr = 0;
		$z_type = 0;
		$z_aval = 0;
		$this->d      = $z_day;
		$this->m      = $z_month;
		$this->y      = $z_year;
		$this->mainm  = $z_month;
		$this->maind  = $z_day;
		$this->mainy  = $z_year;
		$this->h      = $z_hour;
		$this->mt     = $z_min;
		$this->latdeg = $z_latd;
		$this->latmt  = $z_latm;
		$this->ns     = $z_latns;
		$this->longdeg= $z_longd;
		$this->longmt = $z_longm;
		$this->ew     = $z_longew;
		$this->tzone  = $z_tz;
		$whType = 0;
	}

	public function init($changeLat=FALSE) {
		$this->ps = 0.0;
		$this->pt = 0.0;
		$this->z1 = 3.14159265359;
		$this->z2 = $this->z1 / 180.0;
		$this->s1 = 99.99826;

		for ($i = 1; $i <= 12; $i++)
			for ($j = 1; $j <= 11; $j++)
				$this->G_PlanetPos[$i][$j] = "";
		for ($i = 1; $i <= 13; $i++)
			for ($j = 1; $j <= 2; $j++)
				$this->G_RashiGeneral [$i][$j] = "";
		for ($i = 0; $i <= 13; $i++)
			for ($j = 0; $j <= 7; $j++)
				$this->G_varga[$i][$j] = -1;

		if ($changeLat) {
			$this->lat = $this->latdeg + ($this->latmt / 60.0); // {double}
			if (($this->ns == "S") || ($this->ns == "s"))
			$this->lat = -$this->lat;
			$this->longt = $this->longdeg + ($this->longmt / 60.0);
			if (($this->ew == "W") || ($this->ew == "w"))
			$this->longt = -$this->longt;
		} else {
			$this->lat = $this->lat; $this->longt = $this->longt;
		}
		
		$this->jul = $this->julianDay($this->d, $this->m, $this->y);
		$newhcorr = $this->longt / 15;
		$newhcorr = $newhcorr - $this->tzone;

		$this->tzone = - 12 - $this->tzone;
		$this->h6 = (($this->h + $this->tzone + $this->corr) + ($this->mt / 60)) / 24; // + ($newhcorr /24);
		$this->JulianCent = ($this->jul - 694025.0 + $this->h6) / 36525.0;
		$this->jul = ($this->jul+4) % 7;
	}

	public function universal ($hour, $min, $second, $offset) {
		return (1.0*($hour - $offset) + $min/60.0 + $second/3600.0);
	}

	public function julDate ($date, $month, $year, $ut) {
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
		$Mjd = $A + $B + floor(30.6001 * ($month+1)) + $date + $ut/24.0;
		return ($Mjd + 2400000.5);
	}

	public function julianDay($d, $m, $y) {
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

	public function findPlanet($pg, $ph, $pp, $pe, $pq, $pa, $pno) {
		$pm = 0.0;
		$pb = 0.0;
		$pf = 0.0;
		$pc = 0.0;
		$pd = 0.0;
		$pr = 0.0;
		$e1 = 0.0;
		$e2 = 0.0;
		$e3 = 0.0;
		$e4 = 0.0;
		$v1 = 0.0;
		$pv = 0.0;
		$pj = 0.0;
		$pk = 0.0;
		$pl = 0.0;
		$px = 0.0;
		$py = 0.0;
		$this->z1 = 3.14159265359;
		$this->z2 = $this->z1 / 180;

		//    pg - mean longitude
		//    ph - longitude of perihelion
		//    pp - longitude of ascending node
		//    pe - eccentricity
		//    pq - inclination
		//    pa - mean distance
		//    pb - mean anomaly
		//    px, py are coordinates


		$pm = $pg - $ph;  // Mean anomaly == mean long - long of perihelon
		// Convert mean anomaly into radians
		if ($pm < 0)
		$pm = $pm + 360.0;
		$pb = $pm * $this->z2;
		// first estimate of E
		$pf = $pb + $pe * sin($pb);
		// find E from keplers law
		// Use  Newtons method for approx value of root.

		do  {
			$pc = $pf - $pe * sin($pf) - $pb;
			$pd = 1 - $pe * cos($pf);
			$pf = $pf - $pc / $pd;
		} while (abs($pc/$pd) > 0.01);

		$pr = $pa * (1 - $pe * cos($pf));
		// ---- figure the acos value ---

		$e1 = atan($pe / sqrt(1 - $pe * $pe));
		$e2 = $this->z1/4 - $e1/2;
		$e3 = sin($e2) / cos($e2);
		$e4 = sin($pf / 2) / cos($pf / 2);
		$v1 = atan($e4 / $e3);
		if ($v1 < 0.0)
		$v1 = $v1 + $this->z1;
		$pv = 2 * $v1;

		$pc = $ph * $this->z2;
		$pd = $pp * $this->z2;
		$pb = $pq * $this->z2;
		$pj = $pv + $pc;
		$pk = $pj - $pd;
		$pl = 1.0 - cos($pb);
		$px = (cos($pj) + sin($pk) * sin($pd) * $pl) * $pr;
		$py = (sin($pj) - sin($pk) * cos($pd) * $pl) * $pr;

		if ($pno == 1) {
			$this->ps = $px;
			$this->pt = $py;
		}
		$pc = $this->ps + $px;
		$pd = $this->pt + $py;
		// { Geocentric Longitude -- pm }
		$pm = atan($pd/$pc) / $this->z2;
		if ($pc < 0.0)
		$pm = $pm + 180.0;
		else if ($pd < 0.0)
		$pm = $pm + 360.0;
		return $pm;
	}

	public function fractionReal($x) {
		$i = 0;
		$y = 0.0;
		// if ($x < 0) return $x - floor($x) + 1;
		return $x - (int)($x);
	}


	public function computeSun() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd = 360 * $this->fractionReal(0.71455 + 99.99826 * $this->JulianCent);
		$LongPerihelon = 258.76 + 0.323 * $this->JulianCent;
		$LongAscNode = 0.0;
		$Eccentricity = 0.016751 - 0.000042 * $this->JulianCent;
		$Inclination = 0.0;
		$MeanDist = 1.0;
		$pno = 1;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd, $LongPerihelon, $LongAscNode, $Eccentricity, $Inclination, $MeanDist, $pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
		}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd, $LongPerihelon, $LongAscNode, $Eccentricity, $Inclination, $MeanDist, $pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}


	public function computeMercury() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd  =  360 * $this->fractionReal(0.43255 + 415.20187 * $this->JulianCent);
		$LongPerihelon  =  53.44 + 0.159 * $this->JulianCent;
		$LongAscNode  =  24.69 - 0.211 * $this->JulianCent;
		$Eccentricity  =  0.205614 + 0.00002 * $this->JulianCent;
		$Inclination  =  7.00288 + 0.001861 * $this->JulianCent;
		$MeanDist  =  0.3871;
		$pno  =  2;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		if ($this->ret ==  0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd, $LongPerihelon, $LongAscNode, $Eccentricity, $Inclination, $MeanDist, $pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0]< 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
    	}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd, $LongPerihelon, $LongAscNode, $Eccentricity, $Inclination, $MeanDist, $pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}


	public function computeVenus() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd  =  360 * $this->fractionReal(0.88974 + 162.54949 * $this->JulianCent);
		$LongPerihelon  =  107.70 + 0.012 * $this->JulianCent;
		$LongAscNode  =  53.22 - 0.496 * $this->JulianCent;
		$Eccentricity  =  0.006820 - 0.000048 * $this->JulianCent;
		$Inclination  =  3.39363 + 0.001 * $this->JulianCent;
		$MeanDist  =  0.72333;
		$pno  =  3;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
    	}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
    	}
	}

	public function computeMars() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd  =  360 * $this->fractionReal(0.75358 + 53.16751 * $this->JulianCent);
		$LongPerihelon  =  311.76 + 0.445 * $this->JulianCent;
		$LongAscNode  =  26.33 - 0.625 * $this->JulianCent;
		$Eccentricity  =  0.093313 - 0.000092 * $this->JulianCent;
		$Inclination  =  1.850333 - 0.000675 * $this->JulianCent;
		$MeanDist  =  1.5237;
		$pno  =  4;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
     	   $this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
    	}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
    	}
	}

	public function computeJupiter() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd  =  360 * $this->fractionReal(0.59886 + 8.43029 * $this->JulianCent) + $this->jupc[0];
		$Eccentricity  =  0.048335 - 0.000164 * $this->JulianCent + $this->jupc[2];
		$LongPerihelon  =  350.26 + 0.214 * $this->JulianCent + $this->jupc[1] / $Eccentricity;
		$LongAscNode  =  76.98 - 0.386 * $this->JulianCent;
		$Inclination  =  1.308376 - 0.005696 * $this->JulianCent;
		$MeanDist  =  5.2026 + $this->jupc[3];
		$pno  =  5;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
		}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}

	public function computeSaturn() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd  =  360 * $this->fractionReal(0.67807 + 3.39476 * $this->JulianCent) + $this->satc[0];
		$Eccentricity  =  0.055892 - 0.000346 * $this->JulianCent + $this->satc[2];
		$LongPerihelon  =  68.64 + 0.562 * $this->JulianCent + $this->satc[1] / $Eccentricity;
		$LongAscNode  =  90.33 - 0.523 * $this->JulianCent;
		$Inclination  =  2.492520 - 0.003920 * $this->JulianCent;
		$MeanDist  =  9.5547 + $this->satc[3];
		$pno  =  6;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
		}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}

	public function computeMoon() {
		$g1 = 0.0;
		$h1 = 0.0;
		$MeanDist = 0.0;
		$b0 = 0.0;
		$c0 = 0.0;
		$MeanLongtd = 0.0;
		$Eccentricity = 0.0;
		$d0 = 0.0;
		$f0 = 0.0;
		$l0 = 0.0;
		$r0 = 0;
		$d3 = 0;
		$d4 = 0;
		$d5 = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$g1  =  360 * $this->fractionReal(0.71455 + 99.99826 * $this->JulianCent);
		$h1  =  258.76 + 0.323 * $this->JulianCent;
		$MeanDist  =  360 * $this->fractionReal(0.68882 + 1336.851353 * $this->JulianCent);
		$b0  =  360 * $this->fractionReal(0.8663 + 11.298994 * $this->JulianCent - 3.0e-5 * $this->JulianCent * $this->JulianCent);
		$c0  =  360 * $this->fractionReal(0.65756 - 5.376495 * $this->JulianCent);
		if ($c0 < 0.0)
		$c0 = $c0 + 360.0;
		$MeanLongtd  =  $this->z2 * ($MeanDist-$b0);
		$Eccentricity  =  $this->z2 * ($g1-$h1);
		$d0  =  $this->z2 * ($MeanDist-$g1);
		$f0  =  $this->z2 * ($MeanDist-$c0);
		$l0  =  $MeanDist + 6.2888*sin($MeanLongtd)
		+ 0.2136*sin(2*$MeanLongtd) + 0.01*sin(3*$MeanLongtd)
		+ 1.274*sin(2*$d0-$MeanLongtd) + 0.0085*sin(4*$d0-2*$MeanLongtd);
		$l0  =  $l0 - 0.0347*sin($d0) + 0.6583*sin(2*$d0) + 0.0039*sin(4*$d0)
		- 0.1856*sin($Eccentricity) - 0.0021*sin(2*$Eccentricity)
		+ 0.0052*sin($MeanLongtd-$d0);
		$l0  =  $l0 - 0.0588*sin(2*$MeanLongtd-2*$d0)
		+ 0.0572*sin(2*$d0-$MeanLongtd-$Eccentricity)
		+ 0.0533*sin($MeanLongtd+2*$d0)
		+ 0.0458*sin(2*$d0-$Eccentricity)
		+ 0.041*sin($MeanLongtd-$Eccentricity)
		- 0.0305*sin($MeanLongtd+$Eccentricity);
		$l0  =  $l0 - 0.0237*sin(2*$f0-$MeanLongtd) - 0.0153*sin(2*$f0-2*$d0)
		+ 0.0107*sin(4*$d0-$MeanLongtd)
		- 0.0079*sin(-$MeanLongtd+$Eccentricity+2*$d0)
		- 0.0068*sin($Eccentricity+2*$d0)
		+ 0.005*sin($Eccentricity+$d0);
		$l0  =  $l0 - 0.0023*sin($MeanLongtd+$d0) + 0.004*sin(2*$MeanLongtd+2*$d0)
		+ 0.004*sin($MeanLongtd-$Eccentricity+2*$d0)
		- 0.0037*sin(3*$MeanLongtd-2*$d0)
		- 0.0026*sin($MeanLongtd-2*$d0+2*$f0)
		+ 0.0027*sin(2*$MeanLongtd-$Eccentricity);
		$l0  =  $l0 - 0.0024*sin(2*$MeanLongtd+$Eccentricity-2*$d0)
		+ 0.0022*sin(2*$d0-2*$Eccentricity)
		- 0.0021*sin(2*$MeanLongtd+$Eccentricity)
		+ 0.0021*sin($c0*$this->z2)
		+ 0.0021*sin(2*$d0-$MeanLongtd-2*$Eccentricity);
		$l0  =  $l0 - 0.0018*sin($MeanLongtd+2*$d0-2*$f0)
		+ 0.0012*sin(4*$d0-$MeanLongtd-$Eccentricity)
		- 0.0008*sin(3*$d0-$MeanLongtd);
		$r0  =  $this->z2*2*($l0-$c0);
		$d3  =  $l0 - 0.1143 * sin($r0) + 0.004;
		// Moon position
		if ($d3 >=  360.0)
		$d3 =  $d3 - 360.0;
		if ($d3 < 0.0)
		$d3 =  $d3 + 360.0;
		if ($this->ret == 0) {
			$this->plnt[7] = $d3;
        	$this->plnt[7] = ($this->plnt[7] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[7] + $tmp0 - $this->plnt[0] : ($this->plnt[7] + $tmp0 - $this->plnt[0]) - 360; 
		} else {
			$this->plnt[20] = $d3;
        	$this->plnt[20] = ($this->plnt[20] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[20] + $tmp0 - $this->plnt[0] : ($this->plnt[20] + $tmp0 - $this->plnt[0]) - 360; 
		}
		// Rahu Calculation
		$d4 = $c0;
		if ($this->ret == 0) {
			$this->plnt[8] = $d4;
        	$this->plnt[8] = ($this->plnt[8] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[8] + $tmp0 - $this->plnt[0] : ($this->plnt[8] + $tmp0 - $this->plnt[0]) - 360; 
		} else {
			$this->plnt[21] = $d4;
        	$this->plnt[21] = ($this->plnt[21] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[21] + $tmp0 - $this->plnt[0] : ($this->plnt[21] + $tmp0 - $this->plnt[0]) - 360; 
		}
		// Ketu calculation
		$d5 = $c0 + 180.0;
		if ($d5 >= 360.0)
		$d5 = $d5 - 360.0;
		if ($this->ret == 0) {
			$this->plnt[9] = $d5;
        	$this->plnt[9] = ($this->plnt[9] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[9] + $tmp0 - $this->plnt[0] : ($this->plnt[9] + $tmp0 - $this->plnt[0]) - 360; 
		}
		else {
			$this->plnt[22] = $d5;
        	$this->plnt[22] = ($this->plnt[22] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[22] + $tmp0 - $this->plnt[0] : ($this->plnt[22] + $tmp0 - $this->plnt[0]) - 360; 
		}
	}

	public function computeUranus() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd = 360 * $this->fractionReal(0.61372 + 1.19019 * $this->JulianCent);
		$MeanLongtd = $MeanLongtd - 0.166 * sin( ($MeanLongtd+50.0+$this->plnt[0])*$this->z2);
		$LongPerihelon = 149.09 + 0.088 * $this->JulianCent;
		$LongAscNode = 51.02 - 0.897 * $this->JulianCent;
		$Eccentricity = 0.046344 - 0.000027 * $this->JulianCent;
		$Inclination = 0.772464 + 0.000625 * $this->JulianCent;
		$MeanDist = 19.218;
		$pno = 10;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
		}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}

	public function computeNeptune() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd = 360 * $this->fractionReal(0.17361 + 0.60692 * $this->JulianCent);
		$MeanLongtd = $MeanLongtd + (0.1 - 0.1 *
		sin( ($MeanLongtd/2 - 90.0 + $this->plnt[0])*$this->z2) +
		0.166 * sin($this->JulianCent - 1.0));
		$LongPerihelon = 24.27 + 0.028 * $this->JulianCent;
		$LongAscNode = 108.22 - 0.297 * $this->JulianCent;
		$Eccentricity = 0.009 + 0.000006 * $this->JulianCent;
		$Inclination = 1.779242 - 0.009544 * $this->JulianCent;
		$MeanDist = 30.11;
		$pno = 11;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
		}
		else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}

	public function computePluto() {
		$MeanLongtd = 0.0;
		$LongPerihelon = 0.0;
		$LongAscNode = 0.0;
		$Eccentricity = 0.0;
		$Inclination = 0.0;
		$MeanDist = 0.0;
		$pno = 0;
    	$tmp0 = 22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
		
		$MeanLongtd = 360 * $this->fractionReal(0.19434 + 0.40254 * $this->JulianCent);
		$MeanLongtd = $MeanLongtd - (0.1 * sin( ($MeanLongtd + $this->plnt[0])*$this->z2));
		$LongPerihelon = 200.02 + 0.002 * $this->JulianCent;
		$LongAscNode = 86.49 - 0.038 * $this->JulianCent;
		$Eccentricity = 0.248644;
		$Inclination = 17.146778 - 0.005531 * $this->JulianCent;
		$MeanDist = 39.52;
		$pno = 12;
		if ($this->ret == 0) {
			$this->plnt[$pno] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno] = ($this->plnt[$pno] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno] + $tmp0 - $this->plnt[0]; 
		} else {
			$this->plnt[$pno+13] = $this->findPlanet($MeanLongtd,$LongPerihelon,$LongAscNode,$Eccentricity,$Inclination,$MeanDist,$pno);
        	$this->plnt[$pno+13] = ($this->plnt[$pno+13] + $tmp0 - $this->plnt[0] < 360) ? $this->plnt[$pno+13] + $tmp0 - $this->plnt[0] : -360 + $this->plnt[$pno+13] + $tmp0 - $this->plnt[0];
		}
	}

	public function zInitialize() {
		$v0=0;
		$LongAscNode=0.0;
		$Inclination=0.0;
		$s0=0.0;
		$v1=0.0;
		$c0=0.0;
		$z0=0.0;
		$v2=0.0;
		$v3=0.0;
		$v4=0.0;
		$v5=0.0;
		$y1=0.0;
		$y2=0.0;
		$y3=0.0;
		$y4=0.0;
		$y5=0.0;
		$y6=0.0;
		$q1=0.0;
		$q2=0.0;
		$q3=0.0;
		$q4=0.0;
		$q5=0.0;
		$q6=0.0;
		$w2=0.0;
		$r1=0.0;
		$r2=0.0;
		$r3=0.0;
		$r4=0.0;
		$s1=0.0;
		$s2=0.0;
		$s3=0.0;
		$s4=0.0;

		$v0 = $this->JulianCent/5 + 0.1;
		$LongAscNode = 2*$this->z1*$this->fractionReal(0.65965 + 8.43029 * $this->JulianCent);
		$Inclination = 2*$this->z1*$this->fractionReal(0.73866 + 3.39476 * $this->JulianCent);
		$s0 = 2*$this->z1*$this->fractionReal(0.67644 + 1.19019 * $this->JulianCent);
		$v1 = 5*$Inclination - 2*$LongAscNode;
		$c0 = $s0 - $Inclination;
		$z0 = $Inclination - $LongAscNode;
		$v2 = sin($v1);
		$v3 = sin(2*$v1);
		$v4 = cos($v1);
		$v5 = cos(2*$v1);
		$y1 = sin($z0);
		$y2 = sin(2*$z0);
		$y3 = sin(3*$z0);
		$y4 = cos($z0);
		$y5 = cos(2*$z0);
		$y6 = cos(3*$z0);
		$q1 = sin($Inclination);
		$q2 = sin(2*$Inclination);
		$q3 = sin(3*$Inclination);
		$q4 = cos($Inclination);
		$q5 = cos(2*$Inclination);
		$q6 = cos(3*$Inclination);
		$w2 = sin(3*$c0);
		$r1 = (0.331 - 0.01*$v0)*$v2 - 0.064*$v0*$v4 + 0.014*$y1;
		$r1 = $r1 + 0.018*$y2 - 0.034*$y4*$q1 - 0.036*$y1*$q4;
		$r2 = 0.007*$v2 - 0.02*$v4 + $q1*(0.007*$y1 + 0.034*$y4 + 0.006*$y5);
		$r2 = $r2 + $q4*(0.038*$y1 + 0.006*$y2 - 0.007*$y4);
		$r2 = $r2 + $q2*(-0.005*$y1 + 0.004*$y4) + $q5*(0.004*$y1 + 0.006*$y4);
		$r3 = 3606*$v2 + (1289 - 580 *$v0)*$v4 + $q1*(-6764*$y1 - 1110*$y2 - 204 + 1284*$y4);
		$r3 = $r3 + $q4*(1460*$y1 - 817 + 6074*$y4 + 992*$y5 + 508*$y6);
		$r3 = $r3 + $q2*(-956*$y1 - 997*$y4 + 480*$y5);
		$r3 = $r3 + $q5*(-956*$y1 + 490*$y2 + 179 + 1024*$y4 - 437*$y5);
		$r3 = $r3 * 1e-7;
		$r4 = -263*$v4 + 205*$y4 + 693*$y5 + 312*$y6;
		$r4 = $r4 + $q1*(299*$y1 + 181*$y5) + $q4*(204*$y2 + 111*$y3 - 337*$y4 - 111*$y5);
		$r4 = $r4 * 1e-6;
		$s1 = (-0.814 + 0.018*$v0 - 0.017*$v0*$v0)*$v2;
		$s1 = $s1 + (-0.01 + 0.161*$v0)*$v4 - 0.149*$y1 - 0.041*$y2 - 0.015*$y3;
		$s1 = $s1 + $q1*(-0.006 - 0.017*$y2 + 0.081*$y4 + 0.015*$y5);
		$s1 = $s1 + $q4*(0.086*$y1 + 0.025*$y4 + 0.014*$y5 + 0.006*$y6);
		$s2 = (0.077 + 0.007*$v0)*$v2 + (0.046 - 0.015*$v0)*$v4 - 0.007*$y1;
		$s2 = $s2 - $q1*(0.076*$y1 + 0.025*$y2 + 0.009*$y3);
		$s2 = $s2 + $q4*(-0.073 - 0.15*$y4 + 0.027*$y5 + 0.01*$y6);
		$s2 = $s2 + $q6*(-0.014*$y1 - 0.008*$y4 + 0.014*$y5);
		$s2 = $s2 + $q5*(-0.014*$y1 + 0.012*$y2 + 0.015*$y4 - 0.013*$y5);
		$s3 = (-7927 + 2548*$v0)*$v2 + (13381 + 1226*$v0)*$v4;
		$s3 = $s3 + 248*$v3 - 305*$v5 + 412*$y2;
		$s3 = $s3 + $q1*(12415 + (390 - 617*$v0)*$y1 + 26599*$y4 - 4687*$y5 - 1870*$y6 - 821*cos(4*$z0));
		$s3 = $s3 + $q4*(163 - 611*$v0 - 12696*$y1 - 4200*$y2 - 1503*$y3 - 619*sin(4*$z0) - (282 + 1306*$v0)*$y4);
		$s3 = $s3 + $q2*(-350 + 2211*$y1 - 2208*$y2 - 568*$y3 - 2780*$y4 + 2022*$y5);
		$s3 = $s3 + $q5*(-490 - 2842*$y1 - 1594*$y4 + 2162*$y5 + 561*$y6 + 469*$w2);
		$s3 = $s3 * 1e-7;
		$s4 = 572*$v2 + 2933*$v4 + 33629*$y4 - 3081*$y5 - 1423*$y6 - 671*cos(4*$z0);
		$s4 = $s4 + $q1*(1098 - 2812*$y1 + 688*$y2 - 393*$y3 + 2138*$y4 - 995*$y5 - 642*$y6);
		$s4 = $s4 + $q4*(-890 + 2206*$y1 - 1590*$y2 -647*$y3 + 2285*$y4 + 2172*$y5 + 296*$y6);
		$s4 = $s4 + $q2*(-267*$y2 - 778*$y4 + 495*$y5 + 250*$y6);
		$s4 = $s4 + $q5*(-856*$y1 + 441*$y2 + 296*$y5 + 211*$y6);
		$s4 = $s4 + $q3*(-427*$y1 + 398*$y3) + $q6*(344*$y4 - 427*$y6);
		$s4 = $s4 * 1e-6;
		$this->jupc[0] = $r1;
		$this->jupc[1] = $r2;
		$this->jupc[2] = $r3;
		$this->jupc[3] = $r4;
		$this->satc[0] = $s1;
		$this->satc[1] = $s2;
		$this->satc[2] = $s3;
		$this->satc[3] = $s4;
	}

	public function FindSpecialBhavs($sidtm, $c10) {
		$r0 = 0.0;
		$w0 = 0.0;
		$b0 = 0.0;
		$MeanLongtd = 0.0;

		$r0 = $this->aya;
		$w0 = $this->obliq * $this->z2;
		$b0 = $sidtm * 15.0 + 90.0;
		if ($b0 >= 360.0)
		$b0 = $b0 - 360.0;
		$sidtm = $sidtm * $this->z1 / 12.0;
		$c10 = $c10 * $this->z2;
		if (($sidtm == 0.0) && ($c10 == 0.0)) {
			return 90.0;
		}
		$MeanLongtd = atan(-cos($sidtm)/(sin($c10) * sin($w0)/cos($c10) + sin($sidtm)*cos($w0)));
		$MeanLongtd = $MeanLongtd / $this->z2;
		if ($MeanLongtd < 0.00)
			$MeanLongtd = $MeanLongtd + 180.0;
		if ($b0 - $MeanLongtd > 75.0)
			$MeanLongtd = $MeanLongtd + 180.0;
		$MeanLongtd = $MeanLongtd - $r0;
		if ($MeanLongtd < 0.0)
			$MeanLongtd = $MeanLongtd + 360.0;
		if ($MeanLongtd > 360.0)
			$MeanLongtd = $MeanLongtd - 360.0;
		return $MeanLongtd;
	}

	public function findGeneralBhavs($j0, $k0, $u) {
		$l = 0;
		$v = 0;
		$m0 = 0.0;

		for ($l = 0; $l <=2; $l++) {
			$m0 = $j0 + $k0 * $l;
			if ($m0 >= 360.0)
			$m0 = $m0 - 360.0;
			$v = $u + $l - 1;
			$this->f2[$v] = $m0;
		}
	}


	public function FindBhavs() {
		$MeanDist=0.0;
		$b0=0.0;
		$c0=0.0;
		$d0=0.0;
		$i=0;
		$a1=0;
		$a2=0;
		$a3=0;
		$degrees=0.0;
		$mins=0.0;
		$secs=0.0;
		$degree2=0.0;
		$min2=0.0;
		$sec2=0.0;
		$degree3=0.0;
		$min3=0.0;
		$sec3=0.0;
		$bStart=0.0;
		$bMid=0.0;
		$bEnd=0.0;

		$this->aya = $this->plnt[0];
		$this->obliq = 23.452294 - 0.0130125 * $this->JulianCent;
		$MeanDist = 24 * $this->fractionReal(0.2769 + 100.00214 * $this->JulianCent);
		$b0 = $this->h6 * 24.0 + 12.0;
		$c0 = $this->longt / 15.0;
		$this->sidtime = 24 * $this->fractionReal( ($MeanDist+$b0+$c0) / 24.0 );
		if ($this->sidtime < 0)
			$this->sidtime = $this->sidtime + 24.0;
		$MeanDist = $this->FindSpecialBhavs( $this->sidtime, $this->lat );
		$b0 = $this->FindSpecialBhavs( $this->sidtime - 6.0, 0.0);
		$c0 = (180.0 + $b0 - $MeanDist) / 3.0;
		if ($b0 > $MeanDist)
			$c0 = $c0 - 120.0;
		$d0 = 60.0 - $c0;

		$this->findGeneralBhavs( $MeanDist, $c0, 1 );
		$this->findGeneralBhavs( $b0+180.0, $d0, 4 );
		$this->findGeneralBhavs( $MeanDist+180.0, $c0, 7 );
		$this->findGeneralBhavs( $b0, $d0, 10 );

		$this->f3[0] = ($this->f2[11]+$this->f2[0]) / 2.0;
    	$this->MC = $this->f3[0];
		if ($this->f2[0] < $this->f2[11])  $this->f3[0] = $this->f3[0] + 180.0;
		if ($this->f3[0] >= 360.0)  $this->f3[0] = $this->f3[0] - 360.0;

		for ($i = 1; $i <= 11; $i++)  {
			$this->f3[$i] = ($this->f2[$i-1]+$this->f2[$i]) / 2.0;
			if ($this->f2[$i] < $this->f2[$i-1])
				$this->f3[$i] = $this->f3[$i] + 180.0;
			if ($this->f3[$i] > 360.0)
				$this->f3[$i] = $this->f3[$i] - 360.0;
		}

		// { Other details 01 }
		$degrees = $this->plnt[0];
		$mins = ($degrees - (int)($degrees)) * 60;
		$secs = ($mins - (int)($mins)) * 60;
		$this->G_Ayanamsa = sprintf("%2.2d %2.2d %2.2d",
		floor($degrees), floor($mins), floor($secs));
		$degrees = $this->obliq;
		$mins = ($degrees - (int)($degrees)) * 60;
		$secs = ($mins - (int)($mins)) * 60;
		$this->G_Obliquity = sprintf("%2.2d %2.2d %2.2d",
		floor($degrees),floor($mins),floor($secs));
		$this->G_SiderealTime = sprintf("%7.2f", $this->sidtime);

		// { bhava chalit }
		for ($i = 0; $i <= 12; $i++) {
			for ($j = 0; $j <= 11; $j++) {
				$bStart = $this->f3[$j];
				$bMid = $this->f2[$j];
				if ($j == 11) $bEnd = $this->f2[0];
				else $bEnd = $this->f2[$j+1];
				$a1 = floor(($this->f3[$j] / 30)+1);
				$a2 = floor(($this->f2[$j] / 30)+1);
				$a3 = floor(($this->f3[$j+1] / 30)+1);
				$degrees = $this->f2[$j] - (($a2-1)*30);
				$mins = ($degrees - (int)($degrees)) * 60;
				$secs = ($mins - (int)($mins)) * 60;
				$this->G_SignStart[$j][0] = $bStart;
				$this->G_SignStart[$j][1] = $bMid;
				$this->G_SignStart[$j][2] = $bEnd;
				$this->G_HouseBhava[$j] = sprintf("%2.2d&deg; %2.2d' %2.2d\" %2.2s",
					floor($degrees), floor($mins), floor($secs), MysticConstants::$eras[$a2-1]);
              	$this->G_hstart[0][$j] = $this->f2[$j];
              	$this->G_hstart[1][$j] = $bEnd;      
					
				if (($this->G_chalit[1][$i] >= $bMid) && ($this->G_chalit[1][$i] < $bEnd)) {
					$this->G_chalit[2][$i] = $a2;
					$this->G_BhavaChalit[$i+1][1] = MysticConstants::$graha[floor($this->G_chalit[0][$i])];
					$this->G_BhavaChalit[$i+1][2] = sprintf("%7d", $a2);
				}
				if (($this->G_chalit[1][$i] < $bEnd) && ($bMid > $bEnd)) {
					$this->G_chalit[2][$i] = $a2;
					$this->G_BhavaChalit[$i+1][1] = MysticConstants::$graha[floor($this->G_chalit[0][$i])];
					$this->G_BhavaChalit[$i+1][2] = sprintf("%7d", $a2);
				}
				if (($this->G_chalit[1][$i] >= $bMid) && ($bMid > $bEnd)) {
					$this->G_chalit[2][$i] = $a2;
					$this->G_BhavaChalit[$i+1][1] = MysticConstants::$graha[floor($this->G_chalit[0][$i])];
					$this->G_BhavaChalit[$i+1][2] = sprintf("%7d", $a2);
				}

			}
		}
		// Bhavs
		// var_dump($G_BhavaChalit);
	}

	public function FindBhimsottari( $zday, $zmonth, $zyear, $moondasa=true ) {
		$d0 = 0.0;
		$n0 = 0.0;
		$LongAscNode = 0.0;  // this variable got messed up
		$Eccentricity = 0.0;
		$BalDasa = 0.0;
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

		if ($moondasa)
			$d0 = $this->plnt[7]; // Moon position (Nakshatra)
		else
			$d0 = $this->G_LagnaDeg; // Ascendant Pos
		$d0 = 9.0 * $this->fractionReal($d0/120);
		$n0 = $this->fractionReal($d0);
		$qzz = floor($d0);
		$BalDasa = ((1-$n0) * MysticConstants::$vimfactors[$qzz])*365 - floor((1-$n0)*MysticConstants::$vimfactors[$qzz])*365;
		$this->G_BalDasa = sprintf("%2.2d Yrs %2.2d Mos %2.2d Days",
		floor((1-$n0) * MysticConstants::$vimfactors[$qzz]),
		floor($BalDasa / 30),
		floor($BalDasa) % 30);
		$LongAscNode = $n0 * MysticConstants::$vimfactors[$qzz];
		$pday = $pyear + $pmonth/12 + $pday/360;
		$Eccentricity = $pday + 75.0;
		$pmonth = $pday - $LongAscNode;

		$c = $qzz;
		do {
			if ($c > 8)
			$c = $c - 9;
			for ($d = 0; $d <= 8; $d++) {
				$n = $c + $d;
				if ($n > 8)
				$n = $n - 9;
				for ($e = 0; $e <= 8; $e++) {
					$g = $n + $e;
					if ($g > 8)
					$g = $g - 9;
					$pmonth += (MysticConstants::$vimfactors[$c] * MysticConstants::$vimfactors[$n] * MysticConstants::$vimfactors[$g]) / 14400;
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
					if ($ast < 12) {
						if ((MysticConstants::$vimplanets[$c] != $day4mp) && ( $c != $qzz + 8 )) {
							$day4mp = MysticConstants::$vimplanets[$c];
							$this->G_Bhimsottari[$ast] = sprintf("%s %s %2.2d/%-2.2d/%4.2d",
							MysticConstants::$vimplanets[$c], MysticConstants::$vimplanets[$n], $month1, $day3, $year1);
							++$ast;
						}
					}
					$day3 = $day4;
					$month1 = $month2;
					$year1 = $year2;

				}
			}
			$f = $c + 1;
			if ($f > 8)
			$f = $f - 9;
			if ($pmonth > $Eccentricity)
			break;
			++$this->line;
			++$c;
		} while ($c != $qzz+8);
		$this->G_BhimFinal = $ast - 1;
	}


	public function computeVargas($y1, $x0, $t) {
		$q = 0;
		$z = 0;
		$jvarga = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$m = 0;
		$r = 0;
		$i = 0;
		$r0 = 0.0;
		$ARIES = 0;
		$TAURUS = 1;
		$GEMINI = 2;
		$CANCER = 3;
		$LEO = 4;
		$VIRGO = 5;
		$LIBRA = 6;
		$SCORPIO = 7;
		$SAGITTARIUS = 8;
		$CAPRICORNUS = 9;
		$AQUARIUS = 10;
		$PISCES = 11;

		$q = floor($x0 / 30);
		$z = $q + 1;
		$jvarga[1] = $z - 12 * intval($z / 12);     // D1

		$r0 = 30 * $this->fractionReal($x0 / 30);
		if (($r0 >= 0) && ($r0 < 10)) $m = 1;
		else if (($r0 >= 10) && ($r0 < 20)) $m = 5;
		else $m = 9;
		$z = $q + $m;
		$jvarga[2] = $z - 12 * intval($z/12);     // D3

		$z = floor(($x0 * 7.0/30) + 1);
		$jvarga[3] = $z - 12 * intval($z/12);    // D7

		$z = floor((double)($x0 * 9.0 / 30) + 1);
		$jvarga[4] = $z - 12 * intval($z/12);    // D9

		$r = floor(10 * $this->fractionReal($x0 / 30));
		if ($q % 2 == 0) $m = 1;
		else $m = 9;
		$z = $q + $r + $m;
		$jvarga[5] = $z - 12 * intval($z/12);    // D10

		$r = floor(12 * $this->fractionReal($x0 / 30));
		$z = $q + $r + 1;
		$jvarga[6] = $z - 12 * intval($z/12);    // D12

		$z = floor($x0 * 16.0 / 30 + 1);
		$jvarga[7] = $z - 12 * intval($z/12);    // D16

		$z = floor($x0 * 6.0 / 30 + 1);
		$jvarga[8] = $z - 12 * intval($z/12);    // D6

		$z = floor($x0 * 8.0 / 30 + 1);
		$jvarga[9] = $z - 12 * intval($z/12);    // D8

		$r = (floor( $this->getRasiLength( $x0 ) / 7.5 )  * 90 + $this->getRasi( $x0 ) * 30 + $this->getRasiLength( 4 * $x0 ));
		$z = floor($r/30+1);
		$jvarga[10] = $z - 12 * intval($z/12);    // D4

		$z = floor($x0 * 20.0 / 30 + 1);
		$jvarga[11] = $z - 12 * intval($z/12);    // D20

		$r = floor($x0 * 24.0 / 30 + 1);
		if ($q % 2 == 0) $m = 4;
		else $m = 3;
		$z = $r + $m;
		$jvarga[12] = $z - 12 * intval($z/12);    // D24

		$z = floor($x0 * 27.0 / 30 + 1);
		$jvarga[13] = $z - 12 * intval($z/12);    // D27

		$basepos = $this->getRasiLength( $x0 ) * 40;
		if ( $this->isOddRasi( $x0 ) == 1 ) $this->ret = $basepos;
		else $this->ret = $basepos + 180;
		$z = floor($this->ret / 30 + 1);
		$jvarga[14] = $z - 12 * intval($z/12);    // D40

		$basepos = $this->getRasiLength( $x0 ) * 45;
		if ( $this->inMovableSign( $x0 )) $this->ret = $basepos;
		else if ( $this->inFixedSign( $x0 )) $this->ret = $basepos + 120;
		else $this->ret = $basepos + 240;
		$z = floor($this->ret / 30 + 1);
		$jvarga[15] = $z - 12 * intval($z/12);    // D45

		$rs = $this->getRasiLength( $x0 );
		if ( $this->isOddRasi( $x0 ) == 1 ) {
			// Ar, Aq, Sa, Ge, Li
			if ( $rs < 5 )
			$this->ret = 30 * $ARIES + $rs*6;
			else if (( $rs >=  5 ) && ( $rs <= 10 ))
			$this->ret = 30 * $AQUARIUS + ($rs - 5)*6;
			else if (( $rs >= 10 ) && ( $rs <= 18 ))
			$this->ret = 30 * $SAGITTARIUS + ($rs - 10)/4 * 15;
			else if (( $rs >=  18 ) && ( $rs <= 25 ))
			$this->ret = 30 * $GEMINI + ( $rs - 18 )/7 * 30;
			else if ( $rs > 25 )
			$this->ret = 30 * $LIBRA + ($rs - 25)*6;
		}
		else {
			// Ta, Vi, Pi, Cp, Sc
			if ( $rs < 5 ) $this->ret = 30 * $TAURUS + (5-$rs)*6;
			else if (( $rs >=  5 ) && ( $rs <= 10 )) $this->ret = 30 * $VIRGO + (10-$rs)*6;
			else if (( $rs >= 10 ) && ( $rs <= 18 )) $this->ret = 30 * $PISCES + ( 18-$rs)/4 * 15;
			else if (( $rs >= 18 ) && ( $rs <= 25 )) $this->ret = 30 * $CAPRICORNUS + (25-$rs)/7 * 30;
			else if ( $rs > 25 ) $this->ret = 30 * $SCORPIO + ( 30 - $rs)*6;
		}
		$z = floor($this->ret / 30 + 1);
		$jvarga[16] = $z - 12 * intval($z/12);    // D30

		// $this->ret = 60 * $this->getRasiLength( $x0 ) + getRasi( $x0 ) * 30;
		$this->ret = floor(60 * $this->fractionReal($x0 / 30));
		$z = $q + $this->ret;
		$jvarga[17] = $z - 12 * intval($z/12);    // D60

		for ($i=1; $i <= 17; $i++) {
			if ($jvarga[$i] == 0)  $jvarga[$i] = 12;
		}

		for ($i = 1; $i <= 17; $i++) {
			$this->G_varga[$t][$i-1] = $jvarga[$i];
		}
	}

	public function getRasiLength($len /*, $reverse*/ ) {
		return (double)( $this->a_red( $len, 30 ));
	}

	public function isOddRasi( $len ) {
		return (int) ( $this->getRasi( $len + 30 ) % 2 );
	}

	public function a_red( $x, $a ) {
		return (double)( $x - floor( $x / $a ) * $a );
	}

	public function getRasi( $len ) {
		return( (int)( $this->red_deg( $len ) / 30 )  );
	}

	public function red_deg( $input ) {
		return (double)$this->a_red($input, 360);
	}

	public function inMovableSign( $len ) {
		return (int)($this->getRasi( $len ) % 3 ) == 0;
	}

	public function inFixedSign( $len ) {
		return (int)($this->getRasi( $len ) % 3 ) == 1;
	}

	public function degreeDifference($degree1, $degree2) {
		$diff = 0.0;
		// $diff = $degree2 - $degree1;
		if ($degree2 >= $degree1) {
		    $diff = $degree2 - $degree1;
		    if ($diff > 180)  $diff = 360 + $degree1 - $degree2;
		} else {
		    $diff = $degree1 - $degree2;
		    if ($diff > 180)  $diff = 360 + $degree2 - $degree1;
		}
		return $diff;
	}

	public function CalcSaptaVarga() {
		// Saptavargas Table in Rasi
		$this->G_LagnaDeg = $this->f2[0];
		$this->computeVargas("Lagna  ", (double)$this->f2[0],  0);
		$this->computeVargas("Sun    ", $this->plnt[ 1], 1);
		$this->computeVargas("Mercury", $this->plnt[ 2], 2);
		$this->computeVargas("Venus  ", $this->plnt[ 3], 3);
		$this->computeVargas("Mars   ", $this->plnt[ 4], 4);
		$this->computeVargas("Jupiter", $this->plnt[ 5], 5);
		$this->computeVargas("Saturn ", $this->plnt[ 6], 6);
		$this->computeVargas("Moon   ", $this->plnt[ 7], 7);
		$this->computeVargas("Rahu   ", $this->plnt[ 8], 8);
		$this->computeVargas("Ketu   ", $this->plnt[ 9], 9);
		$this->computeVargas("Uranus ", $this->plnt[10],10);
		$this->computeVargas("Neptune", $this->plnt[11],11);
		$this->computeVargas("Pluto  ", $this->plnt[12],12);

		$this->G_CrudeDegrees[0][0] = (double)$this->f2[0]; // Ascendant
		for ($i = 1; $i <= 12; $i++)
			$this->G_CrudeDegrees[$i][0] = $this->plnt[$i];

		for ($i = 0; $i <= 12; $i++) {
			for ($j = 1; $j <= 12; $j++) {
				$this->G_CrudeDegrees[$i][$j] = $this->degreeDifference($this->G_CrudeDegrees[$i][0], $this->G_CrudeDegrees[$j][0]);
			}
		}

		// var_dump($G_CrudeDegrees);
	}

	// Ashtak Vargas

	public function ashtakCompute( $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $n ) {
		$p = 0;
		$q = 0;
		$k2 = array();

		$k2[ 1] = $a;
		$k2[ 2] = $b;
		$k2[ 3] = $c;
		$k2[ 4] = $d;
		$k2[ 5] = $e;
		$k2[ 6] = $f;
		$k2[ 7] = $g;
		$k2[ 8] = $h;
		$k2[ 9] = $i;
		$k2[10] = $j;
		$k2[11] = $k;
		$k2[12] = $l;
		for ($q = 1; $q <= 12; $q++) {
			$p = $n + $q - 1;
			if ($p > 12)
			$p = $p - 12;
			$this->ashtakr3[$p] = $this->ashtakr3[$p] + $k2[$q];
		}
	}

	public function ashtakPrint($x1) {
		$i = 0;
		static $staticrj = 0;
		for ($i = 1; $i <= 12; $i++)
		$this->G_ashtak[$i-1][$staticrj] = $this->ashtakr3[$i];
		++$staticrj;
	}

	public function ashtakAccumulate() {
		$q = 0;
		for ($q = 1; $q <= 12; $q++) {
			$this->s3[$q] = $this->s3[$q] + $this->ashtakr3[$q];
			$this->ashtakr3[$q] = 0;
		}
	}

	public function FindAshtakVarga() {
		$csun = 0;
		$dmoon = 0;
		$emars = 0;
		$fmercury = 0;
		$gjupiter = 0;
		$hvenus = 0;
		$isaturn = 0;
		$jlagna = 0;
		$k = 0;
		$q = 0;

		$csun = floor($this->plnt[1]/30 + 1);
		$dmoon = floor($this->plnt[7]/30 + 1);
		$emars = floor($this->plnt[4]/30 + 1);
		$fmercury = floor($this->plnt[2]/30 + 1);
		$gjupiter = floor($this->plnt[5]/30 + 1);
		$hvenus = floor($this->plnt[3]/30 + 1);
		$isaturn = floor($this->plnt[6]/30 + 1);
		$jlagna = floor($this->f2[0]/30 + 1);
		for ($q = 1; $q <= 12; $q++)
		$this->s3[$q] = 0;

		$this->ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,$csun);
		$this->ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,0,$dmoon);
		$this->ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,$emars);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,1,1,1,1,$fmercury);
		$this->ashtakCompute(0,0,0,0,1,1,0,0,1,0,1,0,$gjupiter);
		$this->ashtakCompute(0,0,0,0,0,1,1,0,0,0,0,1,$hvenus);
		$this->ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,$isaturn);
		$this->ashtakCompute(0,0,1,1,0,1,0,0,0,1,1,1,$jlagna);
		$this->ashtakPrint("Sun    ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(0,0,1,0,0,1,1,1,0,1,1,0,$csun);
		$this->ashtakCompute(1,0,1,0,0,1,1,0,0,1,1,0,$dmoon);
		$this->ashtakCompute(0,1,1,0,1,1,0,0,1,1,1,0,$emars);
		$this->ashtakCompute(1,0,1,1,1,0,1,1,0,1,1,0,$fmercury);
		$this->ashtakCompute(1,0,0,1,0,0,1,1,0,1,1,1,$gjupiter);
		$this->ashtakCompute(0,0,1,1,1,0,1,0,1,1,1,0,$hvenus);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,0,0,1,0,$isaturn);
		$this->ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,0,$jlagna);
		$this->ashtakPrint("Moon ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(0,0,1,0,1,1,0,0,0,1,1,0,$csun);
		$this->ashtakCompute(0,0,1,0,0,1,0,0,0,0,1,0,$dmoon);
		$this->ashtakCompute(1,1,0,1,0,0,1,1,0,1,1,0,$emars);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,0,0,1,0,$fmercury);
		$this->ashtakCompute(0,0,0,0,0,1,0,0,0,1,1,1,$gjupiter);
		$this->ashtakCompute(0,0,0,0,0,1,0,1,0,0,1,1,$hvenus);
		$this->ashtakCompute(1,0,0,1,0,0,1,1,1,1,1,0,$isaturn);
		$this->ashtakCompute(1,0,1,0,0,1,0,0,0,1,1,0,$jlagna);
		$this->ashtakPrint("Mars    ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(0,0,0,0,1,1,0,0,1,0,1,1,$csun);
		$this->ashtakCompute(0,1,0,1,0,1,0,1,0,1,1,0,$dmoon);
		$this->ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,$emars);
		$this->ashtakCompute(1,0,1,0,1,1,0,0,1,1,1,1,$fmercury);
		$this->ashtakCompute(0,0,0,0,0,1,0,1,0,0,1,1,$gjupiter);
		$this->ashtakCompute(1,1,1,1,1,0,0,1,1,0,1,0,$hvenus);
		$this->ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,$isaturn);
		$this->ashtakCompute(1,1,0,1,0,1,0,1,0,1,1,0,$jlagna);
		$this->ashtakPrint("Mercury ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(1,1,1,1,0,0,1,1,1,1,1,0,$csun);
		$this->ashtakCompute(0,1,0,0,1,0,1,0,1,0,1,0,$dmoon);
		$this->ashtakCompute(1,1,0,1,0,0,1,1,0,1,1,0,$emars);
		$this->ashtakCompute(1,1,0,1,1,1,0,0,1,1,1,0,$fmercury);
		$this->ashtakCompute(1,1,1,1,0,0,1,1,0,1,1,0,$gjupiter);
		$this->ashtakCompute(0,1,0,0,1,1,0,0,1,1,1,0,$hvenus);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,0,0,0,1,$isaturn);
		$this->ashtakCompute(1,1,0,1,1,1,1,0,1,1,1,0,$jlagna);
		$this->ashtakPrint("Jupiter ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(0,0,0,0,0,0,0,1,0,0,1,1,$csun);
		$this->ashtakCompute(1,1,1,1,1,0,0,1,1,0,1,1,$dmoon);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,1,0,1,1,$emars);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,1,0,1,0,$fmercury);
		$this->ashtakCompute(0,0,0,0,1,0,0,1,1,1,1,0,$gjupiter);
		$this->ashtakCompute(1,1,1,1,1,0,0,1,1,1,1,0,$hvenus);
		$this->ashtakCompute(0,0,1,1,1,0,0,1,1,1,1,0,$isaturn);
		$this->ashtakCompute(1,1,1,1,1,0,0,1,1,0,1,0,$jlagna);
		$this->ashtakPrint("Venus   ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(1,1,0,1,0,0,1,1,0,1,1,0,$csun);
		$this->ashtakCompute(0,0,1,0,0,1,0,0,0,0,1,0,$dmoon);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,0,1,1,1,$emars);
		$this->ashtakCompute(0,0,0,0,0,1,0,1,1,1,1,1,$fmercury);
		$this->ashtakCompute(0,0,0,0,1,1,0,0,0,0,1,1,$gjupiter);
		$this->ashtakCompute(0,0,0,0,0,1,0,0,0,0,1,1,$hvenus);
		$this->ashtakCompute(0,0,1,0,1,1,0,0,0,0,1,0,$isaturn);
		$this->ashtakCompute(1,0,1,1,0,1,0,0,0,1,1,0,$jlagna);
		$this->ashtakPrint("Saturn  ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(0,0,1,1,0,1,0,0,0,1,1,1,$csun);
		$this->ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,1,$dmoon);
		$this->ashtakCompute(1,0,1,0,1,0,0,0,0,1,1,0,$emars);
		$this->ashtakCompute(1,1,0,1,0,1,0,1,0,1,1,0,$fmercury);
		$this->ashtakCompute(1,1,0,1,1,1,1,0,1,1,1,0,$gjupiter);
		$this->ashtakCompute(1,1,1,1,1,0,0,1,1,0,0,0,$hvenus);
		$this->ashtakCompute(1,0,1,1,0,1,0,0,0,1,1,0,$isaturn);
		$this->ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,0,$jlagna);
		$this->ashtakPrint("Lagna  ");
		$this->ashtakAccumulate();

		$this->ashtakCompute(1,1,1,1,0,0,1,1,0,1,0,0,$csun);
		$this->ashtakCompute(1,0,1,0,1,0,1,1,1,1,0,0,$dmoon);
		$this->ashtakCompute(0,1,1,0,1,0,0,0,0,0,0,1,$emars);
		$this->ashtakCompute(0,1,0,1,0,0,1,1,0,0,0,1,$fmercury);
		$this->ashtakCompute(1,0,1,1,0,1,0,1,0,0,0,0,$gjupiter);
		$this->ashtakCompute(0,0,0,0,0,1,1,0,0,0,1,1,$hvenus);
		$this->ashtakCompute(0,0,1,0,1,0,1,0,0,1,1,1,$isaturn);
		$this->ashtakCompute(0,0,1,1,1,0,0,0,1,0,0,1,$jlagna);
		$this->ashtakPrint("Rahu   ");
		$this->ashtakAccumulate();

	}

	public function doGeneral() {
		$ti = 0;
		$na = 0;
		$yo = 0;
		$ra = 0;
		$part = 0;
		$tithi = 0.0;
		$nakshatra = 0.0;
		$yoga = 0.0;
		$rasi = 0.0;
		$degrees = 0.0;
		$mins = 0.0;
		$secs = 0.0;

		$tithi = ($this->plnt[7]-$this->plnt[1])/12;
		if ($tithi < 0.00)
			$tithi = $tithi + 30.0;
		$this->tt[0] = $tithi;
		$nakshatra = $this->plnt[7] * 3/ 40;
		$this->tt[1] = $nakshatra;
		$part = floor(4 * $this->fractionReal($this->tt[1])+1);
		$yoga = ($this->plnt[7]+$this->plnt[1])*3/40;
		if ($yoga > 27.0)
			$yoga = $yoga - 27;
		$this->tt[2] = $yoga;

		$ti = floor($this->tt[0]) + 1;
		if ($ti == 30) $ti = 15;
		else $ti = ($ti % 15) - 1;
		if ($ti == -1) $ti = 14;
		$na = floor($this->tt[1]);
		$yo = floor($this->tt[2]);
		$rasi = $this->plnt[7]/30;
		$ra = floor($rasi);
		$this->tt[3] = $rasi;

		// { Computed results 01 } // { need this for nak bool }
		$this->G_Tithi = MysticConstants::$tit[floor($tithi)];
		$this->G_LunarDate = MysticConstants::$etit[floor($tithi)]; 
		if ($tithi < 15)
			$this->G_Paksha = sprintf("Sukla Waxing:%2d",floor($tithi)+1.0);
		else
			$this->G_Paksha = sprintf("Krishna Waning:%2d",floor($tithi)+1.0);

		$this->G_LunarDay = floor($tithi)+1.0;


		// { main stuff in nak bool }
		$this->G_Nakshatra = MysticConstants::$nak[$na];
		$this->G_Nakshatra_No = $na;
		$this->G_Nakshatra_Pada = $part;
		$this->G_Nakshatra_Lord = MysticConstants::$nak1[$na];
		$this->G_DasaBorn = MysticConstants::$nak1[$na];
		$this->G_Yoga = MysticConstants::$yog[$yo];
		$this->G_Rashi = MysticConstants::$eras[$ra];

		switch ($ra) {
			case 0 : // { Mesha }
				{
					$this->G_RashiLord = "Mars";
					switch ($na) {
						case 0 : // { Ashwini }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Horse";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Pada";
							}
							break;
						case 1 : // { Bharani }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Elephant";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Kati";
							}
							break;
						case 2 : // { Krittika }
							{
								$this->G_Gana = "Rakhshas";
								$this->G_Yoni = "Sheep";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Nabhi";
							}
							break;
					}
					$this->G_Varna = "Kshatriya";
					$this->G_Mahantarey = "Vaishya";
				}
				break;
			case 1 : // { Vrishaba }
				{
					$this->G_RashiLord = "Venus";
					switch ($na) {
						case 2 : // { Kritika }
							{
								$this->G_Gana = "Rakhshas";
								$this->G_Yoni = "Sheep";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Nabhi";
							}
							break;
						case 3 : // { Rohini }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Serpent";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Kanta";
							}
							break;
						case 4 : // { Mrigashira }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Serpent";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Sira";
							}
							break;
					}
					$this->G_Varna = "Vaishya";
					$this->G_Mahantarey = "Sudra";
				}
				break;
			case 2 : // { Mithuna }
				{
					$this->G_RashiLord = "Mercury";
					switch ($na) {
						case 4 : // { Mrigashira }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Serpent";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Sira";
							}
							break;
						case 5 : // { Ardra }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Dog";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Kanta";
							}
							break;
						case 6 : // { Punarvasu }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Cat";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Nabhi";
							}
							break;
					}
					$this->G_Varna = "Sudra";
					$this->G_Mahantarey = "Vaishya";
				}
				break;
			case 3 : // { Karkata }
				{
					$this->G_RashiLord = "Moon";
					switch ($na) {
						case 6 : // { Punarvasu }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Cat";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Nabhi";
							}
							break;
						case 7 : // { Pushya }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Sheep";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Kati";
							}
							break;
						case 8 : // { Ashlesha }
							{
								$this->G_Gana = "Rakhshas";
								$this->G_Yoni = "Cat";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Pada";
							}
							break;
					}
					$this->G_Varna = "Brahmin";
					$this->G_Mahantarey = "Brahmin";
				}
				break;
			case 4 : // { Simha }
				{
					$this->G_RashiLord = "Sun";
					switch ($na) {
						case 9 : // { Magha }
							{
								$this->G_Gana = "Rakhshas";
								$this->G_Yoni = "Rat";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Pada";
							}
							break;
						case 10 : // { Purva Phalguni }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Rat";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Kati";
							}
							break;
						case 11 : // { Uttara Phalguni }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Cow";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Nabhi";
							}
							break;
					}
					$this->G_Varna = "Kshatriya";
					$this->G_Mahantarey = "Kshatriya";
				}
				break;
			case 5 : // { Kanya }
				{
					$this->G_RashiLord = "Mercury";
					switch ($na) {
						case 11 : // { Uttara Phalguni }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Cow";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Nabhi";
							}
							break;
						case 12 : // { Hasta }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Buffalo";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Kanta";
							}
							break;
						case 13 : // { Chitra }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Tiger";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Sira";
							}
							break;
					}
					$this->G_Varna = "Vaishya";
					$this->G_Mahantarey = "Sudra";
				}
				break;
			case 6 : // { Tula }
				{
					$this->G_RashiLord = "Venus";
					switch ($na) {
						case 13 : // { Chitra }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Tiger";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Sira";
							}
							break;
						case 14 : // { Swati }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Buffalo";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Kanta";
							}
							break;
						case 15 : // { Vishakha }
							{
								$this->G_Gana = "Rakhsas";
								$this->G_Yoni = "Tiger";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Nabhi";
							}
							break;
					}
					$this->G_Varna = "Sudra";
					$this->G_Mahantarey = "Kshatriya";
				}
				break;
			case 7 : // { Vrischika }
				{
					$this->G_RashiLord = "Mars";
					switch ($na) {
						case 15 : // { Vishakha }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Tiger";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Nabhi";
							}
							break;
						case 16 : // { Anuradha }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Hare";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Kati";
							}
							break;
						case 17 : // { Jyestha }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Hare";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Pada";
							}
							break;
					}
					$this->G_Varna = "Brahmin";
					$this->G_Mahantarey = "Brahmin";
				}
				break;
			case 8 : // { Dhanu }
				{
					$this->G_RashiLord = "Jupiter";
					switch ($na) {
						case 18 : // { Mula }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Dog";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Pada";
							}
							break;
						case 19 : // { purvashada }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Monkey";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Kati";
							}
							break;
						case 20 : // { uttarashada }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Mongoose";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Nabhi";
							}
							break;
					}
					$this->G_Varna = "Kshatriya";
					$this->G_Mahantarey = "Kshatriya";
				}
				break;
			case 9 : // { Makara }
				{
					$this->G_RashiLord = "Saturn";
					switch ($na) {
						case 20 : // { uttarashada }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Mongoose";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Nabhi";
							}
							break;
						case 21 : // { shrawana }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Monkey";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Kanta";
							}
							break;
						case 22 : // { dhanista }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Lion";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Sira";
							}
							break;
					}
					$this->G_Varna = "Vaishya";
					$this->G_Mahantarey = "Sudra";
				}
				break;
			case 10: // { Kumbha }
				{
					$this->G_RashiLord = "Saturn";
					switch ($na) {
						case 22 : // { dhanista }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Lion";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Rajju = "Sira";
							}
							break;
						case 23 : // { satvisha }
							{
								$this->G_Gana = "Rakshas";
								$this->G_Yoni = "Horse";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Kanta";
							}
							break;
						case 24 : // { purvabhadrapada }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Lion";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Nabhi";
							}
							break;
					}
					$this->G_Varna = "Sudra";
					$this->G_Mahantarey = "Vaishya";
				}
				break;
			case 11: // { Meena }
				{
					$this->G_RashiLord = "Jupiter";
					switch ($na) {
						case 24 : // { purvabhadrapada }
							{
								$this->G_Gana = "Nar";
								$this->G_Yoni = "Lion";
								$this->G_Nadi = "Aadi (Vata)";
								$this->G_Rajju = "Nabhi";
							}
							break;
						case 25 : // { uttarabhadrapada }
							{
								$this->G_Gana = "Nar";
								$this->G_Nadi = "Madhya (Pitha)";
								$this->G_Yoni = "Cow";
								$this->G_Rajju = "Kati";
							}
							break;
						case 26 : // { revati }
							{
								$this->G_Gana = "Deva";
								$this->G_Yoni = "Elephant";
								$this->G_Nadi = "Pristha (Sleshma)";
								$this->G_Rajju = "Pada";
							}
							break;
					}
					$this->G_Varna = "Brahmin";
					$this->G_Mahantarey = "Brahmin";
				}
				break;
		}
	}


	public function perturbPlanets() {
		$i = 0;
		$a = 0;
		$b = 0;
		$c = 0;
		$aa = 0.0;
		$bb = 0.0;
		$pp = "";
		$zwhtype = "";
		$degrees = 0.0;
		$mins = 0.0;
		$secs = 0.0;
		$lordship = array (0=>array(1,4), array(2,3), array(3,2), array(4,7), array(5,1), array(6,2), 
		array(7,3), array(8,4), array(9,5), array(10,6), array(11,6), array(12,5) );
		$detriment = array (0=>array(1,3), array(2,4), array(3,5), array(4,6), array(5,10), array(6,11),
		array(7,4), array(8,3), array(9,2), array(10,7), array(11,1), array(12,2));
		$exalt = array (0=>array(1,1), array(2,7), array(3,8), array(4,5), array(5,11), array(6,2), 
		array(7,6), array(8,10), array(9,9), array(10,4), array(11,12), array(12,3));
		$exalt = array (0=>array(1,6), array(2,10), array(3,9), array(4,4), array(5,12), array(6,3), 
		array(7,1), array(8,7), array(9,8), array(10,5), array(11,11), array(12,2));

		for ($i = 1; $i <= 12; $i++) {
			$aa = $this->plnt[$i];
			$a = floor($aa/30 + 1);
			$b = floor($aa * 3 / 40);
			$c = floor(4 * $this->fractionReal($aa * 3.0 / 40) + 1);
			$bb = $this->plnt[$i+13];
			if ($bb < $aa)
				$pp = "Ret";
			else
				$pp = "Dir";
			$zwhtype = 0;   // MysticConstants::$IOWNHOUSE, $IEXALT, $IMT, $IDETRI, $IFALL

			$degrees = $aa-(($a-1)*30);
			$mins = ($degrees - (int)($degrees)) * 60;
			$secs = ($mins - (int)($mins)) * 60;

			include 'strengths.php';
			
			$this->G_PlanetPos[$i][9] = "Unk";
			$this->G_PlanetPos[$i][10] = "Unk";
			$this->G_PlanetPos[$i][11] = "Unk";

			// Deprecated
			// include 'sublords.php';

			// { New addition for Bhava Chalit }
			$this->G_chalit[0][$i-1] = $i;
			$this->G_chalit[1][$i-1] = $aa;

			$this->G_PlanetPos[$i][ 1] = MysticConstants::$graha[$i]; // planet
			// $this->G_PlanetPos[$i][ 2] = sprintf("%2.2d %2.2d %2.2d", floor($degrees), floor($mins), floor($secs)); // Longitude
			$this->G_PlanetPos[$i][ 2] = sprintf("%2.2f", $degrees); // Longitude
			$this->G_PlanetPos[$i][ 3] = MysticConstants::$ras[$a-1]; // rashi
			$this->G_PlanetPos[$i][ 4] = sprintf("%2d", $a); // rashi no
			$this->G_PlanetPos[$i][ 5] = MysticConstants::$eras[$a-1]; // zodiac
			$this->G_PlanetPos[$i][ 6] = $zwhtype; // strength (exalted, weak)
			$this->G_PlanetPos[$i][ 7] = MysticConstants::$nak[$b]; // Nakshatra
			// $this->G_PlanetPos[$i][ 7] = sprintf("%2d",$c); // Pada
			$this->G_PlanetPos[$i][ 8] = $pp; // Direct or retrograde
			$this->G_PlanetPos[$i][ 12] = $b; // Nakshatra No
        	$this->G_PlanetPos[$i][ 13] = $c; // Nakshatra pada
		}
	}

	public function CalcVargas($m) {
		$i = 0;
		$j = 0;
		$z = 0;
		$s = 0;
		$p = 0;
		$q = 0;
		$r = 0;
		$u = 0;
		$v = 0;

		$i = 0;
		$this->G_Lagna = MysticConstants::$eras[$this->G_varga[0][0]-1];
		$this->G_LagnaNum = $this->G_varga[0][0];
		switch ($this->G_varga[0][0]-1) {
			case 0 : // { Mesha }
				$this->G_LagnaLord = "Mars"; $this->G_LagnaLordNum = MysticConstants::$_MAR; break;
			case 1 : // { Vrishaba }
				$this->G_LagnaLord = "Venus"; $this->G_LagnaLordNum = MysticConstants::$_VEN; break;
			case 2 : // { Mithuna }
				$this->G_LagnaLord = "Mercury"; $this->G_LagnaLordNum = MysticConstants::$_MER; break;
			case 3 : // { Karkata }
				$this->G_LagnaLord = "Moon"; $this->G_LagnaLordNum = MysticConstants::$_MON; break;
			case 4 : // { Simha }
				$this->G_LagnaLord = "Sun"; $this->G_LagnaLordNum = MysticConstants::$_SUN; break;
			case 5 : // { Kanya }
				$this->G_LagnaLord = "Mercury"; $this->G_LagnaLordNum = MysticConstants::$_MER; break;
			case 6 : // { Tula }
				$this->G_LagnaLord = "Venus"; $this->G_LagnaLordNum = MysticConstants::$_VEN; break;
			case 7 : // { Vrischika }
				$this->G_LagnaLord = "Mars"; $this->G_LagnaLordNum = MysticConstants::$_MAR; break;
			case 8 : // { Dhanu }
				$this->G_LagnaLord = "Jupiter"; $this->G_LagnaLordNum = MysticConstants::$_JUP; break;
			case 9 : // { Makara }
				$this->G_LagnaLord = "Saturn"; $this->G_LagnaLordNum = MysticConstants::$_SAT; break;
			case 10: // { Kumbha }
				$this->G_LagnaLord = "Saturn"; $this->G_LagnaLordNum = MysticConstants::$_SAT; break;
			case 11: // { Meena }
				$this->G_LagnaLord = "Jupiter"; $this->G_LagnaLordNum = MysticConstants::$_JUP; break;
		} // { case }

		for ($i = 0; $i <= 12; $i++) {
			$s = $this->G_varga[$i][$m];
			if ($s < 4)
			$r = $s + 1;
			else if ($s < 7)
			$r = ($s-2)*4;
			else if ($s < 10)
			$r = 22 - $s;
			else
			$r = (12-$s) * 4 + 1;
			$p = floor(($r-1)/4 + 1);
			$q = $r - ($p-1)*4;
			$u = floor(($p-1)*8 + 2 + $i/2);
			$v = ($q-1)*2 + $i % 2;
		}

		// { for graphics }
		for ($i = 0; $i <= 12; $i++) {
			$s = $this->G_varga[$i][$m];
			if ($s < 4)
			$r = $s + 1;
			else if ($s < 7)
			$r = ($s-2)*4;
			else if ($s < 10)
			$r = 22 - $s;
			else
			$r = (12-$s) * 4 + 1;
			$p = floor(($r-1)/4 + 1);
			$q = $r - ($p-1)*4;
			$u = floor(($p-1)*8 + 2 + $i/2);
			$v = ($q-1)*2 + $i % 2;
			if ($i < 13) {
				switch ($m) {
					case 0:
						{
							$this->G_RashiGeneral[$i+1][1] = MysticConstants::$graha[$i];
							$this->G_RashiGeneral[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
					/**
					case 1:
						{
							$this->G_Dreskhana[$i+1][1] = $graha[$i];
							$this->G_Dreskhana[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
					case 2:
						{
							$this->G_Saptamsa[$i+1][1] = $graha[$i];
							$this->G_Saptamsa[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
					case 3:
						{
							$this->G_Navamsa[$i+1][1] = $graha[$i];
							$this->G_Navamsa[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
					case 4:
						{
							$this->G_Dadamsa[$i+1][1] = $graha[$i];
							$this->G_Dadamsa[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
					case 5:
						{
							$this->G_Dwadasamsa[$i+1][1] = $graha[$i];
							$this->G_Dwadasamsa[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
					case 6:
						{
							$this->G_Shodasamsa[$i+1][1] = $graha[$i];
							$this->G_Shodasamsa[$i+1][2] = sprintf("%-2d", $s);
						}
						break;
						*/
				}
			}
		}
		// { Graphics over }
	}

	public function CalcAyanamsa () {
		// { Ayanamsa based on N.C. Lahiri }
		// { Given by Positional Astronomy Center, Calcutta }
		$this->plnt[0]  =  22.460148 + 1.396042*$this->JulianCent + 3.08e-4*$this->JulianCent*$this->JulianCent;
	}


	public function FindKP() {
		$n_aya = 0.0;
		$diff = 0.0;
		$i = 0;

		$n_aya = 23 + (($this->y - 1938) * 50.289999999999999) / 3600;
		$this->plnt[0] = $n_aya;
	}

	public function FindLahiriCorr() {
		$n_aya = 0.0;

		// Correction for N.C. Lahiri for instead of 285 / 291 days.
		$n_aya = (($this->y - 291) * 50.2388475) / 3600;
		$this->plnt[0] = $n_aya;
	}

	// { If using the B.V. Ramans method }
	public function FindRaman() {

		$ramaya = 0.0;

		$ramaya = 21.013972 + 1.398191 * $this->JulianCent;
		$this->plnt[0] = $ramaya;
	}
	
}

class DefinedMystic extends Mystic {
	public function __construct( /*array*/ $itms ) {
		foreach( $itms as $name => $enum )
		$this->add($name, $enum);
	}
}

class FlagsMystic extends Mystic {
	public function __construct( /*...*/ ) {
		$args = func_get_args();
		for( $i=0, $n=count($args), $f=0x1; $i<$n; $i++, $f *= 0x2 )
		$this->add($args[$i], $f);
	}
}

?>