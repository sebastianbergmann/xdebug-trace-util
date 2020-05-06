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
final class ExitFrame extends FrameWithTimeAndMemory
{
    public function isExit(): bool
    {
        return true;
    }
}
