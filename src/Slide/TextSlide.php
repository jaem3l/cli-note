<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\SourceCode\SourceCodeHelper;
use Symfony\Component\Console\Terminal;

class TextSlide extends Slide
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function render(): void
    {
        $text = file_get_contents($this->filePath);
        $lines = explode(PHP_EOL, $text);
        $height = count($lines);
        $width = max(array_map('mb_strlen', $lines));
        $terminal = new Terminal();
        $paddingX = (int)floor(($terminal->getWidth() - $width) / 2);
        $paddingY = (int)floor(($terminal->getHeight() - $height) / 2);

        $this->getOutput()->write(str_repeat(PHP_EOL, $paddingY));

        foreach ($lines as $line) {
            $padding = str_repeat(' ', $paddingX);
            $this->getOutput()->write($padding.$line.$padding.PHP_EOL);
        }

        $this->getOutput()->write(str_repeat(PHP_EOL, $paddingY));
    }
}
