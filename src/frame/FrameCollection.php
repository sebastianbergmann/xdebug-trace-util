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

use function count;
use Countable;
use IteratorAggregate;

/**
 * @psalm-immutable
 */
final class FrameCollection implements Countable, IteratorAggregate
{
    /**
     * @psalm-var list<Frame>
     */
    private array $frames;

    public static function fromList(Frame ...$frames): self
    {
        return new self(...$frames);
    }

    private function __construct(Frame ...$frames)
    {
        $this->frames = $frames;
    }

    /**
     * @psalm-return list<Frame>
     */
    public function asArray(): array
    {
        return $this->frames;
    }

    public function getIterator(): FrameCollectionIterator
    {
        return new FrameCollectionIterator($this);
    }

    public function count(): int
    {
        return count($this->frames);
    }

    public function apply(Filter $filter): self
    {
        $frames = [];

        foreach ($this->frames as $frame) {
            if (!$filter->accept($frame)) {
                continue;
            }

            $frames[] = $frame;
        }

        return self::fromList(...$frames);
    }
}
