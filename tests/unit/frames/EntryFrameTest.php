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
 * @covers \SebastianBergmann\XdebugTraceUtil\EntryFrame
 * @covers \SebastianBergmann\XdebugTraceUtil\FrameWithTimeAndMemory
 * @covers \SebastianBergmann\XdebugTraceUtil\Frame
 */
final class EntryFrameTest extends TestCase
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

    public function testHasName(): void
    {
        $this->assertSame('{main}', $this->fixture()->name());
    }

    public function testHasIncludeFile(): void
    {
        $this->assertSame('', $this->fixture()->includeFile());
    }

    public function testHasFile(): void
    {
        $this->assertSame('test.php', $this->fixture()->file());
    }

    public function testHasLine(): void
    {
        $this->assertSame(1, $this->fixture()->line());
    }

    public function testCanBeQueriedForFrameType(): void
    {
        $this->assertTrue($this->fixture()->isEntry());
        $this->assertFalse($this->fixture()->isExit());
        $this->assertFalse($this->fixture()->isReturn());
    }

    public function testCanBeQueriedForFunctionType(): void
    {
        $this->assertTrue($this->fixture()->isInternal());
        $this->assertFalse($this->fixture()->isUserDefined());
    }

    private function fixture(): EntryFrame
    {
        return Frame::entry(
            1,
            1,
            0.0,
            0,
            '{main}',
            true,
            '',
            'test.php',
            1
        );
    }
}
