@extends('layouts.admin_app')

@section('content')
<h3>Branch</h3>
    <div class="row">
        <div class="col-3">
            <input type="text" class="form-control" name="branch_title" placeholder="Enter Branch Title" id="branch_title">
        </div>
        <div class="col-3">
            <input type="text" class="form-control" name="branch_description" placeholder="Enter Branch Description" id="branch_description">
        </div>
        <div class="col-3">
            <input type="submit" class="btn btn-primary" name="branch-save" onclick="savebranchdata()" id="branch-save">
        </div>
    </div>
</form>
<table class="table table-bordered mt-3">
    <thead>
        <th>Branch Name</th>
        <th>Branch Description</th>
        <th>Action</th>
    </thead>
    <tbody id="Disp">
        <tr>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
    </tbody>

</table>
@endsection
@push('custom-scripts')
<script>
    function getbranchdata(id) {
        // console.log("called");
        fetch("http://localhost:8000/api/branch").then((res) => res.json()).then((data) => {
            // console.log(data);
            var htmlli = ""
            data.forEach(element => {
                htmlli += `<tr><td>${element.branch_title}</td><td>${element.branch_description}</td>
                     <td><button class="btn btn-secondary"><i onclick="editbranchdata(${element.id})" class="ti-pencil-alt"></i></button>
                     &nbsp;&nbsp;<button class="btn btn-danger"><i onclick="deletebranchdata(${element.id})" class="ti-trash"></i></button>
                     </td></tr>`
            });
            $("#Disp").html(htmlli)
            // document.getElementById("Disp").innerHTML = htmlli
        })
    } 
    getbranchdata()  
    function savebranchdata(id) {
    //  console.log("save");
      branch_title = document.getElementById("branch_title").value;
      branch_description = document.getElementById("branch_description").value;
      const requestOptions = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ branch_title: branch_title, branch_description: branch_description })
      };
      fetch("http://localhost:8000/api/savebranchdata/",requestOptions).then((res) => res.json()).then((data)=>{
        document.getElementById("branch_title").value = ""
        document.getElementById("branch_description").value = ""
        getbranchdata() 
    })
    }

    function editbranchdata(id) {
    //   console.log("id for edit",id);
      fetch("http://localhost:8000/api/editbranchdata/"+id,{method : 'PATCH'}).then((res)=>res.json()).then((data)=>{
        $("#branch_title").val(data.branch_title);
        $("#branch_description").val(data.branch_description);
        $("#branch-save").removeAttr("onclick");
        $("#branch-save").attr("onclick","updatebranchdata("+data.id+")");
        $("#branch-save").val("update");
        getbranchdata()
         })  
    }

    function updatebranchdata (id) {
    branch_title = document.getElementById("branch_title").value;
    branch_description = document.getElementById("branch_description").value;
    const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ branch_title: branch_title, branch_description: branch_description })
     };
        fetch("http://localhost:8000/api/updatebranchdata/"+id,requestOptions).then((res)=>res.json()).then((data)=>{
        document.getElementById("branch_title").value = ""
        document.getElementById("branch_description").value = ""
        getbranchdata()
         }) 
    }

    function deletebranchdata(id) {
        fetch("http://localhost:8000/api/deletebranchdata/"+id).then((res) => res.json()).then((data) => {
         getbranchdata() }) 
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