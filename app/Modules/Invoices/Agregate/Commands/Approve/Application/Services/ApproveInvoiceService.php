<?php

namespace App\Modules\Invoices\Agregate\Commands\Approve\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Agregate\Domain\InvoiceApproval;
use App\Modules\Invoices\Application\Services\InvoiceService;
use Ramsey\Uuid\UuidInterface;

class ApproveInvoiceService extends InvoiceService
{
    public function approveInvoice(UuidInterface $id): void
    {
        $invoice = $this->repository->get($id);

        $invoiceApproval = InvoiceApproval::create($invoice);

        $isApproved = $invoiceApproval->approve();

        if (!$isApproved) {
            return;
        }

        $invoice->status = StatusEnum::APPROVED;
        $this->repository->save($invoice);
    }
}
