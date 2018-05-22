<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests\DependencyInjection;

use Ekapusta\OAuth2EsiaBundle\DependencyInjection\EkapustaOAuth2EsiaExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EkapustaBorrowerChecksExtensionTest extends TestCase
{
    public function testCanLoadEmptyConfig()
    {
        $container = new ContainerBuilder();

        $extension = new EkapustaOAuth2EsiaExtension();
        $extension->load([], $container);

        $this->assertTrue(true);
    }

    public function testConfiguresPathToResources()
    {
        $container = new ContainerBuilder();

        $extension = new EkapustaOAuth2EsiaExtension();
        $extension->load([], $container);

        $path = $container->getParameter('ekapusta_oauth2_esia.vendor.resources_path');

        $this->assertFileExists($path);
    }
}
