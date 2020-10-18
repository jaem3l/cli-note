<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\Canvas\CanvasHelper;
use Stoffel\Console\Canvas\Dimension;
use Stoffel\Console\Canvas\Element\Headline;
use Stoffel\Console\Canvas\Element\Image;
use Stoffel\Console\Canvas\Element\Rectangle;
use Stoffel\Console\Canvas\Fill;
use Stoffel\Console\Canvas\Position;

class CanvasSlide extends Slide
{
    public function render(): void
    {
        $canvas = CanvasHelper::create($this->getOutput());
        $canvas
            ->setBackground(Fill::withGradient(['#000000', '#999999']))
            ->addElement(new Position(10, 10), new Rectangle(new Dimension(10, 5), Fill::withColor('#FF0000')))
            ->addElement(new Position(50, 5), new Rectangle(new Dimension(20, 5), Fill::withGradient('summer')))
            ->addElement(new Position(100, 5), new Rectangle(new Dimension(30, 25), Fill::withColor('#00FF00')))
            ->addElement(new Position(10, 40), new Headline('Hello World', Fill::withColor('yellow')))
            ->addElement(new Position(25, 13), new Image(dirname(__DIR__, 2).'/examples/php-logo.png', new Dimension(60, 30)))
            ->draw();
    }
}
