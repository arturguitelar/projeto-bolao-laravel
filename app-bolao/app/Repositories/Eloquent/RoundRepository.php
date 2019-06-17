<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoundRepositoryInterface;
use App\Round;

class RoundRepository extends AbstractRepository implements RoundRepositoryInterface
{
    protected $model = Round::class;

    public function create(array $data) : bool
    {
        $user = auth()->user();
        $listRel = $user->bettings;
        $bettingId = $data['betting_id'];
        $exist = false;

        foreach ($listRel as $key => $value) {
            if ($bettingId == $value->id) $exist = true;
        }

        if ($exist) {
            return (bool) $this->model->create($data);
        } else {
            return false;
        }
    }

    public function update(array $data, int $id) : bool
    {
        $register = $this->find($id);

        if ($register) {

            $user = auth()->user();
            $listRel = $user->bettings;
            $bettingId = $data['betting_id'];
            $exist = false;

            foreach ($listRel as $key => $value) {
                if ($bettingId == $value->id) $exist = true;
            }

            if ($exist) {
                return (bool) $register->update($data);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
