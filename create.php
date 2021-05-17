
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
include("config.php");
include("connect.php");

/*



*/

$is = isTableExists();
if(!$is)
{
 createTable();   
}

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

function isTableExists()
{
    include("config.php");
    include("connect.php");
    $table = "Links";
  if ($result = mysqli_query($con,"SHOW TABLES LIKE '".$table."'")) {
    if($result->num_rows == 1) {
        return true;
    }
}
else {
     return false;
}  
}

function createTable()
{
    include("config.php");
    include("connect.php");
    $sqlQuery = "CREATE TABLE Links ( ID int(11) NOT NULL AUTO_INCREMENT, FULL_LINK varchar(1000) NOT NULL, SHORT_LINK varchar(500) NOT NULL, PRIMARY KEY (ID) )";
    if (mysqli_query($con, $sqlQuery)) {
 // echo "Created successfully";

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
}

?>