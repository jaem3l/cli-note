<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Symfony\Component\Console\Color;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Process\InputStream;
use Symfony\Component\Process\Process;

class ProcessSlide extends Slide
{
    private string $title;
    private string $command;

    public function __construct(string $title, string $command)
    {
        $this->title = $title;
        $this->command = $command;
    }

    public function render(): void
    {
        $cursor = new Cursor($this->getOutput());
        $cursor->clearScreen();
        $cursor->moveToPosition(0, 0);
        $this->getOutput()->write((new Color('#777777'))->apply('→ your/working/directory: '));
        $this->getOutput()->writeln($this->title.PHP_EOL);

        $process = Process::fromShellCommandline($this->command, null, null, null, 300);

        $process->run(function ($type, $buffer) {
            $this->getOutput()->write($buffer);
        });
    }
}
