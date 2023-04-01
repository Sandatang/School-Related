<?php

    session_start();

    if(!isset($_SESSION["username"])){header("location: userLogin.php"); exit;}
?>

<html>
    <head>
       <title>List All Item</title> 
       
       <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body style="background-image: url('https://as2.ftcdn.net/v2/jpg/03/25/01/55/1000_F_325015501_0OREXfdOKXVEkRb3CoULxDDMgGy9gPNW.jpg'); background-repeat: no-repeat; background-size: cover;">
    <?php include "headerwithlogout.php";?> 
    <div class="w-[1200px] flex justify-center items-center m-auto gap-[50em] mt-6">
            <button id="btnAdd" class="bg-blue-400 px-4 py-2 text-white font-bold rounded-md hover:bg-blue-400 hover:text-black">Add Item</button>
            <?php include "searchform.php";?>
    </div>
        <?php
            

            $connection = mysqli_connect("localhost","root","","inventory");

            if($connection){

                    function handleInvalidInputs($qty,$umsr,$price){
                            $nonDecimalUmsr = ["pc","set","doz"];
                            $err = false;

                            if(is_numeric($qty) === FALSE || is_numeric($price) === FALSE){
                                displayAllItem("Quantity or Price should be a valid number");
                                $err = true;
                            }

                            if($qty < 0 || $price <0){
                                displayAllItem("Quantity on hand or price must not be a negative number");
                                // echo "<p> Quantity on hand or price must not be a negative number </p>";
                                $err = true;
                            }

                            if((array_search($umsr,$nonDecimalUmsr)) !== FALSE){
                                if ((strpos($qty,'.') !== false)){
                                    displayAllItem("Decimal value are only allowed in kilo");
                                    // echo "<p> Quantity on hand can only be decimal for Kilo</p>";
                                    $err = true;
                                }	
                            }
                        return $err;
                    }

                    // //handle message
                    // function mssgHandlers($msg){
                    //     echo "<p>".$msg."</p>";
                    // }

                    function displayAllItem($msg){ 
                        $connection = mysqli_connect("localhost","root","","inventory");  
                        $sql = " select 
                                    item.iid,
                                    item.description,
                                    item.umsr,
                                    category.description,
                                    item.qtyonhand,
                                    item.price
                                from
                                    item inner join category
                                        on item.cid = category.cid
                                order by
                                    item.description
                        ";
                        $displayRecords = mysqli_query($connection, $sql);
    
    
                        if(mysqli_num_rows($displayRecords) > 0){
                
                            
                            echo "<p class='text-center font-bold text-[20px] tracking-widest text-white underline'>".$msg."</p>";
                            echo "<div class='flex flex-col justify-center items-center h-[15vh]'>";
                            echo "<form>";
                            echo    "<table class='w-[1200px] border mt-[20px] text-center shadow-md bg-white'>";
                            echo        "<thead>";
                            echo            "<tr class='border uppercase'>";
                            echo                "<th>Sequence</th>";
                            echo                "<th>Item ID</th>";
                            echo                "<th>Description</th>";
                            echo                "<th>Unit Of measure</th>";
                            echo                "<th>Category</th>";
                            echo                "<th>Quantity on hand</th>";
                            echo                "<th>Price</th>";
                            echo                "<th colspan='2'>Action</th>";
                            echo            "</tr>";
                            echo        "</thead>";
    
                            echo        "<tbody>";
                                        $seq=1;
                                        while($rec = mysqli_fetch_array($displayRecords)){
                                            $updateThisId = $rec[0];
                                            echo "<tr class='hover:bg-slate-200'>";
                                            echo    "<td class='border py-[4px]'>".$seq."</td>";
                                            echo    "<td class='border'>".$rec[0]."</td>";
                                            echo    "<td class='border'>".$rec[1]."</td>";
                                            echo    "<td class='border'>".$rec[2]."</td>";  
                                            echo    "<td class='border'>".$rec[3]."</td>";
                                            echo    "<td class='border text-right'>".$rec[4]."</td>";
                                            echo    "<td class='border text-right'>&#x20B1; ".$rec[5]."</td>";
                                            echo    "<td><a class='no-underline bg-green-400 hover:bg-green-700 w-full block py-[4px]' id='updateAnchor' href='updater.php?updateId=".$rec[0]."'>&#9998;</a></td>"; // UPDATE ID and pass to self file
                                            // echo    "<td><button class='w-full py-[4px] bg-green-400' id='updaterId' name='update'>update</button></td>";
                                            echo    "<td><a class='no-underline bg-red-400 text-white hover:bg-red-500 w-full block py-[4px] px-[3px] font-bold' id='deleteId' href='list_all_items.php?deleteId=".$rec[0]."'>&#x2715;</a></td>";
                                            echo "</tr>";
                                            $seq++;
                                        }
                            echo        "</tbody>";
                            echo    "</table>";
                            echo "</form>";
                            echo "</div>";
    
                        }
                    }

                ///SAVE UPDATE
                if(isset($_POST['saveUpdate'])){
                    $idUpdate = $_POST['id'];
                    $descriptionUpdate = trim($_POST["description"]);
                    $umsrUpdate = $_POST["umsr"];
                    $categoryUpdate = $_POST["category"];
                    $qtyUpdate = trim($_POST["qtyonhand"]);
                    $price = trim($_POST["price"]);

                    $con = mysqli_connect("localhost", "root", "", "inventory");

                    $checker = handleInvalidInputs($qtyUpdate, $umsrUpdate, $price);
                        if($checker === false){
                            if($con){
                                $sql = "update 
                                            item 
                                        set 
                                            description = '".$descriptionUpdate."',
                                            umsr ='".$umsrUpdate."',
                                            cid = ".$categoryUpdate.",
                                            qtyonhand = ".$qtyUpdate.", 
                                            price = '".$price."'
                                        where 
                                            iid = ".$idUpdate."
                                    ";
                                mysqli_query($con, $sql);
                                // mssg_alert();
                                displayAllItem("Item was updated successfully...");
                                // echo "<p class='text-center font-bold my-6'>Item was updated successfully...</p>";
                            }
                        }
                    
                }

                // ADD ITEM TO DATABASE
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
                        
                        
                        $con = mysqli_connect("localhost", "root", "", "inventory");
                        $checker = handleInvalidInputs($qty, $umsr, $price);
                        if($checker === false){
                            if($con){
                                $sql = "insert into item (description, umsr, cid, qtyonhand, price) 
                                        values ('".$description."', '".$umsr."', ".$category.", ".$qty.", ".$price.") ";
                                mysqli_query($con, $sql);
                                // mssg_alert();
                                displayAllItem("Item was added successfully...");
                                // header('location: list_all_items.php?keyword=&search=');
                                mysqli_close($con);
                                // echo "<p class='text-center font-bold my-6'>Item was saved successfully...</p>";
                            }
                            else {
                                echo "<p>Error connecting to DB...</p>";
                            }
                        }
                    }

                    ///Delete ITEM
                    if(isset($_GET['deleteId'])){
                        $deleteId = $_GET['deleteId'];
                        $con = mysqli_connect("localhost", "root", "", "inventory");
                        if($con){
                            $sqlDelete = "delete from item where iid = '".$deleteId."'";

                            mysqli_query($con, $sqlDelete);
                            // mssg_alert();
                            displayAllItem("Deleted successfully...");
                            // echo "<p class='text-center font-bold my-6'>Deleted successfully...</p>";
                            mysqli_close($con);
                        }
                        
                    }
                    
                
            }

            //SSearch
            if(isset($_GET["search"])){
                $keyword = trim($_GET["keyword"]);

                $con = mysqli_connect("localhost","root","","inventory");
                if($con){
                    $records = mysqli_query($con, "select * from item where description like '%".$keyword."%' or umsr like '%".$keyword."%' order by description");					

                    if(mysqli_num_rows($records) > 0){
                        echo "<div class='flex flex-col justify-center items-center'>";
                        // echo "<button id='btnAdd' class='bg-blue-400 px-10 py-2 text-white font-bold rounded-md hover:bg-blue-400 hover:text-black'>Add Item</button>";
                        echo "<form>";
                        echo "<table class='w-[1200px] border text-center shadow-md bg-white'>";
                        echo "	<tr class='border uppercase'>";
                        echo "		<th>Seq. No.</th>";
                        echo "		<th>Item ID</th>";
                        echo "		<th>Description</th>";
                        echo "		<th>Unit of Measure</th>";
                        echo "		<th>Category</th>";
                        echo "		<th>Qty. on Hand</th>";
                        echo "		<th>Price</th>";
                        echo "      <th colspan='2'>Action</th>";
                        echo "	</tr>";
                        
                        $seq = 1;
                        while($rec = mysqli_fetch_array($records))
                        {
                            
                            echo "<tr class='hover:bg-slate-200'>";
                            echo "		<td class='border py-[4px]'>".$seq.".</td>";
                            echo "		<td class='border'>".$rec[0]."</td>";
                            echo "		<td class='border'>".$rec[1]."</td>";
                            echo "		<td class='border'>".$rec[2]."</td>";
                            echo "		<td class='border'>".$rec[3]."</td>";
                            echo "		<td class='border text-right'>".$rec[4]."</td>";
                            echo "		<td class='border text-right'>&#x20B1; ".$rec[5]."</td>";
                            echo    "<td><a class='no-underline bg-green-400 hover:bg-green-700 w-full block py-[4px]' id='updateAnchor' href='updater.php?updateId=".$rec[0]."'>&#9998;</a></td>"; // UPDATE ID and pass to self file
                            // echo    "<td><button class='w-full py-[4px] bg-green-400' id='updaterId' name='update'>update</button></td>";
                            echo    "<td><a class='no-underline bg-red-400 text-white hover:bg-red-500 w-full block py-[4px] px-[3px] font-bold' id='deleteId' href='list_all_items.php?deleteId=".$rec[0]."'>&#x2715;</a></td>";
                            echo "</tr>";
                            $seq++;
                        }
                        
                        
                        echo "</table>";
                        echo "</form>";
                        echo "</div>";
                    }
                    else{
                        echo "<p class='text-center mt-10 font-bold text-[18px] text-white underline'>No records found!</p>";
                    }
				
			}else {
				echo "<p>Error connecting to DB...</p>";
			}
			mysqli_close($con);	
		}
            
            
            
        ?>
        <!-- MODAL FOR ADDING ITEM -->
        <div id="modal" class="hidden fixed z-10 left-0 top-0 w-[100vw] h-[100vh] backdrop-blur-sm bg-black bg-opacity-25 overflow-auto">
            <?php include "additem.php";?>
        </div>
        <script type="text/javascript" src="listall.js"></script>
        <script type="text/javascript" src="logout.js"></script>
    </body>
</html>