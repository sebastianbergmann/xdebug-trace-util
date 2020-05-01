<?php declare(strict_types=1);
/*
 * This file is part of sebastian/xdebug-trace-util.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\XdebugTraceUtil;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\XdebugTraceUtil\ReturnFrame
 * @covers \SebastianBergmann\XdebugTraceUtil\Frame
 */
final class ReturnFrameTest extends TestCase
{
    public function testHasLevel(): void
    {
        $this->assertSame(1, $this->fixture()->level());
    }

    public function testHasFunctionNumber(): void
    {
        $this->assertSame(1, $this->fixture()->function());
    }

    public function testHasValue(): void
    {
        $this->assertSame('value', $this->fixture()->value());
    }

    public function testCanBeFormattedAsString(): void
    {
        $this->assertSame('', $this->fixture()->asString());
    }

    public function testCanBeQueriedForFrameType(): void
    {
        $this->assertFalse($this->fixture()->isEntry());
        $this->assertFalse($this->fixture()->isExit());
        $this->assertTrue($this->fixture()->isReturn());
    }

    private function fixture(): ReturnFrame
    {
        return Frame::return(
            1,
            1,
            'value'
        );
    }
}
