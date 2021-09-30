<?php
require_once 'constants.php';

class Cuspal {

	public function getCuspal($degrees, &$lordSign, &$lordStar, &$subLord, &$nvim) {
		$div12 = 360 / 12;
		$div27 = 360 / 27;
		$div108 = 360 / 108;
		$div279 = 360 / (27 * 9);
		
		$sign = floor($degrees / $div12);
		$lordSign = sprintf("%2.2s", MysticConstants::$rlord[$sign]);
		$nvimak = floor($degrees / $div27);
		$lordStar = MysticConstants::$naklords[$nvimak];
		$subl = array();
		$sum = 0;
		$cnt = 0;
		$nvimx = 0;
		$dg = 0;
		for ($i=0; $i<27; $i++){
			for ($j=0; $j<9; $j++) {
				$nvimx = $j + $cnt;
				if ($nvimx >= 9) $nvimx = $nvimx - 9;
				$gr = MysticConstants::$vimfactors[$nvimx];
				$dg = ($gr / 120 * $div27);
				$sum += $dg;
				$subl[] = $sum;
				if ($sum >= $degrees) {
					$subLord = MysticConstants::$vimplanets[$nvimx];
					$nvim = $nvimx;
					return $subl;
				}
			}
			++$cnt;
			if ($cnt >= 9) $cnt = 0;
		}
		return $subl;
	}
	
	public function getSubSub($nvim, $remaining, $unitWhich) {
		$sum = 0;
		$cnt = $nvim;
		$subsub = "";
		$nvimx = 0;
		$dg = 0;
		for ($j=0; $j<9; $j++) {
			$nvimx = $j + $cnt;
			if ($nvimx >= 9) $nvimx = $nvimx - 9;
			$gr = MysticConstants::$vimfactors[$nvimx];
			$dg = ($gr / 120 * $unitWhich);
			// print "<br />*** ".$dg;
			$sum += $dg;
			if ($sum >= $remaining) {
				$subsub = MysticConstants::$vimplanets[$nvimx];
				$nvim = $nvimx;
				return $subsub;
			}
		}
		return $subsub;
	}
			
}


?>