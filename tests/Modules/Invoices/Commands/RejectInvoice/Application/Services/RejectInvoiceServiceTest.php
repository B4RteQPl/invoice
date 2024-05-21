<?php

namespace Tests\Modules\Invoices\Commands\RejectInvoice\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Models\Invoice;
use App\Modules\Invoices\Agregate\Commands\Reject\Application\Services\RejectInvoiceService;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class RejectInvoiceServiceTest extends TestCase
{

    /** @test */
    public function it_rejects_invoice(): void
    {
        // given
        $repository = new InvoiceRepository();
        $service = new RejectInvoiceService($repository);

        $invoice = Invoice::factory()->create();

        $this->assertDatabaseHas(Invoice::class, [
            'id' => $invoice->id,
            'status' => StatusEnum::DRAFT,
        ]);

        // when
        $service->rejectInvoice(Uuid::fromString($invoice->id));

        // then
        $this->assertDatabaseHas(Invoice::class, [
            'id' => $invoice->id,
            'status' => StatusEnum::REJECTED,
        ]);
    }
}
