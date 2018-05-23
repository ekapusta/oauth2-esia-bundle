<?php

namespace Ekapusta\OAuth2EsiaBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class ServiceTestCase extends KernelTestCase
{
    protected function setUp()
    {
        static::$class = TestKernel::class;
        self::bootKernel([
            'debug' => $this->isDebug(),
        ]);
    }

    protected function getService($id)
    {
        return static::$kernel->getContainer()->get($id);
    }

    /**
     * @return bool
     */
    protected function isDebug()
    {
        return isset($_SERVER['argv']) && in_array('--debug', $_SERVER['argv']);
    }
}
