<?php
    //parametros: 'host', 'username', 'password', 'dbname', 'port', 'socket'
    $con = mysqli_connect("localhost","clvu","clvp","clv");
    // Check connection
    if (mysqli_connect_errno($con))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        // Perform a query, check for error
        $result = mysqli_query($con,"SELECT * FROM produto");
        if (!$result)
        {
            echo("Error description: " . mysqli_error($con));
        }
        else
        {
            while($row = mysqli_fetch_array($result))
            {
                echo $row['sku'] . " " . $row['nome'];
                echo "<br>";
            }
        }
        mysqli_close($con);
    }
?>
