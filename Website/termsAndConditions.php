<!--
File Name: createUniversity.php
Purpose: Presents end user with terms and conditions that the user must agree to in order to register. Passes code from register to registrationSubmitted.
Class: ISYS489
Instructor: Amy Buse
Author: Kyle Gottfried
Last Date Modified: 3/28/2014
-->
<?php
session_start();
//start the session
?>
<html>


<head>
    <!--header-->
    <h1>Terms and Conditions</h1>

    <!-- <script type="text/javascript">
    function checkIfDisagree()
    {
    if(document.getElementsByName(\'disagree\')[0].checked)
    {
    window.location.replace(\'index.php\');
    return false;
    }
    }
    </script> -->
</head>

<body>

    <?php
    require 'header.php';
    require 'mysqliConnect.php';
    
    //Check if username is Unique
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    
    $result = mysqli_query($dbc, "SELECT Username FROM `users` WHERE Username = '$username'");
    $usernameCount = mysqli_num_rows($result);
    
    
    if ($usernameCount != 0)
    {
        echo "The username you entered is not unique, plese click the back button and enter a unique username";
    }
    else 
    {
    echo '
    <h2>Please read the terms and conditions before submitting your registration </h2>
    <p>
        These are the terms and conditions....
    </p>

    <form class="termsandconditions" id="termsandconditions" method="post" action="registrationSubmitted.php">

        <input type="checkbox" name="agree" value="agree" />
        I agree
        <br />
        <input type="checkbox" name="disagree" value="disagree" />
        I do not agree

        <input type="hidden" placeholder="First Name" name="firstname" value="'; echo $_POST['firstname']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Last Name" name="lastname" value="';  echo $_POST['lastname']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Middle Initial" name="middleinitial" value="'; echo $_POST['middleinitial']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Username" name="username" value="'; echo $_POST['username']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Password" name="password" value="'; echo $_POST['password']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Retype Password" name="password2" value="'; echo $_POST['password2']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Email Address" name="email" value="'; echo $_POST['email']; echo '" autofocus="" />';

        echo '<input type="hidden" placeholder="Course Number" name="coursenumber" value="'; echo $_POST['coursenumber']; echo '" autofocus="" />';

    echo '    
        <button type="submit">Submit</button>
    </form>;';
    }
    }
    ?>
    
</html>