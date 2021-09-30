<?php

final class MysticConstants {
	public static $IASCENDANT = 0;
	public static $ISUN = 1;
	public static $IMERCURY = 2;
	public static $IVENUS = 3;
	public static $IMARS = 4;
	public static $IJUPITER = 5;
	public static $ISATURN = 6;
	public static $IMOON = 7;
	public static $IRAHU = 8;
	public static $IKETU = 9;
	public static $IURANUS = 10;
	public static $INEPTUNE = 11;
	
	public static $_SUN = 1;
	public static $_MER = 2;
	public static $_VEN = 3;
	public static $_MAR = 4;
	public static $_JUP = 5;
	public static $_SAT = 6;
	public static $_MON = 7;
	public static $_RAH = 8;
	public static $_KET = 9;
	public static $_URA = 10;
	public static $_NEP = 11;
	
	public static $IEXALT = 10;
	public static $IFALL = 9;
	public static $IOWNHOUSE = 8;
	public static $IDETRI = 7;
	public static $IMT = 6;
	
	public static $_HOUSE1 = 1;
	public static $_HOUSE2 = 2;
	public static $_HOUSE3 = 3;
	public static $_HOUSE4 = 4;
	public static $_HOUSE5 = 5;
	public static $_HOUSE6 = 6;
	public static $_HOUSE7 = 7;
	public static $_HOUSE8 = 8;
	public static $_HOUSE9 = 9;
	public static $_HOUSE10 = 10;
	public static $_HOUSE11 = 11;
	public static $_HOUSE12 = 12;
	
	public static $_VATA = 1;
	public static $_PITTA = 2;
	public static $_KAPHA = 3;
	public static $_VATAPITTA = 4;
	public static $_VATAKAPHA = 5;
	public static $_PITTAKAPHA = 6;
	public static $_TRIDOSHA = 7;
	
	public static $_BALA_AVASTHA = 1;
	// 6-12 odd, 18-24 even
	public static $_KUMAR_AVASTHA = 2;
	// 12-18 both
	public static $_YUVA_AVASTHA = 3;
	// 18-24 odd, 6-12 even
	public static $_VRIDDHA_AVASTHA = 4;
	// 24-30 odd, 0-6 even
	public static $_MRITYA_AVASTHA = 5;

	public static $_SEXTILE = 60;
	public static $_OPPOSITE = 180;
	public static $_SQUARE = 90;
	public static $_CONJUNCT = 0;
	
	public static $dosha = array(1=>"Vata", "Pitta", "Kapha", "Vata-Pitta", "Vata-Kapha", "Pitta-Kapha", "Tridosha");
	public static $ras = array ("Mesha", "Vrishabha", "Mithuna", "Karkata", "Simha", "Kanya", "Tula", "Vrischika", "Dhanu", "Makara", "Kumbha", "Meena" );
	
	public static $eras = array ("Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo",
           "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces" );
	public static $rlord = array ("Ma", "Ve", "Me", "Mo", "Su", "Me", "Ve", "Ma", "Ju", "Sa", "Sa", "Ju");
	public static $rlordx = array ("Mars", "Venus", "Mercury", "Moon", "Sun", "Mercury", "Venus", "Mars", "Jupiter", "Saturn", "Saturn", "Jupiter");
	public static $iruler = array (4,    3,    2,    7,    1,    2,    3,    4,    5,    6,    6,    5);
	public static $imtrik = array (4,    7,   -1,   -1,    1,    2,    3,    -1,   5,    -1,   6,    -1);
	public static $detri = array ("Ve", "Ma", "Ju", "Sa", "Ur", "Ne", "Ma", "Ve", "Me", "Mo", "Su", "Me" );
	public static $idetri = array (3,    4,    5,    6,    10,   11,   4,    3,    2,    7,    1,    2);
	public static $exalt = array ("Su", "Mo", "Ra", "Ju", "Ne", "Me", "Sa", "Ur", "Ke", "Ma", ".", "Ve" );
	public static $iexalt = array (1,    7,    8,    5,    11,    2,    6,   10,   9,    4,    -1,   3);
	public static $fall  = array ("Sa", "Ur", "Ke", "Ma", ".", "Ve", "Su", "Mo", "Ra", "Ju", "Ne", "Me" );
	public static $ifall = array (6,     10,   9,     4,   -1,  3,    1,    7,    8,     5,   11,   2);
	public static $gender= array ("M", "F", "M", "F", "M", "F", "M", "F", "M", "F", "M", "F");
	public static $xruler = array (array(5, -1), array(3, 6), array(2, 7), array(1, 8), array(9, 12), array(10, 11), array(4, -1));
	public static $xmtrik = array (5, 6, 7, 1, 9, 11, 2);
	public static $xexalt = array (1, 6, 12, 10, 4, 7, 2);
	public static $xdebil = array (7, 12, 6, 4, 10, 1, 8);
	
	// After Amavasya Sukla, else after Purnima Krishna
	public static $tit =  array("Pratipad", "Dvitiya",
           "Tritiya", "Chaturthi",
           "Panchami", "Sashti",
           "Saptami", "Ashtami",
           "Navami", "Dasami",
           "Ekadasi", "Dvadasi",
           "Trayodasi", "Chaturdasi",
           "Purnima", "Pratipad",
           "Dvitiya","Tritiya",
           "Chaturthi","Panchami",
           "Sashti", "Saptami",
           "Ashtami", "Navami",
           "Dasami", "Ekadasi",
           "Dvadasi", "Trayodasi",
           "Chaturdasi",
           "Amavasya");

	public static $etit =  array(
		   "Waxing 1", "Waxing 2",
           "Waxing 3", "Waxing 4",
           "Waxing 5", "Waxing 6",
           "Waxing 7", "Waxing 8",
           "Waxing 9", "Waxing 10",
           "Waxing 11", "Waxing 12",
           "Waxing 13", "Waxing 14",
           "Full Moon", "Waning 1",
           "Waning 2","Waning 3",
           "Waning 4","Waning 5",
           "Waning 6", "Waning 7",
           "Waning 8", "Waning 9",
           "Waning 10", "Waning 11",
           "Waning 12", "Waning 13",
           "Waning 14",
           "New Moon");
	
	public static $nak = array("Aswini", "Bharani",
           "Krittika", "Rohini",
           "Mrigashira", "Ardra",
           "Punarvasu", "Pushya",
           "Aslesha", "Magha",
           "P-Phalguni", "U-Phalguni",
           "Hastha", "Chitra",
           "Swati", "Vishakha",
           "Anuradha", "Jyestha",
           "Moola", "P-Ashada",
           "U-Ashada", "Sravana",
           "Dhanistha", "S-Bhishag",
           "P-Bhadra","U-Bhadra",
           "Revati");

	public static $nakshort = array("Aswn", "Bhar",
           "Kritk", "Rohni",
           "Mriga", "Ardra",
           "Punrv", "Pushy",
           "Aslsh", "Magha",
           "PPhal", "UPhal",
           "Hasta", "Chitr",
           "Swati", "Vishk",
           "Anurd", "Jyest",
           "Moola", "PShad",
           "UShad", "Shrvn",
           "Dhani", "SVshg",
           "PBhad", "UBhad",
           "Revti");
	
	public static $nakdosha = array(1,2,3, 3,2,1, 1,2,3, 3,2,1,
			1,2,3, 3,2,1, 1,2,3, 3,2,1,
			1,2,3
	);
	
	public static $naklords = array("Ke", "Ve", 
			"Su", "Mo", "Ma", "Ra", "Ju", "Sa", 
			"Me", "Ke", "Ve", "Su", "Mo", 
			"Ma", "Ra", "Ju", "Sa", "Me", "Ke", 
			"Ve", "Su", "Mo", "Ma", 
			"Ra", "Ju", "Sa", "Me");
	
	public static $nak1 = array("Ketu", "Venus",
           "Sun", "Moon",
           "Mars", "Rahu",
           "Jupiter", "Saturn",
           "Mercury", "Ketu",
           "Venus", "Sun",
           "Moon", "Mars",
           "Rahu", "Jupiter",
           "Saturn", "Mercury",
           "Ketu", "Venus",
           "Sun", "Moon",
           "Mars", "Rahu",
           "Jupiter", "Saturn",
           "Mercury");

	public static $nak2 = array("Mars", "Mars",
           "Mars", "Venus",
           "Venus", "Mercury",
           "Mercury", "Moon",
           "Moon", "Sun",
           "Sun", "Sun",
           "Mercury", "Mercury",
           "Venus", "Venus",
           "Mars", "Mars",
           "Jupiter", "Jupiter",
           "Jupiter", "Saturn",
           "Saturn", "Saturn",
           "Saturn", "Jupiter",
           "Jupiter");

	public static $bhavno = array("Personality", "Property",
           "Brother/Sister", "Mother",
           "Children", "Health",
           "Marriage", "Longevity",
           "Association","Profession",
           "Gains", "Losses");

	public static $yog = array("Viskumbha","Priti",
           "Ayusman","Saubhagya",
           "Sobhana","Atiganda",
           "Sukarma", "Dhriti",
           "Sula", "Ganda",
           "Vriddhi","Dhruva",
           "Vyaghata", "Harshana",
           "Vajra", "Siddhi",
           "Vyatipata", "Variyan",
           "Parigha", "Siva",
           "Siddha", "Sadhya",
           "Subha", "Sukla",
           "Brahma", "Indra",
           "Vaidhriti");

	public static $ashx1 = array("Sun     ", "Moon    ",
           "Mars    ", "Mercury ",
           "Saturn  ", "Jupiter ",
           "Rahu    ", "Venus   ");

	public static $ashys1 = array(6.0, 15.0, 8.0, 17.0,	10.0, 19.0, 12.0, 21.0);

	public static $vimplanets = array("Ketu", "Venus",
           "Sun", "Moon",
           "Mars", "Rahu",
           "Jupiter", "Saturn",
           "Mercury");

	public static $vimfactors = array(7.0, 20.0, 6.0, 10.0,
	7.0, 18.0, 16.0, 19.0, 17.0);

	public static $graha = array("Lagna", "Sun", "Mercury",
           "Venus", "Mars", "Jupiter",
           "Saturn", "Moon", "Rahu",
           "Ketu", "Uranus", "Neptune",
           "Pluto" );

	public static $bgraha = array("Lagna", "Surya", "Budha",
           "Shukra", "Mangala", "Brihaspati",
           "Sani", "Chandra", "Rahu",
           "Ketu", "Uranus", "Neptune",
           "Pluto" );
	
	public static $egraha = array("Asc", "Sun", "Mercury",
           "Venus", "Mars", "Jupiter",
           "Saturn", "Moon", "UN",
           "LN", "Uranus", "Neptune",
           "Pluto" );
	
	public static $ndiv = array("", "Natal", "Dreskana",
           "Sapthamsa", "Navamasa",
           "Dadamsa","Dwadasamsa",
           "Shodasamsa");
	
	public static $benefic = array(
	1=>"Su, Ju",
	"Su, Sa",
	"Ve",
	"Mo, Ma, Ju", 
	"Su, Ma, Ju",  
	"Me, Ve",
	"Me, Sa",
	"Mo, Ju",
	"Su, Ma",
	"Me, Ve",
	"Ve, Sa",
	"Mo, Ma, Ju");

	public static $beneficx = array(
	1=>"Sun, Jupiter",
	"Sun, Saturn",
	"Venus",
	"Moon, Mars, Jupiter", 
	"Sun, Mars, Jupiter",  
	"Mercury, Venus",
	"Mercury, Saturn",
	"Moon, Jupiter",
	"Sun, Mars",
	"Mercury, Venus",
	"Venus, Saturn",
	"Moon, Mars, Jupiter");
	
	public static $malefic = array(
	1=>"Me, Ve, Sa",
	"Mo, Ju, Ve",
	"Su, Ma, Ju",
	"Me, Ve",
	"Me, Ve, Sa",
	"Mo, Ma, Ju",
	"Su, Ma, Ju",
	"Me, Ve, Sa",
	"Ve",
	"Mo, Ma, Ju",
	"Mo, Ma, Ju",
	"Su, Me, Ve, Sa");
	
	public static $maleficx = array(
	1=>"Mercury, Venus, Saturn",
	"Moon, Jupiter, Venus",
	"Sun, Mars, Jupiter",
	"Mercury, Venus",
	"Mercury, Venus, Saturn",
	"Moon, Mars, Jupiter",
	"Sun, Mars, Jupiter",
	"Mercury, Venus, Saturn",
	"Venus",
	"Moon, Mars, Jupiter",
	"Moon, Mars, Jupiter",
	"Sun, Mercury, Venus, Saturn");
	
	public static $maraka = array(
	1=>"Ve",
	"Ma (Mo, Ju, Ve)",
	"Mo",
	"Sa",
	"Sa",
	"Ve",
	"Ma",
	"Ve",
	"Ve, Sa",
	"Ma (all malefics)",
	"Su, Ma, Ju",
	"Me, Sa");
	
	public static $marakax = array(
	1=>"Venus",
	"Mars (Moon, Jupiter, Venus)",
	"Moon",
	"Saturn",
	"Saturn",
	"Venus",
	"Mars",
	"Venus",
	"Venus, Saturn",
	"Mars (all malefics)",
	"Sun, Mars, Jupiter",
	"Mercury, Saturn");
	
	public static $yogakaraka = array(
	1=>"None",
	"Sa",
	"None",
	"Ma",
	"Ma",
	"None",
	"Sa",
	"None",
	"None",
	"Ve",
	"Ve",
	"None");
	
	public static $yogakarakax = array(
	1=>"None",
	"Saturn",
	"None",
	"Mars",
	"Mars",
	"None",
	"Saturn",
	"None",
	"None",
	"Venus",
	"Venus",
	"None");
	
	public static $gnotes = array(
	1=>"Combination Ju+Sa not a Raj-yoga, Ju malefic if ill associated, Ma acts benefic",
	"Me partially benefic, Ve not good.",
	"Combination Ju+Sa not a Raj-yoga, Ju benefic but blemished.",
	"Sun acts as benefic or malefic depending on association",
	"Combination Ju+Ve not a Raj-yoga, Mo gives good results depending on association",
	"Combination Ve+Me is a Raj-yoga, Su gives good results based on association, Me is benefic, Ju blemished",
	"Ve is neutral, Mo+Me is a Raj-yoga",
	"Ma is neutral, Su+Mo is a Raj-yoga",
	"Ju, Mo are neutral, Su-Me is a Raj-yoga",
	"Su is neutral, Sa is not a Maraka",
	"Me is mediocre (more benefic than harmful)",
	"Ma not a Maraka");
	
	public static $gnotesx = array(
			1=>"Combination of Jupiter and Saturn is not a Raj-yoga, Jupiter is malefic if ill associated, Mars acts benefic. ",
			"Mercury is partially benefic, Venus does not do good. ",
			"Combination Jupiter and Saturn is not a Raj-yoga, Jupiter is benefic but blemished. ",
			"Sun acts as benefic or malefic depending on association. ",
			"Combination Jupiter and Venus is not a Raj-yoga, Moon gives good results depending on association. ",
			"Combination Venus and Mercury forms a Raj-yoga, Sun gives good results based on association, Mercury is benefic, Jupiter is blemished. ",
			"Venus is neutral, Moon and Mercury is a Raj-yoga. ",
			"Mars is neutral, Sun and Moon is a Raj-yoga. ",
			"Jupiter, Moon are neutral, Sun and Mercury together is a Raj-yoga. ",
			"Sun is neutral, Saturn is not a Maraka or death bearing. ",
			"Mercury is mediocre, it is more benefic than harmful. ",
			"Mars not a Maraka or death bearing. ");
	
}
