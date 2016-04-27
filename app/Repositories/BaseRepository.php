<?php namespace App\Repositories;

abstract class BaseRepository {

    /**
     * The model instance
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Pagination
     *
     * @var Integer
     */
    protected $paginationAmount = 20;

    /**
     * Date format
    */
    protected $dateFormat = 'd/m/Y';

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
        return $this->getById($id)->delete();
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

    /**
     * Updates the model by the params
     *
     * @param Int $id - identificator
     * @param Array $aParams  - the list of fields that should be updated
     *
     * @return Object
    */
    public function fixChanges( $id, $aParams = [] )
    {
        $this->model->where('id', $id)
            ->update($aParams);

        return $this->model;
    }

    public function toSQL( $object )
    {
        return $object->toSql();
    }

    /**
     * Return date format
     *
     * @return {String}
    */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }
}