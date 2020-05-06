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

use function assert;
use FilterIterator;

final class AutoloadFilter extends FilterIterator
{
    private bool $accept = true;

    private int $level = 0;

    public function __construct(FrameCollectionIterator $frames)
    {
        parent::__construct($frames);
    }

    public function accept(): bool
    {
        $frame = $this->getInnerIterator()->current();

        assert($frame instanceof Frame);

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
