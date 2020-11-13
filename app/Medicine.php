<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['MedName', 'MedDescription', 'MedPrice' , 'MedAmount' , 'SoldOut' , 'StoredDate'];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'MedName');
    }
}
