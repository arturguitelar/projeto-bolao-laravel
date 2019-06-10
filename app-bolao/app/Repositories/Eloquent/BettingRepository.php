<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BettingRepositoryInterface;
use App\Betting;
use Illuminate\Support\Facades\Auth;

class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{
    protected $model = Betting::class;

    public function create(array $data):Bool
    {
        $user = Auth()->user();
        $data['user_id'] = $user->id;

        return (bool) $this->model->create($data);
    }

    public function update(array $data, int $id):Bool
    {
        $register = $this->find($id);

        if ($register) {
            $user = Auth()->user();
            $data['user_id'] = $user->id;

            return (bool) $this->model->update($data);
        } else {
            return false;
        }
    }
}
