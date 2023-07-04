@extends('layouts.admin_app')

@section('content')
<h3>Register Employee</h3>
    <div class="row form-control">
        <div class="col-5 mt-3">
            <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" id="firstname">
        </div>
        <div class="col-5 mt-3">
            <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" id="lastname">
        </div>
        <div class="col-5 mt-3">
            <input type="email" class="form-control" name="email" placeholder="Enter Email" id="email">
        </div>
        <div class="col-5 mt-3">
            <input type="tel" class="form-control" name="mobile" placeholder="Enter mobile" id="mobile">
        </div>
        <div class="col-5 mt-3">
           <label for="branch_title">Choose a Branch:</label>
            <select name="branch_title" class="form-control" id="branch_title">
            <option>Select Branch</option>
            </select>
        </div>
        <div class="col-5 mt-3">
            <input type="text" class="form-control" name="salary" placeholder="Enter Salary" id="salary">
        </div>
        <div class="col-2 mt-3">
            <input type="submit" class="btn btn-primary" name="save" onclick="saveuser()" id="save">
        </div>
    </div>
</form>
<table class="table table-bordered mt-3">
    <thead>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Branch Title</th>
        <th>Salary</th>
        <th>Action</th>
    </thead>
    <tbody id="Disp">
        <tr>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
    </tbody>
</table>
@endsection
@push('custom-scripts')
<script>
    function getuserdata(id) {
        // console.log("called");
        fetch("http://localhost:8000/api/allemployee").then((res) => res.json()).then((data) => {
            // console.log("employeedata",data);
            var htmlli = ""

            data.forEach(element => {
                // console.log(element.branch_title);
                htmlli += `<tr><td>${element.firstname}</td><td>${element.lastname}</td><td>${element.email}</td>
                         <td>${element.mobile}</td><td>${element.branch_title}</td><td>${element.salary}</td>
                     <td><button class="btn btn-secondary"><i onclick="editallemployee(${element.empid})" class="ti-pencil-alt"></i></button>
                     &nbsp;&nbsp;<button class="btn btn-danger"><i onclick="deleteallemployee(${element.empid})" class="ti-trash"></i></button>
                     </td></tr>`
            });
            $("#Disp").html(htmlli)
            // document.getElementById("Disp").innerHTML = htmlli
        })
        fetch("http://localhost:8000/api/branch").then((res) => res.json()).then((data) => {
            var htmloption = "<option value=''>Select Branch</option>"
            data.forEach(element => {
                htmloption += `<option value=${element.id}>${element.branch_title}</option>`
            });
            $("#branch_title").html(htmloption)
            // document.getElementById("Disp").innerHTML = htmlli
        })
    } 
    getuserdata()  

    function saveuser(id) {
    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    email = document.getElementById("email").value;
    mobile = document.getElementById("mobile").value;
    branch_title = document.getElementById("branch_title").value;
    salary = document.getElementById("salary").value;
    const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ firstname: firstname,lastname: lastname, email: email, mobile:mobile, branch_title:branch_title, salary:salary})
     };
        fetch("http://localhost:8000/api/saveallemployee",requestOptions).then((res)=>res.json()).then((data)=>{
            document.getElementById("firstname").value = ""
            document.getElementById("lastname").value = ""
            document.getElementById("email").value = ""
            document.getElementById("mobile").value = ""
            document.getElementById("branch_title").value = ""
            document.getElementById("salary").value = ""
        getuserdata()
         }) 
        } 
    function editallemployee(id) {
        fetch("http://localhost:8000/api/editallemployee/"+id,{method : 'PATCH'}).then((res)=>res.json()).then((data)=>{
            // console.log("test",data);
            // console.log("called branch",htmloption);            
            // console.log("data[0].branch_title",data[0].branch_title);
            // $("#branch_title").html(htmloption)
            // console.log("data[0]",data[0]);
            
            $("#firstname").val(data[0].firstname);
            $("#lastname").val(data[0].lastname);
            $("#email").val(data[0].email);
            $("#mobile").val(data[0].mobile);
            $("#branch_title option[value='"+data[0].branchid+"']").attr("selected","selected");
            $("#salary").val(data[0].salary);
            $("#save").removeAttr("onclick");
            $("#save").attr("onclick","updateallemployee("+data[0].empid+")");
            $("#save").val("update");
            getuserdata()
         }) 
    } 
    function updateallemployee (id) {
    firstname = document.getElementById("firstname").value;
    lastname = document.getElementById("lastname").value;
    email = document.getElementById("email").value;
    mobile = document.getElementById("mobile").value;
    branch_title = document.getElementById("branch_title").value;
    salary = document.getElementById("salary").value;
    const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({firstname: firstname,lastname: lastname, email: email, mobile:mobile,branch_title:branch_title, salary:salary})
     };
        fetch("http://localhost:8000/api/updateallemployee/"+id,requestOptions).then((res)=>res.json()).then((data)=>{
            document.getElementById("firstname").value = ""
            document.getElementById("lastname").value = ""
            document.getElementById("email").value = ""
            document.getElementById("mobile").value = ""
            document.getElementById("branch_title").value=""
            document.getElementById("salary").value = ""
        getuserdata()
         }) 
    }
    function deleteallemployee(id) {
      fetch("http://localhost:8000/api/deleteallemployee/"+id).then((res) => res.json()).then((data) => {
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