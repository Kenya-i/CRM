<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }

    public function scopeSubTotal()
    {
        return DB::table('purchases')
            ->join('item_purchase', 'purchases.id', '=', 'item_purchase.purchase_id')
            ->join('items', 'item_purchase.item_id', '=', 'items.id')
            ->join('customers', 'purchases.customer_id', '=', 'customers.id')
            ->select(DB::raw(
                'purchases.id as purchases_id, item_purchase.id as pivot_id, customers.name as customer_name, items.name as item_name, items.price as item_price, item_purchase.quantity as item_quantity, items.price * item_purchase.quantity as  subtotal, purchases.status as status, purchases.created_at as created_at'
            ));
    }
}
