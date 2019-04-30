<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class AbstractRepository
{
    protected $model;
    
    function __construct()
    {
        $this->model = $this->resolveModel();
    }
      
    /**
     * Lista todos os registros por coluna e ordem especificadas.
     * 
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function all(string $column = 'id', string $order = 'ASC'):Collection
    {
        return $this->model->orderBy($column,$order)->get();
    }
    
    /**
     * Lista registros de acordo com a paginação e ordem especificada.
     * 
     * @param int $paginate Número de paginação. Default: 10
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
        return $this->model->orderBy($column,$order)->paginate($paginate);
    }
    
    /**
     * Lista registros de acordo com uma pesquisa.
     * 
     * @param array $columns Colunas a serem listadas.
     * @param string $search Texto com a busca.
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection
    {
        $query = $this->model;
        
        foreach ($columns as $key => $value) {
            $query = $query->orWhere($value,'like','%'.$search.'%');
        }
        
        return $query->orderBy($column, $order)->get();
    }
    
    /**
     * Cria um registro de acordo com os dados especificados.
     * 
     * @param array $data Dados a serem criados.
     * @return Bool
     */
    public function create(array $data):Bool
    {
        return (bool) $this->model->create($data);
    }
    
    /**
     * Busca um registro de acordo com um id especificado.
     * 
     * @param int $id ID do registro.
     * @return any
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Atualiza um registro de acordo com um id especificado.
     * 
     * @param array $data Dados a serem atualizados.
     * @param int $id ID do registro.
     * @return Bool
     */
    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        
        if ($register) {
            return (bool) $register->update($data);
        }
        
        return false;
    }

    /**
     * Remove um registro de acordo com um id especificado.
     * 
     * @param int $id ID do registro.
     * @return Bool
     */
    public function delete(int $id):Bool
    {
        $register = $this->find($id);

        if ($register) {
            return (bool) $register->delete();
        }

        return false;
    }
    
    protected function resolveModel()
    {
        return app($this->model);
    }
}
