<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Laminas\Text\Figlet\Figlet;
use Stoffel\Console\Canvas\Element\Headline;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Canvas\Position;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListSlide extends CanvasSlide
{
    private static string $headlineFont;
    private static string $bulletPointFont;

    private array $bulletPoints;
    private string $headline = '';

    public function __construct(array $bulletPoints)
    {
        $this->bulletPoints = $bulletPoints;
    }

    public static function setHeadlineFont(string $font): void
    {
        static::$headlineFont = $font;
    }

    public static function setBulletPointFont(string $font): void
    {
        static::$bulletPointFont = $font;
    }

    public static function withHeadline(string $headline, array $bulletPoints): self
    {
        $listSlide = new self($bulletPoints);
        $listSlide->headline = $headline;

        return $listSlide;
    }

    protected function getElements(): array
    {
        $paddingTop = 7;
        $offsetY = 8;
        $elements = [];

        if ('' !== $this->headline) {
            $headline = new Headline($this->headline, Fill::withColor('white'), [
                'font' => static::$headlineFont,
                'justification' => Figlet::JUSTIFICATION_CENTER,
            ]);
            $elements[] = [new Position(0, $paddingTop), $headline];
            $paddingTop += 10;
        }

        foreach ($this->bulletPoints as $i => $text) {
            $bulletPoint = new Headline(sprintf('·      %s', $text), Fill::withColor('white'), [
                'font' => static::$bulletPointFont,
            ]);
            $elements[] = [new Position(20, $paddingTop + $i * $offsetY), $bulletPoint];
        }

        return $elements;
    }
}
