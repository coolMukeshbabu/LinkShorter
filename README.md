# LinkShorter

How to use

STEP 1 : Run this query in your sql/db

CREATE TABLE `Links` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `FULL_LINK` varchar(1000) NOT NULL,
 `SHORT_LINK` varchar(500) NOT NULL,
 PRIMARY KEY (`ID`)
 ) 
__________________________________________________________________________________
STEP:2
Open "config.php" and fill the database configrations
/* Database Configration */
$servername = "localhost";
$username = " ";
$password = " ";
$database = " ";
__________________________________________________________________________________
STEP:3
Open "config.php" and fill the baseURL
$baseURL = ""; /* https://www.example.com/ */
__________________________________________________________________________________
Aditionally you can config some more setting which are optional
$urlParameterLength = 15; /* Length of unique code https://bit.ly/3tVXX1Q, 
here 3tVXX1Q is unique code .
Here you can define the length of it */
__________________________________________________________________________________

This is just first version, I will be adding more features into it and optimise it.
I created this in 30 mins
__________________________________________________________________________________






