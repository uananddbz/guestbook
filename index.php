<!DOCTYPE html> 
<html>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="jquery.mobile-1.3.0.min.css" />
	<link rel="stylesheet" href="animate.min.css" />
	<script src="jquery.js"></script>
	<script src="jquery.mobile-1.3.0.min.js"></script>
	<script type="text/javascript">
$(document).ready(function(){
$(".c").slideUp()
  $(".to").click(function(){
    $(".c").slideToggle("slow");
  });
});
</script>
<script type="text/javascript">
function displaymessage()
{
$('#not').fadeOut(500);
}
</script>

<script type="text/javascript">
function displayhmessage()
{
    $(".h").toggle("slow");
}
</script>

<style>
#not {
	-webkit-animation-duration: 1s;
	-webkit-animation-delay: .2s;
}

</style>

<style>
.ui-dialog .ui-dialog-contain { margin-top: 0px; }
</style>
</head>

<body>

<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("guestbook", $con);


if (isset($_GET['d'])) 
{ 

$d=$_GET["d"];
mysql_query("DELETE FROM guestbook WHERE id='$d'");
}

?>

<div data-role="page">


	<div data-theme="b" data-position="fixed" data-role="header"><h1>Guestbook</h1>

<a data-inline="true" data-theme="a" data-transition="pop" data-role="button" href="#popupDialog" data-iconpos="notext" data-position-to="window" data-rel="popup" data-icon="plus"  data-inline="true" class="tog">Write</a>
<a class="s" data-theme="d" data-iconpos="notext" data-role="button" onclick='displayhmessage()'  href="#" data-icon="minus"  data-inline="true">edit</a>

	</div>
	<div data-role="content">

<?php

if (isset($_GET['e'])) 
{ 
echo "hello";
}
?>
<?php

if (isset($_POST['name'])) 
{ 
$name=$_POST["name"];
$email=$_POST["email"];
$gender=$_POST["gender"];
$comment=$_POST["comment"];
$datetime=date("y-m-d h:i:s"); //date time

$sql="INSERT INTO guestbook(name, email, gender, comment, datetime)VALUES('$name', '$email', '$gender', '$comment', '$datetime')";
$result=mysql_query($sql);
echo "<div id='not' class='ui-bar ui-bar-e animated bounce'>

						<h3 style='display:inline-block; width:92%; margin-top:5px;'>" .$name."</h3><div style='display:inline-block; width:8%; margin-top:0px; text-align:right;'><a href='#' data-role='button' data-icon='delete' data-inline='true' data-iconpos='notext' data-corners='true' data-shadow='true' data-iconshadow='true' data-wrapperels='span' data-theme='e' title='Dismiss' class='ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-icon-notext ui-btn-up-e' onclick='displaymessage()'><span class='ui-btn-inner'><span class='ui-btn-text'>Dismiss</span><span class='ui-icon ui-icon-delete ui-icon-shadow'>&nbsp;</span></span></a></div><p style='font-size:85%; margin:-.3em 0 1em;'> your Msg succesfully added .</p>
					</div>";

}

?>


<div data-role="popup" id="popupDialog" data-overlay-theme="a" data-theme="c">


  	<div data-theme="e" data-role="header"><h1>Write here</h1>  </div>


 <form method="post" action="#">
            <div style="padding:10px 20px;">
              <label for="nm" class="ui-hidden-accessible">NAME:</label>
              <input id="nm" type="text" name="name"  value="" placeholder="NAME" />
              <label for="em" class="ui-hidden-accessible">EMAIL:</label>
              <input name="email" type="text" id="em" placeholder="EMAIL" />
			   <label for="cm" class="ui-hidden-accessible">COMMENT:</label>
			  <textarea  cols="40" name="comment" rows="3" id="cm" placeholder="COMMENT ....."></textarea>
			  <label for="gender" class="ui-hidden-accessible">Gender:</label>
<select name="gender" id="gender" data-role="slider" data-mini="true" >
    <option value="male">male</option>
    <option value="female">female</option>
</select>
<input type="submit" data-theme="b" name="Submit" value="Submit" />
			  
            </div>
        </form>
</div>




<ul data-inset="true" data-theme="d" data-role="listview">
<?php
$result = mysql_query("SELECT * FROM guestbook");

while($row = mysql_fetch_array($result))
  {
 echo "<li><h2>". $row['name']."</h2> <p><strong>". $row['comment']."</strong><a class='h' data-role='button' data-icon='delete' data-iconpos='notext' data-theme='c' data-inline='true' style='display:none;' href='index.php?d=".$row['id'] ."'>del</a>";
  echo "</p><p class='ui-li-aside'><strong>".$row['datetime']."</strong><br/>".$row['gender']."<br/>".$row['email']."</p></li>";
  }
?>

</ul>
</div>
</body>
</html>
