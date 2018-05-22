<?php

namespace Ekapusta\OAuth2EsiaBundle\DependencyInjection;

use Ekapusta\OAuth2Esia\Provider\EsiaProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EkapustaOAuth2EsiaExtension extends Extension
{
    private $configLocator;

    public function __construct()
    {
        $this->configLocator = new FileLocator(__DIR__.'/../Resources/config');
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, $this->configLocator);

        $container->setParameter('ekapusta_oauth2_esia.vendor.resources_path', EsiaProvider::RESOURCES);

        $loader->load('services.yml');
    }
}
