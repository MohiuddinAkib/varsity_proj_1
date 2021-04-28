<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialActivity extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRole("local_admin");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => ["required", "string"],
            "location" => ["required", "string"],
            "activity_date" => ["required", "date"],
            "type" => ["required", Rule::in(["education"])],
            "volunteers" => ["required", "array", "min:1"],
            "volunteers.*" => ["exists:App\Models\Employee,id"],
            "organization_id" => ["required", "exists:App\Models\Organization,id"],
        ];
    }
}
