<?php

use Mmcev106\SSNOrITIN;

class SSNOrITINTest extends PHPUnit_Framework_TestCase {

	function test_leading_nine(){
		$this->assertTrue(SSNOrITIN::isITIN('900-70-0000'));
		$this->assertFalse(SSNOrITIN::isITIN('800-70-0000'));
	}

	function test_ssn_range_one(){
		$this->assertFalse(SSNOrITIN::isITIN('900-00-0000'));
		$this->assertFalse(SSNOrITIN::isITIN('900-69-0000'));
	}

	function test_itin_range_one(){
		$this->assertTrue(SSNOrITIN::isITIN('900-70-0000'));
		$this->assertTrue(SSNOrITIN::isITIN('900-88-0000'));
	}

	function test_ssn_range_two(){
		$this->assertFalse(SSNOrITIN::isITIN('900-89-0000'));
	}

	function test_itin_range_two(){
		$this->assertTrue(SSNOrITIN::isITIN('900-90-0000'));
		$this->assertTrue(SSNOrITIN::isITIN('900-92-0000'));
	}

	function test_ssn_range_three(){
		$this->assertFalse(SSNOrITIN::isITIN('900-93-0000'));
	}

	function test_itin_range_three(){
		$this->assertTrue(SSNOrITIN::isITIN('900-94-0000'));
		$this->assertTrue(SSNOrITIN::isITIN('900-99-0000'));
	}

	function test_no_dashes(){
		$number = '900700000';
		$this->assertTrue(SSNOrITIN::isITIN($number));	
	}

	function test_number_too_long(){
		$this->assert_number_length_exception('123-45-67890', 10);
	}

	function test_number_too_short(){
		$this->assert_number_length_exception('123-45-678', 8);
	}

	private function assert_number_length_exception($number, $expectedLength){
		$exceptionThrown = false;
		try{
			SSNOrITIN::isITIN($number);
		}
		catch(Exception $e){
			$exceptionThrown = true;
			$this->assertEquals("SSNs and ITINs must be 9 digits long, but the number specified is $expectedLength digits long.", $e->getMessage());
		}

		$this->assertTrue($exceptionThrown);
	}

	function test_isSSN(){
		$number = '123-45-6789';

		// Simply assert that isSSN() returns the opposite of isITIN()
		$this->assertEquals(!SSNOrITIN::isITIN($number), SSNOrITIN::isSSN($number));
	}

}