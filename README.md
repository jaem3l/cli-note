# CLI Note

CLI Note is an experiment to use a console application as a slide deck.

## Usage

Use [jaem3l/cli-note-presentation](https://github.com/jaem3l/cli-note-presentation) as skeleton for your presentation.

## Example

To execute a simple example you can just clone this repository:

```bash
$ git clone git@github.com:jaem3l/cli-note.git
$ cd cli-note
$ composer install
$ ./cli-note
```

## Controls

**Start at specific slide**

```bash
$ ./cli-note --start-at=10
$ ./cli-note -s 10
```

**While presentation**

 * `p`, `prev` or `previous`: render previous slide
 * `c` or `current`: render current slide again
 * `n` or `next`: render next slide
 * `f` or `first`: render first slide
 * `l` or `last`: render last slide

## Slides

CLI Note ships with seven different built-in slides

 * CanvasSlide - an abstract slide to render various canvas elements based on [chr-hertel/console-canvas](https://github.com/chr-hertel/console-canvas)
 * CodeSlide - to print highlighted code snippets
 * ImageSlide - to print images
 * ListSlide - to print a list with a headline
 * ProcessSlide - to print the output of a child process
 * TextSlide - to print a text file with formatting possible
 * TitleSlide - to print a title and an optional subtitle

## Disclaimer

This is just a project to demonstrate the capabilities of Symfony Console Component for SymfonyWorld 2020.
Use this on your own risk and do not expect this to be actively maintained. 
