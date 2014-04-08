<?php
//File Name: createUniversity.php
//Purpose: Page is where users register to use the site.
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Gottfried
//Last Date Modified: 3/28/2014

//start the session
session_start();
?>


<html>


<head>

    <?php include("header.php");?>
    
    <!--Validate all information before sending data to the termsAndConditions.php page-->
    <script type="text/javascript">
    function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
    function validatePassword(password) {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$/;
    return re.test(password);
    }
function validateForm()
{
    var x=document.forms["registerForm"]["firstname"].value;
    if (x==null || x=="")
    {
        alert("First name must be filled out");
        return false;
    }
    var x=document.forms["registerForm"]["lastname"].value;
    if (x==null || x=="")
    {
        alert("Last name must be filled out");
        return false;
    }
    var x=document.forms["registerForm"]["middleinitial"].value;
    if (x==null || x=="")
    {
        alert("Middle Initial must be filled out");
        return false;
    }
    if (x.length > 1)
    {
        alert("Middle Intial must be only one character");
        return false
    }
    var x=document.forms["registerForm"]["username"].value;
    if (x==null || x=="")
    {
        alert("Username must be filled out");
        return false;
    }
    var x=document.forms["registerForm"]["password"].value;
    if (x==null || x=="")
    {
        alert("Password must be filled out");
        return false;
    }
    if (validatePassword(x) == false)
    {
        alert("Your password must be at least 4 characters, no more than 8 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit.");
        return false;
    }
    var x=document.forms["registerForm"]["password2"].value;
    if (x!=document.forms["registerForm"]["password"].value)
    {
        alert("The password must match between the Password and Retype Password fields");
        return false;
    }
    var x=document.forms["registerForm"]["email"].value;
    if (x==null || x=="")
    {
        alert("Email must be filled out");
        return false;
    }
    if  (validateEmail(x) == false)
    {
        alert("You must enter a valid email address");
        return false;
    }
}
    </script>
</head>
<body>

    <h1>Register Here</h1>
    <form class="login" name="registerForm" id="login-register" method="post" action="termsAndConditions.php">
        <h2>New User Register Here</h2>
        <input type="text" placeholder="First Name" name="firstname" autofocus="" />
        <br />
        <input type="text" placeholder="Last Name" name="lastname" autofocus="" />
        <br />
        <input type="text" placeholder="Middle Initial" name="middleinitial" autofocus="" />
        <br />
        <input type="text" placeholder="Username" name="username" autofocus="" />
        <br />
        <input type="password" placeholder="Password" name="password" autofocus="" />
        <br />
        <input type="password" placeholder="Retype Password" name="password2" autofocus="" />
        <br />
        <input type="text" placeholder="Email Address" name="email" autofocus="" />
        <br />
        <input type="text" placeholder="Course Number" name="coursenumber" autofocus="" />
        <br />
        <button type="submit" onclick="return validateForm()">Register</button>
        <span></span>

    </form>


</body>
</html>
