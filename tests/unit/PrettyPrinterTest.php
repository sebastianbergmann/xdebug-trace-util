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
 * @covers \SebastianBergmann\XdebugTraceUtil\PrettyPrinter
 *
 * @uses \SebastianBergmann\XdebugTraceUtil\EntryFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\ReturnFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameWithTimeAndMemory
 * @uses \SebastianBergmann\XdebugTraceUtil\Frame
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameCollection
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameCollectionIterator
 * @uses \SebastianBergmann\XdebugTraceUtil\Parser
 */
final class PrettyPrinterTest extends TestCase
{
    public function testPrettyPrintsFrames(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../fixture/function/trace.txt',
            (new PrettyPrinter)->print(
                (new Parser)->load(__DIR__ . '/../fixture/function/trace.xt')
            )
        );
    }
}
