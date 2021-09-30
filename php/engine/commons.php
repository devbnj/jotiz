<?php
function refigure($xpos, $by) {
	$newpos = $xpos + $by;
	if ($newpos > 12) $newpos = $newpos - 12 + 1;
	return $newpos;
}
function recalibrate($xpos) {
    $newhse = $xpos + 1;
    if ($newhse < 0) $newhse = $newhse + 12;
    if ($newhse == 0) $newhse = 12;
    return $newhse;
}
function getRasi( $len ) {
    return( (int)( red_deg( $len ) / 30 )  );
}

function red_deg( $input ) {
  return (double)a_red($input, 360);
}
function a_red( $x, $a ) {
    return (double)( $x - floor( $x / $a ) * $a );
}
function JulianDay($d, $m, $y) {
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
function FractionReal($x) {
   $i = 0;
   $y = 0.0;
   // if ($x < 0) return $x - floor($x) + 1;
   return $x - (int)($x);
}

function isPushkara($nno, $npada) {
    $pushkar = false;
    switch ($nno) {
    	case 6: // Ardra, Swati, Satabhishag Ruled by Rahu
    	case 15:
    	case 24: {
    		if ($npada == 4) $pushkar = true; break;
    	}
    	case 4: // Rohini, Hasta, Shravana (moon)
    	case 13:
    	case 22: {
    		if ($npada == 2) $pushkar = true; break;
    	}
    	case 3: // All Sun
    	case 10:
    	case 21: {
    		if (($npada == 1) || ($npada == 4)) $pushkar = true; break;
    	}	
    	case 7: // All Jupiter
    	case 16:
    	case 25: {
    		if (($npada == 2) || ($npada == 4)) $pushkar = true; break;
    	}
    	case 8: // All Saturn
    	case 17:
    	case 26: {
    		if ($npada == 2) $pushkar = true; break;
    	}
    	case 2: // All Venus
    	case 11:
    	case 20: {
    		if ($npada == 3) $pushkar = true; break;
    	}
    	// Mercury and Mars do no form a pushkara navamsa
    }  
    return $pushkar;
} 
function setTheHouses($dno, $g_varga, $g_planetpos, &$G_House, &$G_SHouse, $plnt=NULL, $showdegrees=FALSE, $G_LagnaDeg=0) {
		$npos = 1;
		$apos = $g_varga[0][$dno];
		for ($y = 1; $y <= 12; $y++) {
    		$G_House[$y] = "";
    		$G_SHouse[$y] = "";
		}
		if ($showdegrees) {
			$G_House[1] = "As ".sprintf("%2.0f°<br />", ($G_LagnaDeg - (floor($G_LagnaDeg / 30)*30)));
			$G_SHouse[$ascpos] = "As ".sprintf("%2.0f°<br />", ($G_LagnaDeg - (floor($G_LagnaDeg / 30)*30)));
		} else {
			$G_House[1] = "As <br />";
			$G_SHouse[$apos] = "As <br />";
		}
		$YMAX = 12; 
		for ($y = 1; $y <= $YMAX; $y++) {
			$npos = 1;
			$npos = $g_varga[$y][$dno] - $apos;
			$npos1 = recalibrate($npos);
			$tmpstr = $G_House[$npos1];
			$G_House[$npos1] .= sprintf("%2.2s",MysticConstants::$graha[$y]);
			if ($g_planetpos[$y][8] == "Ret") $G_House[$npos1] .= "<sup>R</sup>"; 
			if ($showdegrees) $G_House[$npos1] .= " ".sprintf("%2.0f°<br />",$plnt[$y] - (floor($plnt[$y] / 30)*30)); else $G_House[$npos1] .= "<br />";
			// Southern style
			$G_SHouse[$g_varga[$y][$dno]] .= " ".sprintf("%2.2s",MysticConstants::$graha[$y]);
			if ($g_planetpos[$y][8] == "Ret") $G_SHouse[$g_varga[$y][$dno]] .= "<sup>R</sup>"; 
			if ($showdegrees) $G_SHouse[$g_varga[$y][0]] .= " ".sprintf("%2.0f°<br />",$plnt[$y] - (floor($plnt[$y] / 30)*30)); else $G_SHouse[$g_varga[$y][0]] .= "<br />"; 
		}
}

function setHoraChart(&$ascpos, $G_LagnaDeg, $G_LagnaNum, $G_PlanetPos, &$G_House, &$G_SHouse) {
	for ($y = 1; $y <= 12; $y++) {
		$G_House[$y] = "";
		$G_SHouse[$y] = "";
	}
	$dgs = ($G_LagnaDeg - (floor($G_LagnaDeg / 30)*30));
	$horamoon = 1; // set to moon;
	$horasun = 12;
	if ($G_LagnaNum % 2 == 0) { // even sign
		if ($dgs <= 15) {
			$ascpos = 4; // cancer
			$horamoon = 1;
			$horasun = 2;
		}
		else {
			$ascpos = 5; // leo
			$horasun = 1;
			$horamoon = 12;
		}
	} else { // odd sign
		if ($dgs <= 15) {
			$ascpos = 5; // leo
			$horasun = 1;
			$horamoon = 12;
		}
		else {
			$ascpos = 4; // cancer
			$horamoon = 1;
			$horasun = 2;
		}
	}
	for ($x = 1; $x <= 12; $x++) {
		$dgs = $G_PlanetPos[$x][2];
		if ($G_PlanetPos[$x][4] % 2 == 0) { // even sign
			// 1st hora is ruled by moon - in even signs
			if ($dgs <= 15) { $G_House[$horamoon] .= "<span style='color:blue'>".$G_PlanetPos[$x][1]."</span><br />"; }
			else $G_House[$horasun] .= "<span style='color:red'>".$G_PlanetPos[$x][1]."</span><br />";
		} else { // odd sign
			// 1st hora is ruled by sun - in odd signs
			if ($dgs <= 15) $G_House[$horasun] .= "<span style='color:red'>".$G_PlanetPos[$x][1]."</span><br />";
			else $G_House[$horamoon] .= "<span style='color:blue'>".$G_PlanetPos[$x][1]."</span><br />";
		}
	}
	$G_SHouse[4] = $G_House[$horamoon];
	$G_SHouse[5] = $G_House[$horasun];
}

function setCuspalChart($G_varga, &$G_House, &$G_SHouse, $G_BhavaChalit, $G_PlanetPos, $plnt, $G_LagnaDeg, $G_HouseBhava) {
	// Cuspal Chart
	// Bhava Chalit Charts
	$apos = $G_varga[0][0];
	$npos = 1;
	$G_SHouse[$apos] = "Asc ".sprintf("%2.0f°<br />", ($G_LagnaDeg - (floor($G_LagnaDeg / 30)*30)));
	for ($y = 1; $y <= 12; $y++) {
    	$npos = 1;
    	$npos = $G_BhavaChalit[$y][2] - $apos;
    	$npos1 = recalibrate($npos);
    	$tmpstr = $G_House[$npos1];
    	$G_House[$npos1] .= sprintf("%2.2s",MysticConstants::$graha[$y]);
		if ($G_PlanetPos[$y][8] == "Ret") $G_House[$npos1] .= "<sup>R</sup>";
		$G_House[$npos1] .= " ".sprintf("%2.0f°<br />",$plnt[$y] - (floor($plnt[$y] / 30)*30));
    	
		$bvpos = (int)$G_BhavaChalit[$y][2];
    	$G_SHouse[$bvpos] .= sprintf("%2.2s",MysticConstants::$graha[$y]);
		if ($G_PlanetPos[$y][8] == "Ret") $G_SHouse[$bvpos] .= "<sup>R</sup>";
		$G_SHouse[$bvpos] .= " ".sprintf("%2.0f°<br />",$plnt[$y] - (floor($plnt[$y] / 30)*30));
	}
	// Put the Mid Heavens in the text
	$chtype .= "<span style='color:blue; font-size:10px;'>";
	for ($zy = 0; $zy <= 11; $zy++) {
		$chtype .= ($zy + 1)."-".$G_HouseBhava[$zy]."<br />";
	}
	$chtype .= "</span>";
}

function setNaadiChart($G_varga, $G_LagnaDeg, $G_PlanetPos, &$G_House, &$G_SHouse, $plnt) {
	// Naadi Chart as stated by Narasimha Alse
	$apos = $G_varga[0][0];
	$npos = 1;
	$G_SHouse[$apos] = "Asc ".sprintf("%2.0f°<br />", ($G_LagnaDeg - (floor($G_LagnaDeg / 30)*30)));
	for ($y = 1; $y <= 12; $y++) {
		$npos = 1;
		if ($G_PlanetPos[$y][8] == "Retrograde") {
			$rps = $G_varga[$y][0] - 1;
			if ($rps <= 0) $rps = 12;
		} else
		$rps = $G_varga[$y][0];

		$npos = $rps - $apos;
		$npos1 = recalibrate($npos);
		$tmpstr = $G_House[$npos1];
		$G_House[$npos1] .= sprintf("%2.2s",MysticConstants::$graha[$y]);
		if ($G_PlanetPos[$y][8] == "Ret") $G_House[$npos1] .= "<sup>R</sup>";
		$G_House[$npos1] .= " ".sprintf("%2.0f°<br />",$plnt[$y] - (floor($plnt[$y] / 30)*30));
		
		$G_SHouse[$rps] .= sprintf("%2.2s",MysticConstants::$graha[$y]);
		if ($G_PlanetPos[$y][8] == "Ret") $G_SHouse[$rps] .= "<sup>R</sup>";
		$G_SHouse[$rps] .= " ".sprintf("%2.0f°<br />",$plnt[$y] - (floor($plnt[$y] / 30)*30));
	}
}

function showBalDasa ($bd) {
	print '<span class="xr_s33" style="position: absolute; left:59px; top:14px;">';
	print '<span class="xr_tl" style="font-size:80%">Balance Dasa: '. $db .'</span>';
	print '</span>';
}

function DegreeDiff($degree1, $degree2) {
    $diff = 0.0;
    $diff = $degree2 - $degree1;
    return $diff;
}
?>