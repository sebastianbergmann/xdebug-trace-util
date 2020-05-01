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

final class FrameCollectionIterator implements \Iterator
{
    /**
     * @psalm-var list<Frame>
     */
    private array $frames;

    private int $position = 0;

    public function __construct(FrameCollection $frames)
    {
        $this->frames = $frames->asArray();
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return $this->position < \count($this->frames);
    }

    public function key(): int
    {
        return $this->position;
    }

    public function current(): Frame
    {
        return $this->frames[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }
}
