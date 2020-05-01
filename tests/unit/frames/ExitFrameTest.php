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
 * @covers \SebastianBergmann\XdebugTraceUtil\ExitFrame
 * @covers \SebastianBergmann\XdebugTraceUtil\FrameWithTimeAndMemory
 * @covers \SebastianBergmann\XdebugTraceUtil\Frame
 */
final class ExitFrameTest extends TestCase
{
    public function testHasLevel(): void
    {
        $this->assertSame(1, $this->fixture()->level());
    }

    public function testHasFunctionNumber(): void
    {
        $this->assertSame(1, $this->fixture()->function());
    }

    public function testHasTime(): void
    {
        $this->assertSame(0.0, $this->fixture()->time());
    }

    public function testHasMemory(): void
    {
        $this->assertSame(0, $this->fixture()->memory());
    }

    public function testCanBeFormattedAsString(): void
    {
        $this->assertSame('', $this->fixture()->asString());
    }

    public function testCanBeQueriedForFrameType(): void
    {
        $this->assertFalse($this->fixture()->isEntry());
        $this->assertTrue($this->fixture()->isExit());
        $this->assertFalse($this->fixture()->isReturn());
    }

    private function fixture(): ExitFrame
    {
        return Frame::exit(
            1,
            1,
            0.0,
            0
        );
    }
}
