<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests;

use Ekapusta\OAuth2EsiaBundle\EkapustaOAuth2EsiaBundle;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel implements CompilerPassInterface
{
    public function registerBundles()
    {
        return [
            new EkapustaOAuth2EsiaBundle(),
            new FrameworkBundle(),
        ];
    }

    public function getRootDir()
    {
        return __DIR__.DIRECTORY_SEPARATOR.'TestKernel';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->setParameter('kernel.secret', __METHOD__);
            $container->setParameter('ekapusta_oauth2_esia.signer.certificate_path', __DIR__.'/Keys/test.cer');
            $container->setParameter('ekapusta_oauth2_esia.signer.private_key_path', __DIR__.'/Keys/test.key');

            $container->setParameter('ekapusta_oauth2_esia.client_id', 'ACMEINC');
            $container->setParameter('ekapusta_oauth2_esia.redirect_uri', 'https://acme.inc/auth/finish');
            $container->setParameter('ekapusta_oauth2_esia.remote_url', 'https://esia-portal1.test.gosuslugi.ru');

            if ($container->getParameter('kernel.debug')) {
                $container->setParameter('ekapusta_oauth2_esia.logger.class', Logger::class);
            }

            $container->addCompilerPass($this);
        });
    }

    public function process(ContainerBuilder $container)
    {
        $container->getDefinition('ekapusta_oauth2_esia.signer')->setPublic(true);
        $container->getDefinition('ekapusta_oauth2_esia.provider')->setPublic(true);
        $container->getDefinition('ekapusta_oauth2_esia.service')->setPublic(true);
    }
}
