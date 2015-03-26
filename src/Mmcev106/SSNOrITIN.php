<?php

namespace Mmcev106;

class SSNOrITIN{

	static function isITIN($number){
		$number = str_replace('-', '', $number);
		if(strlen($number) != 9){
			throw new \Exception("SSNs and ITINs must be 9 digits long, but the number specified is " . strlen($number) . " digits long.");
		}

		if($number[0] != '9'){
			return false;
		}

		$middleDigits = intval(substr($number, 3, 2));
		if($middleDigits >= 70 && $middleDigits <= 88 ||
		   $middleDigits >= 90 && $middleDigits <= 92 || 
		   $middleDigits >= 94 && $middleDigits <= 99){
			return true;
		}

		return false;
	}

	static function isSSN($number){
		return !self::isITIN($number);
	}
}