<?php

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class DatabaseConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('database');

		$rootNode
		    ->beforeNormalization()
                // ->ifTrue(function ($v) { return !isset($v['assets']) && isset($v['templating']); })
                ->ifTrue(function ($v) { return false; })
                ->then(function ($v) {
                    $v['default_connection'] = array();

                    return $v;
                })
            ->end()
		    ->children()
		        ->booleanNode('auto_connect')
		        	->isRequired()
		            ->defaultTrue()
		        ->end()
		        ->arrayNode('redis')
		        	->addDefaultsIfNotSet()
		        	->children()
		        		->scalarNode('host')->defaultValue('333')->end()
		        		->scalarNode('user')->isRequired()->defaultValue('333')->end()
		        		->scalarNode('pass')->treatNullLike('nisa')->end()
		        	->end()
		        ->end()
		        ->scalarNode('default_connection')
		       		->defaultValue('albertshen')
		        ->end()
		        ->arrayNode('connections')
		        	->useAttributeAsKey('name')
            		->prototype('array')
                		->children()
		                    ->scalarNode('driver')
		                    	->isRequired()
		                    	->validate()
                    				->ifString()
                    				->then(function ($v) { return array(); })
                				->end()
		                    ->end()
		                    ->scalarNode('host')->defaultValue('asf')->end()
		                    ->scalarNode('username')->defaultValue('333')->end()
		                    ->scalarNode('password')->defaultValue('ddvsf')->end()
                		->end()
            		->end()
        		->end()
		    ->end()
		;
        // ... add node definitions to the root of the tree
        return $treeBuilder;
    }
}