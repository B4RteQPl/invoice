<?php

namespace Tests\Modules\Invoices\Domain\Status;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Agregate\Domain\Status\InvoiceStatusStateFactory;
use App\Modules\Invoices\Agregate\Domain\Status\States\ApprovedStatus;
use App\Modules\Invoices\Agregate\Domain\Status\States\DraftStatus;
use App\Modules\Invoices\Agregate\Domain\Status\States\RejectedStatus;
use Tests\TestCase;

class InvoiceStatusStateFactoryTest extends TestCase
{

    /** @test */
    public function it_returns_state_draft_status(): void
    {
        // given
        $status = StatusEnum::DRAFT;

        // when
        $result = InvoiceStatusStateFactory::getStateForStatus($status);

        // then
        $this->assertInstanceOf(DraftStatus::class, $result);
    }

    /** @test */
    public function it_returns_state_approved_status(): void
    {
        // given
        $status = StatusEnum::APPROVED;

        // when
        $result = InvoiceStatusStateFactory::getStateForStatus($status);

        // then
        $this->assertInstanceOf(ApprovedStatus::class, $result);
    }

    /** @test */
    public function it_returns_state_rejected(): void
    {
        // given
        $status = StatusEnum::REJECTED;

        // when
        $result = InvoiceStatusStateFactory::getStateForStatus($status);

        // then
        $this->assertInstanceOf(RejectedStatus::class, $result);
    }
}
