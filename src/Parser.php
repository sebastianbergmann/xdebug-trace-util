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

use function count;
use SplFileObject;
use function strpos;

final class Parser
{
    public function load(string $filename): FrameCollection
    {
        $file   = new SplFileObject($filename);
        $frames = [];

        while (!$file->eof()) {
            $line = $file->fgetcsv("\t");

            if (!$line) {
                // @codeCoverageIgnoreStart
                break;
                // @codeCoverageIgnoreEnd
            }

            if (count($line) === 1 && strpos((string) $line[0], 'Version:') === 0) {
                continue;
            }

            if (count($line) === 1 && strpos((string) $line[0], 'File format:') === 0) {
                continue;
            }

            if (count($line) === 1 && strpos((string) $line[0], 'TRACE') === 0) {
                continue;
            }

            if (count($line) === 10 && $line[2] === '0') {
                $frames[] = Frame::entry(
                    (int) $line[0],
                    (int) $line[1],
                    (float) $line[3],
                    (int) $line[4],
                    (string) $line[5],
                    $line[6] === '0',
                    (string) $line[7],
                    (string) $line[8],
                    (int) $line[9]
                );

                continue;
            }

            if (count($line) === 5 && $line[2] === '1') {
                $frames[] = Frame::exit(
                    (int) $line[0],
                    (int) $line[1],
                    (float) $line[3],
                    (int) $line[4]
                );

                continue;
            }

            if (count($line) === 6 && $line[2] === 'R') {
                $frames[] = Frame::return(
                    (int) $line[0],
                    (int) $line[1],
                    (string) $line[5]
                );
            }
        }

        return FrameCollection::fromList(...$frames);
    }
}
