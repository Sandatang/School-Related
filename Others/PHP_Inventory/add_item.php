<?php

session_start();

	if(!isset($_SESSION["username"])){
		header("location: login.php");
		exit;
	}

	
	$description = "";
	$umsr = "";
	$category = "";
	$qty = "";
	$price = "";
	
	
	
	
	if(isset($_POST["save"]))
	{
		$description = trim($_POST["description"]);
		$umsr = $_POST["umsr"];
		$category = $_POST["category"];
		$qty = trim($_POST["qtyonhand"]);
		$price = trim($_POST["price"]);

				//errorTrapping($qty,$umsr,$price);
				if(errorTrapping($qty,$umsr,$price) == false){
					$con = mysqli_connect("localhost", "root", "", "inventory");
						
						if($con)
						{
							$sql = "insert into item (description, umsr, cid, qtyonhand, price) 
									values ('".$description."', '".$umsr."', ".$category.", ".$qty.", ".$price.") ";
							mysqli_query($con, $sql);
							echo "<p>Item was saved successfully...</p>";
						}
						else 
						{
							echo "<p>Error connecting to DB...</p>";
						}
						mysqli_close($con);

						$description = "";
						$umsr = "";
						$category = "";
						$qty = "";
						$price = "";
				}
						
	}
			
		
	function errorTrapping($qty,$umsr,$price){
		$nonDecimalUmsr = ["pc","set","doz"];
		$isError = false;

		if(is_numeric($qty) === FALSE){
			echo "<p> Quantity on hand should be a number </p>";
			$isError = true;
		}
		if(is_numeric($price) === FALSE){
			echo "<p> price should be a number </p>";
			$isError = true;
		}

		if($qty < 0 || $price <0){
			echo "<p> Quantity on hand or price must not be a negative number </p>";
			$isError = true;
		}

		if((array_search($umsr,$nonDecimalUmsr)) !== FALSE){
			if ((fmod($qty,1) !== 0.00)){
				echo "<p> Quantity on hand can only be decimal for Kilo</p>";
				$isError = true;
			}	
		}

	 return $isError;
	}
		
	
	

?>

</script>
<html>
	<head>
		<title>Add Item</title>
		
	</head>
	<body>
		<form method="POST" action="add_item.php">
			<table>
				<tr>
					<td>Description:</td>
					<td><input type="text" name="description" required value ="<?php echo "$description";?>"/></td>
				</tr>
				<tr>
					<td>Unit of Measure:</td>
					<td>
						<select name="umsr">
							<option value="pc" <?php if($umsr == "pc") echo "selected"; ?>>pc</option>
							<option value="set"<?php if($umsr == "set") echo "selected"; ?>>set</option>
							<option value="kl"<?php if($umsr == "kl") echo "selected"; ?>>kilo</option>
							<option value="doz"<?php if($umsr == "doz") echo "selected"; ?>>dozen</option>
						</select>
					</td>
				</tr>	
				<tr>
					<td>Category:</td>
					<td>
						<?php
							$con = mysqli_connect("localhost", "root", "", "inventory");
							if($con)
							{
								$categories = mysqli_query($con, "select * from category order by description");
								if(mysqli_num_rows($categories) > 0)
								{
									echo "<select name='category'>";
									while($row = mysqli_fetch_row($categories))
									{
										echo "<option value='".$row[0]."' <?php if($category == '".$row[0]."') {echo 'selected';} ?>".$row[1]."</option>";
									}
									echo "</select>";
								}
							}
							else 
							{
								echo "<p>Error DB Connection</p>";
							}
							
						?>
					</td>
				</tr>
				<tr>
					<td>Quantity on Hand:</td>
					<td><input type="text" name="qtyonhand" required value ="<?php echo "$qty";?>"/></td>
				</tr>	
				<tr>
					<td>Price:</td>
					<td><input type="text" name="price" required value ="<?php echo "$price";?>"/></td>
				</tr>	
				<tr>
					<td></td>
					<td><button type="submit" name="save">Save</button></td>
				</tr>				
			</table>
			
		</form>
		<a href = "./list_all.php">View List</a>
	</body>
</html>