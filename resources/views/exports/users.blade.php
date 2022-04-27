<h1>Danh sách nhân viên</h1>
<br>
<div>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Họ tên</th>
                <th>Ảnh đại diện</th>
                <th>Số điện thoại</th>
                <th>Ngày sinh</th>
                <th>Ngày bắt đầu làm việc</th>
                <th>Phòng ban</th>
                <th>Chức vụ</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->avatar }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ date('d-m-Y', strtotime($user->birth_day)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($user->start_date)) }}</td>
                    <td>{{ $user->depart->name }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td> {{ __('const.WORK_STATUS.' . $user->status) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
