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

	if(isset($_GET["updateId"]))
	{
        $id = $_GET["updateId"];
        //db connection
        $con = mysqli_connect("localhost", "root", "", "inventory");
			//check if the connection was successful
			if($con)	
			{
				//query record that needs to be updated
				$records = mysqli_query($con, "select * from item where iid = ".$id." ");					
				
                //if record found
                if(mysqli_num_rows($records) > 0)
				{
                    //loop through records found
                    
                    while($rec = mysqli_fetch_row($records)){
                        
                        $description = $rec[1];
                        $umsr = $rec[2];
                        $category = $rec[3];
						if(fmod($rec[4],1) === 0.00){
							$qty = floor($rec[4]);
						}else{
							$qty = $rec[4];
						}
                        $price = $rec[5];
                    }  
                }else{
                    echo "no record to update";
                }
                    
			}
        else 
            {
                echo "<p>Error connecting to DB...</p>";
            }
            mysqli_close($con);

   				
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
			if ((strpos($qty,'.') !== false)){
				echo "<p> Quantity on hand can only be decimal for Kilo</p>";
				$isError = true;
			}	
		}

	 return $isError;
	}

    if(isset($_POST["save"])){
        //errorTrapping($qty,$umsr,$price);
                $id = $_POST["id"];

				$description = trim($_POST["description"]);
				$umsr = $_POST["umsr"];
				$category = $_POST["category"];
				$qty = trim($_POST["qtyonhand"]);
				$price = trim($_POST["price"]);


            if(errorTrapping($qty,$umsr,$price) == false){
              
                 //db connection
                 $con = mysqli_connect("localhost", "root", "", "inventory");
                        if($con){
                            $sql = "update 
                                        item 
                                    set 
                                        description = '".$description."',
                                        umsr ='".$umsr."',
                                        cid = ".$category.",
                                        qtyonhand = ".$qty.", 
                                        price = '".$price."'
                                    where 
                                        iid = ".$id."
                                ";
                            mysqli_query($con, $sql);
                            echo "<p>Item was updated successfully...</p>";
                            
                    }
             
            }
		
     }
	

?>


<html>
	<head>
		<title>Edit Item</title>
		
	</head>
	<body>
		<form method="POST" action="update_item.php">
			<table>
				<tr>
				<td>ID: </td>
				<td><input type="text" name="id" value="<?php echo $id; ?>" readOnly /> </td>
				</tr>
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
                                            

                                             echo " <option value= ".$row[0]." ";
                                            
                                             if(($row[0]) == $category){
                                                echo "selected"; 
                                             } 
                                             echo ">";
                                             echo " ".$row[1]." </option>" ;
                                         
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
        <a href = "./list_all.php">Return to List</a>
	</body>
</html>