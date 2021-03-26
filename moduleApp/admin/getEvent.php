<?php 
include'../config/db.php';
        $result = $dbcon->query("SELECT * FROM announcements") or die(mysqli_error());
        $events = array();
        while ($row = $result->fetch_array()) {
            $e = array();
            $e['id'] = "";
            $e['title'] = "".$row['a_title']."";
            $e['start'] = $row['a_date'];
            $e['end'] = "";
            $e['color'] = "#069";
            $e['url'] = '';
            //$e['allDay'] = false;

        // Merge the event array into the return array
        array_push($events, $e);
        }
    echo json_encode($events);

?>