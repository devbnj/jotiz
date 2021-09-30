<?php
class AnalysisDTO {
	public $graha;
	public $newpos;
	public $lordof1;
	public $lordof2;
	public $actualdegrees;
	public $degrees;
	public $zodiac;
	public $house;
	public $nakshatra;
	public $pada;
	public $retrograde;
	public $strength;
	public $str;
	public $navamsa;
	public $nstrength;
	public $nstr;
	public $aspects_graha = array();
	public $aspected_graha = array();
	public $aspects_house = array();
	public $aspected_house = array();
	public $conjuncts = array();
	
    function setGraha ($graha) {
       $this->graha = $graha;
    }

    function setDegrees ($degrees) {
       $this->degrees = $degrees;
    }
    
    function setLordOf1 ($lordof1) {
       $this->lordof1 = $lordof1;
    }

    function setLordOf2 ($lordof2) {
       $this->lordof2 = $lordof2;
    }
    
    function setZodiac ($zodiac) {
       $this->zodiac = $zodiac;
    }

    function setHouse ($house) {
       $this->house = $house;
    }

    function setNakshatra ($nakshatra) {
       $this->nakshatra = $nakshatra;
    }

    function setRetrograde ($retrograde) {
       $this->retrograde = $retrograde;
    }

    function setAspectsGraha ($graha) {
       $this->aspects_graha[] = $graha;
    }

    function setAspectsHouse ($house) {
       $this->aspects_house[] = $house;
    }

    function setConjuncts ($graha) {
       $this->conjuncts[] = $graha;
    }
	
    public function __construct() {
	}
}

class GrahaAnalysis {
	public $analysisD1 = array();
	public function __construct() {
	}
	
	public function doAnalysis($cname, $wpos, $G_varga, $G_PlanetPos, $G_Planet, $G_LagnaDeg, $plnt) {
		// Set the analysis for D Chart
		for ($y = 0; $y <= 12; $y++) {
			$adto = new AnalysisDTO();
			$this->analysisD1[$y]=$adto;
		}

		// var_dump($G_varga);
		$ascpos = $G_varga[0][$wpos];
		$newpos = 1;
		$this->analysisD1[0]->graha = 9;
		$this->analysisD1[0]->zodiac = $G_varga[0][$wpos];
		$this->analysisD1[0]->house = 1;
		$this->analysisD1[0]->actualdegrees = $G_LagnaDeg;
		$this->analysisD1[0]->degrees = sprintf("%3.2f", ($G_LagnaDeg - (floor($G_LagnaDeg / 30)*30)));
		$zna = floor($G_LagnaDeg * 3/ 40);
		$this->analysisD1[0]->nakshatra = $zna;
		$this->analysisD1[0]->pada = floor(4 * FractionReal($zna)+1);
		$this->analysisD1[0]->setAspectsHouse(7);
		$this->analysisD1[0]->navamsa = $G_varga[0][3];
		
		for ($y = 1; $y <= 12; $y++) {
			$newpos = 1;
			$newpos = $G_varga[$y][$wpos] - $ascpos;
			$newpos1 = recalibrate($newpos);
			// $this->analysisD1[$newpos1]->setGraha($y);
			$this->analysisD1[$y]->newpos = $newpos1;
			$this->analysisD1[$y]->setGraha($y);
			$this->analysisD1[$y]->setZodiac($G_varga[$y][$wpos]);
			$this->analysisD1[$y]->setNakshatra($G_PlanetPos[$y][12]);
			$this->analysisD1[$y]->pada = $G_PlanetPos[$y][13];
			$this->analysisD1[$y]->setRetrograde($G_PlanetPos[$y][8]);
			$this->analysisD1[$y]->str = $G_PlanetPos[$y][6];
			if ($G_PlanetPos[$y][6] == MysticConstants::$IEXALT) $this->analysisD1[$y]->strength = "Exalt";
			if ($G_PlanetPos[$y][6] == MysticConstants::$IDETRI) $this->analysisD1[$y]->strength = "Detri";
			if ($G_PlanetPos[$y][6] == MysticConstants::$IOWNHOUSE) $this->analysisD1[$y]->strength = "Lord";
			if ($G_PlanetPos[$y][6] == MysticConstants::$IFALL) $this->analysisD1[$y]->strength = "Fall";
			if ($G_PlanetPos[$y][6] == MysticConstants::$IMT) $this->analysisD1[$y]->strength = "M-Trik";
			$this->analysisD1[$y]->actualdegrees = $plnt[$y];
			$this->analysisD1[$y]->setDegrees($G_PlanetPos[$y][2]);
			$this->analysisD1[$y]->navamsa = $G_varga[$y][3];
			$nstrength = "";
			$nstr = 0;
			if (MysticConstants::$iruler[$this->analysisD1[$y]->navamsa-1] == $y) {
				$nstrength = "Lord";
				$nstr = MysticConstants::$IOWNHOUSE;
			}
			if (MysticConstants::$idetri[$this->analysisD1[$y]->navamsa-1] == $y) {
				$nstrength = "Detri";
				$nstr = MysticConstants::$IDETRI;
			}
			if (MysticConstants::$iexalt[$this->analysisD1[$y]->navamsa-1] == $y) {
				$nstrength = "Exalt";
				$nstr = MysticConstants::$IEXALT;
			}
			if (MysticConstants::$ifall[$this->analysisD1[$y]->navamsa-1] == $y) {
				$nstrength = "Fall";
				$nstr = MysticConstants::$IFALL;
			}
			$this->analysisD1[$y]->nstrength = $nstrength;
			$this->analysisD1[$y]->nstr = $nstr;
			
			// $this->analysisD1[$y]->setConjuncts($y);
			if ($newpos1 == 1) // if ascendant
				$this->analysisD1[0]->setConjuncts($y);
			$this->analysisD1[$y]->setHouse($newpos1);

			// Array for planets
			$G_Planet[$y][1] = MysticConstants::$graha[$y];
			if ($y == 1) { // Sun and Leo
				$newpos2 = 12 - $ascpos + 5 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
			}
			if ($y == 2) { // Mercury and Gemini, Virgo
				$newpos2 = 12 - $ascpos + 3 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
				$newpos2 = 12 - $ascpos + 6 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][5] = (int)$newpos2;
			}
			if ($y == 3) { // Venus and Taurus, Libra
				$newpos2 = 12 - $ascpos + 2 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
				$newpos2 = 12 - $ascpos + 7 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][5] = (int)$newpos2;
			}
			if ($y == 4) { // Mars and Aries, Scorpio
				$newpos2 = 12 - $ascpos + 1 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
				$newpos2 = 12 - $ascpos + 8 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][5] = (int)$newpos2;
			}
			if ($y == 5) { // Jupiter and Sag, Pis
				$newpos2 = 12 - $ascpos + 9 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
				$newpos2 = 12 - $ascpos + 12 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][5] = (int)$newpos2;
			}
			if ($y == 6) { // Saturn and Cap, Aqu
				$newpos2 = 12 - $ascpos + 10 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
				$newpos2 = 12 - $ascpos + 11 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][5] = (int)$newpos2;
			}
			if ($y == 7) { // Moon and Cancer
				$newpos2 = 12 - $ascpos + 4 + 1;
				if ($newpos2 > 12) $newpos2 = $newpos2 - 12;
				$G_Planet[$y][2] = (int)$newpos2;
			}
			$G_Planet[$y][3] = (int)$newpos1;
			$G_Planet[$y][4] = (int)$G_varga[$y][0];
			$this->analysisD1[$y]->setLordOf1($G_Planet[$y][2]);
			$this->analysisD1[$y]->setLordOf2($G_Planet[$y][5]);
		}

		// 2nd Pass - Do aspects
		for ($y = 1; $y <= 12; $y++) {
			$newpos = 1;
			$newpos = $G_varga[$y][$wpos] - $ascpos;
			$newpos1 = recalibrate($newpos);

			$aspect = $newpos + 6;
			if ($aspect > 11) $aspect = $aspect - 12;
			$newpos2 = recalibrate($aspect);
			if (!($y >= 8) && ($y <= 9)) { // Rahu or Ketu
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
			}

			// Aspects for all grahas thru opposition (180 degree aspect)
			for ($x = 1; $x <= 12; $x++) {
				if ($this->analysisD1[$x]->house == $newpos2) {
					if (!($y >= 8) && ($y <= 9)) // Rahu or Ketu
					$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
					// if ($newpos2 == 1) // ascendant
					// $this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
				}
				if ($this->analysisD1[$x]->house == $newpos1) { // Conjuncts
					$this->analysisD1[$y]->setConjuncts($x);
				}
			}

			
			// Aspects
			if ($y == 4) { // Mars
				$aspect = $newpos + 3;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
				$aspect = $newpos + 7;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
			}

			if ($y == 5) { // Jupiter
				$aspect = $newpos + 4;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}

				$aspect = $newpos + 8;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
			}

			if ($y == 6) { // Saturn
				$aspect = $newpos + 2;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
				
				$aspect = $newpos + 9; 
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
			}
			
			if (($y == 8) || ($y == 9)) { // Rahu or Ketu
				$aspect = $newpos + 4;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
				$aspect = $newpos + 8;
				if ($aspect > 11) $aspect = $aspect - 12;
				$newpos2 = recalibrate($aspect);
				$this->analysisD1[$y]->setAspectsHouse($newpos2);
				for ($x = 1; $x <= 12; $x++) {
					if ($this->analysisD1[$x]->house == $newpos2) {
						$this->analysisD1[$y]->setAspectsGraha($this->analysisD1[$x]->graha);
						if ($newpos2 == 1) // ascendant
						$this->analysisD1[0]->setAspectsGraha($this->analysisD1[0]->graha);
					}
				}
			}
			

		}
		// var_dump($this->analysisD1);
		return $this->analysisD1;
	}

}
?>
