
<?php 
    // include the config file that we created last week
    require "../config.php";
    require "common.php";
    // run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            //grab elements from form and set as varaible
            $work =[
              "id"         => $_POST['id'],
              "chickname" => $_POST['chickname'],
              "chickbreed"  => $_POST['chickbreed'],
              "chicksex"   => $_POST['chicksex'],
              "chickhatch"   => $_POST['chickhatch'],
              "date"   => $_POST['date'],
            ];
            
    
            
            // create SQL statement
            $sql = "UPDATE `unique_data` 
                    SET id = :id, 
                        chickname = :chickname, 
                        chickbreed = :chickbreed, 
                        chicksex = :chicksex, 
                        chickhatch = :chickhatch, 
                        date = :date 
                    WHERE id = :id";
            //prepare sql statement
            $statement = $connection->prepare($sql);
            
            //execute sql statement
            $statement->execute($work);
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    // GET data from DB
    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        
        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM unique_data WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    };
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Chicken successfully updated.</p>
<?php endif; ?>

<h2>Edit a work</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    
    <label for="chickname">Name</label>
    <input type="text" name="chickname" id="chickname" value="<?php echo escape($work['chickname']); ?>">

    <label for="chickbreed">Breed</label>
    <input type="text" name="chickbreed" id="chickbreed" value="<?php echo escape($work['chickbreed']); ?>">

    <label for="chicksex">Sex</label>
    <input type="text" name="chicksex" id="chicksex" value="<?php echo escape($work['chicksex']); ?>">

    <label for="chickhatch">Date of Hatch</label>
    <input type="text" name="chickhatch" id="chickhatch" value="<?php echo escape($work['chickhatch']); ?>">
    
    <label for="date">Work Date</label>
    <input type="text" name="date" id="date" value="<?php echo escape($work['date']); ?>">

    <input type="submit" name="submit" value="Save">

</form>




<?php include "templates/footer.php"; ?>