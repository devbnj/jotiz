<?php
require_once "constants.php";
switch ($a) { // { rasis }
	case 1: // { Aries }
	{
		if ($i == 1) { // { Sun 0 }
			$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 4)  { // { Mars 1 }
			if ($degrees > 12)
			$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 3)  { 
			$zwhtype = MysticConstants::$IDETRI;
		}
		if ($i == 4)  { // { Mars 1 }
		  	if ($degrees <= 12)
				$zwhtype = MysticConstants::$IMT;
		}
		if ($i == 6) { // { Saturn }
			$zwhtype = MysticConstants::$IFALL;
		}
	}
	break;
	case 2: // { Taurus }
	{
		if ($i == 3) { $zwhtype = MysticConstants::$IOWNHOUSE; }
		if ($i == 4) { $zwhtype = MysticConstants::$IDETRI; }
		if ($i == 7) { // { Moon 0 }
				$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 7) { // { Moon 0 }
		  	if ($degrees <= 27)
				$zwhtype = MysticConstants::$IMT;
		}
	}
	break;
	case 3: // { Gemini }
	{
		if ($i == 2)  // { Mercury 1 }
			$zwhtype = MysticConstants::$IOWNHOUSE;
		if ($i == 5) { $zwhtype = MysticConstants::$IDETRI; }
		if ($i == 8) { $zwhtype = MysticConstants::$IEXALT; }
		if ($i == 9) { $zwhtype = MysticConstants::$IFALL; }
	}
	break;
	case 4: // { Cancer }
	{
		if ($i == 5) { // { Jupiter 0 }
		  	if ($degrees <= 5)
				$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 6) { $zwhtype = MysticConstants::$IDETRI; }
		if ($i == 7)  // { Moon 1 }
			$zwhtype = MysticConstants::$IOWNHOUSE;
		if ($i == 4) { // { Mars }
			$zwhtype = MysticConstants::$IFALL;
		}
	}
	break;
	case 5: // { Leo }
	{
		if ($i == 1) { // { Sun 1 }
			if ($degrees > 20)
			$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 1) { // { Sun 1 }
		  	if ($degrees <= 20)
				$zwhtype = MysticConstants::$IMT;
		}
		if ($i == 11) { $zwhtype = MysticConstants::$IEXALT; }
		if ($i == 12) { $zwhtype = MysticConstants::$IFALL; }
		if ($i == 10) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
	case 6: // { Virgo }
	{
		if ($i == 2) { // { Mercury 0 }
			$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 3) { // { Venus }
			$zwhtype = MysticConstants::$IFALL;
		}
		if ($i == 2) { // { Mercury 0 }
		  	if ($degrees <= 20)
				$zwhtype = MysticConstants::$IMT;
		}
		if ($i == 2) { // { Mercury 0 }
		  	if ($degrees > 20)
				$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 11) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
	case 7: // { Libra }
	{
		if ($i == 6) { // { Saturn 0 }
			$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 3) { // { Venus 1 }
		  	if ($degrees > 20)
			$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 3) { // { Venus 1 }
		  	if ($degrees <= 20)
			$zwhtype = MysticConstants::$IMT;
		}
		if ($i == 1) { // { Sun }
			$zwhtype = MysticConstants::$IFALL;
		}
		if ($i == 4) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
	case 8: // { Scorpio }
	{
		if ($i == 4) { // { Mars 2 }
			$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 7) { // { Moon }
			$zwhtype = MysticConstants::$IFALL;
		}
		if ($i == 10) { $zwhtype = MysticConstants::$IEXALT; }
		if ($i == 3) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
	case 9: // { Sagitarrius }
	{
		if ($i == 5) {  // { Jupiter 1 }
		  	if ($degrees > 10)
			$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 5) {  // { Jupiter 1 }
		  	if ($degrees <= 10)
			$zwhtype = MysticConstants::$IMT;
		}
		if ($i == 9) { $zwhtype = MysticConstants::$IEXALT; }
		if ($i == 2) { $zwhtype = MysticConstants::$IDETRI; }
		if ($i == 8) { $zwhtype = MysticConstants::$IFALL; }
	}
	break;
	case 10: // { Capricorn }
	{
		if ($i == 4) {  // { Mars 0 }
			$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 5) { // { Jupiter }
			$zwhtype = MysticConstants::$IFALL;
		}
		if ($i == 6) { $zwhtype = MysticConstants::$IOWNHOUSE; }
		if ($i == 7) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
	case 11: // { Aquarius }
	{
		if ($i == 6) { // { Saturn 2 }
		  	if ($degrees > 5)
			$zwhtype = MysticConstants::$IOWNHOUSE;
		}
		if ($i == 6) { // { Saturn 2 }
		  	if ($degrees <= 5)
			$zwhtype = MysticConstants::$IMT;
		}
		if ($i == 12) { $zwhtype = MysticConstants::$IEXALT; }
		if ($i == 1) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
	case 12: // { Pisces }
	{
		if ($i == 5)   // { Jupiter 2 }
			$zwhtype = MysticConstants::$IOWNHOUSE;
		if ($i == 3) { // { Venus }
			$zwhtype = MysticConstants::$IEXALT;
		}
		if ($i == 2) { // { Mercury }
			$zwhtype = MysticConstants::$IFALL;
		}
		if ($i == 2) { $zwhtype = MysticConstants::$IDETRI; }
	}
	break;
}
?>