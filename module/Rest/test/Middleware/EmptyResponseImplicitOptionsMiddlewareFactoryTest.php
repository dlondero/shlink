<?php

declare(strict_types=1);

namespace ShlinkioTest\Shlink\Rest\Middleware;

use Laminas\Diactoros\Response\EmptyResponse;
use Mezzio\Router\Middleware\ImplicitOptionsMiddleware;
use PHPUnit\Framework\TestCase;
use ReflectionObject;
use Shlinkio\Shlink\Rest\Middleware\EmptyResponseImplicitOptionsMiddlewareFactory;

class EmptyResponseImplicitOptionsMiddlewareFactoryTest extends TestCase
{
    private EmptyResponseImplicitOptionsMiddlewareFactory $factory;

    public function setUp(): void
    {
        $this->factory = new EmptyResponseImplicitOptionsMiddlewareFactory();
    }

    /** @test */
    public function serviceIsCreated(): void
    {
        $instance = ($this->factory)();
        $this->assertInstanceOf(ImplicitOptionsMiddleware::class, $instance);
    }

    /** @test */
    public function responsePrototypeIsEmptyResponse(): void
    {
        $instance = ($this->factory)();

        $ref = new ReflectionObject($instance);
        $prop = $ref->getProperty('responseFactory');
        $prop->setAccessible(true);
        $this->assertInstanceOf(EmptyResponse::class, $prop->getValue($instance)());
    }
}
