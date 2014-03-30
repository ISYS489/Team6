<?php # create a university
//performs INSERT query to add a record to the class table

$page_title = 'CreateClass';

include ('header.php');




///display create course form form
<h1>Create a Course</h1>
<form class ="CreateCourse" id="Create-Course" method="post" action="CreateCourse.php">

<h2>Course Name</h2>
<input type="text" placeholder="Course Name" name="Coursename" autofocus />
<br></br>
<input type="text" placeholder="Course Id" name="courseID" autofocus />
<br></br>
<button type="submit">Login</button>
<br></br>

//populate university list
require ('mysqliConnect.php');
$sql = "SELECT name FROM universities";
$result = mysqli_query($dbc, $sql);

echo "<select name='University'>";
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
}
echo "</select>";
mysqli_close($dbc);

/**
* //check for form submission:
* if ($_SERVER['REQUEST_METHOD'] == 'POST') {
* 	
* 	$errors = array(); //Initialize an error array.
* 	
* 	//Check for a class name
* 	if (empty($_POST['class_name'])) {
* 		$errors[] = 'You forgot to enter a class name.';
* 	}else{
* 	 	$un = trim($_POST['class_name']);
* 	}
* 	
* 	//Check for a class start date
* 	if (empty($_POST['start_date'])) {
* 		$errors[] = 'You forgot to enter a start date.';
* 	}else{
* 	 	$sd = trim($_POST['start_date']);
* 	}
* 	
* 	//Check for a class end date
* 	if (empty($_POST['end_date'])) {
* 		$errors[] = 'You forgot to enter a start date.';
* 	}else{
* 	 	$ed = trim($_POST['end_date']);
* 	}
* 	
* 	if (empty($errors)) { //if there are no errors
* 		//connect to the DB
* 		require ('mysqliConnect.php');
* 		//make the query
* 		$q = "INSERT INTO universities (name, startdate, enddate) VALUES ('$un','$sd','$ed')";
* 		$r = @mysqli_query ($dbc, $q); //run query
* 		if ($r) {//if it ran ok
* 		
* 			//print message:
* 			echo '<h1>Thank You!</h1>
* 			<p>You have created a class.</p>';
* 			
* 		}else{ //if not ok
* 			
* 			echo '<h1>Error</h1>
* 			<p>System error preventing class creation, class may already exist.</p>';
* 		}
* 		
* 		mysqli_close($dbc);
* 		
* 	} else {
* 		
* 		echo '<h1>Error!</h1>
* 		<p>The following error(s) occurred:<br />';
* 		foreach ($errors as $msg) { //print each
* 			echo " - $msg<br />\n";
* 		}
* 		echo '</p><p>Please try again.</p><p><br /></p>';
* 		
* 	}
* }
* ?>
* <h1>Create class</h1>
* <form action="createclass.php" method="post">

* 	<p>class Name: <input type="text" name="class_name" value="<?php if(isset($_POST['class_name'])) echo $_POST['class_name']; ?>" /></p>
* 	
* 	<p>Start Date: <input type="text" name="start_date" placeholder="YYYYMMDD" value="<?php if(isset($_POST['start_date'])) echo $_POST['start_date']; ?>" /></p>
* 	
* 	<p>End Date: <input type="text" name="end_date"  placeholder="YYYYMMDD" value="<?php if(isset($_POST['end_date'])) echo $_POST['end_date']; ?>" /></p>
* 	
*     <input type="submit" name="submit" value="Create class"/>
* 	<br></br>
* </form>
*/
