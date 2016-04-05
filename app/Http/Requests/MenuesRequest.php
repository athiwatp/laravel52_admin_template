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
            //
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