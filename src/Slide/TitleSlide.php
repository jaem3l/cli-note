<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\Headline\HeadlineHelper;
use Symfony\Component\Console\Color;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class TitleSlide extends Slide
{
    private static string $titleFont;
    private static string $subtitleFont;

    private string $title;
    private string $subtitle;

    public function __construct(string $title, string $subtitle = '')
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    public static function setTitleFont(string $font): void
    {
        static::$titleFont = $font;
    }

    public static function setSubtitleFont(string $font): void
    {
        static::$subtitleFont = $font;
    }

    public function render(): void
    {
        $terminalHeight = (new Terminal())->getHeight();
        $title = $this->getTitle();

        if ('' === $this->subtitle) {
            $padding = (int)ceil(($terminalHeight - $title->getHeight()) / 2);
            $this->getOutput()->write(str_repeat(PHP_EOL, $padding));
            $title->write();
            $this->getOutput()->write(str_repeat(PHP_EOL, $padding));

            return;
        }

        $subtitle = $this->getSubtitle();
        $padding = (int)ceil(($terminalHeight - ($title->getHeight() + $subtitle->getHeight())) / 2);

        $this->getOutput()->write(str_repeat(PHP_EOL, $padding - 2));
        $title->write();

        $this->getOutput()->write(str_repeat(PHP_EOL, 8));
        $subtitle->write();

        $this->getOutput()->write(str_repeat(PHP_EOL, $padding - 6));
    }

    private function getTitle(): HeadlineHelper
    {
        return HeadlineHelper::create($this->getOutput())
            ->setColor(new Color('#FFFFFF', '', ['bold']))
            ->setFigletOptions([
                'font' => static::$titleFont,
            ])
            ->setText($this->title);
    }

    private function getSubtitle(): HeadlineHelper
    {
        return HeadlineHelper::create($this->getOutput())
            ->setColor(new Color('#AAAAAA'))
            ->setFigletOptions([
                'font' => static::$subtitleFont,
            ])
            ->setText($this->subtitle);
    }
}
