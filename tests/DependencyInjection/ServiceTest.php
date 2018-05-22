<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests\DependencyInjection;

use Ekapusta\OAuth2Esia\Interfaces\EsiaServiceInterface;
use Ekapusta\OAuth2EsiaBundle\Tests\ServiceTestCase;

class ServiceTest extends ServiceTestCase
{
    public function testCanGetService()
    {
        $signer = $this->service();

        $this->assertInstanceOf(EsiaServiceInterface::class, $signer);
    }

    public function testGetAuthorizationUrl()
    {
        $state = $this->service()->generateState();
        $this->assertRegExp('/^.+-.+-.+-.+$/', $state);

        $url = $this->service()->getAuthorizationUrl($state);

        $this->assertStringStartsWith('https://esia-portal1.test.gosuslugi.ru/aas/oauth2', $url);
        $this->assertContains('ACMEINC', $url);
        $this->assertContains('acme.inc', $url);
    }

    /**
     * @return EsiaServiceInterface
     */
    private function service()
    {
        return $this->getService('ekapusta_oauth2_esia.service');
    }
}
