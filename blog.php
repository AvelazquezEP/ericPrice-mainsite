<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Database data/connection
$host = "abogadoericprice.com";
$port = "5432";
$dbname = "dbezl1uquldojv";
$user = "uhgpgzxv2hhak";
$password = "700Flower!";

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string) or die('Could not reach database.');

// Query to get all the data
$sql = "select *from posts order by title asc";

$all_post = pg_query($sql);

$sql_unique = "select *from posts where id_post='" . $id_post . "'";
$post_data_unique = pg_query($sql_unique);
$unique_post = pg_fetch_object($post_data_unique);

$new_date = $unique_post->created_at;
$date_edited = date("Y-m-d",strtotime($new_date));

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Si esta buscando un abogado para su proceso de inmigración a llegado a la mejor oficina. El abogado Eric Price es  Ex-Fiscal de ICE y tiene años de experiencia. ¡Hable hoy para reserver su consulta gratis!" />
    <meta name="author" content="Eric Price" />
    <meta name="keywords" content="abogado eric price, eric price, abogado de inmigracion, abogado para green card, abogado para permiso de trabajo, abogado para residencia, inmigración, abogados de inmigracion, residencia, green card, ciudadania, petición familiar, Immigration, immigration attorney, immigration attorney los angeles, immigration attorneys">

    <link rel="icon" type="image/x-icon" href="/images/EP_Website-01.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/b50aac37d5.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/dist/output.css">
    <link rel="stylesheet" href="style.css">

    <title>Eric Price - Immigration Attorney</title>
</head>

<body class="bg-gray-50 leading-normal">    
    <header class="" id="Header">
        <div class="bg-[#001e3e]">
            <nav id="header" class="w-full z-30 top-0">
                <div class="w-full mx-auto flex flex-wrap items-center justify-between mt-0 py-2 max-w-screen-xl sm:py-5">
                    <div class="pl-4 flex items-center">
                        <a href="index.html" class="flex items-center">
                            <img src="/images/EricpriceLogo-white.svg" class="h-9 mr-2 sm:h-9" alt="Eric Price Logo" />
                        </a>
                    </div>
                    <div class="block lg:hidden pr-4">
                        <button id="nav-toggle" name="toggle" class="flex items-center p-1 text-white hover:text-orange-200 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                            <i class="fa-solid fa-bars text-2xl">
                                <title>Menu</title>
                            </i>
                        </button>
                    </div>
                    <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 lg:bg-transparent p-4 lg:p-0 z-20" id="nav-content">
                        <ul class="list-reset lg:flex justify-end flex-1 items-center text-white">
                            <li class="mr-3">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="index.html">Inicio</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#Servicios">Servicios</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#Nosotros">Nosotros</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#Equipo">Nuestro equipo</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#FAQ">FAQ</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#Testimonios">Testimonios</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#Blog">Blog</a>
                            </li>
                            <li class="mr-1">
                                <a class="inline-block no-underline hover:text-amber-500 hover:text-underline py-2 px-4 lg:text-white " href="/index.html#Contacto">Contacto</a>
                            </li>
                            <li class="mr-3">
                                <a class="inline-block no-underline bg-orange-400 hover:bg-orange-500 rounded hover:text-gray-50 hover:text-underline py-2 px-4 lg:text-white " href="/english.html">English</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
            </nav>
        </div>

    </header>

    <main class="flex flex-col gap-4 py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    
        <?php while ($post = pg_fetch_object($all_post)) : ?>
            
            <section>
                <article class="p-6 bg-white rounded border border-gray-200 shadow-md ">
                    <figure class="flex flex-col justify-between items-center gap-4 md:w-4/5 md:mx-auto md:flex-row">
                        <div>
                            <span class="text-sm" style="text-align:left;"><?= $date_edited ?></span>
                            <div class="mb-5 text-gray-500">                                
                            </div>
                            <div class="">                                
                                <img src="data:image/png;base64,<?= $post->post_picture ?>" alt="blog picture" class="postImage rounded md:w-[400px]" style="width: 100%;">
                            </div>
                        </div>
                        <div class="">
                            <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900">
                                <a href="#">
                                    <?= $post->title ?>
                                </a>
                            </h2>
                            <figcaption class="mb-5 font-light text-gray-500">
                                <?= $post->description_post ?>
                            </figcaption>
                            <div class="flex justify-start items-center">
                                <a class="inline-flex items-center font-medium text-primary-600 hover:underline bg-orange-400 rounded p-2 text-white" onclick="send_post(<?= $post->id_post ?>)">
                                    seguir leyendo
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </figure>
                </article>

            </section>

        <?php endwhile; ?>

    </main>
    
    <footer class="p-3 mt-8 bg-[#001E3E]">
        <div class="flex flex-col gap-5 pt-5 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-600 md:flex-row">
            <div class="md:w-4/12">
                <div class="mb-6">
                    <a href="index.html" class="flex items-center">
                        <img src="images/EricpriceLogo-white.svg" class="w-[15rem] mx-auto pb-4" alt="Eric Price logo" title="Eric Price logo" />
                    </a>
                    <div class="flex flex-col items-center gap-1 justify-center mt-2 text-white">
                        <div>
                            <a href="tel:(855)662-2772" class="text-base">
                                <i class="fa-solid fa-phone"></i>
                                (855) 662-2772
                            </a>
                        </div>
                        <div>
                            <a href="mailto:info@abogadoericprice.com" class="text-base">
                                <i class="fa-regular fa-envelope"></i>
                                info@abogadoericprice.com
                            </a>
                        </div>
                    </div>
                </div>                

                <div class="flex flex-row justify-around w-4/5 mx-auto">
                    <div class="font-bold rounded-full bg-white flex items-center justify-center" style="height: 40px; width: 40px; font-size: 18px;">
                        <a href="https://www.facebook.com/abogadoericprice" target="_blank">
                            <i class="fa-brands fa-facebook text-2xl text-[#3b5999]"></i></a>
                    </div>
                    <div class="font-bold rounded-full bg-white flex items-center justify-center" style="height: 40px; width: 40px; font-size: 18px;">
                        <a href="https://www.tiktok.com/@attorneyericprice" target="_blank">
                            <i class="fa-brands fa-tiktok text-2xl text-gray-900"></i></a>
                    </div>
                    <div class="font-bold rounded-full bg-white flex items-center justify-center" style="height: 40px; width: 40px; font-size: 18px;">
                        <a href="https://www.instagram.com/abogadoericprice/" target="_blank">
                            <i class="fa-brands fa-instagram text-2xl text-[#e4405f]"></i></a>
                    </div>
                    <div class="font-bold rounded-full bg-white flex items-center justify-center" style="height: 40px; width: 40px; font-size: 18px;">
                        <a href="https://www.youtube.com/@EricPriceEsq" target="_blank">
                            <i class="fa-brands fa-youtube text-2xl text-[#FF0000]"></i></a>
                    </div>
                </div>

            </div>
            <div class="md:w-4/12">
                <div>
                    <h2 class="mb-4 text-lg text-center font-semibold text-white uppercase">Mapa del sitio</h2>
                    <ul class="text-gray-200 text-center">
                        <li>
                            <a href="index.html">Inicio</a>
                        </li>
                        <li>
                            <a href="#Servicios">Servicios</a>
                        </li>
                        <li>
                            <a href="#Nosotros">Nosotros</a>
                        </li>
                        <li>
                            <a href="#Equipo">Equipo</a>
                        </li>
                        <li>
                            <a href="#FAQ">FAQ</a>
                        </li>
                        <li>
                            <a href="#Testimonios">Testimonios</a>
                        </li>
                        <li>
                            <a href="#Blog">Blog</a>
                        </li>
                        <li>
                            <a href="#Contacto">Contacto</a>
                        </li>
                        <li>
                            <a href="english.html">English</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="md:w-4/12 md:mx-auto">
                <p class="text-center mb-4 text-lg font-semibold text-white uppercase">Oficinas</p>
                <div class="grid grid-cols-2 gap-4 md:mx-auto">
                    <div class="flex items-center">
                        <i class="fa-sharp fa-solid fa-location-dot text-orange-400 text-2xl"></i>
                        <a href="https://cta.abogadoericprice.com/html/LADirectionsSpanish.html" target="_blank">
                            <div class="ml-2 text-white">
                                <h2 class="font-semibold">Los Angeles</h2>
                                <p>
                                    700 S Flower St, Ste 2925
                                    Los Angeles, CA 90017
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-sharp fa-solid fa-location-dot text-orange-400 text-2xl"></i>
                        <a href="https://cta.abogadoericprice.com/html/OCDirectionsSpanish.html" target="_blank">
                            <div class="ml-2 text-white">
                                <h2 class="font-semibold">Orange County</h2>
                                <p>
                                    2677 N. Main St., Ste. 125
                                    Santa Ana, CA 92705
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-sharp fa-solid fa-location-dot text-orange-400 text-2xl"></i>
                        <a href="https://cta.abogadoericprice.com/html/escondidoSpanish.html" target="_blank">
                            <div class="ml-2 text-white">
                                <h2 class="font-semibold">Escondido</h2>
                                <p>
                                    500 La Terraza Blvd, Ste 150
                                    Escondido, CA 92025
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-sharp fa-solid fa-location-dot text-orange-400 text-2xl"></i>
                        <a href="https://cta.abogadoericprice.com/html/chulaVistaDirectionsSpanish.html" target="_blank">
                            <div class="ml-2 text-white">
                                <h2 class="font-semibold">Chula Vista</h2>
                                <p>
                                    660 Bay Blvd, Ste 211
                                    Chula Vista, CA 91910
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-sharp fa-solid fa-location-dot text-orange-400 text-2xl"></i>
                        <a href="https://cta.abogadoericprice.com/html/chicagoDirectionsSpanish.html" target="_blank">
                            <div class="ml-2 text-white">
                                <h2 class="font-semibold">Chicago</h2>
                                <p>
                                    1136 S. Delano Court West
                                    STE B201
                                    Chicago, IL 60605
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <i class="fa-sharp fa-solid fa-location-dot text-orange-400 text-2xl"></i>
                        <a href="https://cta.abogadoericprice.com/html/SBDirectionsSpanish.html" target="_blank">
                            <div class="ml-2 text-white">
                                <h2 class="font-semibold">San Bernardino</h2>
                                <p>
                                    473 E Carnegie Dr,
                                    STE 200
                                    San Bernardino, CA 92408
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <div class="text-center flex flex-col items-center justify-center gap-3 md:flex-row md:justify-between">
            <span class="text-sm text-gray-500 sm:text-center">
                © 2023 <a href="/index.html" class="hover:underline">Eric Price™</a>. Todos los derechos reservados.
            </span>
            <div>
                <ul class="flex flex-col text-gray-500 md:flex-row">
                    <li>
                        <a href="/politicaPrivacidad.html" class="mr-4 hover:underline md:mr-6">
                            Política de Privacidad
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <a href="https://www.facebook.com/abogadoericprice" class="text-gray-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Facebook page</span>
                </a>
                <a href="https://www.instagram.com/abogadoericprice/" class="text-gray-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Instagram page</span>
                </a>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/toggle.js"></script>
    <script src="js/post.js"></script>
</body>

</html>