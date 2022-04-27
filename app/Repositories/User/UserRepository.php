<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     *@return void
     *
     */

    public function getModel()
    {
        return User::class;
    }

    public function find($id)
    {
        return $this->model->where('id', $id)->with('role', 'depart')->first();
    }
    public function getAll($validated)
    {
        $query = $this->model;

        if (isset($validated['item_per_page'])) {
            $paginate_qr = $validated['item_per_page'];
        } else {
            $paginate_qr = config('const.DEFAULT_PAGE_SIZE');
        }
        if (isset($validated['keyword'])) {
            $query = $this->model->where(
                function ($query)  use ($validated) {
                    return $query->where('email', 'LIKE', "%" . $validated['keyword'] . "%")
                        ->orWhere('fullname', 'LIKE', "%" . $validated['keyword'] . "%");
                }
            );
        }
        if (isset($validated['department_id'])) {
            $query = $query->where('department_id', $validated['department_id']);
        }
        if (isset($validated['status'])) {
            $query = $query->where('status', $validated['status']);
        }
        if (isset($validated['role_id'])) {
            $query = $query->where('role_id', $validated['role_id']);
        }
        if (isset($validated['sort_by'])) {
            $sort_by = explode("-", $validated['sort_by']);
            $sort_table = $sort_by[0];
            $sort_value = $sort_by[1];
            $query = $query->orderBy($sort_table,  $sort_value);
        }
        return $query->with('role', 'depart')->paginate($paginate_qr);
    }

    public function update($id, $data)
    {
        $result = $this->model->where('id', $id)->update($data);
        return $result;
    }

    public function changePassword($id, $data = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($data);
            return $result;
        }
        return false;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * delete user
     */
    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();;
    }

    public function findUser($department_id, $role_id)
    {
        $result = $this->model->where('department_id', '=', $department_id)
            ->where('role_id', $role_id)
            ->first();
        return $result;
    }
}
