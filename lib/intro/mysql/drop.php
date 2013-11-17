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
        // DROP pet and event tables
        $sql="
            DROP TABLE event, pet
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Tables dropped successfully<br/>";
        }
        else
        {
            echo "Error dropping tables: " . mysqli_error($con)."<br/>";
        }   
        
        // DROP menagerie database
        $sql="
            DROP DATABASE menagerie
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Database dropped successfully<br/>";
        }
        else
        {
            echo "Error dropping database: " . mysqli_error($con)."<br/>";
        }   
	}
    mysqli_close($con);
?>


