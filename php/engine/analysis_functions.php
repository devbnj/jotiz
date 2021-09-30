<?php
	if (!isset($conn)) {
		$conn = db_connect();
	}
	
	// Return the sql result set as arrays
	function mysql_fetch_rowsarr($result, $numass=MYSQLI_BOTH) {
		$i=0;
  		$keys=array_keys(mysqli_fetch_array($result, $numass));
  		mysqli_data_seek($result, 0);
    	while ($row = mysqli_fetch_array($result, $numass)) {
      		foreach ($keys as $speckey) {
        		$got[$i][$speckey]=$row[$speckey];
      		}
    		$i++;
    	}
  		return $got;
	}

	// Search for planets in strings
	function seekPlanets ($instring, $outstring) {
		$tok1 = strtok($instring, " ,");
		if (!$tok1) return $outstring;
		while ($tok1) {
   			$token[] = $tok1;
   			$tok1 = strtok(" ,");
		}
		$resstring = "<span style='background-color:red;'><font color='white'>";
		for ($i=0; $i < count($token); $i++) {
    		$tok2 = strstr($outstring, $token[$i]);
    		if ($tok2) $resstring .= "*";
		}
		$resstring .= "</font></span>";
		return $resstring . $outstring;        	
	}
	
	function displayPlanets ($k0) {
		global $G_SHouse, $G_TSHouse, $data50, $G_houseArray, $G_JLagna;
        
		$xhtm2 = $data50[$k0]["sign_id"]." <b>".$data50[$k0]["sign"]."</b> <i>(".$data50[$k0]["meaning"].")</i> "; 
        $xhtm2 .= $data50[$k0]["type"]." - ".$data50[$k0]["sex"]." - ".$data50[$k0]["mobility"]." <i>(mobility)</i> - "; 
        $xhtm2 .= $data50[$k0]["height"]." <i>(height)</i> - ".$data50[$k0]["strong_during"]." <i>(strong at)</i> - ".$data50[$k0]["rise_by"]." <i>(rise by)</i> - "; 
        $xhtm2 .= $data50[$k0]["caste"]." <i>(caste) - ".$data50[$k0]["description"]."</i><br />";
        	
        $atpos = $G_JLagna;
    	$newpos = $k0 - $atpos + 2;
    	if ($newpos <= 0) $newpos = 12 + $newpos;
		
		$xhtm2 .= "<b>House " . $newpos . "</b><i>";
    	foreach ($G_houseArray as $key => $value) {
			if (($key >= (($newpos)*100)) && ($key <= (($newpos)*100)+99)) {
				$xhtm2 .= " - " . $value;
			}
		}
        $xhtm2 .= "</i><br />";
        
        $istr1 = $G_SHouse[$k0 + 1];
        $ostr1 = $data50[$k0]["lord"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $istr2 = $G_TSHouse[$k0 + 1];
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Lord</b> ".$rstr."<br />"; 
        	

        $ostr1 = $data50[$k0]["ownhouse"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Own House</b> ".$rstr."<br />";
        	 
        $ostr1 = $data50[$k0]["moolatrikona"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Moola Trikona</b> ".$rstr."<br />";
        	 
        $ostr1 = $data50[$k0]["exaltation"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Exaltation</b> ".$rstr."<br />";
        	 
        $ostr1 = $data50[$k0]["debilitation"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Debilitation</b> ".$rstr."<br />"; 
        	
        $ostr1 = $data50[$k0]["friends"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Friend(s)</b> ".$rstr."<br />"; 

        $ostr1 = $data50[$k0]["neutral"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Neutral(s)</b> ".$rstr."<br />"; 
        	
        $ostr1 = $data50[$k0]["enemy"];
        $rstr1 = seekPlanets($istr1, $ostr1);
        $rstr = seekPlanets($istr2, $rstr1); 
        $xhtm2 .= "<b>Enemy(s)</b> ".$rstr."<br />"; 
        
        // Very Important (Check for Transits over Natal Planets)
        // istr2 - Transits
        // istr1 - Natal
        $rstr = findTransits($istr2, $istr1, "mys_transits", $conn);
        $xhtm2 .= $rstr;
        return $xhtm2;
	}
	
	// Find transits over natal (added 11/24/07)
	function findTransits ($transtring, $natalstring, $table_name, &$conn) {
		$tok1 = strtok($transtring, " ,");
		if (!$tok1) return "";
		$token = array();
		$tokenNatal = array();
		while ($tok1) {
			// if ((strcmp($tok1,"Rahu")>=0) || (strcmp($tok1,"Ketu")>=0) 
			// || (strcmp($tok1,"Jupiter")>=0) || (strcmp($tok1,"Saturn")>=0)) 
   			$token[] = $tok1;
   			$tok1 = strtok(" ,");
		}
		if (count($token) <= 0) return "";
		
		
		$tok2 = strtok($natalstring, " ,");
		if (!$tok2) return "";
		while ($tok2) {
   			$tokenNatal[] = $tok2;
   			$tok2 = strtok(" ,");
		}
		if (count($tokenNatal) <= 0) return "";
		
		// debug only
		// $resultStr =  $transtring . " " . $natalstring . " ";
		$resultStr = "";
		for ($i=0; $i < count($token); $i++) {
			for ($j=0; $j < count($tokenNatal); $j++) {
				$strFind = "SELECT `description`,`other` FROM `". $table_name ."` WHERE  ";
				$strFind .= "`transit_planet` = '" . $token[$i] . "' and ";			
				$strFind .= "`natal_planet` = '" . $tokenNatal[$j] . "'";
				// $resultStr = $strFind;			
				$data51 = Array();
    			if ($strFind) {
        			$rs51 = db_query($strFind, $conn);
        			if ($rs51) {
        				$data51 = db_fetch_array($rs51);
        				if ($data51) {
        					$resultStr .= "<b>Transiting " .$token[$i]. " over Natal ".$tokenNatal[$j]. "</b> - " . $data51["description"] . $data51["other"];
        				}
        			}
    			}
			}
		}
		return $resultStr;
	}
	
	function findTransits2 ($transtring, $natalstring, $table_name, &$conn) {
		$resultStr = "";
		$strFind = "SELECT `description`,`other` FROM `". $table_name ."` WHERE  ";
		$strFind .= "`transit_planet` = '" . $transtring . "' and ";
		$strFind .= "`natal_planet` = '" . $natalstring . "'";
		// $resultStr = $strFind;
		$data51 = array();
		if ($strFind) {
			$rs51 = db_query($strFind, $conn);
			if ($rs51) {
				$data51 = db_fetch_array($rs51);
				if ($data51) {
					$resultStr .= "<b>Transiting " .$transtring. " over Natal ".$natalstring. "</b> - " . $data51["description"] . $data51["other"];
				}
			}
		}
		return $resultStr;
	}
	
	function findTransitHouses ($planet, $house, &$conn) {
		$resultStr = "";
	 	$strFind = "SELECT `description` FROM `mys_transit_houses` WHERE  ";
		$strFind .= "`transit_planet` = '" . $planet . "' and ";			
		$strFind .= "`house` = " . $house;
		$data51 = Array();
    	if ($strFind) {
        	$rs51 = db_query($strFind, $conn);
        	if ($rs51) {
        		$data51 = db_fetch_array($rs51);
        		if ($data51) {
        			$resultStr .= "<b>Transiting " .$planet. " over house ".$house. "</b> - " . $data51["description"];
        		}
        	}
    	}
		return $resultStr;
	}
	
	// End of Functions 
	$strSQL = "select `sign_id`, `sign`, `meaning`, `type`, `sex`, `mobility`, `lord`, `height`, `strong_during`, `rise_by`, `direction`, `element`, `caste`, `description`, `moolatrikona`, `ownhouse`, `exaltation`, `debilitation`, `friends`, `neutral`, `enemy` from `mys_signs`";
    if ($strSQL) {
        $rs50 = db_query($strSQL,$conn);
        $data50 = mysql_fetch_rowsarr($rs50);
    }
?>
