<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Match;

class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{
    protected $model = Match::class;

    public function create(array $data) : bool
    {
        $user = auth()->user();
        $listRel = $user->rounds;
        $roundId = $data['round_id'];
        $exist = false;

        foreach ($listRel as $key => $value) {
            if ($roundId == $value->id) $exist = true;
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
            $listRel = $user->rounds;
            $roundId = $data['round_id'];
            $exist = false;

            foreach ($listRel as $key => $value) {
                if ($roundId == $value->id) $exist = true;
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
