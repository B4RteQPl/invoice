<?php

namespace Tests\Modules\Invoices\Queries\GetInvoice\Controllers;

use App\Models\Invoice;
use Tests\TestCase;

class GetInvoiceControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_returns_invoice_resource(): void
    {
        $invoice = Invoice::factory()->create()->refresh();

        $response = $this->getJson(route('invoices.get', ['id' => $invoice->id]));

        $response->assertJsonStructure([
            'data' => [
                'invoice_number',
                'invoice_date',
                'due_date',
                'company' => [
                    'name',
                    'street_address',
                    'city',
                    'zip_code',
                    'phone',
                ],
                'billed_company' => [
                    'name',
                    'street_address',
                    'city',
                    'zip_code',
                    'phone',
                    'email_address',
                ],
                'products' => [
                    '*' => [
                        'name',
                        'quantity',
                        'price',
                        'total'
                    ],
                ],
                'total_price',
            ],
        ]);
    }
}
