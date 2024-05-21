<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Domain\Status\States;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Agregate\Domain\InvoiceApproval;
use App\Modules\Invoices\Agregate\Domain\Status\InvoiceStatus;
use App\Models\Invoice;

class DraftStatus extends InvoiceStatus {
    public function approve(Invoice $invoice): void
    {
        $invoiceApproval = new InvoiceApproval($invoice);

        $result = $invoiceApproval->approve();

        if ($result) {
            $invoice->status = StatusEnum::APPROVED;
        }
    }

    public function reject(Invoice $invoice): void
    {
        $invoiceApproval = new InvoiceApproval($invoice);

        $result = $invoiceApproval->reject();

        if ($result) {
            $invoice->status = StatusEnum::REJECTED;
        }
    }
}
