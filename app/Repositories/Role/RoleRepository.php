<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     *@return void
     *
     */

    public function getModel()
    {
        return Role::class;
    }
    public function getRole()
    {
        return $this->model->all();
    }
    public function find($id){
        {
            return $this->model->where('id', $id)->get();
        }
    }

}
