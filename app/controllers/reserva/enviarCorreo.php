<?php
include dirname(dirname(__FILE__)) . "../../Helpers/Helpers.php";
$datos = array(
  'email' => $_POST["email"],
  'asunto' => $_POST["asunto"],
  'id' => $_POST['id'],
  'emailCopia' => 'javierlobitort@gmail.com'
);
echo json_encode(sendEmail($datos, $_POST["name"]));
