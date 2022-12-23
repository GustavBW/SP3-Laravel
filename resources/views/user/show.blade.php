show user
{{$user->name}}<br>
<a class="fakeBut" href="{{route('users.edit', ['id'=> $user->id])}}">Edit User</a>
