<?php # create a university
//performs INSERT query to add a record to the university table

function isValidDateTimeString($str_dt) {//This will tell you whether or not a valid date has been passed.
    $str_dateformat = 'Y/m/d';
    $date = DateTime::createFromFormat($str_dateformat, $str_dt);
    return ($date === false ? false : true);
}

$page_title = 'CreateUniversity';

include ('header.php');

//check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array(); //Initialize an error array.

	//Check for a university name
	if (empty($_POST['university_name']))
    {
		$errors[] = 'You forgot to enter a university name.';
	}
    else
    {
        $un = trim($_POST['university_name']);
    }


	//Check for a university start date
	if (empty($_POST['start_date']))
    {
		$errors[] = 'You forgot to enter a start date.';
    }
	else if (isValidDateTimeString($_POST['start_date']))
    {
        $sd = trim($_POST['start_date']);
	}
    else
    {
    	$errors[] = 'Please enter a valid Start Date';
    }

	//Check for a university end date
	if (empty($_POST['end_date']))
    {
		$errors[] = 'You forgot to enter a end date.';
    }
    else if (isValidDateTimeString($_POST['end_date']) && strtotime($_POST['start_date']) < strtotime($_POST['end_date']))
    {
        $ed = trim($_POST['end_date']);
	}
    else
    {
    	$errors[] = 'Please enter a valid End Date';
    }
    

	if (empty($errors)) { //if there are no errors
		//connect to the DB
		require ('mysqli_connect.php');
		//make the query
		$q = "INSERT INTO universities (name, startdate, enddate, IsActive) VALUES ('$un','$sd','$ed', true)";
		$r = @mysqli_query ($dbc, $q); //run query
		if ($r) {//if it ran ok

			//print message:
			echo '<h1>Thank You!</h1>
			<p>You have created a University.</p>';

		}else{ //if not ok

			echo '<h1>Error</h1>
			<p>System error preventing University creation, university may already exist.</p>';
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
<h1>Create University</h1>
<form action="createUniversity.php" method="post">

    <p>
        University Name:
        <input type="text" name="university_name" value="<?php if(isset($_POST['university_name'])) echo $_POST['university_name']; ?>" />
        <br />
        Start Date:
        <input type="text" name="start_date" placeholder="YYYY/MM/DD" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>" />
        <br />
        End Date:
        <input type="text" name="end_date" placeholder="YYYY/MM/DD" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>" />
    </p>

    <input type="submit" name="submit" value="Create University" />
    <br />
</form>
