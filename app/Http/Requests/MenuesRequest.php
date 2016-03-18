<?php namespace App\Http\Requests;

use App\Models\Menues, Lang;

class MenuesRequest extends Request {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
    */
    public function rules()
    {
        //@TODO: Specify here a list of required and mandatory fields
        return [
//            'name' => 'required|max:255',
//            'email' => 'required|max:255|email',
//            'message' => 'required|min:5'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}