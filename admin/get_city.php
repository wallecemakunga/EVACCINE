<?php
require_once("../config.php");
if(!empty($_POST["statecode"])) 
{
$statecode=$_POST["statecode"];
$query1 =mysqli_query($con,"SELECT city.id as cityid,city.cityname FROM city 
	join state on state.StCode=city.stateid 
	join country on country.id=city.countryid 
	WHERE city.stateid = '$statecode'");
?>
<option value="">Select Village</option>
<?php
while($row1=mysqli_fetch_array($query1))  
{
?>
<option value="<?php echo $row1["cityname"]; ?>"><?php echo $row1["cityname"]; ?></option>
<?php
}
}
?>
