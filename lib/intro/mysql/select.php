<?php
    //parametros: 'host', 'username', 'password', 'dbname', 'port', 'socket'
    $con=mysqli_connect("localhost","root","","menagerie");
    // Check connection
    if (mysqli_connect_errno($con))
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
        // Perform a query, check for error
        $result = mysqli_query($con,"SELECT * FROM pet");
        /*
        echo'<pre>';
        print_r($result);
        echo'</pre>';
        */
        if (!$result)
        {
            echo("Error description: " . mysqli_error($con));
        }
        else
        {
			echo '<h1 style="text-align: center;">Pets</h1><hr/>';
			$ab='<div style="font-size:200%; font-style:oblique; font-weight:bold; float:left; width:16.6%">';
			$f='</div>';
			echo $ab.'name'.$f.$ab.'owner'.$f.$ab.'species'.$f.$ab.'sex'.$f.$ab.'birth'.$f.$ab.'death'.$f.'<br/>';
			
			$a='<div style="float:left; width:16.6%">';
			$f='</div>';
            while($row = mysqli_fetch_array($result))
            {
                //echo $a.$row['0'].$f.$a.$row['1'].$f.$a.$row['2'].$f.$a.$row['3'].$f.$a.$row['4'].$f.$a.$row['5'].$f.'<br/>';
                for($i=0;$i<6;$i++){
					if (!empty($row[$i])) echo $a.$row[$i].$f;
					else echo $a.'-'.$f;
				}				
            }
        }
        
        // Perform a query, check for error
        $result = mysqli_query($con,"SELECT * FROM event");
        /*
        echo'<pre>';
        print_r($result);
        echo'</pre>';
        */
        if (!$result)
        {
            echo("Error description: " . mysqli_error($con));
        }
        else
        {
			echo '<h1 style="text-align: center;">Events</h1><hr/>';
			$ab='<div style="font-size:200%; font-style:oblique; font-weight:bold; float:left; width:25%">';
			$f='</div>';
			echo $ab.'name'.$f.$ab.'date'.$f.$ab.'type'.$f.$ab.'remark'.$f.'<br/>';
			
			$a='<div style="float:left; width:25%">';
			$f='</div>';
            while($row = mysqli_fetch_array($result))
            {
                //echo $a.$row['0'].$f.$a.$row['1'].$f.$a.$row['2'].$f.$a.$row['3'].$f.'<br/>';
                for($i=0;$i<4;$i++){
					if (!empty($row[$i])) echo $a.$row[$i].$f;
					else echo $a.'-'.$f;
				}				
            }
        }
        mysqli_close($con);
    }
?>
