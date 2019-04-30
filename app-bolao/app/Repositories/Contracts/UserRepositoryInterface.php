<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Lista todos os registros por coluna e ordem especificadas.
     * 
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function all(string $column = 'id', string $order = 'ASC'):Collection;

    /**
     * Lista registros de acordo com a paginação e ordem especificada.
     * 
     * @param int $paginate Número de paginação. Default: 10
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator;

    /**
     * Lista registros de acordo com uma pesquisa.
     * 
     * @param array $columns Colunas a serem listadas.
     * @param string $search Texto com a busca.
     * @param string $column ID da coluna. Default: 'id'.
     * @param string $order Ordem de organização. Default: 'ASC'
     * @return Collection
     */
    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection;

    /**
     * Cria um registro de acordo com os dados especificados.
     * 
     * @param array $data Dados a serem criados.
     * @return Bool
     */
    public function create(array $data):Bool;

    /**
     * Busca um registro de acordo com um id especificado.
     * 
     * @param int $id ID do registro.
     * @return any
     */
    public function find(int $id);

    /**
     * Atualiza um registro de acordo com um id especificado.
     * 
     * @param array $data Dados a serem atualizados.
     * @param int $id ID do registro.
     * @return Bool
     */
    public function update(array $data, int $id):Bool;

    /**
     * Remove um registro de acordo com um id especificado.
     * 
     * @param int $id ID do registro.
     * @return Bool
     */
    public function delete(int $id):Bool;
}
