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

    private string $headline;
    private array $bulletPoints;

    public function __construct(string $headline, array $bulletPoints)
    {
        $this->headline = $headline;
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

    protected function getElements(): array
    {
        $paddingTop = 4;
        $offsetY = 5;
        $elements = [];

        if ('' !== $this->headline) {
            $headline = new Headline($this->headline, Fill::withColor('#000000', '#FFFFFF', ['bold']), [
                'font' => static::$headlineFont,
            ]);
            $elements[] = [new Position(8, $paddingTop - 2), $headline];
            $paddingTop += 8;
        }

        foreach ($this->bulletPoints as $i => $text) {
            $bulletPoint = new Headline(sprintf('-  %s', $text), Fill::withColor('#000000', '#FFFFFF', ['bold']), [
                'font' => static::$bulletPointFont,
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
