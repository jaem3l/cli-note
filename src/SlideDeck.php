<?php

declare(strict_types=1);

namespace jæm3l\CliNote;

use InvalidArgumentException;

class SlideDeck
{
    /**
     * @var array<int, Slide>
     */
    private array $slides;

    public function __construct(Slide ...$slides)
    {
        if (0 === count($slides)) {
            throw new InvalidArgumentException('Cannot instantiate an empty slide deck.');
        }

        $this->slides = $slides;
    }

    public function start(int $slideNumber = 0): bool
    {
        if (!array_key_exists($slideNumber, $this->slides)) {
            $message = 'Slide number %d does not exist, this deck has slides 0-%s';

            throw new InvalidArgumentException(sprintf($message, $slideNumber, count($this->slides) - 1));
        }

        while (key($this->slides) !== $slideNumber) {
            next($this->slides);
        }

        return $this->current();
    }

    public function first(): bool
    {
        return $this->render(reset($this->slides));
    }

    public function current(): bool
    {
        return $this->render(current($this->slides));
    }

    public function previous(): bool
    {
        return $this->render(prev($this->slides));
    }

    public function last(): bool
    {
        return $this->render(end($this->slides));
    }

    public function next(): bool
    {
        return $this->render(next($this->slides));
    }

    private function render($slide): bool
    {
        if (!$slide instanceof Slide) {
            return false;
        }
        
        $slide->render();
        
        return true;
    }
}
