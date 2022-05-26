<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class dataresepRequest extends FormRequest
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
            'resep' => 'required',
            'kategori_id' => 'required',
            'bahan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'resep.required' => 'kolom resep tidak boleh kosong !',
            'kategori_id.required' => 'kolom kategori tidak boleh kosong !',
            'bahan.required' => 'kolom bahan tidak boleh kosong !',
        ];
    }
}
