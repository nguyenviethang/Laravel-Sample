<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserListRequest;
use App\Mail\MailNotify;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Exports\UsersExport;
use App\Jobs\SendMail;
use Maatwebsite\Excel\Excel;

class UserController extends Controller
{
    private $user;

    /**
     * RoleRepositoryInterface
     *
     * @var object
     */
    private $role;

    /**
     * DepartmentRepositoryInterface
     *
     * @var object
     */
    private $department;

    public function __construct(UserRepositoryInterface $user, DepartmentRepositoryInterface $department, RoleRepositoryInterface $role)
    {
        $this->user = $user;
        $this->department = $department;
        $this->role = $role;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserListRequest $request)
    {
        $validated = $request->validated();
        if (Auth::user()->is_admin) {
            $allUser = $this->user->getAll($validated);
            $allDepart = $this->department->getDepart();
            $allRole = $this->role->getRole();
            $allRole = $this->role->getRole();
        } else {
            $validated['department_id'] = Auth::user()->department_id;
            $validated['role_id'] = config('const.ROLE.USER');
            $allUser = $this->user->getAll($validated);
            $allDepart = $this->department->find(Auth::user()->department_id);
            $allRole = $this->role->find(config('const.ROLE.USER'));
        }
        return view('users.index', compact('allUser', 'allDepart', 'allRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        $data = $request->only('email', 'password', 'fullname', 'avatar',  'phone', 'birth_day', 'start_date', 'department_id', 'role_id', 'status');
        $check = $this->user->findUser($data['department_id'], config('const.ROLE.MANAGE'));
        if ($check && $data['role_id'] == config('const.ROLE.MANAGE')) {
            return  response()->json(['errors' => [__('message.existManager')]]);
        }
        $data['password'] = Hash::make(config('const.DEFAULT_PASSWORD'));
        if (!empty($request->file('avatar'))) {
            $image       = $request->file('avatar');
            $filename    = uniqid() . $image->getClientOriginalName();
            $data['avatar'] = $filename;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('images/UserAvatar/' . $filename));
        } else {
            $data['avatar'] = 'default.png';
        }
        $result = $this->user->store($data);
        if ($result) {
            return  response()->json(['success' => ['Thêm thành công!']]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = $this->user->find($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        if (Auth::user()->id == $request->id && Auth::user()->role_id != $request->role_id) {
            return  response()->json(['errors' =>  [__('message.editYourRole')]]);
        }
        $id = $request->id;
        $data = $request->except('id', '_token');
        $check = $this->user->findUser($data['department_id'], config('const.ROLE.MANAGE'));
        if (isset($check)  && $data['role_id'] == config('const.ROLE.MANAGE') && $check->id != $id) {
            return  response()->json(['errors' => [__('message.existManager')]]);
        }
        if (!empty($request->file('avatar'))) {
            $image       = $request->file('avatar');
            $filename    =  uniqid() . $image->getClientOriginalName();
            $data['avatar'] = $filename;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('images/UserAvatar/' . $filename));
        }
        $result = $this->user->update($id, $data);
        if ($result) {
            return  response()->json(['success' => [__('message.update')]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteUserRequest $request)
    {
        if ($request->id == Auth::user()->id) {
            return Redirect::route('user.list')->with('error', __('message.deleteYourSelf'));
        } else {
            $result = $this->user->delete($request->id);
            if ($result) {
                return Redirect::route('user.list')->with('success', __('message.delete'));
            } else {
                return Redirect::route('user.list')->with('error', __('message.deleteFail'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        $user = $this->user->find(Auth::user()->id);
        if (!empty($user)) {
            return view('profiles.profile', compact('user'));
        }
        return redirect('404');
    }

    public function changePassword()
    {
        return view('profiles.change_password');
    }
    public function submitChangePassword(ChangePasswordRequest $request)
    {
        $password = $request->validated();
        if (Hash::check($password['old_password'], Auth::user()->password)) {
            $data['password'] = Hash::make($password['new_password']);
            $data['is_first_login'] = false;
            $result = $this->user->changePassword(Auth::user()->id, $data);
            if ($result) {
                return Redirect::route('profile')->with('success', __('message.changePassSuccess'));
            }
            return Redirect::route('change.password.view')->with('error', __('message.changePassFail'));
        } else {
            return Redirect::route('change.password.view')->with('error', __('message.wrongPassWord'));
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        if (!empty($request->file('avatar'))) {
            $image       = $request->file('avatar');
            $filename    =  uniqid() . $image->getClientOriginalName();
            $data['avatar'] = $filename;
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path('images/UserAvatar/' . $filename));
            $data['phone'] = $request->phone;
            $data['birth_day'] = $request->birth_day;
        } else {
            $data['avatar'] = $request['oldAvatar'];
            $data['phone'] = $request->phone;
            $data['birth_day'] = $request->birth_day;
        }
        $result = $this->user->update(Auth::user()->id, $data);
        if ($result) {
            return  response()->json(['success' => [__('message.update')]]);
        }
    }
    public function reset(ResetPasswordRequest $request)
    {
        $user = $this->user->find($request->id);
        $randomPassword = Str::random(10);
        $data['password'] = Hash::make($randomPassword);
        $data['is_first_login'] = true;
        $result = $this->user->changePassword($request->id, $data);
        $message = [
            'content' => $randomPassword,
        ];
        if ($result) {
            // Mail::to($user->email)->send(new MailNotify($message));
            $emailJob = new SendMail($message, $user->email);
            dispatch($emailJob);
            if (Auth::user()->id == $request->id) {
                return Redirect::route('logout');
            }
            return Redirect::route('user.list')->with('success', __('message.resetSuccess'));
        }
        return Redirect::route('change.password.view')->with('error', __('message.ressetFail'));
    }

    public function export(Excel $excel, UserListRequest $request)
    {
        $data = $request->all();
        if (Auth::user()->role_id = config('const.ROLE.MANAGE') && !Auth::user()->is_admin) {
            $data['department_id'] = Auth::user()->department_id;
            $data['role_id'] = config('const.ROLE.USER');
        }
        $export = app()->makeWith(UsersExport::class, compact('data'));
        $name =  uniqid() . '_user_information';
        return $excel->download($export, $name . '.xlsx');
    }
}
