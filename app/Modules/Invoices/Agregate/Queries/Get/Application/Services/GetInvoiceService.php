<?php

namespace App\Modules\Invoices\Agregate\Queries\Get\Application\Services;

use App\Models\Invoice;
use App\Modules\Invoices\Application\Interfaces\InvoiceRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class GetInvoiceService
{
    public function __construct(
        private InvoiceRepositoryInterface $repository
    ) {}

    public function getInvoice(UuidInterface $id): Invoice
    {
        return $this->repository->get($id);
    }
}
