$("#addNew").on("click" ,function(){
    $("#userModal").modal("show");
    $(".modal-title").html("Add new user");
});

$("#year").html(new Date().getFullYear());

loadUserData();

var btnAction = "Insert";
var fileImage = document.querySelector("#image");
var showImage = document.querySelector("#showImage");
const reader = new FileReader();
fileImage.addEventListener("change", (e) =>{
    var selectedFile = e.target.files[0];
    reader.readAsDataURL(selectedFile);
})
reader.onload = (e) => {
    showImage.src = e.target.result;
}
$("#userForm").on("submit", (e) =>{
    e.preventDefault();
    var sendData = new FormData($("#userForm")[0]);
    sendData.append("image", $("input[type=file]")[0].files[0]);

    var username = $("#username").val();
    var type = $("#type").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    var image = $("#image").attr("src","");

    if(username == ""){
        displayMessage("error", "Username Is Empty!. Please Enter A Username.");
    }
    else if(type == 0){
        displayMessage("error", "User Type Is Not Selected! Please Select Type.");
    }
    else if(email == ""){
        displayMessage("error", "Email Is Empty!. Please Enter A Email.");
    }
    else if(password == ""){
        displayMessage("error", "Password Is Empty!. Please Enter A Password.");
    }
    else if(phone == ""){
        displayMessage("error", "Phone Is Empty!. Please Enter A Phone.");
    }
    // else if(image.attr){
    //     displayMessage("error", "Image Is Not Uploaded!. Please Upload Image.");
    // }
    else{
        if(btnAction == "Insert"){
            sendData.append("action", "registerUser");
        }else{
            sendData.append("action", "updateUser")
        }
    
        $.ajax({
            method: "POST",
            dataType: "json",
            url: "./api/user.php",
            data: sendData,
            processData: false,
            contentType:false,
            success: (data) =>{
                var status = data.status;
                var response = data.data;
    
                if(status){
                   displayMessage("success", response);
                   loadUserData();
                   btnAction = "Insert";
                }else{
                    displayMessage("error", response);
                }
            }
        })
    }
})


function loadUserData(){
   $("#uploadProfile").html("");
    var sendData = {
        "action" : "readAllUsers"
    }

    $.ajax({
        method : "POST",
        dataType : "json",
        url: "./api/user.php",
        data: sendData,
        success: function(data){
            var status = data.status;
            var response = data.data;
            var html = '';

            if(status){
                response.forEach(item => {
                    html += `
                    <div class="col-sm-4 mt-2 mb-3"> `;   
                        html += `
                        <div class="card bg-card">
                        <div class="card-body">
                        <div style="height: 5px; margin-top: -16px; width: 100%; padding: 5px; background-color: darkBlue; border-radius: 0px 0px 10px 10px;"></div>
                            <div class="card-title text-center mt-2">
                                <img src="./assets/uploads/${item['image']}">
                            </div>
                            <hr>
                            <div class="content-user">
                                <h6 class="fs-6" id="id">UserID: <span style="margin-left: 45px;">${item['id']}</span></h6>
                                
                                <h6 class="fs-6" id="id">Username: <span style="margin-left: 20px;">${item['name']}</span></h6>

                                <h6 class="fs-6" id="id">Type: <span style="margin-left: 58px;">${item['type']}</span></h6>
                
                                <h6 class="fs-6" id="id">Email: <span style="margin-left: 55px;">${item['email']}</span></h6>
                
                                <h6 class="fs-6" id="id">Password: <span style="margin-left: 26px;">${item['password']}</span></h6>
                                <h6 class="fs-6" id="id">Phone: <span style="margin-left: 46px;">${item['phone']}</span></h6>
                
                                <h6 class="fs-6" id="id">Date: <span style="margin-left: 58px;">${item['date']}</span></h6>
                            </div>
                
                            <div class="footer text-center mt-2">
                                <a class="btn btn-primary update_info m-2" update_id=${item['id']}><i class="fa fa-edit"></i> Update</a>
                                <a class="btn btn-danger delete_info m-2" delete_id=${item['id']}><i class="fa fa-trash"></i> Delete</a>
                            </div>

                            <div style="height: 5px; margin-bottom: -17px; width: 100%; padding: 5px; border-radius: 10px 10px 0px 0px; background-color: #F47A20;"></div>
                        </div>
                    </div>
                    
                        `
                   
                     html += `</div>`;
                     

                     
                    
                });
              
               $("#uploadProfile").append(html);
            }
            
        }
    })
  

}

function displayMessage (type,message){
    var success = document.querySelector(".alert-success");
    var error = document.querySelector(".alert-danger");

    if(type == "success"){
        error.classList = "alert alert-danger d-none";
        success.classList = "alert alert-success";
        success.innerHTML = message;
        setTimeout(() =>{
            success.classList = "alert alert-success d-none";
            $("#userForm")[0].reset();
            $("#showImage").attr("src","");
            $("#userModal").modal("hide");
        },3000)
    }else{
        error.classList = "alert alert-danger";
        error.innerHTML = message;
        setTimeout(function() {
            error.classList = "alert alert-danger d-none";
        },5000)
    }
}

function fetchUserInfo(id){
    var sendData  = {
        "action": "readSpecificUser",
        "id": id
    }

    $.ajax({
        method: "POST",
        dataType: "json",
        url: "./api/user.php",
        data: sendData,
        success: (data) => {
            var status = data.status;
            var response = data.data;

            if(status){
                $("#userModal").modal('show');
                $(".modal-title").html("Update User Info!");
                $("#updatedId").val(response[0].id);
                $("#username").val(response[0].name);
                $("#type").val(response[0].type);
                $("#email").val(response[0].email);
                $("#password").val(response[0].password);
                $("#phone").val(response[0].phone);
                $("#showImage").attr("src", `./assets/uploads/${response[0].image}`);

                btnAction = "Update"
            }
        }
    })
}

function  deleteUserInfo(id){
    var sendData = {
        "action": "deleteUser",
        "id": id
    }
    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: "./api/user.php",
        data: sendData,

        success: (data) =>{
            var status = data.status;
            var response = data.data;

            if(status){
                console.log(response)
                loadUserData();
            }
        }
    })
}


$("#uploadProfile").on("click","a.update_info", function(){
    var id = $(this).attr("update_id");
    fetchUserInfo(id);
});

$("#uploadProfile").on("click","a.delete_info", function() {
    var id = $(this).attr("delete_id");

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            deleteUserInfo(id);
          Swal.fire(
            'Deleted!',
            'Successfully Deleted ✔😃.',
            'success'
          )
        }
      })
})
