<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\SourceCode\SourceCodeHelper;
use Symfony\Component\Console\Color;
use Symfony\Component\Console\Terminal;

class CodeSlide extends Slide
{
    private string $filePath;
    private int $offset;
    private ?int $lines;
    private int $minLineLength;
    private Color $backgroundColor;
    private Color $borderColor;

    public function __construct(
        string $filePath,
        int $offset = 0,
        int $lines = null,
        int $minLineLength = 60,
        string $backgroundColor = '#FFFFFF',
        string $borderColor = '#999999'
    ) {
        $this->filePath = $filePath;
        $this->offset = $offset;
        $this->lines = $lines;
        $this->minLineLength = $minLineLength;
        $this->backgroundColor = new Color($backgroundColor);
        $this->borderColor = new Color($borderColor);
    }

    public function render(): void
    {
        $code = file_get_contents($this->filePath);
        $lines = explode(PHP_EOL, $code);
        $height = $this->lines ?: count($lines);
        $width = $this->getCodeWidth($lines);
        $terminal = new Terminal();
        $paddingLeft = (int)floor(($terminal->getWidth() - $width) / 2);
        $paddingRight = (int)ceil(($terminal->getWidth() - $width) / 2);
        $paddingTop = max((int)ceil(($terminal->getHeight() - $height) / 2), 2);
        $paddingBottom = max((int)floor(($terminal->getHeight() - $height) / 2), 2);

        if ($paddingTop > 1) {
            $this->getOutput()->write(
                $this->backgroundColor->apply(str_repeat(str_repeat('█', $terminal->getWidth()), $paddingTop - 1))
            );
        }

        $this->getOutput()->writeln(
            $this->backgroundColor->apply(str_repeat('█', max($paddingLeft - 1, 0))).
            $this->borderColor->apply(str_repeat('█', $width + 2)).
            $this->backgroundColor->apply(str_repeat('█', max($paddingRight - 1, 0)))
        );

        $source = SourceCodeHelper::create($this->getOutput())
            ->highlightFile($this->filePath, $this->offset, $this->lines, $this->minLineLength);

        foreach (explode(PHP_EOL, $source) as $line) {
            $padding1 = $this->backgroundColor->apply(str_repeat('█', max($paddingLeft - 1, 0)));
            $padding2 = $this->backgroundColor->apply(str_repeat('█', max($paddingRight - 1, 0)));
            $border = $this->borderColor->apply('█');
            echo $padding1.$border.$line.$border.$padding2.PHP_EOL;
        }

        $this->getOutput()->writeln(
            $this->backgroundColor->apply(str_repeat('█', max($paddingLeft - 1, 0))).
            $this->borderColor->apply(str_repeat('█', $width + 2)).
            $this->backgroundColor->apply(str_repeat('█', max($paddingRight - 1, 0)))
        );

        if ($paddingBottom > 1) {
            $this->getOutput()->write(
                $this->backgroundColor->apply(str_repeat(str_repeat('█', $terminal->getWidth()), $paddingBottom - 1))
            );
        }
    }

    private function getCodeWidth(array $lines): int
    {
        $lineLength = max(max(array_map('mb_strlen', $lines)), $this->minLineLength);
        $lineNumbers = mb_strlen((string)count($lines)) + 2;

        return $lineLength + $lineNumbers;
    }
}
