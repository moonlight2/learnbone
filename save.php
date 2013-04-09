<?php

$postdata = json_decode(file_get_contents("php://input"), true);




$success = ($postdata['done'] == 0) ? 0 : 1;

$responce = array('success'=>$success);
echo json_encode($responce);


?>
