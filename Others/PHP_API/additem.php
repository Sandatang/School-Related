

<html>
    <head>

    </head>
    <body>
        
    <div class="bg-white w-[34vw] mt-[5%] m-auto pb-4 rounded-md relative">
            <button id="closeBtn" class="absolute text-[1.5em] right-0 top-0 hover:text-red-400 pr-2 text-white font-bold">X</button>
            <div class="w-full bg-blue-500 py-6 mb-4 rounded-t-md shadow-md">
                <h1 class="text-center font-bold uppercase text-[25px] text-white tracking-widest">Add Item</h1>
            </div>  
            <iframe id="votar" name="votar" style="display:none;"></iframe>
            <form id="addModalform" onsubmit="validateData()" action="list_all_items.php" method="POST" target="votar">
                <div class="w-[80%] m-auto flex flex-col justify-start items-start">
                    <p id="error" class=" place-self-center text-[12px] underline"></p>
                    <!-- <label>Description</label> -->
                    <input type="text" class="w-full outline-none border-b-2 my-2" placeholder="Description" id="description" name="description" required/>

                    <div class="flex-row justif-start items-start my-2">
                        <label class="pr-[50px]">Unit of Measure</label>
                        <select class="bg-white border border-solid border-gray-400 rounded-md" id="umsr" name="umsr">
							<option value="pc">pc</option>
							<option value="set">set</option>
							<option value="kl">kilo</option>
							<option value="doz">dozen</option>
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
                    <input type="text" class="w-full outline-none border-b-2" placeholder="Quantiy on Hand" id="qty" name="qtyonhand" required />
                    <input type="text" class="w-full outline-none border-b-2 my-2" placeholder="Price" id="price" name="price" required />

                    <button type="submit" class="w-full bg-blue-500 py-2 rounded-md mt-6 hover:bg-blue-400 hover:underline hover:text-black text-white text-[18px]" id="saveAddbtn" name="save">Save</button>
                </div>
            </form>
    </div>
            <script>
                function validateData(){
                    const nonDecimalUmsr = ["pc","set","doz"]
                    let checker = true

                    if(isNaN(qty.value) === true || isNaN(price.value) === true){
                        error.style.color = 'red'
                        error.innerHTML = 'Quantity or Price should be a number'
                        return checker = false
                    }
                    if(qty.value < 0 || price.value < 0){
                        error.style.color = 'red'
                        error.innerHTML = 'Quantity and Price can never be negative'
                        return checker = false
                    }
                    
                    if(nonDecimalUmsr.indexOf(umsr.value) !== -1){
                        let newqty = qty.value
                        if(newqty.indexOf('.') !== -1){
                            error.style.color = 'red'
                            error.innerHTML = 'Decimal Values are only allowed in kilo'
                            return checker = true
                        }
                    }
                    if(checker === true){
                        error.style.color = 'green'
                        error.innerHTML = 'Item added succesfully'
                        // modal.style.display = 'none'
                        // location.reload()
                        window.location.href = 'http://localhost/php_activities/semi_final/activity/my_codes/list_all_items.php'
                        
                    }
                    
                }
            
            </script>
    </body>
</html>