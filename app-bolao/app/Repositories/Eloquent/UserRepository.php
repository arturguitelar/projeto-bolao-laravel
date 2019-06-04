<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    /** 
     * @param array $data Dados a serem criados.
     * @return Bool Registro criado.
     */
    public function create(array $data):Bool
    {
        $data['password'] = Hash::make($data['password']);
        
        $register = $this->model->create($data);

        if (isset($data['roles']) && count($data['roles'])) {

            // relacionando as permissões
            foreach ($data['roles'] as $key => $value) {
                $register->roles()->attach($value);
            }
        }
        return (bool) $register;
    }

    /** 
     * @param array $data Dados a serem atualizados.
     * @param int $id ID do registro.
     * @return Bool Registro atualizado.
     */
    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);
        
        if ($register) {
            if ($data['password'] ?? false) {
                $data['password'] = Hash::make($data['password']);
            }

            $roles = $register->roles; 

            if (count($roles)) {

                foreach ($roles as $key => $value) {
                    $register->roles()->detach($value->id);
                }
            }

            if (isset($data['roles']) && count($data['roles'])) {

                foreach ($data['roles'] as $key => $value) {
                    $register->roles()->attach($value);
                }
            }

            return (bool) $register->update($data);
        }
        
        return false;
    }
}
