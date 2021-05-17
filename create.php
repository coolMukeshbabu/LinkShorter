
<!DOCTYPE html>
<html>
<body>

<center>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <label>Enter link to shorten</label><br>
        <input name="long_link">
        <input type="submit" value="SUBMIT"/>
    </form>
    
    <!-- The text field -->
    <br><br>
<input type="text" value="Hello World" id="myInput">

<!-- The button used to copy the text -->
<button onclick="myFunction()">Copy text</button>
</center>

</body>

<script>
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
</html>

<?php
include("connect.php");
include("config.php");

/*


*/
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $shortLink = getRandomString($urlParameterLength);
    $full_link = $_POST["long_link"];
   $sql = "INSERT INTO Links (SHORT_LINK, FULL_LINK)
VALUES ('$shortLink', '$full_link')";

if (mysqli_query($con, $sql)) {
  echo "Created successfully";
  echo "\n";
  echo $baseURL."?".$shortLink;
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
}


function getRandomString($length)
{
     return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
   
}
?>