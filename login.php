<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Login</title>
    </head>
    <body class= " bg-indigo-400">
        <section class="mt-24">
            <div class=" items-center justify-center flex flex-col">
                <img src="assets/images/profil.svg" class="w-32 "/>
                <h2 class=" my-2 font-bold text-1xl">Welcome to you</h2>
            </div>
            <div class="max-w-xl bg-green-300 h-12 mx-auto mt-3 shadow-2xl shadow-teal-300 opacity-75">
                <h1 class="text-4xl text-center font-bold">Edge Store</h1>
            </div>
            <div class="bg-white mx-auto h-64 max-w-xl rounded-2xl">
                <div class="p-8 pb-2 relative mt-8">
                    <form>
                        <i class="fa fa-user absolute text-primary text-xl"></i>
                        <input type="text" id="email"placeholder=" Masukan username" class="focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 capitalize text-lg invalid:text-red-500" />
                    </form>
                </div>
                <div class="p-8 pt-0 relative mt-2">
                    <form>
                        <i class="fa fa-lock absolute text-primary text-xl"></i>
                        <input type="password" placeholder=" Password" class="focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2  focus:outline-none focus:border-primarycolor transition-all duration-500 capitalize text-lg" />
                        
                    </form>
                </div>
                <button class="block mx-auto">
                    <a href="profil.html" class=" hover:bg-blue-300 py-3 px-16 bg-violet-400 rounded-full text_whi text-white">Sign Up</a>
                    
                </button>
                <button class="block mx-auto mt-8">
                    
                    <a href="#" class="hover:bg-blue-300 py-3 px-16 bg-violet-400 rounded-full text_whi text-white">Sign In</a>
                </button>
            </div>
        </section>
        <img src="assets/images/wave.png"/ class="h-screen">
    </body>
</html>