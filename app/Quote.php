<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStatus\HasStatuses;

class Quote extends Model
{
    use HasStatuses;
    protected $fillable = ['subject','quotestage','contact_id','subtotal','total','discount_amount','fee_vc','fee_ld'];
    public function quoteitems()
    {
        return $this->hasMany('App\QuoteItem');
    }
}
