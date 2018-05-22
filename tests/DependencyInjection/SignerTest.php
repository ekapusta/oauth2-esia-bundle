<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests\DependencyInjection;

use Ekapusta\OAuth2Esia\Interfaces\Security\SignerInterface;
use Ekapusta\OAuth2EsiaBundle\Tests\ServiceTestCase;

class SignerTest extends ServiceTestCase
{
    public function testCanGetService()
    {
        $signer = $this->signer();

        $this->assertInstanceOf(SignerInterface::class, $signer);
    }

    public function testCanSign()
    {
        $signed = $this->signer()->sign('hello world');

        $this->assertNotEmpty($signed);
    }

    /**
     * @return SignerInterface
     */
    private function signer()
    {
        return $this->getService('ekapusta_oauth2_esia.signer');
    }
}
