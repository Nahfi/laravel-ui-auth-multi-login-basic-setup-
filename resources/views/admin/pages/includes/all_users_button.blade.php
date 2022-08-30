<a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary mb-2">All</a>
@foreach ($user_infos as $user_info)
<a href="{{ route('admin.users.clickedUsers',$user_info->status) }}"  class="btn btn-sm mb-2 @if ($user_info->status == 'Active')
    btn-primary
@elseif ($user_info->status == 'DeActive')
    btn-danger
@else
    btn-info
@endif">{{ $user_info->status }}({{ $user_info->total }})</a>
@endforeach