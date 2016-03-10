<?php namespace App\Repositories;

abstract class BaseRepository {

    /**
     * The model instance
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get number of records
     *
     * @return array
    */
    public function getNumber()
    {
        $total = $this->model->count();

        $new = $this->model->whereSeen(0)->count();

        return compact('total', 'new');
    }

    /**
     * Destroy a model
     *
     * @param int $id
     * @return void
    */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

    /**
     * Get model by Id
     *
     * @param int $id
     *
     * @return App\Models\Model
    */
    public function getById( $id )
    {
        return $this->model->findOrFail( $id );
    }
}