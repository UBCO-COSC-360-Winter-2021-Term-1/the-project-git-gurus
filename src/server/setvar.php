<?php
if (isset($_POST['name']) ) {
    // do user authentication as per your requirements
    $name = $_POST['name'];
    if(!strcmp($name,"John")) {
        $postIDs = array(1,2,3,4,5,6);
        echo json_encode($postIDs);
    }
} else {
    $postIDs = array(16,42,1,23,1,9);
    echo json_encode($postIDs);
}
?>