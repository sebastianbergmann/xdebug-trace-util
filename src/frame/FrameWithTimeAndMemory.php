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

/**
 * @psalm-immutable
 */
abstract class FrameWithTimeAndMemory extends Frame
{
    private float $time;

    private int $memory;

    protected function __construct(int $level, int $function, float $time, int $memory)
    {
        parent::__construct($level, $function);

        $this->time   = $time;
        $this->memory = $memory;
    }

    public function time(): float
    {
        return $this->time;
    }

    public function memory(): int
    {
        return $this->memory;
    }
}
