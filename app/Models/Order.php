<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['order_no','total_amount','user_id','offer_id','bank_transaction_id','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps = true;


    // Owner
    public function user() {
        return $this-> belongsTo('App\Models\User','user_id','id');
    }
}
