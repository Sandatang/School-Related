<?php
	session_start();

	if(!isset($_SESSION["username"])){
		header("location: login.php");
		exit;
	}
?>
<html>
	<head>
		<title>List All Items</title>
	</head>
	<body>
		
		<?php

		
		function listAll(){

			
			echo "<form action = './add_item.php' method = 'POST'>"; 
			echo "<button type = 'submit'> Add Item </button>";
			echo "</form>";
			

			//establish a connection to the database
		$connection = mysqli_connect("localhost", "root", "", "inventory");

		//check if the connection was successful
		if($connection)	
			{
				$sql = " select 
							item.iid,
							item.description,
							item.umsr,
							category.description,
							item.qtyonhand,
							item.price
						 from
							item left join category
								on item.cid = category.cid
						 order by
							item.description
				";
				$records = mysqli_query($connection, $sql);
				if(mysqli_num_rows($records) > 0)
				{
					echo "<table border='1'>";
					echo "	<tr>";
					echo "		<th>Seq. No.</th>";
					echo "		<th>Item ID</th>";
					echo "		<th>Description</th>";
					echo "		<th>Unit of Measure</th>";
					echo "		<th>Category</th>";
					echo "		<th>Qty. on Hand</th>";
					echo "		<th>Price</th>";
					echo "		<th colspan ='2'>Action</th>";
					echo "	</tr>";
					
					$seq = 1;
					while($rec = mysqli_fetch_array($records))
					{
						
						echo "<tr>";
						echo "		<td>".$seq.".</td>";
						echo "		<td>".$rec[0]."</td>";
						echo "		<td>".$rec[1]."</td>";
						echo "		<td>".$rec[2]."</td>";
							if($rec[3] === null){
								echo "		<td>Category Deleted</td>";		
							}else{
								echo "		<td>".$rec[3]."</td>";
							}
						
							if(fmod($rec[4],1) === 0.00){
								echo "		<td align='right'>".floor($rec[4])."</td>";
							}else{
								echo "		<td align='right'>".$rec[4]."</td>";
							}
						
						echo "		<td align='right'>".$rec[5]."</td>";
						echo "		<td><a href='list_all.php?deleteId= ".$rec[0]."'>&#128465; Delete</a></td>";
						echo "		<td><a href='./update_item.php?updateId=".$rec[0]."'>&#128393; Update</a></td>";
						echo "</tr>";
						$seq++;
					}
					
					
					echo "</table>";
				}
				else 
				{
					echo "<p>No records found...</p>";
				}
				
			}
			else 
			{
				echo "<p>Error connecting to DB...</p>";
			}
			mysqli_close($connection);			
		
		}
		function searchBar(){
			echo '<form method="GET" action="list_all.php">';
			echo '<input type="text" name="keyword" value="" placeholder="Type keyword here..." />';
			echo '<button type="submit" name="search">Search</button>';
			echo '</form>';
		}
		searchBar();
		listAll();
		

		if(isset($_GET["search"]))
		{
			ob_end_clean();
			$keyword = trim($_GET["keyword"]);
			
			
			
			//search bar
			searchBar();
			//add item
			echo "<form action = './add_item.php' method = 'POST'>"; 
			echo "<button type = 'submit'> Add Item </button>";
			echo "</form>";
			


			//establish a connection to the database
			$connection = mysqli_connect("localhost", "root", "", "inventory");

			//check if the connection was successful
			if($connection)	
			{
				//get all the records from the student table
				$records = mysqli_query($connection, 
					" select
							item.iid,
							item.description,
							item.umsr,
							category.description,
							item.qtyonhand,
							item.price
						from
							item left join category
								on item.cid = category.cid
							where 
								item.description like '%".$keyword."%' or price like '%".$keyword."%' 
							order by 
								item.description");					
				
				//check if there are records retrieved
				
				if(mysqli_num_rows($records) > 0)
				{
					echo "<table border='1'>";
					echo "	<tr>";
					echo "		<th>Seq. No.</th>";
					echo "		<th>Item ID</th>";
					echo "		<th>Description</th>";
					echo "		<th>Unit of Measure</th>";
					echo "		<th>Category</th>";
					echo "		<th>Qty. on Hand</th>";
					echo "		<th>Price</th>";
					echo "		<th colspan ='2'>Action</th>";
					echo "	</tr>";
					
					$seq = 1;
					while($rec = mysqli_fetch_array($records))
					{
						
						echo "<tr>";
						echo "		<td>".$seq.".</td>";
						echo "		<td>".$rec[0]."</td>";
						echo "		<td>".$rec[1]."</td>";
						echo "		<td>".$rec[2]."</td>";
						if($rec[3] === null){
							echo "		<td>Category Deleted</td>";		
						}else{
							echo "		<td>".$rec[3]."</td>";
						}
					
						if(fmod($rec[4],1) === 0.00){
							echo "		<td align='right'>".floor($rec[4])."</td>";
						}else{
							echo "		<td align='right'>".$rec[4]."</td>";
						}
						echo "		<td align='right'>".$rec[5]."</td>";
						echo "		<td><a href='list_all.php?deleteId= ".$rec[0]."'>&#128465; Delete</a></td>";
						echo "		<td><a href='./update_item.php?updateId=".$rec[0]."'>&#128393; Update</a></td>";
						echo "</tr>";
						$seq++;
					}
					
					
					echo "</table>";
				}
				else 
				{
					echo "<p>No records found...</p>";
				}
				
			}
			else 
					{
						echo "<p>Error connecting to DB...</p>";
					}
			mysqli_close($connection);	
		}
			
		
		

		if(isset($_GET["deleteId"]))
		{
				$id = $_GET["deleteId"];
				ob_end_clean();
				searchBar();
				//establish a connection to the database
				$connection = mysqli_connect("localhost", "root", "", "inventory");					
				
					mysqli_query($connection, "delete from item where iid = '".$id."' ");					
				
				echo "<p>Deleted successfully...</p>";
				mysqli_close($connection);	
			listAll();
		}

		?>
	
	</body>
</html>