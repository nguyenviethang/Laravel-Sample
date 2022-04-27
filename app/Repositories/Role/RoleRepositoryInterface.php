<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function getRole();
    public function find($id);

}
