<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head></head>
<body>

<?php
    // attempt a connection
    $dbh = pg_connect("host=dbproj.sfsu.edu dbname=dbold user=dbold password=860812");
    if (!$dbh)
    {
        die("Error in connection: " . pg_last_error());
    }
    
    // execute query
    $sql = "SELECT * FROM driver";
    $result = pg_query($dbh, $sql);
    if (!$result)
    {
        die("Error in SQL query: " . pg_last_error());
    }
    
    // iterate over result set
    // print each row
    while ($row = pg_fetch_array($result)) {
        echo "Driver ID: " . $row[0] . "<br />";
        echo "Driver Name: " . $row[1] . "<p />";
    }
    
    // free memory
    pg_free_result($result);
    
    // close connection
    pg_close($dbh);
?>       

</body>
</html>