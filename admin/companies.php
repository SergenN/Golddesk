<?php
session_start();
$title = "Admin";
include'components/header.php';
?>
<table>
	<tr>
		<td>Naam</td>
		<td>Branch</td>
		<td>Contact</td>
		<td>info</td>
	</tr>
<?php
$query ="SELECT * FROM `companies` ORDER BY `name` ASC";
$result = mysqli_query($link, $query);
while($row=mysqli_fetch_assoc($result)){
	echo('
		<tr>
			<td><input type="text" name="cname" value=".$row['name']."></td>
			<td><input type="text" name="cname" value=".$row['branch']."></td>
			<td><input type="text" name="cname" value=".$row['contact']."></td>
			<td><input type="text" name="cname" value=".$row['info']."></td>
		</tr>
');
	
?>
<?php
include'components/footer.php';
?>