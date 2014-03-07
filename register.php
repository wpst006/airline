<?php include('includes/includefiles.php'); ?>

<?php
if (isset($_POST['submitted'])) {
    $error = false;
    //*********************************************************************
    //Filling Data
    $flight_id = autoID::getAutoID('customers', 'customer_id', 'CUS_', 6);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $DOB=$_POST['DOB'];
    $nrc_no = $_POST['nrc_no'];
    $phone_no = $_POST['phone_no'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $post_code = $_POST['post_code'];
    //*********************************************************************
    //"members" Table Insert
    $flight_sql = "INSERT INTO " .
            "customers(customer_id,firstname,lastname,gender,DOB,nrc_no,phone_no,street,city,country,post_code) " .
            "VALUES('$flight_id','$firstname','$lastname','$gender','$DOB','$nrc_no','$phone_no','$street','$city','$country','$post_code')";

    mysql_query($flight_sql) or die(mysql_error());
    //*********************************************************************
    //User Table Insert
    $userInsert_sql = "INSERT INTO " .
            "`users`(user_id,username,email,password,role) " .
            "VALUES('$flight_id','$username','$email','$password','member')";

    mysql_query($userInsert_sql) or die(mysql_error());
    //*********************************************************************
    messageHelper::setMessage("You have successfully registered. Please log in to continue.", MESSAGE_TYPE_SUCCESS);
    header("Location:login.php");
    exit();
}
?>

<?php $pageTitle="Register"; ?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="register" name="register" action="register.php" method="post" class="form-horizontal">

            <div class="form-group">
                <div class="col-sm-3 control-label">User Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="username" name="username" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="password" name="password" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label" style="font-size:10pt;">Confirm Password :</div>
                <div class="col-sm-9">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Email :</div>
                <div class="col-sm-9">
                    <input type="text" id="email" name="email" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">First Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="firstname" name="firstname" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Last Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="lastname" name="lastname" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Gender :</div>
                <div class="col-sm-9">
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optMale" value="M" checked>
                            Male
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                            <input type="radio" name="gender" id="optFemale" value="F">
                            Female
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">DOB :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="DOB" name="DOB" class="form-control" data-format="YYYY-MM-DD" value="<?php echo date('Y-m-d', time()); ?>"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker({
                        pickTime: false
                    });
                });
            </script>

            <div class="form-group">
                <div class="col-sm-3 control-label">NRC No :</div>
                <div class="col-sm-9">
                    <input type="text" id="nrc_no" name="nrc_no" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Phone No :</div>
                <div class="col-sm-9">
                    <input type="text" id="phone_no" name="phone_no" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Street :</div>
                <div class="col-sm-9">
                    <input type="text" id="street" name="street" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">City :</div>
                <div class="col-sm-9">
                    <input type="text" id="city" name="city" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Country :</div>
                <div class="col-sm-9">
                    <input type="text" id="country" name="country" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Post Code :</div>
                <div class="col-sm-9">
                    <input type="text" id="post_code" name="post_code" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>                        
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $("#register").validate({
        rules: {
            username: 
                {
                required: true
            },
            password: 
                {
                required: true
            },
            confirm_password: 
                {
                required:true,
                equalTo: "#password"
            },
            email: 
                {
                required: true,
                email: true
            },
            firstname: 
                {
                required: true
            },
            lastname: 
                {
                required: true
            },
            nrc_no: 
                {
                required: true
            },
            phone_no: 
                {
                required: true
            },
            street: 
                {
                required: true
            },
            city: 
                {
                required: true
            },
            country: 
                {
                required: true
            },
            post_code: 
                {
                required: true
            },
        },
        //set messages to appear inline
        messages: 
            {
            username: "Please enter user name.",
            password: "Please enter a password.",
            confirm_password: 
                {
                required: "Please enter a confirm password.",
                equalTo: "Password and Confirm Password not match."
            },
            email: 
                { 
                required: "Please enter a E-Mail address.",
                email: "Please enter a valid E-Mail address."
            },
            firstname: "Please enter first name.",
            lastname: "Please enter last name.",  
            nrc_no: "Please enter NRC No.",
            phone_no: "Please enter phone no.",  
            street: "Please enter street.",
            city: "Please enter city.",  
            country: "Please enter country.",
            post_code: "Please enter post Code.",  
        }
    });
</script>
<?php include('includes/footer.php'); ?>
