
<?php
session_start();
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$stmt=$mysqli->prepare("SELECT email,password,id FROM userregistration WHERE email=? and password=? ");
$stmt->bind_param('ss',$email,$password);
$stmt->execute();
$stmt -> bind_result($email,$password,$id);
$rs=$stmt->fetch();
$stmt->close();
$_SESSION['id']=$id;
$_SESSION['login']=$email;
$uip=$_SERVER['REMOTE_ADDR'];
$ldate=date('d/m/Y h:i:s', time());
if($rs)
{
$uid=$_SESSION['id'];
$uemail=$_SESSION['login'];
$ip=$_SERVER['REMOTE_ADDR'];
$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
$city = $addrDetailsArr['geoplugin_city'];
$country = $addrDetailsArr['geoplugin_countryName'];
$log="insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
$mysqli->query($log);
if($log)
{
header("location:dashboard.php");
}
}
else
{
echo "<script>alert('Invalid Username/Email or password');</script>";
}
}
?>
<?php
/*session_start();
check_login();*/
//code for update email id
if($_POST['update'])
{
    $email=$_POST['emailid'];
    $aid=$_SESSION['id'];
    $udate=date('Y-m-d');
    $query="update admin set email=?,updation_date=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc=$stmt->bind_param('ssi',$email,$udate,$aid);
    $stmt->execute();
    echo"<script>alert('Email id has been successfully updated');</script>";
}
// code for change password
if(isset($_POST['changepwd']))
{
    $op=$_POST['oldpassword'];
    $np=$_POST['newpassword'];
    $ai=$_SESSION['id'];
    $udate=date('Y-m-d');
    $sql="SELECT password FROM admin where password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('s',$op);
    $chngpwd->execute();
    $chngpwd->store_result();
    $row_cnt=$chngpwd->num_rows;;
    if($row_cnt>0)
    {
        $con="update admin set password=?,updation_date=?  where id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('ssi',$np,$udate,$ai);
        $chngpwd1->execute();
        $_SESSION['msg']="Password Changed Successfully !!";
    }
    else
    {
        $_SESSION['msg']="Old Password not match !!";
    }


}
?>
//------------------------------------------------
/*----------------------------------------------------------------------------------------------*/
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Student%20Section/css/style.css">
    <link rel="stylesheet" href="footer.css">
    <!---------------------------Js--------------------------------------------->

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
    <!---------------------------Js--------------------------------------------->
</head>
<body>
<section id="home">
    <header>
        <!--  <a href="#"><img src="Fury" alt=""></a>-->
        <a href="#"><img src="image/logo-removebg-preview.png" style="width:400px;height: 60px" alt=""></a>

        <ul id="menu">
            <li><a href="#home">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                    Home</a></li>
            <li><a href="#about">About us</a></li>
            <li><a href="#galary">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
            <!---    <li><a href="#faq">FAQ</a></li>---->
            <li><a href="faq.html">FAQ</a></li>
        </ul>
    </header>
    <!---   <img src="image/r.jpeg" alt="" width="150%">----->
    <div class="container">

        <form class="form">
            <img src="image/he-removebg-preview1.png"style="width:360px;height: 150px">
            <p style="font-variant:small-caps;"> <h3>Hostel Management System</h3></p>
            <input type="email" placeholder="E-mail"><br>
            <!----------
            <input type="password" placeholder="Password" required><br>
       ------------>
            <div class="input-box">
                <i class="fas fa-eye-slash show_hide"></i>
                <input spellcheck="false" type="password" placeholder="Enter password">
            </div>
            <div class="indicator">
                <div class="icon-text">
                    <i class="fas fa-exclamation-circle error_icon"></i>
                    <h6 class="text"></h6>
                </div>
            </div>
            <!--<button class="btn btn-default" type="cancel"><SPan></SPan>Cancel</button>--->
            <button type="submit"><SPan></SPan>login</button><br>
            <a href="forgot-password.php"><div class="sss">forget password?</div></a><br>
            <a href="registration.php"><div class="sss">create account</div></a>
        </form>
    </div>
</section>
<section id="about">
    <table>
        <tr>
            <th>
                <img id="borderimg1" src="image/ezgif.com-gif-maker.gif" alt="Computer man"
                     style="width: 450px; height:350px;">
            </th>
            <th>
                <p style="text-align:center">
                    Hostel management system
                    is designed to manage<br>
                    all hostel activities like
                    hostel admissions, fees, room,<br>
                    mess allotment, hostel
                    stores & generates related<br>
                    reports for smooth transactions.
                    It is also used to<br>
                    manage monthly mess bill
                    calculation, hostel staff<br>
                    payroll, student
                    certificates, etc.<br></p>
            </th>
        </tr>
    </table>
</section>
<section id="galary">
    <!--  <TABLE>
          <TR>
              <TD>--->
    <div class="aaa">
        <marquee width="100%" direction="right" height="100%" scrollamount="30" behavior="alternate">
            <IMG src="image/g1.jpeg"  style="width: 600px; height:500px;">
            <IMG src="image/g2.jpeg"  style="width: 600px; height:500px;">
            <IMG src="image/g3.jpeg"  style="width: 600px; height:500px;">
            <IMG src="image/g4.jpeg"  style="width: 600px; height:500px;">
            <IMG src="image/g5.jpg"  style="width: 600px; height:500px;">
        </marquee>
    </div>

</section>
<section id="contact">
    <div><h1>Contact us</h1></div>
    <div class="container2">
        <div class="content2">
            <div class="left-side">
                <div class="address details">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="topic">Address</div>
                    <div class="text-one">Surkhet, NP12</div>
                    <div class="text-two">Birendranagar 06</div>
                </div>
                <div class="phone details">
                    <i class="fas fa-phone-alt"></i>
                    <div class="topic">Phone</div>
                    <div class="text-one">+0098 9893 5647</div>
                    <div class="text-two">+0096 3434 5678</div>
                </div>
                <div class="email details">
                    <i class="fas fa-envelope"></i>
                    <div class="topic">Email</div>
                    <div class="text-one">codinglab@gmail.com</div>
                    <div class="text-two">info.codinglab@gmail.com</div>
                </div>
            </div>
            <div class="right-side">
                <div class="topic-text">Send us a message</div>
                <p>If you have any work from me or any types of quries related to my tutorial, you can send me message from here. It's my pleasure to help you.</p>
                <form action="#">
                    <div class="input-box">
                        <input type="text" placeholder="Enter your name">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Enter your email">
                    </div>
                    <div class="input-box message-box">

                    </div>
                    <div class="button">
                        <input type="button" value="Send Now" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!------------------------------------------------------->
<!--<section id="faq">
</section>---->
<!-------------------foooter------------------------->

<footer>
    <div class="content">
        <div class="top">
            <div class="logo-details">
                <i class="fab fa-slack"></i>
                <span class="logo_name">CodingLab</span>
            </div>
            <div class="media-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="link-boxes">
            <ul class="box">
                <li class="link_name">Company</li>
                <li><a href="#">Home</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Get started</a></li>
            </ul>
            <ul class="box">
                <li class="link_name">Services</li>
                <li><a href="#">GymKhana</a></li>
                <li><a href="#">Mess Facility</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Cultural Fest</a></li>
            </ul>
            <ul class="box">
                <li class="link_name">Account</li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">My account</a></li>
                <li><a href="#">Prefrences</a></li>
                <li><a href="faq.html">FAQ</a></li>
            </ul>
            <ul class="box">
                <li class="link_name">Department</li>
                <li><a href="#">Mess</a></li>
                <li><a href="#">Sanitation</a></li>
                <li><a href="#">Accounting</a></li>
                <li><a href="#">Management</a></li>
            </ul>
            <ul class="box input-box">
                <a href="admin/index.php"><li class="link_name">Admin Login</li></a>
            <!--  <li><input type="text" placeholder="Enter your email"></li>
                <li><input type="password" placeholder="Enter your  Password"></li>
                <li><input type="submit" value="Login"></li>--->
            </ul>
        </div>
    </div>
    <div class="bottom-details">
        <div class="bottom_text">
            <span class="copyright_text">Copyright © 2021 <a href="#">CodingLab.</a>All rights reserved</span>
            <span class="policy_terms">
          <a href="#">Privacy policy</a>
          <a href="#">Terms & condition</a>
        </span>
        </div>
    </div>
</footer>

<!---------------------------------------------->


<script>
    const input = document.querySelector("input"),
        showHide = document.querySelector(".show_hide"),
        indicator = document.querySelector(".indicator"),
        iconText = document.querySelector(".icon-text"),
        text = document.querySelector(".text");

    // js code to show & hide password

    showHide.addEventListener("click", ()=>{
        if(input.type === "password"){
            input.type = "text";
            showHide.classList.replace("fa-eye-slash","fa-eye");
        }else {
            input.type = "password";
            showHide.classList.replace("fa-eye","fa-eye-slash");
        }
    });

    // js code to show password strength (with regex)

    let alphabet = /[a-zA-Z]/, //letter a to z and A to Z
        numbers = /[0-9]/, //numbers 0 to 9
        scharacters = /[!,@,#,$,%,^,&,*,?,_,(,),-,+,=,~]/; //special characters

    input.addEventListener("keyup", ()=>{
        indicator.classList.add("active");

        let val = input.value;
        if(val.match(alphabet) || val.match(numbers) || val.match(scharacters)){
            text.textContent = "Password is weak";
            input.style.borderColor = "#FF6333";
            showHide.style.color = "#FF6333";
            iconText.style.color = "#FF6333";
        }
        if(val.match(alphabet) && val.match(numbers) && val.length >= 6){
            text.textContent = "Password is medium";
            input.style.borderColor = "#cc8500";
            showHide.style.color = "#cc8500";
            iconText.style.color = "#cc8500";
        }
        if(val.match(alphabet) && val.match(numbers) && val.match(scharacters) && val.length >= 8){
            text.textContent = "Password is strong";
            input.style.borderColor = "#22C32A";
            showHide.style.color = "#22C32A";
            iconText.style.color = "#22C32A";
        }

        if(val == ""){
            indicator.classList.remove("active");
            input.style.borderColor = "#A6A6A6";
            showHide.style.color = "#A6A6A6";
            iconText.style.color = "#A6A6A6";
        }
    });

</script>
<!---------------------faqs------------->

<script>
    let li = document.querySelectorAll(".faq-text li");
    for (var i = 0; i < li.length; i++) {
        li[i].addEventListener("click", (e)=>{
            let clickedLi;
            if(e.target.classList.contains("question-arrow")){
                clickedLi = e.target.parentElement;
            }else{
                clickedLi = e.target.parentElement.parentElement;
            }
            clickedLi.classList.toggle("showAnswer");
        });
    }
</script>
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
</html>
