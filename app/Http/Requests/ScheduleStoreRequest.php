<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ScheduleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole('manage-schedules');
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'message' => 'required|string',
            'when' => 'required|date|date_format:"Y-m-d H:i:s"'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('schedules.create.name.required'),
            'message.required'  => __('schedules.create.message.required'),
            'when.required' => __('schedules.create.when.required'),
            'when.date_format' => __('schedules.create.when.date_format'),
            'when.after' => __('schedules.create.when.after')
        ];
    }
}
