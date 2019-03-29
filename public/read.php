
<?php 

	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM unique_data";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

?>

<?php include "templates/header.php"; ?>
<div></div>
<h2>Results</h2>

<!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>

<p>
    ID:
    <?php echo $row['chickname']; ?><br>Name:
    <?php echo $row['chickbreed']; ?><br>Breed:
    <?php echo $row['chicksex']; ?><br> Sex:
    <?php echo $row['chickhatch']; ?><br>Date of Hatch:
    <?php echo $row['workdate']; ?><br>
</p>
<?php 
            // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row); 
        ?>

<hr>
<?php }; //close the foreach

?>




<?php include "templates/footer.php"; ?>