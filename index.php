<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Project| Image Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
       <div class="row d-flex justify-content-center mt-2">
        <h4 class="fs-4 text-muted fw-bold">Users CRUD Operation With Image Upload Using php , Mysql , Bootstrap , Ajax & js. </h4>

        <div class="col-sm-12 col-md-12 col-lg-10">
            <button id="addNew" class="btn btn-primary m-1" style="float: right;"><i class="fa fa-plus"></i> Add New User</button>
        </div>
        
        <div class="row mb-2" id="uploadProfile">
        </div>

        <div>
            <h6 class="fs-6 text-center text-muted fw-bold">&copy;<span id="year"></span>. Khalifa Online Service. All rights reserved. </h6>
        </div>

        <div class="modal" tabindex="-1" id="userModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="userForm" enctype="multpart/form-data">
                            
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="alert alert-success fw-bold d-none" role="alert">Successfully Alert</div>
                                    <div class="alert alert-danger fw-bold d-none" role="alert">Sorry Alert</div>
                                </div>
                                <div class="col-sm-12 col-lg-12-cl-md-12">
                                <input type="hidden" name="updatedId" id="updatedId" class="form-control">
                                    <div class="form-group">
                                        <label for="" class="label-form">Username*</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" >
                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="label-form">User Type*</label>
                                        <select name="type" id="type" class="form-control" >
                                            <option value="0">Select Option</option>
                                            <option value="User">User</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User Admin">User Admin</option>
                                        </select>
                                    </div>
                                        
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="label-form">Email*</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" >
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="label-form">Password*</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="password">
                                    </div>
                                </div>
                                 <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="" class="label-form">Phone*</label>
                                        <input type="number" name="phone" id="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>
                                

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                         <div class="form-group">
                                            <label for="label-form"">image*</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>
                                </div>

                                
                                
                                </div>

                                <div class="row d-flex justify-content-center">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 ">
                                       
                                    <img class="img-fluid" id="showImage">
                                    
                                
                                    </div>
                                </div>


                                
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


       </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/main.js"></script>
</body>
</html>