<?php

namespace Tests\Modules\Invoices\Commands\ApproveInvoice\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Models\Company;
use App\Models\Invoice;
use App\Modules\Invoices\Agregate\Commands\Approve\Application\Services\ApproveInvoiceService;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class ApproveInvoiceServiceTest extends TestCase
{

    /** @test */
    public function it_approve_invoice(): void
    {
        // given
        $repository = new InvoiceRepository();
        $service = new ApproveInvoiceService($repository);

        $invoice = Invoice::factory()->create([
            'status' => StatusEnum::DRAFT,
        ])->refresh();

        // when
        $service->approveInvoice(Uuid::fromString($invoice->id));

        // then
        $this->assertDatabaseHas(Invoice::class, [
            'id' => $invoice->id,
            'status' => StatusEnum::APPROVED,
        ]);
    }
}
