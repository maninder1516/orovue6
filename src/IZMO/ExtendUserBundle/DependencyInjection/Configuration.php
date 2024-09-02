<?php

namespace IZMO\ExtendUserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;


class Configuration implements ConfigurationInterface {

    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('izmo_extend_user');
        // Build the configuration tree here
        SettingsBuilder::append($treeBuilder->getRootNode(), [
            'foo' => [
                'value' => true,
                'type' => 'boolean',
            ],
            'bar' => [
                'value' => 10,
            ],
        ]);
        
        return $treeBuilder;
    }
    
}
