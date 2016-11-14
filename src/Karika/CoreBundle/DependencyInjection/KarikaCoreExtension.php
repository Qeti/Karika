<?php

namespace Karika\CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class KarikaCoreExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $mergedConfig, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $processedConfig = $this->processConfiguration($configuration, $mergedConfig);

        foreach ($processedConfig['entity'] as $key => $value)
        {
            $container->setParameter('karika.entity.' . $key, $value);
        }
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return 'karika';
    }
}
