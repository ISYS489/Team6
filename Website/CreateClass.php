<?php # create a class
//performs INSERT query to add a record to the class table

$page_title = 'CreateClass';

include ('header.php');

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array(); //Initialize an error array.

    //Check for a class name
    if (empty($_POST['class_name'])) {
        $errors[] = 'You forgot to enter a class name.';
    }else{
        $un = trim($_POST['class_name']);
    }

    //Check for a class start date
    if (empty($_POST['start_date'])) {
        $errors[] = 'You forgot to enter a start date.';
    }else{
        $sd = trim($_POST['start_date']);
    }

    //Check for a class end date
    if (empty($_POST['end_date'])) {
        $errors[] = 'You forgot to enter a start date.';
    }else{
        $ed = trim($_POST['end_date']);
    }

    if (empty($errors)) { //if there are no errors
        //connect to the DB
        require ('mysqli_connect.php');
        //make the query
        $q = "INSERT INTO class (name, startdate, enddate) VALUES ('$un','$sd','$ed')";
        $r = @mysqli_query ($dbc, $q); //run query
        if ($r) {//if it ran ok

            //print message:
            echo '<h1>Thank You!</h1>
<p>You have created a class.</p>';

        }else{ //if not ok

            echo '<h1>Error</h1>
<p>System error prclassing Class creation, Class may already exist.</p>';
        }

        mysqli_close($dbc);

    } else {

        echo '<h1>Error!</h1>
<p>The following error(s) occurred:<br />';
        foreach ($errors as $msg) { //print each
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p><p><br /></p>';

    }
}
?>
<h1>Create Class</h1>
<form action="CreateClass.php" method="post">

    <p>
        Class Name:
        <input type="text" name="class_name" value="<?php if(isset($_POST['class_name'])) echo $_POST['class_name']; ?>" /><br/>
        Start Date:
        <input type="text" name="start_date" placeholder="YYYYMMDD" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>" /><br/>
        End Date:
        <input type="text" name="end_date" placeholder="YYYYMMDD" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>" /><br/><br/>
        <input type="submit" name="submit" value="Create Class" />
        <br />
    </p>
</form>
