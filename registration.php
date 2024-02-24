<?php
session_start();

if(isset($_POST['submit']))
{
    $regno=$_POST['regno'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $gender=$_POST['gender'];
    $contactno=$_POST['contact'];
    $emailid=$_POST['email'];
    $password=$_POST['password'];
    $query="insert into  userRegistration(regNo,firstName,middleName,lastName,gender,contactNo,email,password) values(?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('sssssiss',$regno,$fname,$mname,$lname,$gender,$contactno,$emailid,$password);
    $stmt->execute();
    echo"<script>alert('Student Succssfully register');</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="regis.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript">
        function valid()
        {
            if(document.registration.password.value!= document.registration.cpassword.value)
            {
                alert("Password and Re-Type Password Field do not match  !!");
                document.registration.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="container">
    <div class="title">Registration</div>
    <div class="content">
        <form action="#">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Registration no.</span>
                    <input type="text" name="regno" id="regno"  placeholder="Enter your Registration No." >
                </div>
                <div class="input-box">
                    <span class="details">First Name</span>
                    <input class="form-control" required="required" placeholder="Enter your First Name" >
                </div>
                <div class="input-box">
                    <span class="details">Middle Name </span>
                    <input  type="text" name="mname" id="mname"  class="form-control" placeholder="Enter your Middle Name" required>
                </div>
                <div class="input-box">
                    <span class="details">Last Name </span>
                    <input type="text" name="lname" id="lname"  class="form-control" required="required" placeholder="Enter your Last Name">
                </div>
                <div class="input-box">
                    <span class="details">Gender</span>
                    <select name="gender" class="form-control" required="required">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" id="email"  class="form-control" onBlur="checkAvailability()" required="required" placeholder="Enter your email" >
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" name="contact" id="contact"  class="form-control" required="required" placeholder="Enter your number" >
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" id="password"  class="form-control" required="required" placeholder="Enter your password" >
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" name="cpassword" id="cpassword"  class="form-control" required="required" placeholder="Confirm your password" >
                </div>
            </div>
            <!-------------Panel---------------------->
           <!-- <div class="gender-details">
                <input type="radio" name="gender" id="dot-1">
                <input type="radio" name="gender" id="dot-2">
                <input type="radio" name="gender" id="dot-3">
                <span class="gender-title">Panel</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Student</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Administration</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Vendor</span>
                    </label>
                </div>
            </div>---->
            <!--------------Gender---------------------->
            <!--------------<div class="gender-details">
                <input type="radio" name="gender" id="dot-1">
                <input type="radio" name="gender" id="dot-2">
                <input type="radio" name="gender" id="dot-3">
                <span class="gender-title">Gender</span>
                <div class="category">
                    <label for="dot-1">
                        <span class="dot one"></span>
                        <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                        <span class="dot two"></span>
                        <span class="gender">Female</span>
                    </label>
                    <label for="dot-3">
                        <span class="dot three"></span>
                        <span class="gender">Prefer not to say</span>
                    </label>
                </div>
            </div>---------------------->
           <div class="button">
            <input type="cancel" value="Cancel">
    </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>
</body>
<script>
    function checkAvailability() {

        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data:'emailid='+$("#email").val(),
            type: "POST",
            success:function(data){
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error:function ()
            {
                event.preventDefault();
                alert('error');
            }
        });
    }
</script>

</html>
