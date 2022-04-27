<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\DeleteDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Repositories\Department\DepartmentRepositoryInterface;
use Redirect;
use App\Repositories\User\UserRepositoryInterface;

class DepartmentController extends Controller
{
    private $department;
    private $user;

    public function __construct(DepartmentRepositoryInterface $department, UserRepositoryInterface $user)
    {
        $this->department = $department;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allDepartments = $this->department->getListDepart();
        return view('departments.index', compact('allDepartments'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        //
        $data = $request->only('name', 'description');
        $result = $this->department->storeDepart($data);
        if ($result) {
            return redirect()->route('department.list')->with('success', __('message.msgAdd'));
        }
        return redirect()->route('department.list')->with('error', __('message.msgAddFail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request)
    {
        $id = $request->id;
        $data = $request->except('_token', 'id', 'user_id');
        if (isset($request->user_id)) {
            $user = $this->user->find($request->user_id);
        }
        $check = $this->user->findUser($id, config('const.ROLE.MANAGE'));
        if (isset($user)) {
            if ($check->id != $user->id) {
                return redirect()->route('department.list')->with('error', __('message.existManager'));
            }
            $user_data['role_id'] = config('const.ROLE.MANAGE');
            $update_user = $this->user->update($user->id, $user_data);
        }
        $result = $this->department->updateDepart($id, $data);
        if ($result) {
            return redirect()->route('department.list')->with('success', __('message.update'));
        }
        return redirect()->route('department.list')->with('error', __('message.editFail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteDepartmentRequest $request)
    {
        $id = $request->id;
        $result = $this->department->deleteDepart($id);
        if ($result) {
            return redirect()->route('department.list')->with('success', __('message.delete'));
        }
        return redirect()->route('department.list')->with('error', __('message.deleteAnotherUser'));
    }
}
