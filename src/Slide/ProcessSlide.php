<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Process;

class ProcessSlide extends Slide
{
    private string $command;

    public function __construct(string $command)
    {
        $this->command = $command;
    }

    public function render(): void
    {
        $cursor = new Cursor($this->getOutput());
        $cursor->clearScreen();
        $cursor->moveToPosition(0, 0);
        $this->getOutput()->writeln(sprintf('-> %s', $this->command));
        sleep(1);

        $process = Process::fromShellCommandline($this->command);

        $process->run(function ($type, $buffer) {
            $this->getOutput()->write($buffer);
        });
    }
}
