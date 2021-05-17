<?php

include("connect.php");
$code = getShortLinkCode();

$sql = "SELECT FULL_LINK fROM Links WHERE SHORT_LINK="."'$code'";

if ($result = mysqli_query($con, $sql)) {
  while ($row = mysqli_fetch_row($result)) {
    $fullLink = $row[0];
    redirect($fullLink);
  }
  mysqli_free_result($result);
}

mysqli_close($con);


function redirect($url)
{
    echo $url;
   $redirectScript =  '<script type="text/javascript">
           window.location = "{URL}"
      </script>';
      echo str_replace("{URL}",$url,$redirectScript);
}
function getShortLinkCode()
{
    return $_SERVER['QUERY_STRING'];
    //return $_GET["code"];
}
?>