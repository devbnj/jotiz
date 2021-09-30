<?php
class Upagraha {
	public $kala = 0;
	public $mrityu = 0;
	public $ardhaprahara = 0;
	public $yamaghantaka = 0;
	public $gulika = 0;
	public $sunrise;
	public $sunset;

	private $dtstamp;
	public $hrborn;
	private $daylength;
	private $wsay;
	private $lsun;
	private $jday = 0;
	private $tz;
	private $ld;
	private $lt;

	public function __construct($mm, $dd, $yy, $hr, $lsun) {
		$this->dtstamp = mktime(0, 0, 0, $mm, $dd, $yy);
		$this->jday = JulianDay($dd, $mm, $yy);
		$this->lsun = $lsun;
		$this->hrborn = $hr;
	}

	public function setValues($ld, $lt, $tz) {
		$this->sunrise = date_sunrise($this->dtstamp, SUNFUNCS_RET_DOUBLE, $lt, $ld, 90, $tz);
		$this->sunset = date_sunset($this->dtstamp, SUNFUNCS_RET_DOUBLE, $lt, $ld, 90, $tz);
		$this->daylength = abs( $this->sunset - $this->sunrise );
		$Tdate = getdate($this->dtstamp);
		$this->wday=$Tdate["wday"];
		$this->tz = $tz;
		$this->ld = $ld;
		$this->lt = $lt;
	}

	private function JulianDay($d, $m, $y) {
		$a = 0;
		$j = 0;
		$l = 0;
		$b = 0.0;
		if ($m < 3) {
			$m = $m + 12;
			$y = $y - 1;
		}
		$a = floor($y / 100);
		$b = 30.6 * ($m + 1.0);
		$l = floor($b);
		$j = 365 * $y + floor($y/4) + $l + 2 - $a + floor($a/4) + $d;
		return $j;
	}

	private function fractionReal($x) {
		return $x - (int)($x);
	}

	function findSplBhavas($sidtm, $c10, $aya, $obliq, $z2, $z1) {
		$r0 = 0.0;
		$w0 = 0.0;
		$b0 = 0.0;
		$MeanLongtd = 0.0;

		$r0 = $aya;
		$w0 = $obliq * $z2;
		$b0 = $sidtm * 15.0 + 90.0;
		if ($b0 >= 360.0)
		$b0 = $b0 - 360.0;
		$sidtm = $sidtm * $z1 / 12.0;
		$c10 = $c10 * $z2;
		if (($sidtm == 0.0) && ($c10 == 0.0)) {
			return 90.0;
		}
		$MeanLongtd = atan(-cos($sidtm)/(sin($c10) * sin($w0)/cos($c10) + sin($sidtm)*cos($w0)));
		$MeanLongtd = $MeanLongtd / $z2;
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

	function findGenBhavas($j0, $k0, $u, &$f2) {
		$l = 0;
		$v = 0;
		$m0 = 0.0;
		for ($l = 0; $l <=2; $l++) {
			$m0 = $j0 + $k0 * $l;
			if ($m0 >= 360.0)
				$m0 = $m0 - 360.0;
			$v = $u + $l - 1;
			$f2[$v] = $m0;
		}
	}

	public function compute() {
		$lord = 0;
		$ps = 0.0;
		$pt = 0.0;
		$z1 = 3.14159265359;
		$z2 = $z1 / 180.0;
		$s1 = 99.99826;
		$f2 = array(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0); // : array [0..12] of double;

		for( $ilord = 0; $ilord < 8; $ilord++ ) {
			// day birth
			if (($this->hrborn > $this->sunrise) && ($this->hrborn < $this->sunset)) {
				// print "<br />Day Born";
				$lord = ( $this->wday + $ilord ) % 8;
				$step_len = 0.125 * $this->daylength;
				$thejd = $this->sunrise + $ilord * $step_len;
			} else {
				// print "<br />Night Born";
				$lord = ( $this->wday + $ilord + 4 ) % 8;
				$step_len = 0.125 * $this->daylength;
				if ( $step_len < 0 ) $step_len *= -1;
				$thejd = $this->sunset + $ilord * $step_len;
			}
			$thejd += 0.5 * $step_len;
			$h = floor($thejd);
			$mt = ($thejd - $h) * 60;
			$to = - 12 - $this->tz;
			$h6 = (($h + $to) + ($mt / 60)) / 24;
			$JulianCent = ($this->jday - 694025.0 + $h6) / 36525.0;
			// print "<br /> Julian Day ".$this->jday;
			// print "<br /> Julian Cent ".$JulianCent;
			$j = $this->jday;
			$j = ($j+4) % 7;
			$lat = $this->lt;
			$longt = $this->ld;

			$v0 = $JulianCent/5 + 0.1;
			$LongAscNode = 2*$z1*fractionReal(0.65965 + 8.43029 * $JulianCent);
			$Inclination = 2*$z1*fractionReal(0.73866 + 3.39476 * $JulianCent);
			$s0 = 2*$z1*fractionReal(0.67644 + 1.19019 * $JulianCent);
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

			// ayanamsa
			$aya =  22.460148 + 1.396042*$JulianCent + 3.08e-4*$JulianCent*$JulianCent;
			// print "<br />Ayanamsa ".$aya;
			$obliq = 23.452294 - 0.0130125 * $JulianCent;
			$MeanDist = 24 * $this->fractionReal(0.2769 + 100.00214 * $JulianCent);
			$b0 = $h6 * 24.0 + 12.0;
			$c0 = $longt / 15.0;
			$sidtime = 24 * $this->fractionReal( ($MeanDist+$b0+$c0) / 24.0 );
			if ($sidtime < 0)
			$sidtime = $sidtime + 24.0;
			$MeanDist = $this->findSplBhavas( $sidtime, $lat, $aya, $obliq, $z2, $z1 );
			$b0 = $this->findSplBhavas( $sidtime - 6.0, 0.0, $aya, $obliq, $z2, $z1);
			$c0 = (180.0 + $b0 - $MeanDist) / 3.0;
			if ($b0 > $MeanDist)
			$c0 = $c0 - 120.0;
			$d0 = 60.0 - $c0;

			$this->findGenBhavas( $MeanDist, $c0, 1, $f2 );
			 
			$asc = $f2[0];
			// print "<br />Ascendant ".$f2[0];
			switch( $lord ) {
				case 0: $this->kala = $asc; break;
				case 2: $this->mrityu = $asc; break;
				case 3: $this->ardhaprahara = $asc; break;
				case 4: $this->yamaghantaka = $asc; break;
				case 6: $this->gulika = $asc; break;
			}
		}
		return;
	}
	public function FindKP($y) {
		$n_aya = 0.0;
		$diff = 0.0;
		$i = 0;

		$n_aya = (($y - 291) * 50.2388475) / 3600;
		return $n_aya;
	}

	public function FindLahiriCorr($y) {
		$n_aya = 0.0;

		// Correction for N.C. Lahiri for instead of 285 / 291 days.
		$n_aya = (($y - 285) * 50.2388475) / 3600;
		return $n_aya;
	}

	function FindRaman($JulianCent) {
		$ramaya = 0.0;

		$ramaya = 21.013972 + 1.398191 * $JulianCent;
		return $ramaya;
	}


}