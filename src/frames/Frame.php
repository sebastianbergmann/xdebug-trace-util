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
abstract class Frame
{
    private int $level;

    private int $function;

    public static function entry(int $level, int $function, float $time, int $memory, string $name, bool $isInternal, string $includeFile, string $file, int $line): EntryFrame
    {
        return new EntryFrame(
            $level,
            $function,
            $time,
            $memory,
            $name,
            $isInternal,
            $includeFile,
            $file,
            $line
        );
    }

    public static function exit(int $level, int $function, float $time, int $memory): ExitFrame
    {
        return new ExitFrame(
            $level,
            $function,
            $time,
            $memory
        );
    }

    public static function return(int $level, int $function, string $value): ReturnFrame
    {
        return new ReturnFrame(
            $level,
            $function,
            $value
        );
    }

    protected function __construct(int $level, int $function)
    {
        $this->level    = $level;
        $this->function = $function;
    }

    /**
     * @psalm-assert-if-true EntryFrame $this
     */
    public function isEntry(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true ExitFrame $this
     */
    public function isExit(): bool
    {
        return false;
    }

    /**
     * @psalm-assert-if-true ReturnFrame $this
     */
    public function isReturn(): bool
    {
        return false;
    }

    public function level(): int
    {
        return $this->level;
    }

    public function function(): int
    {
        return $this->function;
    }

    public function asString(): string
    {
        return '';
    }
}
