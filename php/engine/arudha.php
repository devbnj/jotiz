<?php
// require "constants.php";

class Arudha {
	public $ketuStrongerThanMars = false;
	public $rahuStrongerThanSaturn = false;
	public $G_varga = array();
	public $G_House = array();
	public $G_SHouse = array();
	public $G_PlanetPos = array();
	public $plnt = array();
	// public $G_Arudha = Array();
	private $ascpos;
	public function __construct() {
	}
	public function setValues($G_varga, $G_House, $G_SHouse, $ascpos, $G_PlanetPos, $plnt) {
		$this->G_varga = $G_varga;
		$this->G_House = $G_House;
		$this->G_SHouse = $G_SHouse;
		$this->ascpos = $ascpos;
		$this->G_PlanetPos = $G_PlanetPos;
		$this->plnt = $plnt;
	}
	public function calculateArudha() {
		$newpos = 1;
		$this->calcNodeStrength();
		// echo "Ketu Stronger than Mars = "; var_dump($ketuStrongerThanMars);echo "<br>";
		// echo "Rahu Stronger than Saturn = ";var_dump($rahuStrongerThanSaturn);echo "<br>";
		for ($i = 1; $i <= 12; $i++) {
			$newpos = 1;
			$rasi = $this->calcPada($this->ascpos, $i -1);
			$newpos = $rasi +1 - $this->ascpos;
			$newpos1 = $this->recalibrate($newpos);
			if ($i == 1) {
				$this->G_House[$newpos1] .= " " . "AL";
				$this->G_SHouse[$rasi +1] .= " " . "AL";
			} else
			if ($i == 12) {
				$this->G_House[$newpos1] .= " " . "UL";
				$this->G_SHouse[$rasi +1] .= " " . "UL";
			} else {
				$this->G_House[$newpos1] .= " " . sprintf("A%d", $i);
				$this->G_SHouse[$rasi +1] .= " " . sprintf("A%d", $i);
			}
		}
	}
	function recalibrate($xpos) {
		$newhse = $xpos + 1;
		if ($newhse < 0) $newhse = $newhse + 12;
		if ($newhse == 0) $newhse = 12;
		return $newhse;
	}

	function red12($input) {
		$ret = $input % 12;
		return (int) ($ret >= 0 ? $ret : $ret +12);
	}

	function calcPada($apos, $bhava) {
		$rasi = $this->red12(($apos - 1) + $bhava);
		$lrd = $this->getJaiminiLord($rasi);
		$diff = $this->red12($this->getVRasi($lrd) - $rasi);
		$pada = $this->red12($rasi + (2 * $diff));
		if (!($diff % 3))
			$pada = $this->red12($pada +9);
		return $pada;
	}

	function getJaiminiLord($rasi) {
		$lrd = $this->getLord($rasi);
		if (($rasi == 7) && ($this->ketuStrongerThanMars))
			$lrd = MysticConstants::$IKETU;
		if (($rasi == 10) && ($this->rahuStrongerThanSaturn))
			$lrd = MysticConstants::$IRAHU;
		return $lrd;
	}

	function getLord($planet) {
		$k_lord = array (
			MysticConstants::$IMARS,
			MysticConstants::$IVENUS,
			MysticConstants::$IMERCURY,
			MysticConstants::$IMOON,
			MysticConstants::$ISUN,
			MysticConstants::$IMERCURY,
			MysticConstants::$IVENUS,
			MysticConstants::$IMARS,
			MysticConstants::$IJUPITER,
			MysticConstants::$ISATURN,
			MysticConstants::$ISATURN,
			MysticConstants::$IJUPITER
			);
		return $k_lord[$planet];
	}

	function getVRasi($planet) {
		switch ($planet) {
			case MysticConstants::$ISUN :
				return (int) ($this->G_varga[1][0] - 1);
			case MysticConstants::$IMERCURY :
				return (int) ($this->G_varga[2][0] - 1);
			case MysticConstants::$IVENUS :
				return (int) ($this->G_varga[3][0] - 1);
			case MysticConstants::$IMARS :
				return (int) ($this->G_varga[4][0] - 1);
			case MysticConstants::$IJUPITER :
				return (int) ($this->G_varga[5][0] - 1);
			case MysticConstants::$ISATURN :
				return (int) ($this->G_varga[6][0] - 1);
			case MysticConstants::$IMOON :
				return (int) ($this->G_varga[7][0] - 1);
			case MysticConstants::$IRAHU :
				return (int) ($this->G_varga[8][0] - 1);
			case MysticConstants::$IKETU :
				return (int) ($this->G_varga[9][0] - 1);
		}
	}

	function calcNodeStrength() {
		$nbplanets = array (0,0,0,0,0,0,0,0,0);
		$this->ketuStrongerThanMars = false;
		$this->rahuStrongerThanSaturn = false;
		for ($i = 0; $i < 12; $i++)
			$nbplanets[$i] = 0;
		for ($i = MysticConstants::$ISUN; $i <= MysticConstants::$IKETU; $i++) {
			$nbplanets[$this->getRasi($this->plnt[$i])]++;
		}
		$aspSat = $this->calcPlanetAspects(MysticConstants::$ISATURN);
		$aspRah = $this->calcPlanetAspects(MysticConstants::$IRAHU);
		$aspMar = $this->calcPlanetAspects(MysticConstants::$IMARS);
		$aspKet = $this->calcPlanetAspects(MysticConstants::$IKETU);

		/**********************************************
		 ** RAHU -- SATURN
		 **********************************************/
		// ** RULE 1: Jupiter aspects rahu -> rahu in fall
		if ($this->hasJaiminiAspect($this->getRasi($this->plnt[MysticConstants::$IJUPITER]), $this->getRasi($this->plnt[MysticConstants::$IRAHU]))) {
			$this->rahuStrongerThanSaturn = false;
		}
		// RULE 2a
		else
		if (($this->getRasi($this->plnt[MysticConstants::$ISATURN]) == 10) && ($this->getRasi($this->plnt[MysticConstants::$IRAHU]) != 10)) {
			$this->rahuStrongerThanSaturn = true;
		}
		// RULE 2b
		else
		if (($this->getRasi($this->plnt[MysticConstants::$ISATURN]) != 10) && ($this->getRasi($this->plnt[MysticConstants::$IRAHU]) == 10)) {
			$this->rahuStrongerThanSaturn = false;
		}
		// RULE 3a
		else
		if ($nbplanets[$this->getRasi($this->plnt[MysticConstants::$ISATURN])] > $nbplanets[$this->getRasi($this->plnt[MysticConstants::$IRAHU])]) {
			$this->rahuStrongerThanSaturn = false;
		}
		// RULE 3b
		else
		if ($nbplanets[$this->getRasi($this->plnt[MysticConstants::$ISATURN])] < $nbplanets[$this->getRasi($this->plnt[MysticConstants::$IRAHU])]) {
			$this->rahuStrongerThanSaturn = true;
		}
		// RULE 4a
		else
		if ($aspSat > $aspRah) {
			$this->rahuStrongerThanSaturn = false;
		}
		// RULE 4b
		else
		if ($aspSat < $aspRah) {
			$this->rahuStrongerThanSaturn = true;
		}
		// RULE 5a
		else
		if ($this->hasExaltationRasi(MysticConstants::$ISATURN, $this->getRasi($this->plnt[MysticConstants::$ISATURN])) && 
			!$this->hasExaltationRasi(MysticConstants::$IRAHU, $this->getRasi($this->plnt[MysticConstants::$IRAHU]))) {
			$this->rahuStrongerThanSaturn = false;
		}
		// RULE 5b
		else
		if (!$this->hasExaltationRasi(MysticConstants::$ISATURN, $this->getRasi($this->plnt[MysticConstants::$ISATURN])) && 
			$this->hasExaltationRasi(MysticConstants::$IRAHU, $this->getRasi($this->plnt[MysticConstants::$IRAHU]))) {
			$this->rahuStrongerThanSaturn = true;
		}
		// RULE 8a
		else
		if ($this->getRasiLength(MysticConstants::$ISATURN) > $this->getRasiLength(MysticConstants::$IRAHU)) {
			$this->rahuStrongerThanSaturn = false;
		}
		// RULE 8b
		else
		if ($this->getRasiLength(MysticConstants::$ISATURN) < $this->getRasiLength(MysticConstants::$IRAHU)) {
			$this->rahuStrongerThanSaturn = true;
		} else {
			$this->rahuStrongerThanSaturn = false;
		}

		/**********************************************
		 ** KETU -- MARS
		 **********************************************/
		//** RULE 1: Jupiter aspects ketu -> ketu in fall
		if ($this->hasJaiminiAspect($this->getRasi($this->plnt[MysticConstants::$IJUPITER]), $this->getRasi($this->plnt[MysticConstants::$IKETU]))) {
			$this->ketuStrongerThanMars = false;
		}
		// RULE 2a
		else
		if (($this->getRasi($this->plnt[MysticConstants::$IMARS]) == 7) && ($this->getRasi($this->plnt[MysticConstants::$IKETU]) != 7)) {
			$this->ketuStrongerThanMars = true;
		}
		// RULE 2b
		else
		if (($this->getRasi($this->plnt[MysticConstants::$IMARS]) != 7) && ($this->getRasi($this->plnt[MysticConstants::$IKETU]) == 7)) {
			$this->ketuStrongerThanMars = false;
		}
		// RULE 3a
		else
		if ($nbplanets[$this->getRasi($this->plnt[MysticConstants::$IMARS])] > $nbplanets[$this->getRasi($this->plnt[MysticConstants::$IKETU])]) {
			$this->ketuStrongerThanMars = false;
		}
		// RULE 3b
		else
		if ($nbplanets[$this->getRasi($this->plnt[MysticConstants::$IMARS])] < $nbplanets[$this->getRasi($this->plnt[MysticConstants::$IKETU])]) {
			$this->ketuStrongerThanMars = true;
		}
		// RULE 4a
		else
		if ($aspMar > $aspKet) {
			$this->ketuStrongerThanMars = false;
		}
		// RULE 4b
		else
		if ($aspMar < $aspKet) {
			$this->ketuStrongerThanMars = true;
		}
		// RULE 5a
		else
		if ($this->hasExaltationRasi(MysticConstants::$IMARS, $this->getRasi($this->plnt[MysticConstants::$IMARS])) && 
			!$this->hasExaltationRasi(MysticConstants::$IKETU, $this->getRasi($this->plnt[MysticConstants::$IKETU]))) {
			$this->ketuStrongerThanMars = false;
		}
		// RULE 5b
		else
		if (!$this->hasExaltationRasi(MysticConstants::$IMARS, $this->getRasi($this->plnt[MysticConstants::$IMARS])) && 
			$this->hasExaltationRasi(MysticConstants::$IKETU, $this->getRasi($this->plnt[MysticConstants::$IKETU]))) {
			$this->ketuStrongerThanMars = true;
		}
		// **** TODO: RULE 6 + 7
		// RULE 8a
		else
		if ($this->getRasiLength(MysticConstants::$IMARS) > $this->getRasiLength(MysticConstants::$IKETU)) {
			$this->ketuStrongerThanMars = false;
		}
		// RULE 8b
		else
		if ($this->getRasiLength(MysticConstants::$IMARS) < $this->getRasiLength(MysticConstants::$IKETU)) {
			$this->ketuStrongerThanMars = true;
		} else {
			$this->ketuStrongerThanMars = false;
		}

	}

	function hasJaiminiAspect($pos1, $pos2) {
		$diff = $this->red12($pos2 - $pos1);

		// CHARA
		if (!($pos1 % 3)) {
			if (($diff == 4) || ($diff == 7) || ($diff == 10))
			return true;
		}
		// STHIRA
		else
		if (($pos1 % 3) == 1) {
			if (($diff == 2) || ($diff == 5) || ($diff == 8))
			return true;
		}
		// DWISWA
		else {
			if (($diff == 3) || ($diff == 3) || ($diff == 9))
			return true;
		}
		return false;
	}

	function calcPlanetAspects($planet) {
		$ret = 0;
		if ($this->hasJaiminiAspect($this->getRasi($this->plnt[MysticConstants::$IJUPITER]), $this->getRasi($this->plnt[$planet])))
			$ret++;
		if ($this->hasJaiminiAspect(getRasi($this->plnt[MysticConstants::$IMERCURY]), $this->getRasi($this->plnt[$planet])))
			$ret++;
		$rasi1 = $this->getRasi($this->plnt[$planet]);
		$lord1 = $this->getJaiminiLord($rasi1);
		if ($this->hasJaiminiAspect($this->getRasi($this->plnt[$lord1]), $this->getRasi($this->plnt[$planet])))
			$ret++;
		return $ret;
	}

	function getExaltationRasi($planet) {
		$exalt_rasi = array (0,1,9,5,3,11,6,2,8,0,0,0);
		return $exalt_rasi[$planet];
	}

	function hasExaltationRasi($planet, $rasi) {
		return ($this->getExaltationRasi($planet) == $rasi);
	}

	function getRasiLength($planet) {
		global $IRAHU, $IKETU;
		return $this->getVRasiLen($this->getLength($planet), $planet == MysticConstants::$IRAHU || $planet == MysticConstants::$IKETU);
	}

	function getLength($planet) {
		switch ($planet) {
			case MysticConstants::$ISUN :
				return 30.0 - floatval($this->G_PlanetPos[1][1]);
			case MysticConstants::$IMERCURY :
				return 30.0 - floatval($this->G_PlanetPos[2][1]);
			case MysticConstants::$IVENUS :
				return 30.0 - floatval($this->G_PlanetPos[3][1]);
			case MysticConstants::$IMARS :
				return 30.0 - floatval($this->G_PlanetPos[4][1]);
			case MysticConstants::$IJUPITER :
				return 30.0 - floatval($this->G_PlanetPos[5][1]);
			case MysticConstants::$ISATURN :
				return 30.0 - floatval($this->G_PlanetPos[6][1]);
			case MysticConstants::$IMOON :
				return 30.0 - floatval($this->G_PlanetPos[7][1]);
			case MysticConstants::$IRAHU :
				return 30.0 - floatval($this->G_PlanetPos[8][1]);
			case MysticConstants::$IKETU :
				return 30.0 - floatval($this->G_PlanetPos[9][1]);
		}
	}

	function getVRasiLen($len, $reverse) {
		if (!$reverse)
			return ($this->a_red($len, 30));
		else
			return (30 - $this->a_red($len, 30));
	}
	public function getRasi( $len ) {
		return( (int)( $this->red_deg( $len ) / 30 )  );
	}

	public function red_deg( $input ) {
		return (double)$this->a_red($input, 360);
	}
	public function a_red( $x, $a ) {
		return (double)( $x - floor( $x / $a ) * $a );
	}
	
}


?>
