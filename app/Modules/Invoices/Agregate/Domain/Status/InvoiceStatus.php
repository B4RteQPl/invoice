<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Domain\Status;

use App\Models\Invoice;
use App\Modules\Invoices\Agregate\Domain\Exceptions\CannotApproveInvoiceException;
use App\Modules\Invoices\Agregate\Domain\Exceptions\CannotRejectInvoiceException;

class InvoiceStatus implements InvoiceStatusInterface
{

    /**
     * @throws CannotApproveInvoiceException
     */
    public function approve(Invoice $invoice): void
    {
        throw new CannotApproveInvoiceException();
    }

    /**
     * @throws CannotRejectInvoiceException
     */
    public function reject(Invoice $invoice): void
    {
        throw new CannotRejectInvoiceException();
    }
}
