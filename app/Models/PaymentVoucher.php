<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function list()
    {
        return $this->hasMany(PaymentVoucherList::class);
    }
}
