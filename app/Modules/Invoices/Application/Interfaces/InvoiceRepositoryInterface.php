<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Interfaces;

use App\Models\Invoice;
use Ramsey\Uuid\UuidInterface;

interface InvoiceRepositoryInterface
{
    public function get(UuidInterface $id): Invoice;
    public function update(Invoice $invoice, array $attributes): void;
}
