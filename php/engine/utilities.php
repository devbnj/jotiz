<?php

require_once 'jotiz.php';

class Utilities {
	protected $m;
	public $nakshatra = -1;
	public $nakPada = -1;
	public $zodiacSign = -1;
	public $navamsa = -1;
	
	public function getMystic() {
		return $m;
	}

	public function setMystic(Mystic $m) {
		$this->m = $m;
	}
	
	public function isMalefic($celestialBody) {
		if (($celestialBody == MysticConstants::$_SUN ) ||
		($celestialBody == MysticConstants::$_SAT) ||
		($celestialBody == MysticConstants::$_MAR) ||
		($celestialBody == MysticConstants::$_RAH) ||
		($celestialBody == MysticConstants::$_KET) ||
		($celestialBody == MysticConstants::$_URA)) return true;
		else return false;
	}

	public function recalculate($celestialBody) {
		$position = (double) $this->m->plnt[$celestialBody];
		$d2 = 13.33333333333333;
		$d1 = 3.333333333333333;
	
		$this->nakshatra = (int)($position / $d2);
		$this->nakPada = (int)($position / $d1) % 4 + 1;
		$this->zodiacSign = (int)($position / 30.0);
		$this->navamsa = (int)($position / 3.333333) % 12;
	}
	
	public function whatDoshaSign($sign) {
		$dosha = 0;
		switch ($sign) {
			case 3:
			case 6:
			case 11: $dosha = MysticConstants::$_VATA; break;
			case 1:
			case 5:
			case 9: $dosha = MysticConstants::$_PITTA; break;
			default: $dosha = MysticConstants::$_KAPHA; break;
		}
		return $dosha;
	}
	
	public function whatDoshaGraha($graha) {
		$dosha = 0;
		switch ($graha) {
			case MysticConstants::$_SUN:
			case MysticConstants::$_MAR:
			case MysticConstants::$_KET: $dosha = MysticConstants::$_PITTA; break;
			case MysticConstants::$_SAT:
			case MysticConstants::$_JUP:
			case MysticConstants::$_RAH: $dosha = MysticConstants::$_VATA; break;
			case MysticConstants::$_MON:
			case MysticConstants::$_VEN:
			case MysticConstants::$_MER: $dosha = MysticConstants::$_KAPHA; break;
			default: break;
		}
		return $dosha;
	}

	public function safeHarbor($xpos) {
		$newhse = $xpos + 1;
		if ($newhse < 0) $newhse = $newhse + 12;
		if ($newhse == 0) $newhse = 12;
		return $newhse;
	}

	public function signToHouse($sign) {
		$newhse = $sign - $this->m->G_LagnaNum;
		if ($newhse < 0) $newhse = $newhse + 12;
		if ($newhse == 0) $newhse = 12;
		return $newhse;
	}
	
	public function houseToSign($hse) {
		$sign = $hse + $this->m->G_LagnaNum - 1;
		if ($sign > 12) $sign -= 12;
		return $sign;
	}
	
	public function inSign($cbody) {
		$this->recalculate($cbody);
		return MysticConstants::$ras[$this->zodiacSign];
	}
	
	public function inOddsign($celestialBody) {
		if ($this->m != null) {
			$this->recalculate($celestialBody);
			// check the divisibility by two
			return (($this->zodiacSign + 1) % 2 != 0);
		}
		return false;
	}
	
	public function inEvensign($celestialBody) {
		return !($this->inOddsign($celestialBody));
	}
	
	public function celestialBodyInHouse($celestialBody) {
		if ($this->m != null) {
			$this->recalculate($celestialBody);
			return $this->safeHarbor
			($this->zodiacSign + 1 - $this->m->G_LagnaNum);
		}
		return -1;
	}

	public function lordOfHouseInSign($house) {
		// determine the house lord
		$lord = $this->lordOf($house);
		// calculate the sign it is in
		$this->recalculate($lord);
		// the sign value is 0 to 11 and 1 to 12
		// must increment if just printing the number
		return $this->zodiacSign;
	}

	public function lordInHouse($house) {
		// return the house the lord of the house is in
		// remember to increment the sign by 1
		$lagna = $this->m->G_LagnaNum;
		return $this->safeHarbor
		($this->lordOfHouseInSign($house) - $lagna);
	}
	
	public function lordOf($house) {
		// get the Rasi from the house
		$lagna = $this->m->G_LagnaNum;
		$sign = $house + $lagna - 1;
		if ($sign > 12) $sign = $sign - 12;
		// get the lordship from the sign
		return MysticConstants::$iruler[$sign - 1];
	}
	
	public function isLordOfHouse($celestialBody, $house) {
		// get the sign from the house
		$lagna = $this->m->G_LagnaNum;
		$sign = $house + $lagna - 1;
		if ($sign > 12) $sign = $sign - 12;
		// see if the array lordship is the celestialBody
		return (MysticConstants::$iruler[$sign - 1] == $celestialBody);
	}
	
	public function isInHouse($celestialBody, $house) {
		if ($this->m != null) {
			$lagna = $this->m->G_LagnaNum;
			$this->recalculate($celestialBody);
			// see if the signtohouse points to the house
			return ($this->safeHarbor($this->zodiacSign + 1 - $lagna) == $house);
		}
		return false;
	}
	
	public function isLordOfSignInHouse($sign, $house) {
		// Find the Lord of the Rasi first
		$lord = MysticConstants::$iruler[$sign -1];
		// Return whether the
		// lord is in the house
		return $this->isInHouse($lord, $house);
	}
	
	public function isLordOfHouseInHouse($house1, $house2) {
		// From the house1 get the sign (Rasi)
		$asc = $this->m->G_LagnaNum;
		$sign = $house1 + $asc - 1;
		if ($sign > 12) $sign = $sign - 12;
		// Once the Rasi is found,
		// determine who the lord is
		$lord = MysticConstants::$iruler[$sign - 1];
		// Return whether the lord is in house2
		return $this->isInHouse($lord, $house2);
	}
	
	public function isExchange($house1, $house2) {
		// check if the lord of house 1 is in house 2
		// and house2 in house1
		return ($this->isLordOfHouseInHouse($house1, $house2)
				&& $this->isLordOfHouseInHouse($house2, $house1));
	}
	
	public function whichHouse($fromGraha, $targetGraha) {
		// Determine the Rasi of from Graha
		$this->recalculate($fromGraha);
		$fromSign = $this->zodiacSign;
		// Determine the Rasi of Target Graha
		$this->recalculate($targetGraha);
		$targetSign = $this->zodiacSign;
		// convert the difference between them to a house number
		return $this->safeHarbor($targetSign - $fromSign);
	}
	
	public function whoisLordInHouseFromHouse($fromHouse, $toHouse) {
		// Determine the target house location
		$relPos = $fromHouse + $toHouse - 1;
		if ($relPos > 12) $relPos = $relPos - 12;
		return $this->lordOf($relPos);
	}
	
	public function whoIsDepositor($house) {
		$lord = $this->lordOf($house);
		$this->recalculate($lord);
		return MysticConstants::$iruler[$this->zodiacSign];
	}
	
	public function inAngle($celestialBody) {
		$house =
		$this->celestialBodyInHouse($celestialBody);
		return (($house == 1) ||
				($house % 3 == 1)) ? true : false;
	}
	
	public function inTrine($celestialBody) {
		$house =
		$this->celestialBodyInHouse($celestialBody);
		return (($house == 1) || ($house == 5) ||
				($house == 9)) ? true : false;
	}
	public function isMovable($sign) {
		return ($sign == 1) ||
		($sign % 3 == 1) ? true : false;
	}
	
	public function isFixed($sign) {
		return ($sign == 2) ||
		($sign % 3 == 2) ? true : false;
	}
	
	public function isDual($sign) {
		return ($sign % 3 == 0)
		? true : false;
	}
	
	public function isExalted($heavenlyBody) {
		$this->recalculate($heavenlyBody);
		return ($heavenlyBody == MysticConstants::$iexalt[$this->zodiacSign]);
	}
	
	public function isDebilitated($heavenyBody) {
		$this->recalculate($heavenyBody);
		return ($heavenyBody == MysticConstants::$ifall[$this->zodiacSign]);
	}
	
	public function isCombust($heavenlyBody) {
		$degs = $this->m->degreeDifference
		($this->m->plnt[$heavenlyBody],
		$this->m->plnt[MysticConstants::_SUN]);
		return (($degs >= -8) && ($degs <= 8)) ? true : false;
	}

	public function inAnglefromSign($fromSign, $celestialBody) {
		$this->recalculate($celestialBody);
		$hse = $this->safeHarbor($this->zodiacSign + 1 - $fromSign);
		return (($hse % 3 == 1) || ($hse == 1)) ? true : false;
	}
	
	public function inAnglefromHouse($fromHouse, $celestialBody) {
		$houseEnd =
		$this->celestialBodyInHouse($celestialBody);
		$hse = $this->safeHarbor($houseEnd - $fromHouse);
		return (($hse % 3 == 1) || ($hse == 1)) ? true : false;
	}

	public function inAnglefromCelestialBody($fromcelestialBody, $tocelestialBody) {
		$house1 = $this->celestialBodyInHouse($fromcelestialBody);
		$house2 = $this->celestialBodyInHouse($tocelestialBody);
		$hse = $this->safeHarbor($house2 - $house1);
		return (($hse % 3 == 1) || ($hse == 1)) ? true : false;
	}
	
	public function posfromSign($fromSign, $celestialBody) {
		$this->recalculate($celestialBody);
		return $this->safeHarbor($this->zodiacSign + 1 - $fromSign);
	}
	
	public function posfromHouse($fromHouse, $heavenlyBody) {
		$houseEnd = $this->celestialBodyInHouse($heavenlyBody);
		return $this->safeHarbor($houseEnd - $fromHouse);
	}
	
	public function posfromcelestialBody($fromcelestialBody,
			$tocelestialBody) {
		$house1 = $this->celestialBodyInHouse($fromcelestialBody);
		$house2 = $this->celestialBodyInHouse($tocelestialBody);
		return $this->safeHarbor($house2 - $house1);
	}
	
	public function inTrinefromSign($fromSign, $celestialBody) {
		$this->recalculate($celestialBody);
		$hse = $this->safeHarbor($this->zodiacSign + 1 - $fromSign);
		return (($hse == 5) || 	($hse == 9)) ? true : false;
	}
	
	public function inTrinefromHouse($fromHouse, $graha) {
		$houseEnd = $this->celestialBodyInHouse($graha);
		$hse = $this->safeHarbor($houseEnd - $fromHouse);
		return (($hse == 5) || ($hse == 9)) ? true : false;
	}
	
	public function inTrinefromHeavenlyBody($fromheavenlyBody, $toheavenlyBody) {
		$house1 = $this->celestialBodyInHouse($fromheavenlyBody);
		$house2 = $this->celestialBodyInHouse($toheavenlyBody);
		$hse = $this->safeHarbor($house2 - $house1);
		return (($hse == 5) || ($hse == 9)) ? true : false;
	}
	
	public function isMoonWaning() {
		return ($this->m->G_LunarDay > 15);
	}
	
	public function isFullMoon() {
		return ($this->m->G_LunarDay >= 14
				&& $this->m->G_LunarDay <= 16);
	}
	
	public function isConjoined($graha1, $graha2) {
		return ($this->m->G_varga[$graha1][0] ==
				$this->m->G_varga[$graha2][0]);
	}
	
	private function degreeDiff($hbody1, $hbody2, $degs, $tolerance) {
		$result = $this->m->plnt[$hbody1] - $this->m->plnt[$hbody2];
		if ($result < 0) $result += 360.0;
		return ((($degs - $tolerance) <= $result) &&
				(($degs + $tolerance) >= $result));
	}

	public function isWesternAspect($hbody1, $hbody2, $aspect) {
		return $this->degreeDiff($hbody1, $hbody2, $aspect, 3);
	}

	public function isFruitfulHouse($hse) {
		$sign = $this->houseToSign($hse);
		return ($sign == 4 || $sign == 8 || $sign == 12);
	}
	
	public function isBarrenHouse($hse) {
		$sign = $this->houseToSign($hse);
		return ($sign == 3 || $sign == 5 || $sign == 6);
	}

	public function isBeneficInHouse($hse) {
		for ($i = 1; $i < 10; $i++) {
			// ignore the nodes
			if (($i == 8) || ($i == 9)) continue;
			// ignore malefics
			if ($this->isMalefic($i)) continue;
			if ($this->isInHouse($i, $hse)) return true;
		}
		return false;
	}
	
	public function isMaleficInHouse($hse) {
		for ($i = 1; $i < 10; $i++) {
			// ignore the nodes
			if (($i == 8) || ($i == 9)) continue;
			// ignore benefics
			if (!$this->isMalefic($i)) continue;
			if ($this->isInHouse($i, $hse)) return true;
		}
		return false;
	}
	
}

class JyotishUtilities extends Utilities {
	
	public $dhoomSign = -1;
	public $vyatipatSign = -1;
	public $pariveshSign = -1;
	public $chapaSign = -1;
	public $upaketuSign = -1;
	
	private function fixdegs($tmppos) {
		if ($tmppos > 360) $tmppos = ($tmppos - 360)/30;
		else if ($tmppos < 0) $tmppos = ($tmppos + 360)/30;
		else $tmppos = $tmppos/30;
		return (int)$tmppos;
	}
	
	public function checkNonLuminous() {
		$dpos = $this->m->plnt[1] + 133.333333333;
		$this->dhoomSign = $this->fixdegs($dpos);
		$vpos = 360 - 133.33333333 - $this->m->plnt[1];
		$this->vyatipatSign = $this->fixdegs($vpos);
		$ppos = 180 - 133.33333333 - $this->m->plnt[1];
		$this->pariveshSign = $this->fixdegs($ppos);
		$tmppos = $this->m->plnt[1] + 313.333333333;
		$this->chapaSign = $this->fixdegs($tmppos);
		$tmppos = $this->m->plnt[1] + 330.0000;
		$this->upaketuSign = $this->fixdegs($tmppos);
	}
	
	public function inMoolaTrikona($graha) {
		if ($this->m != null) {
			$this->recalculate($graha);
			return (MysticConstants::$imtrik[$this->zodiacSign] == $graha);
		}
		return false;
	}
	
	public function inOwnHouse($graha) {
		if ($this->m != null) {
			$this->recalculate($graha);
			return (MysticConstants::$iruler[$this->zodiacSign] == $graha);
		}
		return false;
	}
	
	public function inDebilitationNavamsa($graha) {
		if ($this->m != null) {
			$this->recalculate($graha);
			// Determine if the array points to the graha
			return (MysticConstants::$ifall[$this->navamsa] == $graha);
		}
		return false;
	}

	public function inExaltationNavamsa($graha) {
		if ($this->m != null) {
			$this->recalculate($graha);
			// Determine if the
			// array points to the graha
			return (MysticConstants::$iexalt[$this->navamsa] == $graha);
		}
		// if jotiz is null - just return false
		return false;
	}

	public function inOwnHouseNavamsa($graha) {
		if ($this->m != null) {
			$this->recalculate($graha);
			return (MysticConstants::$iruler[$this->navamsa] == $graha);
		}
		return false;
	}
	
	public function inKendra($graha) {
		return $this->inAngle($graha);
	}
	
	public function inKona($graha) {
		return $this->inTrine($graha);
	}
	
	public function inEnemyRasi($graha) {
		// recalculate the stats for the graha
		$this->recalculate($graha);
		$enemy = false;
		$sign = $this->zodiacSign + 1;
		// check graha and rasi
		// moon has no enemies
		switch ($graha) {
			case (MysticConstants::$_SUN) : 
				$enemy = ($sign == 7) || ($sign == 2) || ($sign == 10) || ($sign == 11);
				break;
			case MysticConstants::$_MER: 
				$enemy = ($sign == 4);
				break;
			case MysticConstants::$_VEN: 
				$enemy = ($sign == 4) || ($sign == 5);
				break;
			case MysticConstants::$_MAR: 
				$enemy = ($sign == 3) || ($sign == 6);
				break;
			case MysticConstants::$_JUP: 
				$enemy = ($sign == 3) || ($sign == 6);
				break;
			case MysticConstants::$_SAT: 
				$enemy = ($sign == 4) || ($sign == 5) || ($sign == 1) || ($sign == 8);
				break;
			default: break;
		}
		return $enemy;
	}
	
	public function inFriendlyRasi($graha) {
		// recalculate the stats for the graha
		$this->recalculate($graha);
		$friend = false;
		$sign = $this->zodiacSign + 1;
		// check graha and rasi
		switch ($graha) {
			case MysticConstants::$_SUN: 
				$friend = ($sign == 4) || ($sign == 1) || ($sign == 8) || ($sign == 9) || ($sign == 12);
				break;
			case MysticConstants::$_MER: 
				$friend = ($sign == 5) || ($sign == 2) || ($sign == 7);
				break;
			case MysticConstants::$_VEN: 
				$friend = ($sign == 3) || ($sign == 6) || ($sign == 10) || ($sign == 11);
				break;
			case MysticConstants::$_MAR: 
				$friend = ($sign == 5) || ($sign == 4) || ($sign == 9) || ($sign == 12);
				break;
			case MysticConstants::$_JUP: 
				$friend = ($sign == 4) || ($sign == 5) || ($sign == 1) || ($sign == 8);
				break;
			case MysticConstants::$_SAT: 
				$friend = ($sign == 3) || ($sign == 6) || ($sign == 2) || ($sign == 7);
				break;
			case MysticConstants::$_MON: 
				$friend = ($sign == 3) || ($sign == 6) || ($sign == 5);
				break;
			default: break;
		}
		return $friend;
	}
	
	public function inUpachaya($rasi) {
		$hse = $this->safeHarbor($rasi);
		return ($hse == 3 || $hse == 6 || $hse == 10 || $hse == 11);
	}
	
	public function inDusthana($graha) {
		$house = $this->celestialBodyInHouse($graha);
		return (($house == 6) || ($house == 8) || ($house == 12)) ? true : false;
	}
	
	public function isGrahaAspect($grahaAspecting, $grahaAspected) {
		if (($grahaAspecting == MysticConstants::$_RAH)
		|| ($grahaAspecting == MysticConstants::$_KET))
			return false;
		$house1 = $this->celestialBodyInHouse($grahaAspecting);
		$house2 = $this->celestialBodyInHouse($grahaAspected);
		$hse = $this->safeHarbor($house2 - $house1);
		if ($grahaAspecting == MysticConstants::$_MAR) {
			return ($hse == 7) || ($hse == 4) || ($hse == 8);
		} else if ($grahaAspecting == MysticConstants::$_JUP) {
			return ($hse == 7) || ($hse == 5) || ($hse == 9);
		} else if ($grahaAspecting == MysticConstants::$_SAT) {
			return ($hse == 7) || ($hse == 3) || ($hse == 10);
		} else return ($hse == 7);
		// all others aspect the 7th house
	}

	public function isGrahaAspectHouse($grahaAspecting, $houseAspected) {
		if (($grahaAspecting == MysticConstants::$_RAH)
		|| ($grahaAspecting == MysticConstants::$_KET))
			return false;
		$house1 = $this->celestialBodyInHouse($grahaAspecting);
		$hse = $this->safeHarbor($houseAspected - $house1);
		if ($grahaAspecting == MysticConstants::$_MAR) {
			return ($hse == 7) || ($hse == 4) || ($hse == 8);
		} else if ($grahaAspecting == MysticConstants::$_JUP) {
			return ($hse == 7) || ($hse == 5) || ($hse == 9);
		} else if ($grahaAspecting == MysticConstants::$_SAT) {
			return ($hse == 7) || ($hse == 3) || ($hse == 10);
		} else return ($hse == 7);
		// all others aspect the 7th house
	}
	
	public function isGrahaAspectRasi($grahaAspecting, $rasiAspected) {
		if (($grahaAspecting == MysticConstants::$_RAH)
		|| ($grahaAspecting == MysticConstants::$_KET))
			return false;
		$house1 = $this->celestialBodyInHouse($grahaAspecting);
		$lagna = $this->m->G_LagnaNum;
		$house2 = $this->safeHarbor($rasiAspected - $lagna);
		$hse = $this->safeHarbor($house2 - $house1);
		if ($grahaAspecting == MysticConstants::$_MAR) {
			return ($hse == 7)
			|| ($hse == 4) || ($hse == 8);
		} else if ($grahaAspecting == MysticConstants::$_JUP) {
			return ($hse == 7)
			|| ($hse == 5) || ($hse == 9);
		} else if ($grahaAspecting == MysticConstants::$_SAT) {
			return ($hse == 7)
			|| ($hse == 3) || ($hse == 10);
		} else return ($hse == 7);
		// all others aspect the 7th house
	}
	
	public function whatBasicAvastha($graha) {
		$result = -1;
		$this->recalculate($graha);
		$position = $this->m->plnt[$graha];
		$length = $position - ($this->zodiacSign * 30);
		if ((($this->zodiacSign+1) % 2) != 0) {
			// odd sign graha
			if ($length <= 6.0)
				$result = MysticConstants::$_BALA_AVASTHA;
			else if ($length > 6 && $length <= 12)
				$result = MysticConstants::$_KUMAR_AVASTHA;
			else if ($length > 12 && $length <= 18)
				$result = MysticConstants::$_YUVA_AVASTHA;
			else if ($length > 18 && $length <= 24)
				$result = MysticConstants::$_VRIDDHA_AVASTHA;
			else
				$result = MysticConstants::$_MRITYA_AVASTHA;
		} else {
			// even sign graha
			if ($length <= 6.0)
				$result = MysticConstants::$_MRITYA_AVASTHA;
			else if ($length > 6 && $length <= 12)
				$result = MysticConstants::$_VRIDDHA_AVASTHA;
			else if ($length > 12 && $length <= 18)
				$result = MysticConstants::$_YUVA_AVASTHA;
			else if ($length > 18 && $length <= 24)
				$result = MysticConstants::$_KUMAR_AVASTHA;
			else $result = MysticConstants::$_BALA_AVASTHA;
		}
		return $result;
	}

	public function isDefeated($graha) {
		// Sun, Moon,
		// Rahu and Ketu are exempted
		// from this rule
		if (($graha == MysticConstants::$_SUN)
		|| ($graha == MysticConstants::$_MON)
		|| ($graha == MysticConstants::$_RAH)
		|| ($graha == MysticConstants::$_KET))
			return false;
		$defeated = false;
		$gdegs = $this->m->plnt[$graha];
		for ($i=0; $i<10; $i++) {
			if (($i == MysticConstants::$_SUN)
			|| ($i == MysticConstants::$_MON)
			|| ($i == MysticConstants::$_RAH)
			|| ($i == MysticConstants::$_KET))
				continue;
			if (($graha != $i)
			&& (abs($this->m->plnt[$i] - $gdegs) <= 2.0)) {
				// graha Yuddha occurs
				if ($this->m->plnt[$i] < $gdegs)
					$defeated = true;
			}
		}
		return $defeated;
	}
	
	public function inSunsHora($graha) {
		$sign = (int) floor($this->m->plnt[$graha]/30.0);
		$degs = $this->m->plnt[$graha] - ($sign * 30.0);
		// System.out.println("$degs = "+$degs);
		$sign = $sign + 1;
		if (($sign % 2 != 0) && ($degs <= 15))
			return true;
		if (($sign % 2 == 0) && ($degs > 15))
			return true;
		return false;
	}
	
	public function inMoonsHora($graha) {
		return (!$this->inSunsHora($graha));
	}
	
	public function inGandhanta($graha) {
		$gan = false;
		$degs = $this->m->plnt[$graha];
		$gan = ($degs <= 3) || ($degs >= 357) 
		|| ($degs >= 117 && $degs <= 123) 
		|| ($degs >= 237 && $degs <= 243);
		return $gan;
	}
	
	public function isAspectedByBenefic($graha) {
		$result = false;
		for ($i = 1; $i < 10; $i++) {
			if ($i == $graha) continue;
			if ($this->isGrahaAspect($i, $graha)
			&& (!$this->isMalefic($i)))
				$result = true;
		}
		return $result;
	}
	
	public function isAspect($diff, $g) {
		if ($g == MysticConstants::$_MAR) {
			return ($diff == 7)
			|| ($diff == 4) || ($diff == 8);
		} else if ($g == MysticConstants::$_JUP) {
			return ($diff == 7)
			|| ($diff == 5) || ($diff == 9);
		} else if ($g == MysticConstants::$_SAT) {
			return ($diff == 7)
			|| ($diff == 3) || ($diff == 10);
		} else return ($diff == 7);
	}
	
	public function isHouseAspectedByBenefic($hse) {
		// ignore Rahu and Ketu
		for ($i = 1; $i < 8; $i++) {
			// we only need benefic
			if ($this->isMalefic($i)) continue;
			// found benefic
			$house1 = $this->celestialBodyInHouse($i);
			$diff = $this->safeHarbor($hse - $house1);
			if ($this->isAspect($diff, $i)) return true;
		}
		return false;
	}
	
	public function isHouseAspectedByMalefic($hse) {
		// ignore Rahu and Ketu
		for ($i = 1; $i < 8; $i++) {
			if (!$this->isMalefic($i)) continue;
			// found malefic
			$house1 = $this->celestialBodyInHouse($i);
			$diff = $this->safeHarbor($hse - $house1);
			if ($this->isAspect($diff, $i)) return true;
		}
		return false;
	}
	
	public function isAspectedByMalefic($graha) {
		$result = false;
		for ($i = 1; $i < 10; $i++) {
			if ($i == $graha) continue;
			if ($this->isGrahaAspect($i, $graha)
			&& ($this->isMalefic($i))) $result = true;
		}
		return $result;
	}
	
	public function isAspectedByLord($hse) {
		$lord = $this->lordOf($hse);
		$this->recalculate($lord);
		$lordSign = $this->zodiacSign + 1;
		$lordhse = $this->celestialBodyInHouse($lord);
		$diff = $this->safeHarbor($hse - $lordhse);
		if ($this->isAspect($diff, $lord)) 
			return true;
		else 
			return false;
	}
	
	public function isBeneficInHouse($hse) {
		// ignore Rahu, Ketu, Hershel
		for ($i = 1; $i < 8; $i++) {
			// ignore malefics
			if ($this->isMalefic($i)) continue;
			if ($this->isInHouse($i, $hse)) return true;
		}
		return false;
	}
	
	public function isMaleficInHouse($hse) {
		// ignore Rahu, Ketu, Hershel
		for ($i = 1; $i < 8; $i++) {
			// ignore benefics
			if (!$this->isMalefic($i)) continue;
			if ($this->isInHouse($i, $hse)) return true;
		}
		return false;
	}
	
	public function isSurroundedByMalefics($graha) {
		$bNext = false;
		$bPrev = false; 
		$bConj = false;
		$this->recalculate($graha);
		++$this->zodiacSign;
		$signNext = $this->zodiacSign + 1;
		if ($signNext > 12) $signNext -= 12;
		$signPrev = $this->zodiacSign - 1;
		if ($signPrev < 1) $signNext = 12;
		for ($i = 1; $i < 10; $i++) {
			if ($graha == $i) continue;
			if (((int)$this->m->G_varga[$i][0]
					== $signNext) && ($this->isMalefic($i)))
				$bNext = true;
			if (((int)$this->m->G_varga[$i][0]
					== $signPrev) && ($this->isMalefic($i)))
				$bPrev = true;
			if (((int)$this->m->G_varga[$i][0]
					== $this->zodiacSign) && ($this->isMalefic($i)))
				$bConj = true;
		}
		return ($bNext && $bPrev) || ($bNext && $bConj) || ($bPrev && $bConj);
	}
	
	public function isSurroundedByBenefics($graha) {
		$bNext = false;
		$bPrev = false; $bConj = false;
		$this->recalculate($graha);
		++$this->zodiacSign;
		$signNext = $this->zodiacSign + 1;
		if ($signNext > 12) $signNext -= 12;
		$signPrev = $this->zodiacSign - 1;
		if ($signPrev < 1) $signNext = 12;
		for ($i = 1; $i < 10; $i++) {
			if ($graha == $i) continue;
			if (((int)$this->m->G_varga[$i][0] == $signNext) &&
					(!$this->isMalefic($i))) $bNext = true;
			if (((int)$this->m->G_varga[$i][0] == $signPrev) &&
					(!$this->isMalefic($i))) $bPrev = true;
			if (((int)$this->m->G_varga[$i][0] == $this->zodiacSign) &&
					(!$this->isMalefic($i))) $bConj = true;
		}
		return ($bNext && $bPrev) || ($bNext && $bConj) || ($bPrev && $bConj);
	}
	
	public function isInOwnNavamsa($graha) {
		if ($this->m != null) {
			return ($this->m->G_varga[$graha][0] ==
					$this->m->G_varga[$graha][3]);
		}
		return false;
	}
	
}
