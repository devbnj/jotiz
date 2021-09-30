<?php
class Chalit {
	public $natal_lord;
	public $star_lord;
	public $sub_lord;
	public function doBhavas ($asign, $degrees) {
			// Determine House, Nakshatra and Sub Lords
			switch ($asign) { // zodiacs
				case 1: // Aries
					{
						if (($degrees >= 0.00) && ($degrees < 0.78))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 0.78) && ($degrees < 3.00))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 3.00) && ($degrees < 3.67))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 3.67) && ($degrees < 4.78))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 4.78) && ($degrees < 5.56))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 5.56) && ($degrees < 7.56))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 7.56) && ($degrees < 9.33))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 9.33) && ($degrees < 11.44))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 11.44) && ($degrees < 13.33))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 13.33) && ($degrees < 15.56))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 15.56) && ($degrees < 16.22))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 16.22) && ($degrees < 17.33))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 17.33) && ($degrees < 18.11))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 18.11) && ($degrees < 20.11))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 20.11) && ($degrees < 21.89))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 21.89) && ($degrees < 24.00))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 24.00) && ($degrees < 25.89))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 25.89) && ($degrees < 26.67))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Venus";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 26.67) && ($degrees < 27.33))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Sun";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 27.33) && ($degrees < 28.44))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Sun";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 28.44) && ($degrees < 29.22))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Sun";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 29.22) && ($degrees < 30.00))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Sun";
							$this->sub_lord = "Rahu";
						}
					}
					break;

				case 2: // Taurus
					{
						if (($degrees >= 0.00) && ($degrees < 1.22))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Sun";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 1.22) && ($degrees < 3.00))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Sun";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 3.00) && ($degrees < 5.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Sun";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 5.11) && ($degrees < 7.00))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Sun";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 7.00) && ($degrees < 7.78))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Sun";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 7.78) && ($degrees < 10.00))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Sun";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 10.00) && ($degrees < 11.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 11.11) && ($degrees < 11.89))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 11.89) && ($degrees < 13.89))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 13.89) && ($degrees < 15.67))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 15.67) && ($degrees < 17.78))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 17.78) && ($degrees < 19.67))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 19.67) && ($degrees < 20.44))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 20.44) && ($degrees < 22.67))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 22.67) && ($degrees < 23.33))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Moon";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 23.33) && ($degrees < 24.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 24.11) && ($degrees < 26.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 26.11) && ($degrees < 27.89))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 27.89) && ($degrees < 30.00))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Saturn";
						}
					}
					break;

				case 3: // Gemini
					{
						if (($degrees >= 0.00) && ($degrees < 1.89))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 1.89) && ($degrees < 2.67))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 2.67) && ($degrees < 4.89))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 4.89) && ($degrees < 5.56))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 5.56) && ($degrees < 6.67))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 6.67) && ($degrees < 8.67))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 8.67) && ($degrees < 10.44))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 10.44) && ($degrees < 12.56))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 12.56) && ($degrees < 14.44))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 14.44) && ($degrees < 15.22))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 15.22) && ($degrees < 17.44))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 17.44) && ($degrees < 18.11))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 18.11) && ($degrees < 19.22))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 19.22) && ($degrees < 20.00))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 20.00) && ($degrees < 21.78))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 21.78) && ($degrees < 23.89))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 23.89) && ($degrees < 25.78))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 25.78) && ($degrees < 26.56))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 26.56) && ($degrees < 28.78))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 28.78) && ($degrees < 29.44))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 29.44) && ($degrees < 30.00))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Moon";
						}
					}
					break;

				case 4: // Cancer
					{
						if (($degrees >= 0.00) && ($degrees < 0.56))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 0.56) && ($degrees < 1.33))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 1.33) && ($degrees < 3.33))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 3.33) && ($degrees < 5.44))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 5.44) && ($degrees < 7.33))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 7.33) && ($degrees < 8.11))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 8.11) && ($degrees < 10.33))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 10.33) && ($degrees < 11.00))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 11.00) && ($degrees < 12.11))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 12.11) && ($degrees < 12.89))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 12.89) && ($degrees < 14.89))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 14.89) && ($degrees < 16.67))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 16.67) && ($degrees < 18.56))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 18.56) && ($degrees < 19.33))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 19.33) && ($degrees < 21.56))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 21.56) && ($degrees < 22.22))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 22.22) && ($degrees < 23.33))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 23.33) && ($degrees < 24.11))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 24.11) && ($degrees < 26.11))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 26.11) && ($degrees < 27.89))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 27.89) && ($degrees < 30.00))
						{
							$this->natal_lord = "Moon";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Saturn";
						}
					}
					break;

				case 5: // Leo
					{
						if (($degrees >= 0.00) && ($degrees < 1.29))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 1.29) && ($degrees < 3.00))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 3.00) && ($degrees < 3.11))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 3.11) && ($degrees < 5.29))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 5.29) && ($degrees < 5.92))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 5.92) && ($degrees < 7.92))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 7.92) && ($degrees < 9.06))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 9.06) && ($degrees < 11.73))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 11.73) && ($degrees < 13.06))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 13.06) && ($degrees < 15.92))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 15.92) && ($degrees < 16.37))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 16.37) && ($degrees < 17.06))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 17.06) && ($degrees < 18.18))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 18.18) && ($degrees < 20.18))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 20.18) && ($degrees < 22.48))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 22.48) && ($degrees < 24.00))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 24.00) && ($degrees < 26.48))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 26.48) && ($degrees < 26.11))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Venus";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 26.11) && ($degrees < 27.06))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Sun";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 27.06) && ($degrees < 28.73))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Sun";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 28.73) && ($degrees < 29.37))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Sun";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 29.37) && ($degrees < 30.00))
						{
							$this->natal_lord = "Sun";
							$this->star_lord = "Sun";
							$this->sub_lord = "Rahu";
						}
					}
					break;

				case 6: // Virgo
					{
						if (($degrees >= 0.00) && ($degrees < 1.37))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Sun";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 1.37) && ($degrees < 3.00))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Sun";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 3.00) && ($degrees < 5.18))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Sun";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 5.18) && ($degrees < 7.00))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Sun";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 7.00) && ($degrees < 8.29))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Sun";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 8.29) && ($degrees < 10.00))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Sun";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 10.00) && ($degrees < 11.18))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 11.18) && ($degrees < 12.48))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 12.48) && ($degrees < 14.48))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 14.48) && ($degrees < 15.11))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 15.11) && ($degrees < 18.29))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 18.29) && ($degrees < 19.11))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 19.11) && ($degrees < 20.73))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 20.73) && ($degrees < 22.11))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 22.11) && ($degrees < 23.06))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Moon";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 23.06) && ($degrees < 24.18))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 24.18) && ($degrees < 26.18))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 26.18) && ($degrees < 28.48))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 28.48) && ($degrees < 30.00))
						{
							$this->natal_lord = "Mercury";
							$this->star_lord = "Mars";
							$this->sub_lord = "Saturn";
						}
					}
					break;

				case 7: // Libra
					{
						if (($degrees >= 0.00) && ($degrees < 2.48))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 2.48) && ($degrees < 2.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 2.11) && ($degrees < 5.48))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 5.48) && ($degrees < 5.92))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 5.92) && ($degrees < 6.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Mars";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 6.11) && ($degrees < 8.11))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 8.11) && ($degrees < 10.73))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 10.73) && ($degrees < 12.92))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 12.92) && ($degrees < 14.73))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 14.73) && ($degrees < 15.37))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 15.37) && ($degrees < 17.73))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 17.73) && ($degrees < 18.18))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 18.18) && ($degrees < 19.37))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 19.37) && ($degrees < 20.00))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 20.00) && ($degrees < 22.29))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 22.29) && ($degrees < 24.48))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 24.48) && ($degrees < 26.29))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 26.29) && ($degrees < 26.92))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 26.92) && ($degrees < 29.29))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 29.29) && ($degrees < 29.73))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 29.73) && ($degrees < 30.00))
						{
							$this->natal_lord = "Venus";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Moon";
						}

					}
					break;

				case 8: // Scorpio
					{
						if (($degrees >= 0.00) && ($degrees < 0.92))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 0.92) && ($degrees < 1.06))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 1.06) && ($degrees < 3.06))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 3.06) && ($degrees < 5.73))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 5.73) && ($degrees < 7.06))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 7.06) && ($degrees < 8.18))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 8.18) && ($degrees < 10.06))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 10.06) && ($degrees < 11.00))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 11.00) && ($degrees < 12.18))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 12.18) && ($degrees < 13.48))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 13.48) && ($degrees < 15.48))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 15.48) && ($degrees < 16.11))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 16.11) && ($degrees < 18.92))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 18.92) && ($degrees < 19.06))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 19.06) && ($degrees < 21.92))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 21.92) && ($degrees < 22.37))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 22.37) && ($degrees < 23.06))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 23.06) && ($degrees < 24.18))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 24.18) && ($degrees < 26.18))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 26.18) && ($degrees < 28.48))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 28.48) && ($degrees < 30.00))
						{
							$this->natal_lord = "Mars";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Saturn";
						}
					}
					break;

				case 9: // Sagittarius
					{
						if (($degrees >= 0.00) && ($degrees < 1.29))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 1.29) && ($degrees < 3.00))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 3.00) && ($degrees < 3.11))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 3.11) && ($degrees < 5.29))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 5.29) && ($degrees < 5.92))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 5.92) && ($degrees < 7.92))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 7.92) && ($degrees < 9.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 9.06) && ($degrees < 11.73))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 11.73) && ($degrees < 13.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Ketu";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 13.06) && ($degrees < 15.92))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 15.92) && ($degrees < 16.37))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 16.37) && ($degrees < 17.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 17.06) && ($degrees < 18.18))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 18.18) && ($degrees < 20.18))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 20.18) && ($degrees < 22.48))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 22.48) && ($degrees < 24.00))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 24.00) && ($degrees < 26.48))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 26.48) && ($degrees < 26.11))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Venus";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 26.11) && ($degrees < 27.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Sun";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 27.06) && ($degrees < 28.73))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Sun";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 28.73) && ($degrees < 29.37))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Sun";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 29.37) && ($degrees < 30.00))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Sun";
							$this->sub_lord = "Rahu";
						}
					}
					break;

				case 10: // Capricorn
					{
						if (($degrees >= 0.00) && ($degrees < 1.37))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Sun";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 1.37) && ($degrees < 3.00))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Sun";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 3.00) && ($degrees < 5.18))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Sun";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 5.18) && ($degrees < 7.00))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Sun";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 7.00) && ($degrees < 8.29))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Sun";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 8.29) && ($degrees < 10.00))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Sun";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 10.00) && ($degrees < 11.18))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 11.18) && ($degrees < 12.48))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 12.48) && ($degrees < 14.48))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 14.48) && ($degrees < 15.11))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 15.11) && ($degrees < 18.29))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 18.29) && ($degrees < 19.11))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 19.11) && ($degrees < 20.73))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 20.73) && ($degrees < 22.11))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 22.11) && ($degrees < 23.06))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Moon";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 23.06) && ($degrees < 24.18))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 24.18) && ($degrees < 26.18))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 26.18) && ($degrees < 28.48))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 28.48) && ($degrees < 30.00))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Saturn";
						}
					}
					break;

				case 11: // Aquarius
					{
						if (($degrees >= 0.00) && ($degrees < 2.48))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 2.48) && ($degrees < 2.11))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 2.11) && ($degrees < 5.48))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 5.48) && ($degrees < 5.92))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 5.92) && ($degrees < 6.11))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Mars";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 6.11) && ($degrees < 8.11))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 8.11) && ($degrees < 10.73))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 10.73) && ($degrees < 12.92))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 12.92) && ($degrees < 14.73))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 14.73) && ($degrees < 15.37))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 15.37) && ($degrees < 17.73))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 17.73) && ($degrees < 18.18))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 18.18) && ($degrees < 19.37))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 19.37) && ($degrees < 20.00))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Rahu";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 20.00) && ($degrees < 22.29))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 22.29) && ($degrees < 24.48))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 24.48) && ($degrees < 26.29))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 26.29) && ($degrees < 26.92))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 26.92) && ($degrees < 29.29))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 29.29) && ($degrees < 29.73))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 29.73) && ($degrees < 30.00))
						{
							$this->natal_lord = "Saturn";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Moon";
						}
					}
					break;

				case 12: // Pisces
					{
						if (($degrees >= 0.00) && ($degrees < 0.92))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 0.92) && ($degrees < 1.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 1.06) && ($degrees < 3.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Jupiter";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 3.06) && ($degrees < 5.73))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Saturn";
						}
						if (($degrees >= 5.73) && ($degrees < 7.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 7.06) && ($degrees < 8.18))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 8.18) && ($degrees < 10.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 10.06) && ($degrees < 11.00))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 11.00) && ($degrees < 12.18))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 12.18) && ($degrees < 13.48))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 13.48) && ($degrees < 15.48))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 15.48) && ($degrees < 16.11))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Saturn";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 16.11) && ($degrees < 18.92))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Mercury";
						}
						if (($degrees >= 18.92) && ($degrees < 19.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Ketu";
						}
						if (($degrees >= 19.06) && ($degrees < 21.92))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Venus";
						}
						if (($degrees >= 21.92) && ($degrees < 22.37))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Sun";
						}
						if (($degrees >= 22.37) && ($degrees < 23.06))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Moon";
						}
						if (($degrees >= 23.06) && ($degrees < 24.18))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Mars";
						}
						if (($degrees >= 24.18) && ($degrees < 26.18))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Rahu";
						}
						if (($degrees >= 26.18) && ($degrees < 28.48))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Jupiter";
						}
						if (($degrees >= 28.48) && ($degrees < 30.00))
						{
							$this->natal_lord = "Jupiter";
							$this->star_lord = "Mercury";
							$this->sub_lord = "Saturn";
						}
					}
			} // zodiacs
		
	}
}