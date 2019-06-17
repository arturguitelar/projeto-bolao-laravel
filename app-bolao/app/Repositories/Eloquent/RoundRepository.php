<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoundRepositoryInterface;
use App\Round;

class RoundRepository extends AbstractRepository implements RoundRepositoryInterface
{
    protected $model = Round::class;
}
