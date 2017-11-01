<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>LOG OUT</title>
  <?//php include 'css/css.html'; ?>
</head>
<style type="text/css">
		body
		{
			background-color: lightblue;
			text-align: center;
		}

</style>
		
<body>
    <div class="form">
          <h1>Thanks for stopping by</h1>
              
          <p><?= 'You have been logged out!'; ?></p>
          
          <a href="index.php">Home</button></a>

    </div>
</body>
</html>