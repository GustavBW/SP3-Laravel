@extends('/admin/admin')

@section("siteStyling")
    <link rel="stylesheet" href="{{asset('css/admin/CreateUser.css')}}">
@endsection

@section("admincC")
    <form id="createUser" method="post">
        @csrf
        <h2 class="">Create User</h2>
        <Section>
            <input id="name" name="name" class="Cinput" type="text" placeholder="Name">
        </Section>
        <section id="passwordS">
            <input id="password" name="password" class="Cinput" type="password" placeholder="Password">
            <img id="passwordimg" src="{{asset("imgs/see.png")}}" onclick="see()">
        </section>
        <section>
            <select id="CreateUserSelect" onchange="select()">
                <option>Access lvl</option>
                <option>spectator</option>
                <option>user</option>
                <option value="admin">admin</option>
            </select>
        </section>
        <section>
            <input id="pin" name="pin" class="Cinput" type="text" placeholder="Pin-code">
        </section>
        <button id="createUserBut" onclick="create()">Create User</button>
    </form>
    <script>
        function select(){
            if(document.getElementById("CreateUserSelect").value == "admin"){
                document.getElementById("pin").style.opacity = "100%"
                return;
            }
            document.getElementById("pin").style.opacity = "0"
        }

        function see(){
            document.getElementById("passwordimg").src = "{{asset("imgs/unsee.png")}}";
            document.getElementById("passwordimg").onclick = function () {unsee()};
            document.getElementById("password").type = "text"
        }

        function unsee(){
            document.getElementById("passwordimg").src = "{{asset("imgs/see.png")}}";
            document.getElementById("passwordimg").onclick = function () {see()};
            document.getElementById("password").type = "password"
        }
    </script>
@endsection
