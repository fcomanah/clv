<?php
    //parametros: 'host', 'username', 'password', 'dbname', 'port', 'socket'
    $dbname = 'menagerie';
	
    $con=mysqli_connect("localhost","root","arjl39");
    // Check connection
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
		// Create database
        $sql="CREATE DATABASE $dbname";
        if (mysqli_query($con,$sql))
        {
            echo "Database $dbname created successfully<br/>";
        }
        else
        {
            echo "Error creating database: " . mysqli_error($con)."<br/>";
        }
        
	}
	mysqli_close($con);
	
    $con=mysqli_connect("localhost","root","arjl39",$dbname);
    // Check connection
    if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        // Create table pet
        $sql="
            CREATE TABLE pet
            (
              name    VARCHAR(20),
              owner   VARCHAR(20),
              species VARCHAR(20),
              sex     CHAR(1),
              birth   DATE,
              death   DATE
            );
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Table pet created successfully<br/>";
        }
        else
        {
            echo "Error creating table: " . mysqli_error($con)."<br/>";
        }   


        // Create table event
        $sql="
            CREATE TABLE event
            (
              name   VARCHAR(20),
              date   DATE,
              type   VARCHAR(15),
              remark VARCHAR(255)
            );
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Table event created successfully<br/>";
        }
        else
        {
            echo "Error creating table event: " . mysqli_error($con)."<br/>";
        }   

	}
    mysqli_close($con);
?>
