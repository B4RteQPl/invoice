<?php

namespace App\Models;

use App\Domain\Enums\StatusEnum;
use App\Domain\ValueObjects\Money;
use App\Modules\Invoices\Agregate\Domain\Status\InvoiceStatus;
use App\Modules\Invoices\Agregate\Domain\Status\InvoiceStatusInterface;
use App\Modules\Invoices\Agregate\Domain\Status\InvoiceStatusStateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'status', 'number', 'date', 'due_date', 'company_id'];

    protected $casts = [
        'id' => 'string',
        'status' => StatusEnum::class,
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, (new InvoiceProductLine)->getTable())
            ->withPivot('quantity');
    }

    public function stateStatus(): InvoiceStatusInterface
    {
        dump($this->status);
        return InvoiceStatusStateFactory::getStateForStatus($this->status);
    }

    public function invoiceProductLines(): HasMany
    {
        return $this->hasMany(InvoiceProductLine::class);
    }

    public function productsTotalPrice(): Money
    {
        if ($this->products->isEmpty()) {
            return Money::zero();
        }

        $totalPrice = Money::zero();

        $this->products->each(function (Product $product) use (&$totalPrice) {
            $totalProductPrice = $this->totalSingleProductPrice($product);

            $totalPrice = $totalPrice->add($totalProductPrice);
        });

        return $totalPrice;
    }

    public function totalSingleProductPrice (Product $product): Money
    {
        return $product->price->multiply($product->pivot->quantity);
    }
}
