<!DOCTYPE html> 
<html>
<head>
  <title>Guestbook</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="jquery.mobile-1.3.0.min.css" />
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
</head>

<body>

<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("guestbook", $con);
?>
<div data-close-btn="none" data-role="page">

<div data-role="panel" data-display="overlay" id="mypanel">

<ul data-role="listview" data-inset="true" data-filter="true">
<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("guestbook", $con);

$result = mysql_query("SELECT * FROM guestbook");

while($row = mysql_fetch_array($result))
  {
  echo "<li><a href='?d=".$row['id'] ."'><h2>". $row['name']."</h2> <p><strong>". $row['comment']."</strong>";
  echo "</p><p class='ui-li-aside'><strong>".$row['datetime']."</strong><br/>".$row['email']."</p></a></li>";
  }

if (isset($_GET['d'])) 
{ 
$d=$_GET["d"];
mysql_query("DELETE FROM guestbook WHERE id='$d'");
echo "deleted";
echo "<script type='text/javascript'>
$(document).ready(function(){
 $.mobile.changePage(
    window.location.href,
    {
      allowSamePageTransition : true,
      transition              : 'none',
      showLoadMsg             : false,
      reloadPage              : true
    }
  );
});
</script>";
}

?>



</ul>

</div><!-- /panel -->

	<div  data-role="header"><h1>Guestbook</h1>
<a data-theme="a" data-role="button" href="#popupDialog" data-iconpos="notext" data-position-to="window" data-rel="popup" data-icon="plus"  data-inline="true" class="tog">Write</a>
<a data-rel="dialog" data-theme="a" data-iconpos="notext" data-role="button"  href="#mypanel" data-icon="minus"  data-inline="true">edit</a>

	</div>
	<div data-role="content">


<?php

if (isset($_POST['name'])) 
{ 
$name=$_POST["name"];
$email=$_POST["email"];
$comment=$_POST["comment"];
$datetime=date("y-m-d h:i:s"); //date time

$sql="INSERT INTO guestbook(name, email, comment, datetime)VALUES('$name', '$email', '$comment', '$datetime')";
$result=mysql_query($sql);
echo "<div class='ui-bar ui-bar-e'><p><strong>" .$name."</strong> your Msg succesfully added</div>";

}

?>



<div data-role="popup" id="popupDialog" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
 <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h1>Write here</h1>
    </div>
    <div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">

 <form method="post" action="#">
            <div style="padding:10px 20px;">
              <label for="nm" class="ui-hidden-accessible">NAME:</label>
              <input id="nm" type="text" name="name"  value="" placeholder="NAME" />
              <label for="em" class="ui-hidden-accessible">EMAIL:</label>
              <input name="email" type="text" id="em" placeholder="EMAIL" />
			   <label for="cm" class="ui-hidden-accessible">COMMENT:</label>
			  <textarea  cols="40" name="comment" rows="3" id="cm" placeholder="COMMENT ....."></textarea>
<input type="submit" data-theme="b" name="Submit" value="Submit" />
</fieldset>
			  
            </div>
        </form>
    </div>
</div>




<ul data-inset="true" data-role="listview">
<?php
$result = mysql_query("SELECT * FROM guestbook");

while($row = mysql_fetch_array($result))
  {
echo "<li><h2>". $row['name']."</h2> <p><strong>". $row['comment']."</strong>";
  echo "</p><p class='ui-li-aside'><strong>".$row['datetime']."</strong><br/>".$row['email']."</p></li>";
  }
?>

</ul>
</div>
	<div data-role="footer"><h4>created by - utkarsh</h4></div>
</div>
</body>
</html>
