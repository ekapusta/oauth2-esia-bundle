<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests;

use Ekapusta\OAuth2EsiaBundle\EkapustaOAuth2EsiaBundle;
use PHPUnit\Framework\TestCase;

class EkapustaOAuth2EsiaBundleTest extends TestCase
{
    public function testHasName()
    {
        $bundle = new EkapustaOAuth2EsiaBundle();

        $this->assertEquals('EkapustaOAuth2EsiaBundle', $bundle->getName());
    }
}
