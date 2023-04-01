<html>
    <head><script src="https://cdn.tailwindcss.com"></script></head>
    <body>
        <div class="w-[100%] bg-blue-500 py-10 shadow-lg relative">
            <h2 class="text-center font-bold text-[25px] text-white tracking-wide uppercase">Inventory Database</h2>
            <!-- <form action="userLogout.php"> -->
            <button class="absolute top-30 right-10 font-bold text-white hover:text-slate-100 underline" id="logout">Logout</button>
                <!-- </form> -->
                <div id="logoutModal" class="hidden fixed z-10 top-0 right-0 w-[100vw] h-[100vh] backdrop-blur-sm bg-opacity-25 bg-slate-50 overflow-auto">
                    <div class="w-[600px] py-20 mt-[15%] m-auto text-center bg-gray-100 shadow-md rounded-md">
                        <form action="userLogout.php" method="POST">
                        <label class="text-black font-semibold pr-2">Are you sure you want to log out?</label>
                            <button class="px-10 py-2 bg-white text-black shadow-md rounded-md hover:bg-gray-400 font-bold" name="yes">Yes</button>
                            <button class="px-10 py-2 bg-white text-black shadow-md text-white rounded-md hover:bg-gray-400 font-bold" name="no">No</button>
                        </form>
                    </div>
                </div>
                
        </div>
    </body>
</html>