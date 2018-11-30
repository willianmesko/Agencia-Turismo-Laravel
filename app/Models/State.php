<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function search($keySearch)
    {
        return $this->where('name', 'LIKE', "%{$keySearch}%")
                        ->orWhere('initials', $keySearch)
                        ->get();
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function searchCities($cityName, $totalPage = 10)
    {
        return $this->cities()
                            ->where('name', 'LIKE', $cityName)
                            ->paginate($totalPage);
    }
}
