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

final class SplAutoloadCallFilter implements Filter
{
    private bool $accept = true;

    private int $level = 0;

    public function accept(Frame $frame): bool
    {
        if ($this->accept && $frame->isEntry() && $frame->name() === 'spl_autoload_call') {
            $this->accept = false;
            $this->level  = $frame->level();

            return false;
        }

        if (!$this->accept && $frame->isExit() && $frame->level() === $this->level) {
            $this->accept = true;

            return false;
        }

        return $this->accept;
    }
}
