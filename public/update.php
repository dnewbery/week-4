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




<body>
<h2>Results</h2>

<!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>

<p>
     ID:
    <?php echo $row['id']; ?><br> Name:
    <?php echo $row['chickname']; ?><br>Breed: 
    <?php echo $row['chickbreed']; ?><br>Sex: 
    <?php echo $row['chicksex']; ?><br>Age: 
    <?php echo $row['chickhatch']; ?><br>Date/Time:
    <?php echo $row['date']; ?><br>
    
</p>
    <a href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>

 <br>  <a href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>

</body>
<hr>
<?php }; //close the foreach
?>