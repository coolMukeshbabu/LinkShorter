
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
    <div id="divResult">
<textarea value="" id="shortLink"></textarea>

<!-- The button used to copy the text -->
<button onclick="copyToClip()">Copy</button>
</div>

</center>

</body>

<script>

document.getElementById("divResult").style.display="none";

    function copyToClip() {
  /* Get the text field */
  var copyText = document.getElementById("shortLink");

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

$isExists = isTableExists();
if(!$isExists)
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
 // echo "Created successfully";
  echo "\n";
  $shortedURL = $baseURL."?".$shortLink;
  //echo $shortedURL;
  updateUI($shortedURL);
  
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
}


function updateUI($shortedURL)
{
    $UIScript =  '<script type="text/javascript">
     document.getElementById("divResult").style.display="block";
           document.getElementById("shortLink").value = "{URL}";
      </script>';
      echo str_replace("{URL}",$shortedURL,$UIScript);
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
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
}

?>