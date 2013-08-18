<?php
    //parametros: 'host', 'username', 'password', 'dbname', 'port', 'socket'
    $con = mysqli_connect("localhost","clv","clv","clv");
    // Check connection
    if (mysqli_connect_errno($con))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        // Perform a query, check for error
        $result = mysqli_query($con,"SELECT * FROM ctg");
        if (!$result)
        {
            echo("Error description: " . mysqli_error($con));
        }
        else
        {
            while($row = mysqli_fetch_array($result))
            {
                echo $row['id_'] . " " . $row['nme'];
                echo "<br>";
            }
        }
        mysqli_close($con);
    }
?>
