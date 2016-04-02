<?php namespace App\Repositories;

use App\Models\Vacancies as Vacancies;
use Carbon\Carbon, Auth;

class VacanciesRepository extends BaseRepository {
    /**
     * Create a new Message instance
     *
     * @param App\Models\Vacancies $Vacancies
     *
     * @return void
    */
    public function __construct(Vacancies $vacancies)
    {
        $this->model = $vacancies;
    }

        /**
     * Create or update Message
     *
     * @param App\Models\Vacancies $vacancies
     *
     * @return
    */
    public function index()
    {
        return $this->model->all();
    }

    /**
     * Create or update Message
     *
     * @param App\Models\Vacancies $vacancies
     *
     * @return
    */
    public function saveVacancies( $vacancies, $inputs )
    {
        $vacancies->title        = $inputs['title'];
        $vacancies->date_reg     = $inputs['date_reg'];
        $vacancies->valid_before = $inputs['valid_before'];
        $vacancies->employer     = $inputs['employer'];
        $vacancies->type_employment = $inputs['type_employment'];
        $vacancies->requirements = $inputs['requirements'];
        $vacancies->description  = $inputs['description'];
        $vacancies->is_published = $inputs['is_published'];
        $vacancies->phone        = $inputs['phone'];
        $vacancies->contact_person = $inputs['contact_person'];
        $vacancies->email        = $inputs['email'];
        $vacancies->wage         = $inputs['wage'];
        $vacancies->user_id      = Auth::id();

        $vacancies->save();

        return true;
    }

    /**
     * Create a vacancies
     *
     * @param array $inputs
     *
     * @return mixed ( App\Models\Vacancies | false )
    */
    public function store( $inputs )
    {
        $id = $inputs['id'];

        if ( isset($id) && $id > 0 ) {
            $model = $this->model->find( $id );
        } else {
            $model = new $this->model;
        }

        $vacancies = $this->saveVacancies( $model, $inputs );

    }

    /**
     * Edit or update Message
     *
     * @param App\Models\Vacancies $vacancies
     *
     * @return
    */
    public function edit( $id )
    {
        return $this->model->find($id);
    }

    /**
     * Destroy a message
     *
     * @param App\Models\Vacancies
     *
     * @return void
    */
    public function destroy($vacancies)
    {
        $vacancies->delete();
    }
}
