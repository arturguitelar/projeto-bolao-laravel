<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Role;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $model = Role::class;
}
