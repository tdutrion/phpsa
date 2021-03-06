<?php

namespace Tests\PHPSA\Compiler\Expression\Operators\Comparison;

use PhpParser\Node;
use PHPSA\CompiledExpression;
use PHPSA\Compiler\Expression;

/**
 * Class SmallerTest
 * @package Tests\PHPSA\Expression\Operators\Comparison
 *
 * @see PHPSA\Compiler\Expression\Operators\Comparison\Smaller
 */
class SmallerTest extends BaseTestCase
{
    /**
     * @param \PhpParser\Node\Scalar $a
     * @param \PhpParser\Node\Scalar $b
     * @return Node\Expr\BinaryOp\Smaller
     */
    protected function buildExpression($a, $b)
    {
        return new Node\Expr\BinaryOp\Smaller($a, $b);
    }

    /**
     * @param $a
     * @param $b
     * @return bool
     */
    protected function operator($a, $b)
    {
        return $a < $b;
    }
}
