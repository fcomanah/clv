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
            INSERT INTO `pet` (`name`, `owner`, `species`, `sex`, `birth`, `death`) VALUES
            ('Fluffy',	'Harold',	'cat',	'f',	'1993-02-04',	NULL),
            ('Claws',	'Gwen',	'cat',	'm',	'1994-03-17',	NULL),
            ('Buffy',	'Harold',	'dog',	'f',	'1989-05-13',	NULL),
            ('Fang',	'Benny',	'dog',	'm',	'1990-08-27',	NULL),
            ('Bowser',	'Diane',	'dog',	'm',	'1979-08-31',	'1995-07-29'),
            ('Chirpy',	'Gwen',	'bird',	'f',	'1998-09-11',	NULL),
            ('Whistler',	'Gwen',	'bird',	NULL,	'1997-12-09',	NULL),
            ('Slim',	'Benny',	'snake',	'm',	'1996-04-29',	NULL);
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Data inserted in pet successfully<br/>";
        }
        else
        {
            echo "Error inserting in pet: " . mysqli_error($con)."<br/>";
        }   
        
        // Insert in pet table
        $sql="
            INSERT INTO `event` (`name`, `date`, `type`, `remark`) VALUES
            ('Fluffy',	'1995-05-15',	'litter',	'4 kittens, 3 female, 1 male'),
            ('Buffy',	'1993-06-23',	'litter',	'5 puppies, 2 female, 3 male'),
            ('Buffy',	'1994-06-19',	'litter',	'3 puppies, 3 female'),
            ('Chirpy',	'1999-03-21',	'vet',	'needed beak straightened'),
            ('Slim',	'1997-08-03',	'vet',	'broken rib'),
            ('Bowser',	'1991-10-12',	'kennel',	NULL),
            ('Fang',	'1991-10-12',	'kennel',	NULL),
            ('Fang',	'1998-08-28',	'birthday',	'Gave him a new chew toy'),
            ('Claws',	'1998-03-17',	'birthday',	'Gave him a new flea collar'),
            ('Whistler',	'1998-12-09',	'birthday',	'First birthday');
            ";
        if (mysqli_query($con,$sql))
        {
            echo "Data inserted in event successfully<br/>";
        }
        else
        {
            echo "Error inserting in event: " . mysqli_error($con)."<br/>";
        }   
	}
    mysqli_close($con);
?>


