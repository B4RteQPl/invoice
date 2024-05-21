<?php

namespace Tests\Modules\Invoices\Infrastructure\Repositories;

use App\Domain\Enums\StatusEnum;
use App\Models\Invoice;
use App\Modules\Invoices\Application\Interfaces\InvoiceRepositoryInterface;
use App\Modules\Invoices\Infrastructure\Repositories\InvoiceRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class InvoiceRepositoryTest extends TestCase
{

    public InvoiceRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new InvoiceRepository();
    }

    /** @test */
    public function it_gets_invoice(): void
    {
        // given
        $model = Invoice::factory()->create()->refresh();

        // when
        $id = Uuid::fromString($model->id);
        $result = $this->repository->get($id);

        // then
        $this->assertEquals($model->id, $result->id);
    }

    /** @test */
    public function it_saves_invoice(): void
    {
        // given
        $model = Invoice::factory()->create([
            'status' => StatusEnum::DRAFT,
        ])->refresh();

        // when
        $this->repository->update($model, [
            'status' => StatusEnum::APPROVED
        ]);

        // then
        $this->assertDatabaseHas(Invoice::class, [
            'id' => $model->id,
            'status' => StatusEnum::APPROVED
        ]);
    }
}
