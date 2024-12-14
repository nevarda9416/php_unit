<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class StupidTest extends TestCase
{
    /**
     * Annotations là các flag đặc biệt được khai báo trong docblocks của method
     * @annotationName Annotation value
     */
    public function testTrueIsTrue()
    {
        $foo = true;
        $this->assertTrue($foo);
    }
}
