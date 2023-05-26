<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class Services
{

    private $model;


    protected $_message;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function message() {
        return $this->_message;
    }


    public function find($id)
    {
        if (!$data = $this->model->find($id)) {
            $this->_message = 'Registro não encontrado';
            return false;
        }

        return $data;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        if(!$data = $this->model->create($data)) {
            $this->_message = 'Não foi possível criar o registro';
            return false;
        }

        $this->_message = 'Registro criado com sucesso!';

        return $data;
    }

    public function update(Model $model, $data)
    {
        $model->fill($data);

        if(!$model->save()) {
            $this->_message = 'Não foi possível salvar o registro';
            return false;
        }

        $this->_message = 'Registro atualizado com sucesso!';

        return true;
    }

    public function delete(Model $model)
    {
        if(!$model->delete()) {
            $this->_message = 'Não foi possível excluir o registro';
            return false;
        }

        $this->_message = 'Registro excluído com sucesso!';

        return true;
    }

    public function deleteBatch($data) {
        if(!$this->model->whereIn('id', array_values($data))->delete()) {
            $this->_message = 'Não foi possível excluir os registros';
            return false;
        }

        $this->_message = 'Registro excluído com sucesso!';

        return true;
    }

    public function toSelectBox($fields=[]) {


        $fields = (empty($fields)) ? ['id', 'name'] : $fields;

        return $this->model->select($fields)->get()->toArray();
    }
}
