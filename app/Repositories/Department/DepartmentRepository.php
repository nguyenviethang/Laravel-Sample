<?php

namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\BaseRepository\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    /**
     *@return void
     *
     */

    public function getModel()
    {
        return Department::class;
    }
    public function find($id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function getDepart()
    {
        return $this->model->all();
    }

    public function getListDepart()
    {
        return $this->model->with('manager', 'users')->paginate(config('const.DEFAULT_PAGE_SIZE'));
    }

    public function storeDepart($data)
    {
        return $this->model->create($data);
    }

    public function updateDepart($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }
    public function deleteDepart($id)
    {
        $user = $this->model->with('allUsers')->find($id);
        if (count($user->allUsers) > 0) {
            return false;
        } else {
            return $this->model->where('id', $id)->delete();
        }
    }
}
