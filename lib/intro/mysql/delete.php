<?php
    //parametros: 'host', 'username', 'password', 'dbname', 'port', 'socket'
    $con=mysqli_connect("localhost","root","","menagerie");
    // Check connection
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        // Insert in pet table
        $sql="
            DELETE FROM `pet`
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Data deleted from pet successfully<br/>";
        }
        else
        {
            echo "Error deleting from pet: " . mysqli_error($con)."<br/>";
        }   
        
        // Insert in pet table
        $sql="
            DELETE FROM `event` 
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Data deleted from event successfully<br/>";
        }
        else
        {
            echo "Error deleting from event: " . mysqli_error($con)."<br/>";
        }   
	}
    mysqli_close($con);
?>


