<?php
/*
Plugin Name: Countries Helper Plugin
Description: 
Version: 1.0.0
Author: Andrei Ioniță
Author URI: https://andrei.io/
*/

class Countries_Helper {
	public $assets_dir;
	public $assets_url;

	public function __construct() {
		$this->init();

		add_filter('countries_helper_get_list', array($this, 'get_country_list'));
	}

	private function init() {
		$this->assets_dir = get_template_directory() . '/assets/images/flags';
		$this->assets_url = get_template_directory_uri() . '/assets/images/flags';
		$this->countries = array(
			'af' => "Afghanistan",
			'al' => "Albania",
			'dz' => "Algeria",
			'as' => "American Samoa",
			'ad' => "Andorra",
			'ao' => "Angola",
			'ai' => "Anguilla",
			'ag' => "Antigua and Barbuda",
			'ar' => "Argentina",
			'am' => "Armenia",
			'aw' => "Aruba",
			'au' => "Australia",
			'at' => "Austria",
			'az' => "Azerbaijan",
			'bs' => "Bahamas",
			'bh' => "Bahrain",
			'bd' => "Bangladesh",
			'bb' => "Barbados",
			'by' => "Belarus",
			'be' => "Belgium",
			'bz' => "Belize",
			'bj' => "Benin",
			'bm' => "Bermuda",
			'bt' => "Bhutan",
			'bo' => "Bolivia, Plurinational State of",
			'ba' => "Bosnia and Herzegovina",
			'bw' => "Botswana",
			'br' => "Brazil",
			'io' => "British Indian Ocean Territory",
			'bn' => "Brunei Darussalam",
			'bg' => "Bulgaria",
			'bf' => "Burkina Faso",
			'bi' => "Burundi",
			'kh' => "Cambodia",
			'cm' => "Cameroon",
			'ca' => "Canada",
			'cv' => "Cape Verde",
			'ky' => "Cayman Islands",
			'cf' => "Central African Republic",
			'td' => "Chad",
			'cl' => "Chile",
			'cn' => "China",
			'cx' => "Christmas Island",
			'cc' => "Cocos (Keeling) Islands",
			'co' => "Colombia",
			'km' => "Comoros",
			'cg' => "Congo",
			'cd' => "Congo, the Democratic Republic of the",
			'ck' => "Cook Islands",
			'cr' => "Costa Rica",
			'hr' => "Croatia",
			'cu' => "Cuba",
			'cw' => "Curaçao",
			'cy' => "Cyprus",
			'cz' => "Czech Republic",
			'ci' => "Côte d'Ivoire",
			'dk' => "Denmark",
			'dj' => "Djibouti",
			'dm' => "Dominica",
			'do' => "Dominican Republic",
			'ec' => "Ecuador",
			'eg' => "Egypt",
			'sv' => "El Salvador",
			'gq' => "Equatorial Guinea",
			'er' => "Eritrea",
			'ee' => "Estonia",
			'et' => "Ethiopia",
			'fk' => "Falkland Islands (Malvinas)",
			'fo' => "Faroe Islands",
			'fj' => "Fiji",
			'fi' => "Finland",
			'fr' => "France",
			'pf' => "French Polynesia",
			'tf' => "French Southern Territories",
			'ga' => "Gabon",
			'gm' => "Gambia",
			'ge' => "Georgia",
			'de' => "Germany",
			'gh' => "Ghana",
			'gi' => "Gibraltar",
			'gr' => "Greece",
			'gl' => "Greenland",
			'gd' => "Grenada",
			'gu' => "Guam",
			'gt' => "Guatemala",
			'gg' => "Guernsey",
			'gn' => "Guinea",
			'gw' => "Guinea-Bissau",
			'gy' => "Guyana",
			'ht' => "Haiti",
			'va' => "Holy See (Vatican City State)",
			'hn' => "Honduras",
			'hk' => "Hong Kong",
			'hu' => "Hungary",
			'is' => "Iceland",
			'in' => "India",
			'id' => "Indonesia",
			'ir' => "Iran, Islamic Republic of",
			'iq' => "Iraq",
			'ie' => "Ireland",
			'im' => "Isle of Man",
			'il' => "Israel",
			'it' => "Italy",
			'jm' => "Jamaica",
			'jp' => "Japan",
			'je' => "Jersey",
			'jo' => "Jordan",
			'kz' => "Kazakhstan",
			'ke' => "Kenya",
			'ki' => "Kiribati",
			'kp' => "Korea, Democratic People's Republic of",
			'kr' => "Korea, Republic of",
			'kw' => "Kuwait",
			'kg' => "Kyrgyzstan",
			'la' => "Lao People's Democratic Republic",
			'lv' => "Latvia",
			'lb' => "Lebanon",
			'ls' => "Lesotho",
			'lr' => "Liberia",
			'ly' => "Libya",
			'li' => "Liechtenstein",
			'lt' => "Lithuania",
			'lu' => "Luxembourg",
			'mo' => "Macao",
			'mk' => "Macedonia, the former Yugoslav Republic of",
			'mg' => "Madagascar",
			'mw' => "Malawi",
			'my' => "Malaysia",
			'mv' => "Maldives",
			'ml' => "Mali",
			'mt' => "Malta",
			'mh' => "Marshall Islands",
			'mr' => "Mauritania",
			'mu' => "Mauritius",
			'mx' => "Mexico",
			'fm' => "Micronesia, Federated States of",
			'md' => "Moldova, Republic of",
			'mc' => "Monaco",
			'mn' => "Mongolia",
			'me' => "Montenegro",
			'ms' => "Montserrat",
			'ma' => "Morocco",
			'mz' => "Mozambique",
			'mm' => "Myanmar",
			'na' => "Namibia",
			'nr' => "Nauru",
			'np' => "Nepal",
			'nl' => "Netherlands",
			'nc' => "New Caledonia",
			'nz' => "New Zealand",
			'ni' => "Nicaragua",
			'ne' => "Niger",
			'ng' => "Nigeria",
			'nu' => "Niue",
			'nf' => "Norfolk Island",
			'mp' => "Northern Mariana Islands",
			'no' => "Norway",
			'om' => "Oman",
			'pk' => "Pakistan",
			'pw' => "Palau",
			'ps' => "Palestine",
			'pa' => "Panama",
			'pg' => "Papua New Guinea",
			'py' => "Paraguay",
			'pe' => "Peru",
			'ph' => "Philippines",
			'pn' => "Pitcairn",
			'pl' => "Poland",
			'pt' => "Portugal",
			'pr' => "Puerto Rico",
			'qa' => "Qatar",
			'ro' => "Romania",
			'ru' => "Russian Federation",
			'rw' => "Rwanda",
			're' => "Réunion",
			'sh' => "Saint Helena, Ascension and Tristan da Cunha",
			'kn' => "Saint Kitts and Nevis",
			'lc' => "Saint Lucia",
			'vc' => "Saint Vincent and the Grenadines",
			'ws' => "Samoa",
			'sm' => "San Marino",
			'st' => "Sao Tome and Principe",
			'sa' => "Saudi Arabia",
			'sn' => "Senegal",
			'rs' => "Serbia",
			'sc' => "Seychelles",
			'sl' => "Sierra Leone",
			'sg' => "Singapore",
			'sx' => "Sint Maarten (Dutch part)",
			'sk' => "Slovakia",
			'si' => "Slovenia",
			'sb' => "Solomon Islands",
			'so' => "Somalia",
			'za' => "South Africa",
			'gs' => "South Georgia and the South Sandwich Islands",
			'ss' => "South Sudan",
			'es' => "Spain",
			'lk' => "Sri Lanka",
			'sd' => "Sudan",
			'sr' => "Suriname",
			'sz' => "Swaziland",
			'se' => "Sweden",
			'ch' => "Switzerland",
			'sy' => "Syrian Arab Republic",
			'tw' => "Taiwan, Province of China",
			'tj' => "Tajikistan",
			'tz' => "Tanzania, United Republic of",
			'th' => "Thailand",
			'tl' => "Timor-Leste",
			'tg' => "Togo",
			'tk' => "Tokelau",
			'to' => "Tonga",
			'tt' => "Trinidad and Tobago",
			'tn' => "Tunisia",
			'tr' => "Turkey",
			'tm' => "Turkmenistan",
			'tc' => "Turks and Caicos Islands",
			'tv' => "Tuvalu",
			'ug' => "Uganda",
			'ua' => "Ukraine",
			'ae' => "United Arab Emirates",
			'gb' => "United Kingdom",
			'us' => "United States",
			'uy' => "Uruguay",
			'uz' => "Uzbekistan",
			'vu' => "Vanuatu",
			've' => "Venezuela, Bolivarian Republic of",
			'vn' => "Viet Nam",
			'vg' => "Virgin Islands, British",
			'vi' => "Virgin Islands, U.S.",
			'ye' => "Yemen",
			'zm' => "Zambia",
			'zw' => "Zimbabwe",
			'ax' => "Åland Islands",
		);
	}

	public function get_country_list() {
		return $this->countries;
	}

	public function flag_exists($iso) {
		if (!isset($this->countries[$iso]))
			return false;

		$path = sprintf('%s/%s.png',
			$this->assets_dir, $iso
		);

		if (!is_readable($path))
			return false;

		return true;
	}

	public function get_flag_url($iso) {
		if (!$this->flag_exists($iso))
			return false;

		return sprintf('%s/%s.png',
			$this->assets_url, $iso
		);
	}
}

new Countries_Helper;
