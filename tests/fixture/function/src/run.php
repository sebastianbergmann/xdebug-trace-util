<?php declare(strict_types=1);
/*
 * This file is part of sebastian/xdebug-trace-util.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
function ret_ord($c)
{
    return ord($c);
}

foreach (str_split('Xdebug') as $char) {
    echo $char, ': ', ret_ord($char), "\n";
}
