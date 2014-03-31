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

    <?php require 'header.php'; ?>

    <h1>Terms and Conditions</h1>

    <!-- <script type="text/javascript">
    function checkIfDisagree()
    {
    if(document.getElementsByName('disagree')[0].checked)
    {
    window.location.replace('index.php');
    return false;
    }
    }
    </script> -->
</head>

<body>
    <h2>Please read the terms and conditions before submitting your registration </h2>
    <p>
        These are the terms and conditions....
    </p>

    <form class="terms">

        <input type="checkbox" name="agree" value="agree" />
        I agree
        <br />
        <input type="checkbox" name="disagree" value="disagree" />
        I do not agree

        <input type="hidden" placeholder="First Name" name="firstname" value="<?php echo $_POST['firstname']?>" autofocus="" />

        <input type="hidden" placeholder="Last Name" name="lastname" value="<?php echo $_POST['lastname']?>" autofocus="" />

        <input type="hidden" placeholder="Middle Initial" name="middleinitial" value="<?php echo $_POST['middleinitial']?>" autofocus="" />

        <input type="hidden" placeholder="Username" name="username" value="<?php echo $_POST['username']?>" autofocus="" />

        <input type="hidden" placeholder="Password" name="password" value="<?php echo $_POST['password']?>" autofocus="" />

        <input type="hidden" placeholder="Retype Password" name="password2" value="<?php echo $_POST['password2']?>" autofocus="" />

        <input type="hidden" placeholder="Email Address" name="email" value="<?php echo $_POST['email']?>" autofocus="" />

        <input type="hidden" placeholder="Course Number" name="coursenumber" value="<?php echo $_POST['firstname']?>" autofocus="" />

    </form>


    <form class="termsandconditions" id="termsandconditions" method="post" action="registrationSubmitted.php">
        <button type="submit">Submit</button>
    </form>

</body>
</html>
