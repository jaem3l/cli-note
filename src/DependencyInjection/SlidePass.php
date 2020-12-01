<?php

declare(strict_types=1);

namespace jæm3l\CliNote\DependencyInjection;

use jæm3l\CliNote\Slide;
use ReflectionClass;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * CompilerPass to tag child classes of predefined slides.
 */
class SlidePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        foreach ($container->getDefinitions() as $definition) {
            if (!$definition instanceof ChildDefinition || $definition->isAbstract()|| $definition->hasTag('cli_note.slide')) {
                continue;
            }

            $parentClass = $container->getDefinition($definition->getParent())->getClass();

            if (null === $parentClass) {
                continue;
            }

            if ((new ReflectionClass($parentClass))->isSubclassOf(Slide::class)) {
                $definition->addTag('cli_note.slide');
            }
        }
    }
}
