<?php
//File Name: createClass.php
//Purpose: Create a new class
//Class: ISYS489
//Instructor: Amy Buse
//Author: Kyle Gottfried
//Last Date Modified: 4/30/2014

session_start();
?>

<?php # create a class
//performs INSERT query to add a record to the class table

$page_title = 'CreateClass';

include 'header.php';
require '../mysqli_connect.php';

//Check that the end user has permissions necessary to access this page
if ($_SESSION['userid'])
{
    $userId = $_SESSION['userid'];
    $userRoles = array();
    $result = mysqli_query($dbc, "SELECT RoleId FROM `users-roles` WHERE UserId = $userId");
    while ($row = mysqli_fetch_array($result))
    {
        $userRoles[] = $row[0];
    }
    if (!(in_array(1, $userRoles) or in_array(2, $userRoles) or in_array(3, $userRoles)))
        header("location: index.php");
}
else
{
    header("location: index.php");
}

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $errors = array(); //Initialize an error array.
    
    //Check for university id
    if (empty($_POST['university'])) {
        $errors[] = 'You forgot to enter a university.';
    }else
    {
    	$u = trim($_POST['university']);
    }
    

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
        //require ('../mysqli_connect.php');
        //make the query
        $q = "INSERT INTO classes (universityId, classname, startdate, enddate) VALUES ($u,'$un','$sd','$ed')";
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
<!---The Create Class form, some fields are filled programically by PHP-->
<form action="createClass.php" method="post">
<div class="stretchLeft">
    <p>
        University:
        <select name="university">
        <?php
        if (in_array(1, $userRoles))
        {
            //Allow user to select from a selection of universities. (Site admin)
            $result = mysqli_query($dbc,'SELECT UniversityId, Name FROM universities WHERE isActive = true');

            while ($row=mysqli_fetch_array($result))
            {
                echo '<option value=' . htmlspecialchars($row['UniversityId']) . '>'
                . htmlspecialchars($row['Name'])
                . '</option>';
            }
        }
        else
        {
            //Only provide a single university to select from that the user belongs to.
            $result = mysqli_query($dbc, 'SELECT universities.UniversityId, Name FROM universities LEFT JOIN users ON universities.universityId = users.UniversityId WHERE users.$userId = 1');
        	while ($row = mysqli_fetch_row($result)) {
                echo '<option value=' . htmlspecialchars($row['UniversityId']) . '>'
                . htmlspecialchars($row['Name'])
                . '</option>';
            }
        }
        
        ?>
        </select><br/>
        Class Name:
        <input type="text" name="class_name" value="<?php if(isset($_POST['class_name'])) echo $_POST['class_name']; ?>" /><br/>
        Start Date:
        <input type="text" name="start_date" placeholder="YYYY/MM/DD" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>" /><br/>
        End Date:
        <input type="text" name="end_date" placeholder="YYYY/MM/DD" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>" /><br/><br/>
        <input type="submit" name="submit" value="Create Class" />
        <br />
    </p>
	</div>
</form>
