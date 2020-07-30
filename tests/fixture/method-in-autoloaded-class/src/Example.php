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
use function ord;

final class Example
{
    public function publicMethod(): string
    {
        $string = '';

        foreach (str_split('Xdebug') as $char) {
            $string .= $char . ': ' . $this->privateMethod($char) . PHP_EOL;
        }

        return $string;
    }

    private function privateMethod(string $c): int
    {
        return ord($c);
    }
}
