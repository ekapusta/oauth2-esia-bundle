<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests\DependencyInjection;

use Ekapusta\OAuth2Esia\Interfaces\Provider\ProviderInterface;
use Ekapusta\OAuth2EsiaBundle\Tests\ServiceTestCase;

class ProviderTest extends ServiceTestCase
{
    public function testCanGetService()
    {
        $signer = $this->provider();

        $this->assertInstanceOf(ProviderInterface::class, $signer);
    }

    public function testGetAuthorizationUrl()
    {
        $url = $this->provider()->getAuthorizationUrl();

        $this->assertStringStartsWith('https://esia-portal1.test.gosuslugi.ru/aas/oauth2', $url);
        $this->assertContains('ACMEINC', $url);
        $this->assertContains('acme.inc', $url);
    }

    /**
     * @expectedException \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     * @expectedExceptionMessage Unauthorized
     */
    public function testLoggerInjected()
    {
        $this->provider()->getAccessToken('authorization_code', ['code' => '...']);
    }

    /**
     * @return ProviderInterface
     */
    private function provider()
    {
        return $this->getService('ekapusta_oauth2_esia.provider');
    }
}
