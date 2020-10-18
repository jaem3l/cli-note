<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\Image\ImageHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class ImageSlide extends Slide
{
    private string $imagePath;

    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function render(): void
    {
        $terminal = new Terminal();

        ImageHelper::create($this->getOutput())
            ->print($this->imagePath, $terminal->getWidth(), $terminal->getHeight() * 2);
    }
}
