<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Laminas\Text\Figlet\Figlet;
use Stoffel\Console\Canvas\Element\Headline;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Canvas\Position;
use Stoffel\Console\Headline\HeadlineHelper;
use Symfony\Component\Console\Color;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class TitleSlide extends CanvasSlide
{
    private static string $defaultTitleFont;
    private static string $defaultSubtitleFont;

    private string $title;
    private string $subtitle;
    private string $titleFont;
    private string $subtitleFont;

    public function __construct(
        string $title,
        string $subtitle = '',
        string $titleFont = null,
        string $subtitleFont = null
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->titleFont = $titleFont ?? self::$defaultTitleFont;
        $this->subtitleFont = $subtitleFont ?? self::$defaultSubtitleFont;
    }

    public static function setDefaultTitleFont(string $font): void
    {
        static::$defaultTitleFont = $font;
    }

    public static function setDefaultSubtitleFont(string $font): void
    {
        static::$defaultSubtitleFont = $font;
    }

    protected function getBackground(): ?Fill
    {
        return Fill::withColor('#FFFFFF');
    }

    protected function getElements(): array
    {
        $color = Fill::withColor('#000000', '#FFFFFF', ['bold']);

        if (null === $this->subtitle) {
            return [
                [new Position(0, 10), new Headline($this->title, $color, [
                    'font' => $this->titleFont,
                    'justification' => Figlet::JUSTIFICATION_CENTER,
                ])],
            ];
        }

        return [
            [new Position(0, 10), new Headline($this->title, $color, [
                'font' => $this->titleFont,
                'justification' => Figlet::JUSTIFICATION_CENTER,
            ])],
            [new Position(0, 25), new Headline($this->subtitle, $color, [
                'font' => $this->subtitleFont,
                'justification' => Figlet::JUSTIFICATION_CENTER,
            ])],
        ];
    }
}
