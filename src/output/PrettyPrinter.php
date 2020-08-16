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

use const PHP_EOL;
use function sprintf;
use function str_repeat;

/**
 * @psalm-pure
 */
final class PrettyPrinter
{
    public function print(FrameCollection $frames): string
    {
        $buffer = '';

        foreach ($frames as $frame) {
            if (!$frame->isEntry()) {
                continue;
            }

            $buffer .= $this->printEntryFrame($frame);
        }

        return $buffer;
    }

    private function printEntryFrame(EntryFrame $frame): string
    {
        return sprintf(
            '%s-> %s%s %s:%d' . PHP_EOL,
            str_repeat('  ', $frame->level() - 1),
            $frame->name(),
            $frame->name() !== '{main}' ? '()' : '',
            $frame->file(),
            $frame->line()
        );
    }
}
