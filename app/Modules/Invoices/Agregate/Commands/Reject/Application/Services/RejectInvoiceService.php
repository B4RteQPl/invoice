<?php

namespace App\Modules\Invoices\Agregate\Commands\Reject\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Agregate\Domain\InvoiceApproval;
use App\Modules\Invoices\Application\Interfaces\InvoiceRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class RejectInvoiceService
{
    public function __construct(
        private InvoiceRepositoryInterface $repository
    ) {}

    public function rejectInvoice(UuidInterface $id): void {
        $invoice = $this->repository->get($id);

        $invoiceApproval = InvoiceApproval::create($invoice);

        $isRejected = $invoiceApproval->reject();

        if (!$isRejected) {
            return;
        }

        $this->repository->update($invoice, ['status' => StatusEnum::REJECTED]);
    }
}
