<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Permission;

class PermissionRepository extends AbstractRepository implements PermissionRepositoryInterface
{
    protected $model = Permission::class;
}
