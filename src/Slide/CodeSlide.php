<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\SourceCode\SourceCodeHelper;
use Symfony\Component\Console\Terminal;

class CodeSlide extends Slide
{
    private string $filePath;
    private int $offset;
    private ?int $lines;

    public function __construct(string $filePath, int $offset = 0, int $lines = null)
    {
        $this->filePath = $filePath;
        $this->offset = $offset;
        $this->lines = $lines;
    }

    public function render(): void
    {
        $code = file_get_contents($this->filePath);
        $lines = explode(PHP_EOL, $code);
        $height = $this->lines ? $this->lines : count($lines);
        $width = max(array_map('mb_strlen', $lines)) + 5;
        $terminal = new Terminal();
        $paddingX = (int)floor(($terminal->getWidth() - $width) / 2);
        $paddingY = (int)floor(($terminal->getHeight() - $height) / 2);

        $this->getOutput()->write(str_repeat(PHP_EOL, $paddingY));

        $source = SourceCodeHelper::create($this->getOutput())
            ->highlightFile($this->filePath, $this->offset, $this->lines);

        foreach (explode(PHP_EOL, $source) as $line) {
            $padding = str_repeat(' ', $paddingX);
            $this->getOutput()->write($padding.$line.$padding.PHP_EOL);
        }

        $this->getOutput()->write(str_repeat(PHP_EOL, $paddingY));
    }
}
