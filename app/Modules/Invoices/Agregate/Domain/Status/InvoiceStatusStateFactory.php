<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Agregate\Domain\Status;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Agregate\Domain\Status\States\ApprovedStatus;
use App\Modules\Invoices\Agregate\Domain\Status\States\DraftStatus;
use App\Modules\Invoices\Agregate\Domain\Status\States\RejectedStatus;
use InvalidArgumentException;

class InvoiceStatusStateFactory {
    public static function getStateForStatus(StatusEnum $status): InvoiceStatusInterface
    {
        return match ($status) {
            StatusEnum::DRAFT => new DraftStatus(),
            StatusEnum::APPROVED => new ApprovedStatus(),
            StatusEnum::REJECTED => new RejectedStatus(),
            default => throw new InvalidArgumentException("Unknown state: $status->value"),
        };
    }
}
