<?php

namespace mageekguy\atoum\phpunit\tests\units\constraints;

use
	mageekguy\atoum,
	mageekguy\atoum\phpunit\constraints\isInstanceOf as testedClass
;

class isInstanceOf extends \PHPUnit_Framework_TestCase
{
	public function testClass()
	{
		$this->assertInstanceOf('mageekguy\atoum\phpunit\constraint', new testedClass(new \stdClass));
	}

	public function testAssertInstanceOf()
	{
		$constraint = new testedClass('stdClass');
		$this->assertSame($constraint, $constraint->evaluate(new \stdClass()));

		try
		{
			$constraint->evaluate(new \exception());

			$this->fail();
		}
		catch (\PHPUnit_Framework_ExpectationFailedException $exception)
		{
			$this->assertEquals('object(Exception) is not an instance of stdClass', $exception->getMessage());
		}
	}

	public function testAssertInstanceOfThrowsExceptionForInvalidArgument()
	{
		$constraint = new testedClass(null);

		try
		{
			$constraint->evaluate(new \stdClass);

			$this->fail();
		}
		catch (\PHPUnit_Framework_Exception $exception)
		{
			$this->assertEquals('Argument of mageekguy\atoum\asserters\object::isInstanceOf() must be a class instance or a class name', $exception->getMessage());
		}
	}
}
