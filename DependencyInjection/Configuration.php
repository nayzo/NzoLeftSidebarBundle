<?php

/*
 * This file is part of the NzoLeftSidebarBundle package.
 *
 * (c) Ala Eddine Khefifi <alakhefifi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nzo\LeftSidebarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('nzo_left_sidebar');
        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
            ->arrayNode('menu')
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->arrayPrototype()
            ->children()
            ->scalarNode('label')
            ->isRequired()
            ->end()
            ->scalarNode('href')
            ->isRequired()
            ->end()
            ->scalarNode('icon')->end()
            ->scalarNode('class')->end()
            ->scalarNode('role')->end()
            ->arrayNode('accepted_environment_names')
            ->scalarPrototype()->end()
            ->end()
            ->arrayNode('children')
            ->arrayPrototype()
            ->children()

            ->scalarNode('label')
            ->isRequired()
            ->end()
            ->scalarNode('href')
            ->isRequired()
            ->end()
            ->scalarNode('icon')->end()
            ->scalarNode('class')->end()
            ->scalarNode('role')->end()
            ->arrayNode('accepted_environment_names')
            ->scalarPrototype()->end()
            ->end()
            ->arrayNode('children')
            ->arrayPrototype()
            ->children()

            ->scalarNode('label')
            ->isRequired()
            ->end()
            ->scalarNode('href')
            ->isRequired()
            ->end()
            ->scalarNode('icon')->end()
            ->scalarNode('class')->end()
            ->scalarNode('role')->end()
            ->arrayNode('accepted_environment_names')
            ->scalarPrototype()->end()
            ->end()

            ->end()
            ->end()
            ->end()

            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
