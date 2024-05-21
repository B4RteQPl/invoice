<?php

namespace App\Modules\Invoices\Infrastructure\Repositories;

use App\Models\Invoice;
use App\Modules\Invoices\Application\Interfaces\InvoiceRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function get(UuidInterface $id): Invoice
    {
        return Invoice::findOrFail($id);
    }

    public function update(Invoice $invoice, array $attributes): void
    {
        $invoice->update($attributes);
    }
}
