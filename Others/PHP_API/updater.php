<html>
    <head>
        <title>Updater</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <?php
            // UPDATE ITEM
            $descriptionUpdate = "";
            $umsrUpdate = "";
            $categoryUpdate = "";
            $qtyonhandUpdate = "";
            $priceUpdate = "";

            if(isset($_GET['updateId'])){
                $id = $_GET['updateId'];

                $con = mysqli_connect("localhost", "root", "", "inventory");
                if($con)
                {
                    $sql = "select * from item where iid = ".$id." ";
                    $records = mysqli_query($con, $sql);
                    if(mysqli_num_rows($records) > 0){
                        while($rec = mysqli_fetch_row($records)){

                            $descriptionUpdate = $rec[1];
                            $umsrUpdate = $rec[2];
                            $categoryUpdate = $rec[3];
                            $qtyonhandUpdate = $rec[4];
                            $priceUpdate = $rec[5];
                        }
                    }
                    else{
                        echo "<p>No records found</p>";
                    }
                }
                else 
                {
                    echo "<p>Error connecting to DB...</p>";
                }
            }
        ?>

        <!-- MODAL FOR UPDATING ITEM -->
        <div id="modalForUpdate" class="fixed z-10 left-0 top-0 w-[100vw] h-[100vh] backdrop-blur-sm bg-black bg-opacity-25 overflow-auto">
            <div class="bg-white w-[34vw] mt-[5%] m-auto pb-4 rounded-md">
                <div class="w-full bg-blue-400 py-6 mb-4 rounded-t-md shadow-md">
                    <h1 class="text-center font-bold uppercase text-[25px] text-white tracking-widest">Update Item</h1>
                </div>
            <iframe name="test" style="display:none;"></iframe>
            <form onsubmit="updateData()" action="list_all_items.php" method="POST" target="test">
                <div class="w-[80%] m-auto flex flex-col justify-start items-start">
                <p id="errorUpdate" class="text-red-300 place-self-center text-[12px] underline"></p>
                
                    <!-- <label>Description</label> --><p id="error" class="text-red-400 place-self-center"></p>
                    <input type="text" class="w-full outline-none border-b-2 my-2" name="id" value="<?php echo $id; ?>" readonly/>
                    <input type="text" class="w-full outline-none border-b-2 my-2" placeholder="Description" name="description" value="<?php echo $descriptionUpdate; ?>" required/>

                    <div class="flex-row justif-start items-start my-2">
                        <label class="pr-[50px]">Unit of Measure</label>
                        <select class="bg-white border border-solid border-gray-400 rounded-md" id="umsr" name="umsr">
							<option value="pc" <?php if($umsrUpdate == "pc") echo "selected"; ?>>pc</option>
							<option value="set" <?php if($umsrUpdate == "set") echo "selected"; ?>>set</option>
							<option value="kl" <?php if($umsrUpdate == "kl") echo "selected"; ?>>kilo</option>
							<option value="doz" <?php if($umsrUpdate == "doz") echo "selected"; ?>>dozen</option>
						</select>
                    </div>
                    <div class="flex-row justif-start items-start my-2">
                    <label class="pr-[100px]">Category</label>
                        <?php
							$con = mysqli_connect("localhost", "root", "", "inventory");
							if($con)
							{
								$categories = mysqli_query($con, "select * from category order by description");
								if(mysqli_num_rows($categories) > 0)
								{
									echo "<select class='bg-white border border-solid border-gray-400 rounded-md' name='category'>";
									while($row = mysqli_fetch_row($categories))
									{
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									}
									
								}
                                else{
                                    echo "</select>";
                                }
							}
							else 
							{
								echo "<p>Error DB Connection</p>";
							}
							
						?>
                    </div>

                    <!-- <label>Quantity on Hand</label> -->
                    <input type="text" class="w-full outline-none border-b-2" placeholder="Quantiy on Hand" id="qty"  name="qtyonhand" value="<?php echo $qtyonhandUpdate; ?>" required />
                    <input type="text" class="w-full outline-none border-b-2 my-2" placeholder="Price" id="price" name="price" value="<?php echo $priceUpdate; ?>" required />
                    <button type="submit" class="w-full bg-blue-400 py-2 rounded-md mt-6 hover:bg-blue-500 hover:text-black text-white text-[20px]" name="saveUpdate">Save</button>
                </div>
            </form>
            <a class="mt-6 text-blue-500 font-bold hover:text-green-400 place-self-end hover:no-underline tracking-widest underline" href="list_all_items.php?keyword=&search=">Done?</a>
        </div>
        <script type="text/javascript" src="update.js"></script>
    </body>
</html>