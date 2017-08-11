<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
            'name' => 'required|string'
        ];
    }

    public function postFillData()
    {
        return [
            'name' => strlen(trim($this->name)) == 0 ? 'new task' : trim($this->name),
            'list_id' => is_null($this->list_id) ? 0 : $this->list_id,
            'completed' => 0,
            'memo' => $this->memo,
            'deadline' => is_null($this->deadline) ? null : $this->deadline,
        ];
    }
}
