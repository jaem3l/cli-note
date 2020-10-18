<?php

declare(strict_types=1);

namespace jæm3l\CliNote;

use InvalidArgumentException;
use Symfony\Component\Console\Output\OutputInterface;

class SlideDeck
{
    /**
     * @var array<int, Slide>
     */
    private array $slides;

    public function __construct(array $slides)
    {
        $this->slides = $slides;
    }

    public function start(int $slideNumber = 0): bool
    {
        if (!array_key_exists($slideNumber, $this->slides)) {
            $message = 'Slide number %d does not exist, this deck has slides 0-%s';

            throw new InvalidArgumentException(sprintf($message, $slideNumber, count($this->slides)));
        }

        while (key($this->slides) !== $slideNumber) {
            next($this->slides);
        }

        $this->render();

        return true;
    }

    public function first(): bool
    {
        if ($result = reset($this->slides)) {
            $this->render();
        }

        return $result instanceof Slide;
    }

    public function previous(): bool
    {
        if ($result = prev($this->slides)) {
            $this->render();
        }

        return $result instanceof Slide;
    }

    public function last(): bool
    {
        if ($result = end($this->slides)) {
            $this->render();
        }

        return $result instanceof Slide;
    }

    public function next(): bool
    {
        if ($result = next($this->slides)) {
            $this->render();
        }

        return $result instanceof Slide;
    }

    private function render(): void
    {
        current($this->slides)->render();
    }
}
