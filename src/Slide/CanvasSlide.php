<?php

declare(strict_types=1);

namespace jæm3l\CliNote\Slide;

use jæm3l\CliNote\Slide;
use Stoffel\Console\Canvas\CanvasHelper;
use Stoffel\Console\Canvas\Fill;

abstract class CanvasSlide extends Slide
{
    public function render(): void
    {
        $canvas = CanvasHelper::create($this->getOutput());
        $canvas->setBackground($this->getBackground());

        foreach ($this->getElements() as $touple) {
            $canvas->addElement(...$touple);
        }

        $canvas->draw();
    }

    /**
     * Returns array of Position+Element tuples.
     *
     * @return array
     */
    abstract protected function getElements(): array;

    protected function getBackground(): ?Fill
    {
        return null;
    }
}
