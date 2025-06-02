<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $id
 * @property string $transaction_id
 * @property string $batch_id
 * @property int $quantity
 * @property string $price_per_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Batch $batch
 * @property-read \App\Models\Transaction $transaction
 * @method static \Database\Factories\SaleitemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem wherePricePerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Saleitem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Saleitem extends Model
{
    /** @use HasFactory<\Database\Factories\SaleitemFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'transaction_id', 'batch_id', 'quantity', 'price_per_unit'];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
