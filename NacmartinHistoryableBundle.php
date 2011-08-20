<?php

namespace Nacmartin\HistoryableBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Nacmartin\HistoryableBundle\DependencyInjection\Compiler\ValidateExtensionConfigurationPass;

class NacmartinHistoryableBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ValidateExtensionConfigurationPass());
    }
}
