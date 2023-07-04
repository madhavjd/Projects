@extends('layouts.admin_app')

@section('content')
<h3>Users</h3>
    <div class="row">
        <div class="col-5">
            <input type="text" class="form-control" name="username" placeholder="Enter User Name" id="username">
        </div>
        <div class="col-5">
            <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email">
        </div>
        <div class="col-2">
            <input type="submit" class="btn btn-primary" name="save" onclick="saveuser()" id="save">
        </div>
    </div>
</form>
<table class="table table-bordered mt-3">
    <thead>
        <th>User Name</th>
        <th>Action</th>
    </thead>
    <tbody id="Disp">
        <tr>
            <td>test</td>
            <td>test</td>
        </tr>
    </tbody>
</table>
@endsection
@push('custom-scripts')
<script>
    function getuserdata(id) {
        console.log("called");
        fetch("http://localhost:8000/api/todolistget").then((res) => res.json()).then((data) => {
            var htmlli = ""
            data.forEach(element => {
                htmlli += `<tr><td>${element.username}</td>
                     <td><button class="btn btn-secondary"><i onclick="edituser(${element.id})" class="ti-pencil-alt"></i></button>
                     &nbsp;&nbsp;<button class="btn btn-danger"><i onclick="deleteuser(${element.id})" class="ti-trash"></i></button>
                     </td></tr>`
            });
            $("#Disp").html(htmlli)
            // document.getElementById("Disp").innerHTML = htmlli
        })
    } 
    getuserdata()  

    function saveuser(id) {
    inp = document.getElementById("username").value;
    email = document.getElementById("email").value;
    const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ title: inp,email: email})
     };
        fetch("http://localhost:8000/api/todolist",requestOptions).then((res)=>res.json()).then((data)=>{
        document.getElementById("username").value = ""
        getuserdata()
         }) 
        } 
    function edituser(id) {
        console.log("save");
        fetch("http://localhost:8000/api/todolist/"+id,{method : 'PATCH'}).then((res)=>res.json()).then((data)=>{
        $("#username").val(data.username);
        $("#email").val(data.email);
        $("#save").removeAttr("onclick");
        $("#save").attr("onclick","updatetodo("+data.id+")");
        $("#save").val("update");
        getuserdata()
         }) 
    } 
    function updatetodo (id) {
    inp = document.getElementById("username").value;
    email = document.getElementById("email").value;
    const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ title: inp, email: email })
     };
        fetch("http://localhost:8000/api/updatetodo/"+id,requestOptions).then((res)=>res.json()).then((data)=>{
        document.getElementById("username").value = ""
        document.getElementById("email").value = ""
        getuserdata()
         }) 
    }
    function deleteuser(id) {
      fetch("http://localhost:8000/api/deletetodolist/"+id).then((res) => res.json()).then((data) => {
        console.log(data);
        getuserdata() }) 
        }

//    function editbranchdata(id) {
//             console.log("called");
//             var result = { };
//             console.log(id);
//             fetch(`http://localhost:8000/api/editbranchdata/${id}`).then((res) => res.json()).then((data)=>{
//                 console.log(data.branch_description);
//                 console.log(data.branch_title);
//                 $("#branch_title").val(data.branch_title)   
//                 $("#branch_description").val(data.branch_description)  
//                 document.getElementByID("insertbranch").setAttribute("onclick","event.preventDefault(); updatebranchdata")
//                 getbranchdata()
//             })
//         }   
        
//      function updatebranchdata() {
//         console.log("madhav");
//         }   
    
      
   
</script>
@endpush