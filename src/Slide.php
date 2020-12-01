<?php

declare(strict_types=1);

namespace jæm3l\CliNote;

use Symfony\Component\Console\Output\OutputInterface;

abstract class Slide
{
    private OutputInterface $output;

    abstract public function render(): void;

    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    protected function getOutput(): OutputInterface
    {
        return $this->output;
    }
}
