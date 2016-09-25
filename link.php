<?php
if(empty($_GET["url"])) {
  header("location:/");
} else {
  $url = $_GET["url"];
  header("location:$url");
}
?>
