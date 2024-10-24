<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Họ tên</th>
            <th class="text-center">Email</th>
            <th class="text-center">Số điện thoại</th>
            <th class="text-center">Địa chỉ</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($users) && is_object($users))
            @foreach ($users as $user)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" value="" id="checkAll" class="input-checkbox checkBoxItem">
                    </td>
                    <td>
                        <div class="user-item name">{{ $user->name }}</div>
                    </td>
                    <td>
                        <div class="user-item email">{{ $user->email }}</div>
                    </td>
                    <td>
                        <div class="user-item phone">{{ $user->phone }}</div>
                    </td>
                    <td>
                        <div class="address-item name">{{ $user->address }}</div>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" value="{{ $user->publish }}" class="js-switch"
                            {{ $user->publish == 1 ? 'checked' : '' }} />
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{ $users->links('pagination::bootstrap-4') }}
