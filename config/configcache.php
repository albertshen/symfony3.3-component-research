<?php

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\Config\Loader\DelegatingLoader;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class CacheConfig implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('database');
        $rootNode
            ->children()
                ->booleanNode('auto_connect')->end()
                ->scalarNode('default_connection')->end()
                ->arrayNode('connections')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('driver')->end()
                            ->scalarNode('host')->defaultValue('asf')->end()
                            ->scalarNode('username')->defaultValue('333')->end()
                            ->scalarNode('password')->defaultValue('ddvsf')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('redis')
                    ->children()
                        ->scalarNode('host')->end()
                        ->scalarNode('user')->end()
                        ->scalarNode('pass')->end()
                    ->end()
                ->end()
            ->end();
        return $treeBuilder;
    }
}



$cachePath = __DIR__.'/cache/configcache.php';


$userMatcherCache = new ConfigCache($cachePath, true);

if (!$userMatcherCache->isFresh()) {var_dump(2222);
   // fill this with an array of 'users.yml' file paths
    $yaml1 = __DIR__.'/config/database.yml';
    $yaml2 = __DIR__.'/config/database2.yml';

    $yamlUserFiles = array($yaml1, $yaml2);

    $resources = array();

    $configs = array();

    foreach ($yamlUserFiles as $yamlUserFile) {
        // see the article "Loading resources" to
        // know where $delegatingLoader comes from
        //$delegatingLoader->load($yamlUserFile);
        $configs[] = Yaml::parse(
            file_get_contents($yamlUserFile)
        );
        $resources[] = new FileResource($yamlUserFile);
    }

    $processor = new Processor();
    $configuration = new CacheConfig();

//$dumper = new YamlReferenceDumper();
//var_dump($dumper->dump($configuration));

    $processedConfiguration = $processor->processConfiguration(
        $configuration,
        $configs
    );

    // var_dump($processedConfiguration);exit;
    // the code for the UserMatcher is generated elsewhere
    $code = sprintf("<?php \n return %s;", var_export($processedConfiguration, true));

    $userMatcherCache->write($code, $resources);
}




// you may want to require the cached code:
// require $cachePath;