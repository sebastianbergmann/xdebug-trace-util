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

use function iterator_to_array;
use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\XdebugTraceUtil\AutoloadFilter
 *
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameCollection
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameCollectionIterator
 * @uses \SebastianBergmann\XdebugTraceUtil\Frame
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameWithTimeAndMemory
 * @uses \SebastianBergmann\XdebugTraceUtil\EntryFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\ReturnFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\ExitFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\Parser
 * @uses \SebastianBergmann\XdebugTraceUtil\PrettyPrinter
 */
final class AutoloadFilterTest extends TestCase
{
    public function testFiltersAutoloadFrames(): void
    {
        $this->assertStringEqualsFile(
            __DIR__ . '/../fixture/method-in-autoloaded-class/filtered-trace.txt',
            (new PrettyPrinter)->print(
                FrameCollection::fromList(
                    ...iterator_to_array(
                        AutoloadFilter::from(
                            (new Parser)->load(
                                __DIR__ . '/../fixture/method-in-autoloaded-class/trace.xt'
                            )
                        ),
                        false
                    )
                )
            )
        );
    }
}
