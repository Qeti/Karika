<?php

namespace Karika\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('karika');

        $rootNode
            ->children()
                ->arrayNode('entity')
                    ->children()
                        ->scalarNode('product_class')->end()
                        ->scalarNode('user_class')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}
