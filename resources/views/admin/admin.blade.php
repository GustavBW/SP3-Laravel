@extends("master")

@section("styling")
    <link rel="stylesheet" href="{{asset('css/admin/mainAdmin.css')}}">
    @yield('siteStyling')
@endsection

@section("cContent")
    <div class="adminContent">
        <H2>Admin Dashboard</H2>
        <div class="adminButtons">
            <a class="button" href="{{route("newUser")}}">
                <img class="colorFilter" src="{{asset("imgs/user.png")}}">
                <h3>Create user</h3>
            </a>
            <a class="button" href="{{route("userList")}}">
                <img class="colorFilter" src="{{asset("imgs/users.png")}}">
                <h3>User list</h3>
            </a>
            <a class="button" href="">
                <img class="colorFilter" src="{{asset("imgs/log.png")}}">
                <h3>Log</h3>
            </a>
        </div>
        <div class="admincC">
            @yield('admincC')
        </div>
    </div>
@endsection
