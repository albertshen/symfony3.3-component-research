<?php
namespace Symfony\Component\Config\Definition\Builder;

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class DatabaseConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('database');

		// $rootNode
		//     ->children()
		//         ->booleanNode('auto_connect')
		//             ->defaultTrue()
		//         ->end()
		//         ->scalarNode('default_connection')
		//             ->defaultValue('default')
		//         ->end()
		//         ->ArrayNode('array_node')
		//         	->children()
		//         		->booleanNode('boolean_con')
		// 		            ->defaultTrue()
		// 		        ->end()
		// 		    ->end()
		// 		->end()
		//     ->end()
		// ;
		$rootNode
		    ->children()
		        ->arrayNode('connections')
            		->prototype('array')
                		->children()
		                    ->scalarNode('driver')
		                    	->isRequired()
		                    	->validate()
                    				->ifString()
                    				->then(function ($v) { return array(); })
                				->end()
		                    ->end()
		                    ->scalarNode('host')->end()
		                    ->scalarNode('username')->end()
		                    ->scalarNode('password')->end()
                		->end()
            		->end()

        		->end()
		    ->end()
		;

		var_dump($rootNode->getChildren('connections')->getChildren());
		var_dump($rootNode->getChildren('connections')->getPrototype());
		exit;

        /*
        builder->node->builder->node
        return builer->parent = node
        return node->parent = builder
         */
        
		var_dump($rootNode instanceof ArrayNodeDefinition);
		/*
		$rootNode = new NodeDefinition (ArrayNodeDefinition)
		$rootNode->name = 'database'
		$rootNode->Builer = Builder1 = new NodeBuilder()
		$rootNode->Parent = $treeBuilder
		 */

		var_dump($rootNode
				    ->children() instanceof NodeBuilder);

		/*
		$Builer1 = $rootNode->children()
		$Builer1->Parant = $rootNode
		 */

		var_dump($rootNode
				    ->children()
				        ->booleanNode('auto_connect') instanceof NodeDefinition);
		/*
		$AutoConnectNode = new NodeDefinition (booleanNodeDefinition)
		$AutoConnectNode->Builer2 clone Builder1
		$AutoConnectNode->Parent = Builer2 (user clone to save the parent status)
		 */

		var_dump($rootNode
				    ->children()
				        ->booleanNode('auto_connect')
				            ->defaultTrue() instanceof NodeDefinition);
		/*
		$AutoConnectNode->defulteTrue = AutoConnectNode
		 */
		
		var_dump($rootNode
				    ->children()
				        ->booleanNode('auto_connect')
				            ->defaultTrue() 
				        ->end() instanceof NodeBuilder);
		/*
		return Builder2 = $AutoConnectNode->Builer2
		 */
		
		var_dump($rootNode
		    		->children()
		        		->booleanNode('auto_connect')
		            		->defaultTrue()
		       	 		->end()
		    		->end()
		);
		/*
		return Builder2 = $AutoConnectNode->Builer2
		Builder2->parent = Builder1->parent (clone after set Builder1->parent) = $rootNode
		 */
		exit;

        // ... add node definitions to the root of the tree

        return $treeBuilder;
    }
}

$a = new DatabaseConfiguration();
$a->getConfigTreeBuilder();