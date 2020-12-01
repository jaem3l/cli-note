<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use Stoffel\Console\Canvas\Element\Headline;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Canvas\Position;

class ListSlide extends CanvasSlide
{
    private string $headline;
    private array $bulletPoints;
    private string $headlineFont;
    private string $bulletPointFont;

    public function __construct(string $headline, array $bulletPoints, string $headlineFont, string $bulletPointFont)
    {
        $this->headline = $headline;
        $this->bulletPoints = $bulletPoints;
        $this->headlineFont = $headlineFont;
        $this->bulletPointFont = $bulletPointFont;
    }

    protected function getElements(): array
    {
        $paddingTop = 4;
        $offsetY = 5;
        $elements = [];

        if ('' !== $this->headline) {
            $headline = new Headline($this->headline, Fill::withColor('#000000', '#FFFFFF', ['bold']), [
                'font' => $this->headlineFont,
            ]);
            $elements[] = [new Position(8, $paddingTop - 2), $headline];
            $paddingTop += 8;
        }

        foreach ($this->bulletPoints as $i => $text) {
            $bulletPoint = new Headline(sprintf('-  %s', $text), Fill::withColor('#000000', '#FFFFFF', ['bold']), [
                'font' => $this->bulletPointFont,
            ]);
            $elements[] = [new Position(12, $paddingTop + $i * $offsetY), $bulletPoint];
        }

        return $elements;
    }

    protected function getBackground(): Fill
    {
        return Fill::withColor('#FFFFFF');
    }
}
