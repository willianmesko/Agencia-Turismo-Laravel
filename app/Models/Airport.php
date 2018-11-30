<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = [
        'city_id',
        'name',
        'latitude',
        'longitude',
        'number',
        'zip_code',
        'address',
        'complement',
    ];


    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function search(City $city, $request, $totalPage)
    {
        $airports = $city->airports()
                        ->where('name', 'LIKE', "%{$request->key_search}%")
                        ->paginate($totalPage);

        return $airports;
    }
}
