<?php
class Aspects {
	public function __construct() {
	}
	function findHousePlanets($cname, $wpos, $G_varga, &$G_House) {
		for ($y = 1; $y <= 12; $y ++) {
			$G_House[$y] = "";
		}
		$ascpos = $G_varga[0][$wpos];
		$newpos = 1;
		for ($y = 1; $y <= 12; $y ++) {
			$newpos = 1;
			$newpos = $G_varga[$y][$wpos] - $ascpos;
			$newpos1 = $this->recalibrate($newpos);
			$tmpstr = $G_House[$newpos1];
			$G_House[$newpos1] .= " ".MysticConstants::$graha[$y];
		}
		return $G_House;
	}

	function findAspects($cname, $wpos, $G_varga, $G_PlanetPos, &$hseCopy) {
		$xhtm2 = "";
		$xhtm2 .= "<h2>".$cname." Chart Aspects</h2>";
		$xhtm2 .= "<table id=\"yogini\" class=\"xr_s38\" style=\"width:600px; border-spacing: 2px; border-color: gray; border-collapse: collapse;\">";
		$xhtm2 .= "<tr>";
		$xhtm2 .= "<th>Graha</th>";
		$xhtm2 .= "<th>Longitude</th>";
		$xhtm2 .= "<th>Sign</th>";
		$xhtm2 .= "<th>Aspects Sign</th>";
		$xhtm2 .= "<th>Aspects House</th>";
		$xhtm2 .= "<th>Aspects Planets</th>";
		$xhtm2 .= "</tr>";

		$ascpos = $G_varga[0][$wpos];
		$newpos = 1;

		for ($x = 1; $x <= 12; $x ++) {
			$newpos = 1;
			$xhtm2 .= "<tr>";
			$xhtm2 .= "<td>";
			$xhtm2 .= MysticConstants::$graha[$x];
			$xhtm2 .= "</td>";

			$xhtm2 .= "<td>";
			$xhtm2 .= $G_PlanetPos[$x][2];
			$xhtm2 .= "</td>";

			$xhtm2 .= "<td>";
			// $outpt = $eras[$G_PlanetPos[$x][4] - 1];
			$outpt = MysticConstants::$eras[$G_varga[$x][$wpos] - 1];
			$xhtm2 .= $outpt;
			$xhtm2 .= "<td>";
			$housed = "";
			// $aspect = $G_PlanetPos[$x][4] + 6;
			$aspect = $G_varga[$x][$wpos] + 6;
			if ($aspect > 12) $aspect = $aspect -12;
			$newpos = $aspect - $ascpos;
			$newpos1 = $this->recalibrate($newpos);
			$housed = "".$newpos1;
			$planetsAspected = $hseCopy[$newpos1];
			$aspected = MysticConstants::$eras[$aspect -1];
			if ($x == 4) { // Mars
				// $aspect = $G_PlanetPos[$x][4] + 3;
				$aspect = $G_varga[$x][$wpos] + 3;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
				// $aspect = $G_PlanetPos[$x][4] + 7;
				$aspect = $G_varga[$x][$wpos] + 7;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
			}
			if ($x == 5) { // Jupiter
				$aspect = $G_varga[$x][$wpos] + 4;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
				$aspect = $G_varga[$x][$wpos] + 8;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
			}
			if ($x == 6) { // Saturn
				$aspect = $G_varga[$x][$wpos] + 2;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
				$aspect = $G_varga[$x][$wpos] + 9;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
			}
			if (($x == 8) || ($x == 9)) { // Rahu or Ketu
				$aspect = $G_varga[$x][$wpos] + 4;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed = "".$newpos1;
				$planetsAspected = $hseCopy[$newpos1];
				$aspected = MysticConstants::$eras[$aspect -1];
				$aspect = $G_varga[$x][$wpos] + 8;
				if ($aspect > 12) $aspect = $aspect -12;
				$newpos = $aspect - $ascpos;
				$newpos1 = $this->recalibrate($newpos);
				$housed .= ", ".$newpos1;
				$planetsAspected .= $hseCopy[$newpos1];
				$aspected .= ", ".MysticConstants::$eras[$aspect -1];
			}
			$xhtm2 .= $aspected;
			$xhtm2 .= "</td>";
			$xhtm2 .= "<td align='center'>";
			$xhtm2 .= $housed;
			$xhtm2 .= "</td>";
			$xhtm2 .= "<td align='center'>";
			$xhtm2 .= $planetsAspected;
			$xhtm2 .= "</td>";
			$xhtm2 .= "</tr>";
		}
		$xhtm2 .= "</table>";
		return $xhtm2;
	}
	function recalibrate($xpos) {
		$newhse = $xpos + 1;
		if ($newhse < 0) $newhse = $newhse + 12;
		if ($newhse == 0) $newhse = 12;
		return $newhse;
	}

}
?>
