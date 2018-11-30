<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Flight;

class CheckAvailableFlight implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $flight         = Flight::with(['plane', 'reserves'])->find($value);
        $plane          = $flight->plane;
        $qtyPassengers  = $plane->qty_passengers;
        $qtyReserves    = $flight->reserves->count();

        return $qtyPassengers > $qtyReserves;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A quantidade de reservas superou a quantidade passageiros permitidos!';
    }
}
