@extends('/admin/admin')

@section("siteStyling")
    <link rel="stylesheet" href="{{asset('css/admin/userList.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/CreateUser.css')}}">
@endsection

@section("admincC")
    <h2 class="header">User List</h2>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>access Level</th>
            <th>Edit</th>
        </tr>
        <tr>
            <td>0</td>
            <td>Kanye West</td>
            <td>Admin</td>
            <td class="edit" onclick="edit()">...</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Alex jones</td>
            <td>admin</td>
            <td class="edit" onclick="edit()">...</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jefrey epstein</td>
            <td>user</td>
            <td class="edit" onclick="edit()">...</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Andrew Tate</td>
            <td>Spectator</td>
            <td class="edit" onclick="edit()">...</td>
        </tr>
    </table>
    <div class="pageButtons">
        <button class="BSelected ButtonSelect">1</button>
        <button class="ButtonSelect">2</button>
        <button class="ButtonSelect">3</button>
        <button class="ButtonSelect">4</button>
        <button class="ButtonSelect">5</button>
    </div>




        <div class="editU" id="editU" onmouseleave="left()">
            <a class="editB" onclick="editSShow()">Edit user</a>
            <a class="editB" onclick="deleteSShow()">Delete user</a>
        </div>


        <div class="deleteOuter" id="deleteOuter">
            <div class="delete">
                <h3>Are you sure you want to delete</h3>
                <h2>User: Kanye West</h2>
                <div>
                    <button class="delBut">Yes</button>
                    <button class="delBut" onclick="deleteSGoAway()">No</button>
                </div>
            </div>
        </div>

    <div class="deleteOuter" id="editOOuter">
        <form id="createUser">
            @csrf
            <h2 class="">Edit User</h2>
            <Section>
                <input id="name" name="name" class="Cinput" type="text" placeholder="Name" value="Alex Jones" onkeyup="shessh()">
            </Section>
            <section id="passwordS">
                <input id="password" name="password" class="Cinput" type="password" placeholder="Password" value="dfjdsnlk" onkeyup="shessh()">
                <img id="passwordimg" src="{{asset("imgs/see.png")}}" onclick="see()">
            </section>
            <section>
                <select id="CreateUserSelect" onchange="select()">
                    <option>Access lvl</option>
                    <option>spectator</option>
                    <option>user</option>
                    <option value="admin" selected>admin</option>
                </select>
            </section>
            <section>
                <input id="pin" name="pin" class="Cinput" type="number" placeholder="Pin-code" value="1234" onkeyup="shessh()">
            </section>
            <button id="createUserBut" onclick="check()">Close</button>
        </form>
    </div>

    <script>
        let xPos = 0
        let yPos = 0
        window.addEventListener("mousemove", (e) => {
            xPos = e.clientX
            yPos = e.clientY
            console.log(xPos, yPos)
        });

        function edit(){
            document.getElementById("editU").style.opacity = "100%";
            document.getElementById("editU").style.top = yPos+"px";
            document.getElementById("editU").style.left = xPos+"px";
        }

        function left(){
            document.getElementById("editU").style.opacity = 0;
        }

        function deleteSGoAway(){
            document.getElementById("deleteOuter").style.opacity = 0;
            document.getElementById("deleteOuter").style.zIndex = "-100";
            left()
        }

        function deleteSShow(){
            document.getElementById("deleteOuter").style.opacity = "100%";
            document.getElementById("deleteOuter").style.zIndex = "1000";
        }

        function editSGoAway(){
            document.getElementById("editOOuter").style.opacity = 0;
            document.getElementById("editOOuter").style.zIndex = "-100";
            left()
        }

        function editSShow(){
            document.getElementById("editOOuter").style.opacity = "100%";
            document.getElementById("editOOuter").style.zIndex = "1000";
        }

        //
        select()
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

        function check(){
            if(document.getElementById("createUserBut").value = "Save"){
                unsee();
            }else {
                unsee();
            }
        }

        function shessh(){
            if(document.getElementById("name") != "Alex Jones" || document.getElementById("Password") != "dfjdsnlk" || document.getElementById("pin") != "1234"){
                document.getElementById("createUserBut").innerText = "Save"
                return;
            }
            document.getElementById("createUserBut").innerText = "close"
        }
    </script>
@endsection
