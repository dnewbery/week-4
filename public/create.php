<?php 

// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Get the contents of the form and store it in an array
        $new_unique_data = array( 
            
            "chickname" => $_POST['chickname'], 
            "chickbreed" => $_POST['chickbreed'],
            "chicksex" => $_POST['chicksex'],
            "chickhatch" => $_POST['chickhatch'], 
        );
        
        // THIRD: Turn the array into a SQL statement
        $sql = "INSERT INTO unique_data (chickname, chickbreed, chicksex, chickhatch) VALUES (:chickname, :chickbreed, :chicksex, :chickhatch)";        
        
        // FOURTH: Now write the SQL to the database
        $statement = $connection->prepare($sql);
        $statement->execute($new_unique_data);

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>


<h2>Add a Chook</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p><br>Work successfully added.</p>
<?php } ?>

<!--form to collect data for each artwork-->

<form method="post">
    <label for="chickname">Name</label>
    <input type="text" name="chickname" id="chickname">

    <label for="chickbreed">Breed</label>
    <input type="text" name="chickbreed" id="chickbreed">

    <label for="chicksex">Sex</label>
    <input type="text" name="chicksex" id="chicksex">

    <label for="chickhatch">Date of Hatch</label>
    <input type="text" name="chickhatch" id="chickhatch">

    <input type="submit" name="submit" value="Submit">

</form>

<img src="assets/img/chicken-on-white-background.png" width="100%"  title="Double chicken" alt="Two untrustworthy chickens" class="center">

<?php include "templates/footer.php"; ?>