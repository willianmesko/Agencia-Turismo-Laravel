<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Reserve extends Model
{
    protected $fillable = ['user_id', 'flight_id', 'date_reserved', 'status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function status($op = null)
    {
        $statusAvailable = [
            'reserved'  => 'Reservado',
            'canceled'  => 'Cancelado',
            'paid'      => 'Pago',
            'concluded' => 'Concluído',
        ];

        if( $op )
            return $statusAvailable[$op];

        return $statusAvailable;
    }


    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;

        return $this->save();
    }


    public function search($request, $totalPage)
    {
        /*
        $this->where(function($query) use ($request) {
            if ($request->date)

        })->paginate($totalPage);
        */
        $reserves = $this->join('users', 'users.id', '=', 'reserves.user_id')
                            ->join('flights', 'flights.id', '=', 'reserves.flight_id')
                            ->select('reserves.*', 'users.name as user_name', 'users.email as user_email', 'users.id as user_id', 'flights.id as flight_id', 'flights.date as flight_date')
                            ->where(function($query) use ($request) {
                                if ($request->user) {
                                    $dataUser = $request->user;
                                    $query->where(function($qr) use ($dataUser) {
                                        $qr->where('users.name', 'LIKE', "%{$dataUser}%");
                                        $qr->orWhere('users.email', $dataUser);
                                    });
                                }

                                if ($request->date)
                                    $query->where('flights.date', '=', $request->date);
                                
                                if ($request->reserve)
                                    $query->where('reserves.id', $request->reserve);
                                
                            })
                            ->where('reserves.status', $request->status)
                            ->paginate($totalPage);
        return $reserves;
    }


    public function newReserve($flightId)
    {
        $this->user_id          = auth()->user()->id;
        $this->flight_id        = $flightId;
        $this->date_reserved    = date('Y-m-d');
        $this->status           = 'reserved';

        return $this->save();
    }

}
