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
final class EntryFrame extends FrameWithTimeAndMemory
{
    private string $name;

    private bool $isInternal;

    private string $includeFile;

    private string $file;

    private int $line;

    protected function __construct(int $level, int $function, float $time, int $memory, string $name, bool $isInternal, string $includeFile, string $file, int $line)
    {
        parent::__construct($level, $function, $time, $memory);

        $this->name        = $name;
        $this->isInternal  = $isInternal;
        $this->includeFile = $includeFile;
        $this->file        = $file;
        $this->line        = $line;
    }

    public function isEntry(): bool
    {
        return true;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function isInternal(): bool
    {
        return $this->isInternal;
    }

    public function isUserDefined(): bool
    {
        return !$this->isInternal;
    }

    public function includeFile(): string
    {
        return $this->includeFile;
    }

    public function file(): string
    {
        return $this->file;
    }

    public function line(): int
    {
        return $this->line;
    }

    public function asString(): string
    {
        return \sprintf(
            '%s-> %s%s %s:%d',
            \str_repeat('  ', $this->level() - 1),
            $this->name(),
            $this->name() !== '{main}' ? '()' : '',
            $this->file(),
            $this->line()
        );
    }
}
