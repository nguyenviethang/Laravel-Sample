<?php

namespace App\Exports;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
class UsersExport implements FromView
{

    use Exportable;
    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $user;
    protected $data;

    public function __construct(UserRepositoryInterface $user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }
    public function view(): View
    {
        $dataUsers = $this->user->getAll($this->data);
        return view('exports.users', [
            'users' =>  $dataUsers
        ]);
    }
}
