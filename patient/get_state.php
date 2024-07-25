<?php
require_once("../config.php");
if(!empty($_POST["coutrycode"])) 
{
$query =mysqli_query($con,"SELECT * FROM state WHERE countryid = '" . $_POST["coutrycode"] . "'");
?>
<option value="">Select District</option>
<?php
while($row=mysqli_fetch_array($query))  
{
?>
<option value="<?php echo $row["StCode"]; ?>"><?php echo $row["StateName"]; ?></option>
<?php
}
}



?>
