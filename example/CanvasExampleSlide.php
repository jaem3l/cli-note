<?php

declare(strict_types=1);

use jæm3l\CliNote\Slide\CanvasSlide;
use Stoffel\Console\Canvas\Dimension;
use Stoffel\Console\Canvas\Element\Headline;
use Stoffel\Console\Canvas\Element\Image;
use Stoffel\Console\Canvas\Element\Rectangle;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Canvas\Position;

class CanvasExampleSlide extends CanvasSlide
{
    protected function getBackground(): ?Fill
    {
        return Fill::withGradient('instagram');
    }

    protected function getElements(): array
    {
        return [
            [new Position(10, 5), new Rectangle(new Dimension(150, 10), Fill::withColor('#FFFFFF'))],
            [new Position(15, 7), new Headline('Hello World', Fill::withColor('#000000', '#FFFFFF'))],
            [new Position(10, 20), new Image(__DIR__.'/elephant.jpg', new Dimension(60, 50))],
            [new Position(90, 20), new Image(__DIR__.'/elephant.jpg', new Dimension(60, 50))],
        ];
    }
}
