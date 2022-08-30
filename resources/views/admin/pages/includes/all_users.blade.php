@foreach($users as $user)
    <tr>
        <input class="user_val_id" type="hidden" name="id" value="{{ $user->id }}">
        <th scope="row">
            <div class="form-check font-size-16">
                <input type="checkbox" name="ids" class="form-check-input" value="{{ $user->id }}">
                <label class="form-check-label"></label>
            </div>
        </th>
        <th>{{ $loop->iteration }}</th>
        <td>
            <img src="{{ asset('photo/user_profile') }}/{{ $user->photo }}" alt="{{ $user->name }}" class="avatar-sm rounded-circle me-2">
            {{ $user->name }}
        </td>
        <td>
            {{ $user->email }}
        </td>
        <td>
            {{ $user->phone }}
        </td>
        <td>
            @if ($user->status == 'Pending')
                <span class="badge bg-info">Pending</span>
            @elseif($user->status == 'Active')
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">DeActive</span>
            @endif
        </td>
        <td>
            @if (Auth::guard('admin')->User()->can('users.status.edit'))  
                <a href="{{ route('admin.users.status.edit',$user->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
            @endif
            @if (Auth::guard('admin')->User()->can('users.destroy'))   
                <button class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></button>
            @endif
        </td>
    </tr>
@endforeach