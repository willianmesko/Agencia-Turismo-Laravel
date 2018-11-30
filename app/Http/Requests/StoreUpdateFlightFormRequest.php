<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateFlightFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plane_id'                  => 'required|exists:planes,id',
            'airport_origin_id'         => 'required|exists:airports,id',
            'airport_destination_id'    => 'required|exists:airports,id',
            'date'                      => 'required|date|after:today',
            'time_duration'             => 'required',
            'hour_output'               => 'required',
            'arrival_time'              => 'required',
            'arrival_time'              => 'required',
            'old_price'                 => 'required',
            'price'                     => 'required',
            'price'                     => 'required',
            'total_plots'               => 'required|digits_between:1,12',
            'price'                     => 'required',
            'is_promotion'              => 'boolean',
            'image'                     => 'image',
            'qty_stops'                 => 'numeric',
            'description'               => 'min:3|max:1000',
        ];
    }
}
