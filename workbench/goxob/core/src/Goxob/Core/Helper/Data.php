<?php

namespace Goxob\Core\Helper;

use URL, Input;

class Data {
    /**
     * Function to convert array to integer values
     *
     * @param   array  &$array   The source array to convert
     * @param   mixed  $default  A default value (int|array) to assign if $array is not an array
     *
     * @return  void
     *
     * @since   11.1
     */
    public static function toInteger(&$array, $default = null)
    {
        if (is_array($array))
        {
            foreach ($array as $i => $v)
            {
                $array[$i] = (int) $v;
            }
        }
        else
        {
            if ($default === null)
            {
                $array = array();
            }
            elseif (is_array($default))
            {
                self::toInteger($default, null);
                $array = $default;
            }
            else
            {
                $array = array((int) $default);
            }
        }
    }

    public static function snakeToUpper($string)
    {
        if(strpos($string, '_'))
        {
            $result = '';
            $segments = explode('_',$string);
            foreach($segments as $seg)
            {
                $result .= strtoupper($seg);
            }
            return $result;
        }
        return $string;
    }

    public static function isAssocArray($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public static function array_combine($arr1, $arr2) {
        if(is_null($arr1) || !is_array($arr1) || is_null($arr2) || !is_array($arr2))
        {
            throw new \Exception('array_combine($arr1, $arr2): Both parameters should be array');
        }
        $count = min(count($arr1), count($arr2));
        return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
    }

    public static function camel2dashed($className)
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
    }

    public static function dashes2camel($string, $capitalizeFirstCharacter = true)
    {
        $str = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }


    public static function getCountryList()
    {
        $countryList = array(
            "Afghanistan",
            "Albania",
            "Algeria",
            "Andorra",
            "Angola",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bhutan",
            "Bolivia",
            "Bosnia and Herzegovina",
            "Botswana",
            "Brazil",
            "Brunei",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Colombi",
            "Comoros",
            "Congo (Brazzaville)",
            "Congo",
            "Costa Rica",
            "Cote d'Ivoire",
            "Croatia",
            "Cuba",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "East Timor (Timor Timur)",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Fiji",
            "Finland",
            "France",
            "Gabon",
            "Gambia, The",
            "Georgia",
            "Germany",
            "Ghana",
            "Greece",
            "Grenada",
            "Guatemala",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Honduras",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran",
            "Iraq",
            "Ireland",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, North",
            "Korea, South",
            "Kuwait",
            "Kyrgyzstan",
            "Laos",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macedonia",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Mauritania",
            "Mauritius",
            "Mexico",
            "Micronesia",
            "Moldova",
            "Monaco",
            "Mongolia",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepa",
            "Netherlands",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Poland",
            "Portugal",
            "Qatar",
            "Romania",
            "Russia",
            "Rwanda",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Vincent",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syria",
            "Taiwan",
            "Tajikistan",
            "Tanzania",
            "Thailand",
            "Togo",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Vatican City",
            "Venezuela",
            "Vietnam",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        );
        return $countryList;
    }

    public static function currentUrl($queryAdd = array())
    {
        $currentUrl = Url::current();

        $currentQuery = Input::query();
        $query = array_merge($currentQuery, $queryAdd);
        $query = http_build_query($query);
        $url = $currentUrl.'?'.$query;

        return $url;
    }

    public static function formatPrice($value)
    {
        return \Goxob\Locale\Helper\Currency::formatPrice($value);
    }

    public static function formatDate( $date )
    {
        return date('m/d/Y', strtotime($date));
    }

    public static function formatDateTime( $date )
    {
        return date('m/d/Y H:i:s', strtotime($date));
    }
}