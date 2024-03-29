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
final class ReturnFrame extends Frame
{
    private string $value;

    protected function __construct(int $level, int $function, string $value)
    {
        parent::__construct($level, $function);

        $this->value = $value;
    }

    public function isReturn(): bool
    {
        return true;
    }

    public function value(): string
    {
        return $this->value;
    }
}
