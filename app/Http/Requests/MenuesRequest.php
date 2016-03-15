<?php namespace App\Http\Requests;

use App\Models\Menues, Lang;

class MenuesRequest extends Request {

    // const TYPE_MAIN = 'M';
    // const TYPE_SIDE = 'S';
    // const TYPE_FOOTER = 'F';
    // const TYPE_HIDDEN_PAGE = 'H';

    // const IS_PUBLISHED = '1';
    // const NOT_PUBLISHED = '0';


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