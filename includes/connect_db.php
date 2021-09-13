<?php

/* Connect  on 'localhost' for database 'site_db'
 1. start by creating a variable $link
 2.  The mysqli_connect() function in PHP is used to connect you to the database.
 3. localhost is a hostname that refers to the current computer used to access it.
 4. root is the server username, usbw is the password and site_db is the database name.
*/

$link = mysqli_connect('localhost','mike','ssaTtu91!','carbooking');
# 5. If  username,password and database are correct 'connecton ok' will be dispalyed on screen.
if (!$link) {
# 6. Otherwise fail gracefully and explain the error.
	die('Could not connect to MySQL: ' . mysqli_error("Its dead Jim"));
}
?> 
