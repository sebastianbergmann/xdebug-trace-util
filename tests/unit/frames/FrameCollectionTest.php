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
 * @covers \SebastianBergmann\XdebugTraceUtil\FrameCollection
 * @covers \SebastianBergmann\XdebugTraceUtil\FrameCollectionIterator
 *
 * @uses \SebastianBergmann\XdebugTraceUtil\EntryFrame
 * @uses \SebastianBergmann\XdebugTraceUtil\FrameWithTimeAndMemory
 * @uses \SebastianBergmann\XdebugTraceUtil\Frame
 */
final class FrameCollectionTest extends TestCase
{
    public function testCanBeIterated(): void
    {
        foreach ($this->fixture() as $position => $frame) {
            $this->assertSame(0, $position);
            $this->assertInstanceOf(Frame::class, $frame);
        }
    }

    public function testCanBeCounted(): void
    {
        $this->assertCount(1, $this->fixture());
    }

    private function fixture(): FrameCollection
    {
        return FrameCollection::fromList(
            Frame::entry(
                1,
                1,
                0.0,
                0,
                '{main}',
                true,
                '',
                'test.php',
                1
            )
        );
    }
}
