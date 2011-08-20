<?php

namespace Nacmartin\HistoryableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nacmartin_historyable');

        $rootNode
            ->append($this->getVendorNode('orm'))
            ->append($this->getVendorNode('mongodb'))
            ->append($this->getClassNode())
            ->children()
                ->scalarNode('default_locale')
                    ->cannotBeEmpty()
                    ->defaultValue('en')
                ->end()
                ->booleanNode('translation_fallback')->defaultFalse()->end()
            ->end()
        ;

        return $treeBuilder;
    }

    private function getVendorNode($name)
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root($name);

        $node
            ->useAttributeAsKey('id')
            ->prototype('array')
                ->performNoDeepMerging()
                ->children()
                    ->scalarNode('historyable')->defaultFalse()->end()
                ->end()
            ->end()
        ;

        return $node;
    }

    private function getClassNode()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('class');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('historyable')
                    ->cannotBeEmpty()
                    ->defaultValue('Nacmartin\\Historyable\\HistoryableListener')
                ->end()
            ->end()
        ;

        return $node;
    }
}
