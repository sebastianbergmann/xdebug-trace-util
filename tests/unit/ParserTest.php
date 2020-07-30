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
 * @covers \SebastianBergmann\XdebugTraceUtil\Parser
 *
 * @uses \SebastianBergmann\XdebugTraceUtil\EntryFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\ExitFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\ReturnFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\Frame
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameCollection
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameWithTimeAndMemory
 */
final class ParserTest extends TestCase
{
    public function testParsesXdebugTraceFile(): void
    {
        $frames = (new Parser)->load(__DIR__ . '/../fixture/function/trace.xt')->asArray();

        $this->assertCount(28, $frames);

        $frame = $frames[0];
        $this->assertTrue($frame->isEntry());
        $this->assertSame('{main}', $frame->name());
        $this->assertFalse($frame->isInternal());
        $this->assertSame('', $frame->includeFile());
        $this->assertSame('/path/to/xdebug-trace-util/tests/fixture/function/src/run.php', $frame->file());
        $this->assertSame(0, $frame->line());
        $this->assertSame(0.000264, $frame->time());
        $this->assertSame(428640, $frame->memory());
        $this->assertSame(1, $frame->level());
        $this->assertSame(0, $frame->function());

        $frame = $frames[1];
        $this->assertTrue($frame->isEntry());
        $this->assertSame('str_split', $frame->name());
        $this->assertTrue($frame->isInternal());
        $this->assertSame('', $frame->includeFile());
        $this->assertSame('/path/to/xdebug-trace-util/tests/fixture/function/src/run.php', $frame->file());
        $this->assertSame(15, $frame->line());
        $this->assertSame(0.000284, $frame->time());
        $this->assertSame(428640, $frame->memory());
        $this->assertSame(2, $frame->level());
        $this->assertSame(1, $frame->function());

        $frame = $frames[2];
        $this->assertTrue($frame->isExit());
        $this->assertSame(0.00029, $frame->time());
        $this->assertSame(429208, $frame->memory());
        $this->assertSame(2, $frame->level());
        $this->assertSame(1, $frame->function());

        // How paranoid do I want to be?
    }
}
