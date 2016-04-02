<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Transformers\Vacancies as VacanciesTransformer;
use Yajra\Datatables\Facades\Datatables;
use App\Models\Vacancies;

class VacanciesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Vacancies::query())
            ->setTransformer( new VacanciesTransformer() )
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
