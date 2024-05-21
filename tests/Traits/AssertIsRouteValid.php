<?php

namespace Tests\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Assert as PHPUnit;

trait AssertIsRouteValid
{
    protected function assertIsRouteValid(string $httpMethod, string $uri, string $controller, string $controllerMethod)
    {
        $expectedActionName = $controller.'@'.$controllerMethod;

        $route = Route::getRoutes()->match(Request::create($uri, $httpMethod));
        $actionName = $route->getActionName();

        PHPUnit::assertEquals($expectedActionName, $actionName);
    }
}
