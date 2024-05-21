<?php

namespace Tests\Modules\Invoices\Api;

use App\Modules\Invoices\Agregate\Commands\Approve\Infrastructure\Controllers\ApproveInvoiceController;
use App\Modules\Invoices\Agregate\Commands\Reject\Infrastructure\Controllers\RejectInvoiceController;
use App\Modules\Invoices\Agregate\Queries\Get\Infrastructure\Controllers\GetInvoiceController;
use Tests\TestCase;
use Tests\Traits\AssertIsRouteValid;

class InvoiceApiTest extends TestCase
{
    use AssertIsRouteValid;

    /**
     * @test
     * @dataProvider routeProvider
     */
    public function it_checks_routes(string $httpMethod, string $uri, string $controller, string $controllerMethod)
    {
        $this->assertIsRouteValid($httpMethod,$uri, $controller, $controllerMethod);
    }

    public function routeProvider(): array
    {
        return [
            'invoices.get' => ['GET', '/api/invoices/{id}', GetInvoiceController::class, 'index'],
            'invoices.approve' => ['PATCH', '/api/invoices/{id}/approve', ApproveInvoiceController::class, 'update'],
            'invoices.reject' => ['PATCH', '/api/invoices/{id}/reject', RejectInvoiceController::class, 'update'],
        ];
    }
}
