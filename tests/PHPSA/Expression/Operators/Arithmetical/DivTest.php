<?php

namespace Tests\PHPSA\Expression\Operators\Arithmetical;

use PhpParser\Node;
use PHPSA\CompiledExpression;
use PHPSA\Visitor\Expression;

class DivTest extends AbstractDivMod
{
    /**
     * @param $a
     * @param $b
     * @return float
     */
    protected function process($a, $b)
    {
        return $a / $b;
    }

    /**
     * @param $a
     * @param $b
     * @return Node\Expr\BinaryOp\Div
     */
    protected function buildExpression($a, $b)
    {
        return new Node\Expr\BinaryOp\Div(
            $this->newScalarExpr($a),
            $this->newScalarExpr($b)
        );
    }

    protected function getAssertType()
    {
        return CompiledExpression::DNUMBER;
    }

    /**
     * Data provider for Div {int} / {int} = {int}
     *
     * @return array
     */
    public function testDivIntResultDataProvider()
    {
        return array(
            array(-1, -1),
            array(-1, 1),
            array(1, 1),
            array(true, 1),
            array(true, true),
            array(1, true),
            array(0, 1),
            array(25, 25),
            array(50, 50),
            array(500, 50),
            array(5000, 50)
        );
    }

    /**
     * Tests {int} $operator {int} = {int}
     *
     * @dataProvider testDivIntResultDataProvider
     */
    public function testDivIntToIntWithIntResult($a, $b)
    {
        $compiledExpression = $this->compileExpression(
            $this->buildExpression($a, $b)
        );

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::LNUMBER, $compiledExpression->getType());
        $this->assertSame($this->process($a, $b), $compiledExpression->getValue());
    }

    /**
     * Data provider for Div {int} / {double} = {double}
     *
     * @return array
     */
    public function testDivFloatResultDataProvider()
    {
        return array(
            array(-1, -1.25, 0.8),
            array(-1, 1.25, -0.8),
            array(1, 1.25, 0.8),
            array(true, 1.25, 0.8),
            array(0, 1.25, 0.0),
            array(25, 12.5, 2.0),
            array(25, 6.25, 4.0),
            array(25, 3.125, 8.0),
        );
    }

    /**
     * Tests {int} $operator {double} = {double}
     *
     * @dataProvider testDivFloatResultDataProvider
     */
    public function testDivIntToDoubleWithDoubleResult($a, $b, $c)
    {
//        $this->assertInternalType('int', $a);
        $this->assertInternalType('double', $b);
        $this->assertInternalType('double', $c);

        $compiledExpression = $this->compileExpression(
            $this->buildExpression($a, $b)
        );

        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::DNUMBER, $compiledExpression->getType());
        $this->assertSame($this->process($a, $b), $compiledExpression->getValue());
    }

    /**
     * Data provider for Div {double} / {double} = {double}
     *
     * @return array
     */
    public function testDivDoubleToDoubleResultDataProvider()
    {
        return array(
            array(-1.25, -1, 1.25),
            array(1.25, -1, -1.25),
            array(1.25, 1, 1.25),
            array(1.25, true, 1.25),
            array(12.5, 25, 1/2),
            array(6.25, 25, 1/4),
            array(3.125, 25, 1/8),
        );
    }

    /**
     * Tests {double} $operator {int} = {double}
     *
     * @dataProvider testDivDoubleToDoubleResultDataProvider
     */
    public function testDivDoubleToIntWithDoubleResult($a, $b, $c)
    {
        $this->assertInternalType('double', $a);
//        $this->assertInternalType('int', $b);
        $this->assertInternalType('double', $c);

        $compiledExpression = $this->compileExpression(
            $this->buildExpression($a, $b)
        );
        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::DNUMBER, $compiledExpression->getType());
        $this->assertSame($this->process($a, $b), $compiledExpression->getValue());
    }

    /**
     * Tests {double} $operator {double} = {double}
     *
     * @dataProvider testDivDoubleToDoubleResultDataProvider
     */
    public function testDivDoubleToDoubleWithDoubleResult($a, $b, $c)
    {
        $b = (float) $b;

        $this->assertInternalType('double', $a);
        $this->assertInternalType('double', $b);
        $this->assertInternalType('double', $c);

        $compiledExpression = $this->compileExpression(
            $this->buildExpression($a, $b)
        );
        $this->assertInstanceOfCompiledExpression($compiledExpression);
        $this->assertSame(CompiledExpression::DNUMBER, $compiledExpression->getType());
        $this->assertSame($this->process($a, $b), $compiledExpression->getValue());
    }
}
