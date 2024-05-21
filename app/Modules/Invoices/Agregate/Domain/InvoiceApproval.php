<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Domain;

use App\Models\Invoice;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use Ramsey\Uuid\Uuid;

final class InvoiceApproval
{
    protected function __construct(
        protected Invoice $invoice,
    ) {
    }

    public static function create(Invoice $invoice): self
    {
        return new self($invoice);
    }

    public function approve(): bool
    {
        return $this->approvalFacade()->approve($this->approvalDto());
    }

    public function reject(): bool
    {
        return $this->approvalFacade()->reject($this->approvalDto());
    }

    protected function approvalFacade(): ApprovalFacadeInterface
    {
        return resolve(ApprovalFacadeInterface::class);
    }

    protected function approvalDto(): ApprovalDto
    {
        $id = Uuid::fromString($this->invoice->id);
        $status = $this->invoice->status;
        return new ApprovalDto($id, $status, Invoice::class);
    }
}
