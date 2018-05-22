<?php

namespace Ekapusta\OAuth2EsiaBundle\DependencyInjection;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Log\LoggerInterface;

final class Factory
{
    /**
     * @param LoggerInterface $logger
     * @param string          $logFormat
     * @param string          $logLevel
     *
     * @return ClientInterface
     */
    public static function createHttpClient(
        LoggerInterface $logger,
        $logFormat,
        $logLevel,
        callable $httpHandler
    ) {
        $formatter = new MessageFormatter($logFormat);
        $logger = Middleware::log($logger, $formatter, $logLevel);
        $httpStack = HandlerStack::create($httpHandler);
        $httpStack->push($logger, 'logger');

        return new Client(['handler' => $httpStack]);
    }

    /**
     * @return callable
     */
    public static function createHttpHandler()
    {
        return \GuzzleHttp\choose_handler();
    }
}
