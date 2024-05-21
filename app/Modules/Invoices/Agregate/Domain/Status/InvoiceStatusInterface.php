<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Domain\Status;

use App\Modules\Invoices\Agregate\Domain\Exceptions\CannotApproveInvoiceException;
use App\Modules\Invoices\Agregate\Domain\Exceptions\CannotRejectInvoiceException;
use App\Models\Invoice;

interface InvoiceStatusInterface
{
    /**
     * @throws CannotApproveInvoiceException
     */
    public function approve(Invoice $invoice): void;

    /**
     * @throws CannotRejectInvoiceException
     */
    public function reject(Invoice $invoice): void;
}
