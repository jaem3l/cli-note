<?php

declare(strict_types=1);

namespace jæm3l\CliNote;

use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\SingleCommandApplication;

class CliNote extends SingleCommandApplication
{
    private array $slides;
    
    public function __construct(Slide ...$slides)
    {
        $this->slides = $slides;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption('start-at', 's', InputOption::VALUE_REQUIRED, 'Slide number to start with', 0);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->slides as $slide) {
            $slide->setOutput($output);
        }

        $slideDeck = new SlideDeck($this->slides);

        $cursor = new Cursor($output);
        $cursor->hide();
        $slideDeck->start((int)$input->getOption('start-at'));

        do {
            $answer = (new QuestionHelper())->ask($input, $output, new Question(''));
            $cursor->clearScreen();

            switch ($answer) {
                case 'p':
                case 'prev':
                case 'previous':
                    $step = static fn () => $slideDeck->previous();
                    break;
                case 'c':
                case 'current':
                    $step = static fn () => $slideDeck->current();
                    break;
                case 'f':
                case 'first':
                    $step = static fn () => $slideDeck->first();
                    break;
                case 'l':
                case 'last':
                    $step = static fn () => $slideDeck->last();
                    break;
                case 'n':
                case 'next':
                default:
                    $step = static fn () => $slideDeck->next();
            }

        } while ($step());

        $cursor->show();

        return 0;
    }
}
