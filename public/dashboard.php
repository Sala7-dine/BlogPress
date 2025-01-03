<?php
require "config.php";

if(isset($_GET['deleteid'])){
  $actionId = $_GET['deleteid'];

  $sql = "DELETE FROM article where id_article = $actionId;";
  $result = $connexion->query($sql); 

}

if(!empty($_SESSION["id_auteur"])){
  $id = $_SESSION["id_auteur"];
  $result = mysqli_query($connexion , "SELECT * FROM auteur WHERE id_auteur = $id");
  $row = mysqli_fetch_assoc($result);
}else{
  header("Location:login.php");
}

if(isset($_POST["submit"])){

  $titre = $_POST["titre"] ?? '';
  $content = $_POST["content"] ?? '';
  $img = $_POST["image"] ?? '';
  $description = $_POST["description"] ?? '';

  if($titre != "" && $content != ""){
    $query = "INSERT INTO article(title,content , description ,  image ,id_auteur) VALUES('$titre' , '$content' ,'$description' ,  '$img' ,  $id)";
    mysqli_query($connexion , $query);

    echo "<script>alert('Artcie ajouter avec succes')</script>";

    header("Location: " . $_SERVER['PHP_SELF']);

  }else{

    echo "<script>alert('Tout les Champ Obligatoire')</script>";

  }

  unset($_POST);
}






?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body class="flex">


<nav class="bg-white shadow-lg h-screen sticky top-0 left-0 min-w-[250px] py-6 px-4 font-[sans-serif] overflow-auto">
      <a href="javascript:void(0)"><img src="./images/logo.svg" alt="logo" class='w-[160px]' />
      </a>

      <ul class="mt-6">
        <li>
          <a href="Home.php"
            class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
              viewBox="0 0 512 512">
              <path
                d="M197.332 170.668h-160C16.746 170.668 0 153.922 0 133.332v-96C0 16.746 16.746 0 37.332 0h160c20.59 0 37.336 16.746 37.336 37.332v96c0 20.59-16.746 37.336-37.336 37.336zM37.332 32A5.336 5.336 0 0 0 32 37.332v96a5.337 5.337 0 0 0 5.332 5.336h160a5.338 5.338 0 0 0 5.336-5.336v-96A5.337 5.337 0 0 0 197.332 32zm160 480h-160C16.746 512 0 495.254 0 474.668v-224c0-20.59 16.746-37.336 37.332-37.336h160c20.59 0 37.336 16.746 37.336 37.336v224c0 20.586-16.746 37.332-37.336 37.332zm-160-266.668A5.337 5.337 0 0 0 32 250.668v224A5.336 5.336 0 0 0 37.332 480h160a5.337 5.337 0 0 0 5.336-5.332v-224a5.338 5.338 0 0 0-5.336-5.336zM474.668 512h-160c-20.59 0-37.336-16.746-37.336-37.332v-96c0-20.59 16.746-37.336 37.336-37.336h160c20.586 0 37.332 16.746 37.332 37.336v96C512 495.254 495.254 512 474.668 512zm-160-138.668a5.338 5.338 0 0 0-5.336 5.336v96a5.337 5.337 0 0 0 5.336 5.332h160a5.336 5.336 0 0 0 5.332-5.332v-96a5.337 5.337 0 0 0-5.332-5.336zm160-74.664h-160c-20.59 0-37.336-16.746-37.336-37.336v-224C277.332 16.746 294.078 0 314.668 0h160C495.254 0 512 16.746 512 37.332v224c0 20.59-16.746 37.336-37.332 37.336zM314.668 32a5.337 5.337 0 0 0-5.336 5.332v224a5.338 5.338 0 0 0 5.336 5.336h160a5.337 5.337 0 0 0 5.332-5.336v-224A5.336 5.336 0 0 0 474.668 32zm0 0"
                data-original="#000000" />
            </svg>
            <span>Home</span>
        </a>
        </li>
      </ul>


     

      <div class="mt-6">
        <h6 class="text-blue-600 text-sm font-bold px-4">Information</h6>

        
        <ul class="mt-3">
        <li>
          <div id="dashboardSection"
            class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
              viewBox="0 0 512 512">
              <path
                d="M197.332 170.668h-160C16.746 170.668 0 153.922 0 133.332v-96C0 16.746 16.746 0 37.332 0h160c20.59 0 37.336 16.746 37.336 37.332v96c0 20.59-16.746 37.336-37.336 37.336zM37.332 32A5.336 5.336 0 0 0 32 37.332v96a5.337 5.337 0 0 0 5.332 5.336h160a5.338 5.338 0 0 0 5.336-5.336v-96A5.337 5.337 0 0 0 197.332 32zm160 480h-160C16.746 512 0 495.254 0 474.668v-224c0-20.59 16.746-37.336 37.332-37.336h160c20.59 0 37.336 16.746 37.336 37.336v224c0 20.586-16.746 37.332-37.336 37.332zm-160-266.668A5.337 5.337 0 0 0 32 250.668v224A5.336 5.336 0 0 0 37.332 480h160a5.337 5.337 0 0 0 5.336-5.332v-224a5.338 5.338 0 0 0-5.336-5.336zM474.668 512h-160c-20.59 0-37.336-16.746-37.336-37.332v-96c0-20.59 16.746-37.336 37.336-37.336h160c20.586 0 37.332 16.746 37.332 37.336v96C512 495.254 495.254 512 474.668 512zm-160-138.668a5.338 5.338 0 0 0-5.336 5.336v96a5.337 5.337 0 0 0 5.336 5.332h160a5.336 5.336 0 0 0 5.332-5.332v-96a5.337 5.337 0 0 0-5.332-5.336zm160-74.664h-160c-20.59 0-37.336-16.746-37.336-37.336v-224C277.332 16.746 294.078 0 314.668 0h160C495.254 0 512 16.746 512 37.332v224c0 20.59-16.746 37.336-37.332 37.336zM314.668 32a5.337 5.337 0 0 0-5.336 5.332v224a5.338 5.338 0 0 0 5.336 5.336h160a5.337 5.337 0 0 0 5.332-5.336v-224A5.336 5.336 0 0 0 474.668 32zm0 0"
                data-original="#000000" />
            </svg>
            <span>Dashboard</span>
          </div>
        </li>
        <li>
            <div id="articleSection"
              class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                viewBox="0 0 24 24">
                <path
                  d="M18 2c2.206 0 4 1.794 4 4v12c0 2.206-1.794 4-4 4H6c-2.206 0-4-1.794-4-4V6c0-2.206 1.794-4 4-4zm0-2H6a6 6 0 0 0-6 6v12a6 6 0 0 0 6 6h12a6 6 0 0 0 6-6V6a6 6 0 0 0-6-6z"
                  data-original="#000000" />
                <path d="M12 18a1 1 0 0 1-1-1V7a1 1 0 0 1 2 0v10a1 1 0 0 1-1 1z" data-original="#000000" />
                <path d="M6 12a1 1 0 0 1 1-1h10a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1z" data-original="#000000" />
              </svg>
              <span>Articles</span>
              </div>
        </li>
          <li>
            <div id="commentSection"
              class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                viewBox="0 0 512 512">
                <path
                  d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 53.687 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703zM256 269.507c-42.871 0-77.754-34.882-77.754-77.753C178.246 148.879 213.13 114 256 114s77.754 34.879 77.754 77.754c0 42.871-34.883 77.754-77.754 77.754zm170.719 134.427a175.9 175.9 0 0 0-46.352-82.004c-18.437-18.438-40.25-32.27-64.039-40.938 28.598-19.394 47.426-52.16 47.426-89.238C363.754 132.34 315.414 84 256 84s-107.754 48.34-107.754 107.754c0 37.098 18.844 69.875 47.465 89.266-21.887 7.976-42.14 20.308-59.566 36.542-25.235 23.5-42.758 53.465-50.883 86.348C50.852 364.242 30 312.512 30 256 30 131.383 131.383 30 256 30s226 101.383 226 226c0 56.523-20.86 108.266-55.281 147.934zm0 0"
                  data-original="#000000" />
              </svg>
              <span>Comments</span>
            </div>
          </li>
          
          <li>
            <a href="javascript:void(0)"
              class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                viewBox="0 0 510 510">
                <g fill-opacity=".9">
                  <path
                    d="M255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                    data-original="#000000" />
                  <path d="M267.75 127.5H229.5v153l132.6 81.6 20.4-33.15-114.75-68.85z" data-original="#000000" />
                </g>
              </svg>
              <span>Schedules</span>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)"
              class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                viewBox="0 0 512.003 512.003">
                <path
                  d="M475.244 264.501a15.592 15.592 0 0 1 0-16.998l18.698-28.74c17.032-26.178 5.556-61.348-23.554-72.491l-32.02-12.26a15.596 15.596 0 0 1-9.992-13.754l-1.765-34.24c-1.608-31.184-31.563-52.902-61.667-44.802l-33.109 8.902a15.598 15.598 0 0 1-16.167-5.254l-21.555-26.665c-19.631-24.284-56.625-24.245-76.223 0l-21.556 26.666a15.597 15.597 0 0 1-16.167 5.254l-33.111-8.902c-30.163-8.112-60.063 13.678-61.667 44.802l-1.765 34.24a15.598 15.598 0 0 1-9.992 13.753l-32.018 12.26c-29.171 11.166-40.555 46.365-23.556 72.492l18.699 28.739a15.596 15.596 0 0 1 0 16.998L18.061 293.24c-17.034 26.181-5.554 61.352 23.554 72.492l32.02 12.26a15.598 15.598 0 0 1 9.992 13.754l1.765 34.24c1.608 31.19 31.568 52.899 61.667 44.802l33.109-8.902a15.602 15.602 0 0 1 16.168 5.254l21.555 26.664c19.635 24.291 56.628 24.241 76.223 0l21.555-26.664a15.607 15.607 0 0 1 16.167-5.254l33.111 8.902c30.155 8.115 60.062-13.674 61.667-44.802l1.765-34.24a15.598 15.598 0 0 1 9.992-13.753l32.018-12.26c29.169-11.166 40.554-46.364 23.557-72.493l-18.702-28.739zm-16.806 70.02-32.02 12.26c-18.089 6.926-30.421 23.9-31.418 43.243l-1.765 34.24c-.511 9.921-10.036 16.821-19.612 14.249l-33.111-8.902c-18.705-5.032-38.661 1.455-50.836 16.518l-21.553 26.664c-6.245 7.725-18.009 7.709-24.242 0l-21.553-26.664c-9.438-11.676-23.55-18.198-38.132-18.198-4.229 0-8.499.548-12.706 1.68l-33.111 8.902c-9.596 2.576-19.1-4.348-19.612-14.249l-1.765-34.24c-.997-19.343-13.33-36.318-31.418-43.243l-32.02-12.261c-9.277-3.552-12.896-14.744-7.49-23.053l18.698-28.739c10.563-16.236 10.563-37.218 0-53.452l-18.698-28.739c-5.418-8.326-1.768-19.509 7.491-23.054l32.02-12.26c18.089-6.926 30.421-23.9 31.418-43.243l1.765-34.24c.511-9.921 10.036-16.821 19.612-14.249l33.111 8.902c18.705 5.031 38.66-1.455 50.836-16.518l21.555-26.665c6.245-7.724 18.01-7.708 24.241 0l21.555 26.666c12.178 15.063 32.129 21.549 50.836 16.517l33.111-8.902c9.595-2.577 19.1 4.348 19.612 14.249L395 121.98c.997 19.343 13.33 36.318 31.418 43.243l32.021 12.261c9.276 3.55 12.895 14.744 7.49 23.053l-18.697 28.738c-10.565 16.235-10.565 37.217-.001 53.453l18.698 28.738c5.416 8.328 1.768 19.51-7.491 23.055z"
                  data-original="#000000" />
                <path
                  d="M339.485 170.845c-6.525-6.525-17.106-6.525-23.632 0L159.887 326.811c-6.525 6.525-6.525 17.106.001 23.632 3.263 3.263 7.54 4.895 11.816 4.895s8.554-1.632 11.816-4.895l155.966-155.967c6.526-6.524 6.526-17.105-.001-23.631zm-151.071-4.895c-18.429 0-33.421 14.993-33.421 33.421 0 18.429 14.994 33.421 33.421 33.421 18.429 0 33.421-14.993 33.421-33.421.001-18.428-14.992-33.421-33.421-33.421zm122.545 122.545c-18.429 0-33.421 14.993-33.421 33.421 0 18.429 14.993 33.421 33.421 33.421s33.421-14.993 33.421-33.421c.001-18.428-14.992-33.421-33.421-33.421z"
                  data-original="#000000" />
              </svg>
              <span>Promote</span>
            </a>
          </li>
        </ul>
      </div>

    

      <div class="mt-6">
        <h6 class="text-blue-600 text-sm font-bold px-4">Actions</h6>
        <ul class="mt-3">
          <li>
            <a href="javascript:void(0)"
              class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                viewBox="0 0 512 512">
                <path
                  d="M437.02 74.98C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512s132.668-26.629 181.02-74.98C485.37 388.668 512 324.379 512 256s-26.629-132.668-74.98-181.02zM111.105 429.297c8.454-72.735 70.989-128.89 144.895-128.89 38.96 0 75.598 15.179 103.156 42.734 23.281 23.285 37.965 53.687 41.742 86.152C361.641 462.172 311.094 482 256 482s-105.637-19.824-144.895-52.703zM256 269.507c-42.871 0-77.754-34.882-77.754-77.753C178.246 148.879 213.13 114 256 114s77.754 34.879 77.754 77.754c0 42.871-34.883 77.754-77.754 77.754zm170.719 134.427a175.9 175.9 0 0 0-46.352-82.004c-18.437-18.438-40.25-32.27-64.039-40.938 28.598-19.394 47.426-52.16 47.426-89.238C363.754 132.34 315.414 84 256 84s-107.754 48.34-107.754 107.754c0 37.098 18.844 69.875 47.465 89.266-21.887 7.976-42.14 20.308-59.566 36.542-25.235 23.5-42.758 53.465-50.883 86.348C50.852 364.242 30 312.512 30 256 30 131.383 131.383 30 256 30s226 101.383 226 226c0 56.523-20.86 108.266-55.281 147.934zm0 0"
                  data-original="#000000" />
              </svg>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a href="logout.php"
              class="text-black hover:text-blue-600 text-sm flex items-center hover:bg-blue-50 rounded px-4 py-3 transition-all">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4"
                viewBox="0 0 6.35 6.35">
                <path
                  d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                  data-original="#000000" />
              </svg>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </div>


</nav>

<section class="px-12 py-12 w-full flex flex-col">
      
      <!-------------------------------------------- Dashboard ------------------------------------------------------>
      
      <div class="dashboard">
        
        <div class="w-full flex justify-between px-2">
          
          <h1 class="text-balck text-4xl font-extrabold">Hello <?php echo $row["username"]; ?></h1>
        

        </div>

        <div class="flex max-lg:flex-wrap w-full gap-2 mt-12">

            <div class="bg-gray-200 w-4/12 py-5 flex flex-col items-start gap-4 pl-10 rounded-xl relative">
                <img class="absolute bottom-6 right-6" src="./images/Group 11.svg" alt="">
                <div class="flex justify-between items-center gap-x-3">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    <h1 class="text-balck text-lg font-medium" >Total Article</h1>
                </div>      

                <h1 class="text-balck font-bold text-4xl">
                <?php
                    $totalLikes = mysqli_query($connexion , "SELECT COUNT(*) as totale FROM article WHERE id_auteur = $id");
                    $res = mysqli_fetch_assoc($totalLikes);
                    echo $res["totale"];
                  ?>
                </h1>

                <div class="flex justify-center items-center gap-2">
                    <h3 class="bg-[#0ee87bf2] text-[10px] rounded-xl w-10 text-center text-white text-bold">+21%</h3>
                    <p class="text-balck text-center text-sm">Last month</p>
                </div>
            </div>
        
            <div class="bg-gray-200 w-4/12 py-5 flex flex-col items-start gap-4 pl-10 rounded-xl relative">
              <img class="absolute bottom-6 right-6" src="./images/Group 30.svg" alt="">
                <div class="flex justify-between items-center gap-x-3">
                    <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                    <h1 class="text-balck text-lg font-medium">Totale views</h1>
                </div>      

                <h1 class="text-balck font-bold text-4xl">
                <?php
                    $totalLikes = mysqli_query($connexion , "SELECT SUM(views) as totaleViews FROM article WHERE id_auteur = $id");
                    $res = mysqli_fetch_assoc($totalLikes);
                    echo $res["totaleViews"];
                  ?>
                </h1>

                <div class="flex justify-center items-center gap-2">
                    <h3 class="bg-[#0ee87bf2] text-[10px] rounded-xl w-10 text-center text-white text-bold">+10%</h3>
                    <p class="text-balck text-center text-sm">Last month</p>
                </div>
            </div>
        
            <div class="bg-gray-200 w-4/12 py-5 flex flex-col items-start gap-4 pl-10 rounded-xl relative">
              <img class="absolute bottom-6 right-6" src="./images/Group 29.svg" alt="">
                <div class="flex justify-between items-center gap-x-3">
                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                    <h1 class="text-balck text-lg font-medium">Totale Likes</h1>
                </div>      

                <h1 class="text-balck font-bold text-4xl">
                <?php
                    $totalLikes = mysqli_query($connexion , "SELECT SUM(likes) as totaleLikes FROM article WHERE id_auteur = $id");
                    $res = mysqli_fetch_assoc($totalLikes);
                    echo $res["totaleLikes"];
                  ?>
                </h1>

                <div class="flex justify-center items-center gap-2">
                    <h3 class="bg-[#0ee87bf2] text-[10px] rounded-xl w-10 text-center text-white text-bold">+33%</h3>
                    <p class="text-balck text-center text-sm">Last month</p>
                </div>
            </div>
        
            
          </div>
          

          <div class="mt-12 flex flex-col justify-center items-center m-auto gap-24 w-4/6">
            <canvas id="myChart1"></canvas>
            <canvas id="myChart2"></canvas>
          </div>
      

      </div>

      <!--------------------------------------------- Articles ------------------------------------------------------->

      <div class="artcile hidden">

        <div class="w-full flex justify-between px-2">
          
          <h1 class="text-black text-4xl font-extrabold">Articles</h1>

        </div>
        
          <div class="flex justify-between py-10 px-1">

            <h1 class="text-gray-500 text-xl font-bold">All Articles.</h1>

            <div class="flex gap-4"> 
   
             <div class="relative font-[sans-serif] w-max">
                <button type="button" id="dropdownToggle"
                  class="px-5 py-2.5 rounded text-white text-sm font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">
                  Filter by Title
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-white inline ml-3" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                      d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                      clip-rule="evenodd" data-original="#000000" />
                  </svg>
                </button>
          
                <ul id="dropdownMenu" class='absolute hidden shadow-lg bg-white py-2 z-[1000] min-w-full w-max rounded max-h-96 overflow-auto'>
                  <li class='py-2.5 px-5 hover:bg-blue-50 text-white text-sm cursor-pointer'>Facile</li>
                  <li class='py-2.5 px-5 hover:bg-blue-50 text-white text-sm cursor-pointer'>Moyenne</li>
                  <li class='py-2.5 px-5 hover:bg-blue-50 text-white text-sm cursor-pointer'>Difficile</li>
                </ul>
              </div>
             <div class="relative font-[sans-serif] w-max">
                <button type="button" id="dropdownToggle"
                  class="px-5 py-2.5 rounded text-white text-sm font-semibold border-none outline-none bg-blue-600 hover:bg-blue-700 active:bg-blue-600">
                  Filter by Date
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3 fill-white inline ml-3" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                      d="M11.99997 18.1669a2.38 2.38 0 0 1-1.68266-.69733l-9.52-9.52a2.38 2.38 0 1 1 3.36532-3.36532l7.83734 7.83734 7.83734-7.83734a2.38 2.38 0 1 1 3.36532 3.36532l-9.52 9.52a2.38 2.38 0 0 1-1.68266.69734z"
                      clip-rule="evenodd" data-original="#000000" />
                  </svg>
                </button>
          
              </div>


              <div class="font-[sans-serif] w-max">
                <button type="button" id="ajoutBtn"
                  class="flex justify-center items-center gap-2 px-5 py-2.5 rounded text-white text-sm font-medium border-none outline-none bg-green-600 hover:bg-green-700 active:bg-green-600">
                  <span>Ajouter Article</span>  
                  <i class="fa fa-plus" style="font-size:16px"></i>
                </button>
              </div>
  
            </div>

            <!-- Modal Ajouter Article -->

            <div id="ajoutModalArticle"
                    class="fixed inset-0 p-4 hidden flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
            <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 relative">
                <div class="flex items-center">
                    <h3 class="text-blue-600 text-3xl font-bold flex-1 text-center w-full">Ajouter Article</h3>

                    <div id="close1"> 
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500"
                      viewBox="0 0 320.591 320.591">
                      <path
                          d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                          data-original="#000000"></path>
                      <path
                          d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                          data-original="#000000"></path>
                      </svg>
                    </div>
                    
                </div>

                <form class="space-y-4 mt-8" method="post" autocomplete="off">
                    <div>
                        <labe class="text-gray-800 text-sm mb-2 block">Titre</labe>
                        <input type="text" name="titre" placeholder="Saisir le titre..."
                            class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                    </div>

                    <div>
                        <labe class="text-gray-800 text-sm mb-2 block">Image</labe>
                        <input type="text" name="image" placeholder="Saisir L'image..."
                            class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                    </div>

                    <div>
                        <labe class="text-gray-800 text-sm mb-2 block">Content</labe>
                        <input type="text" name="content" placeholder="Saisir content..."
                            class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                    </div>

                    <div>
                        <labe class="text-gray-800 text-sm mb-2 block">Description</labe>
                        <textarea placeholder='Saisir la description...' name="description"
                            class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" rows="3"></textarea>
                    </div>

                    <div class="flex justify-end gap-4 !mt-8">
                        <button type="button" id="ajouteCancelQuiz"
                            class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                        <button type="submit" id="ajoutQuizBtn" name="submit"
                            class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Ajouter</button>
                    </div>


                </form>
            </div>
            </div>


            

            <!-- Fin Ajout Article -->
        

            

          </div>

          <div class="bg-gray-100 md:px-10 px-4 py-12 font-[sans-serif]">
      <div class="max-w-5xl max-lg:max-w-3xl max-sm:max-w-sm mx-auto">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
         
         <?php 

          $articles = mysqli_query($connexion , "SELECT * FROM article WHERE id_auteur = $id;");

          foreach($articles as $article){

            echo '
              <div class="bg-white rounded overflow-hidden">
                <img src="https://readymadeui.com/Imagination.webp" alt="Blog Post 3" class="w-full h-52 object-cover" />
                <div class="p-6">
                  <h3 class="text-lg font-bold text-gray-800 mb-3">'.$article["title"].'</h3>
                  <p class="text-gray-500 text-sm">'.$article["content"].'</p>
                  <p class="text-orange-500 text-[13px] font-semibold mt-4">'.$article["created_at"].'</p>
                  <form method="GET">
                    <a href="update.php?updateId='.$article["id_article"].'" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-green-500 hover:bg-green-600 text-white text-[13px]" >Update</a>
                    <a href="dashboard.php?deleteid='.$article["id_article"].'" class="mt-4 inline-block px-4 py-2 rounded tracking-wider bg-red-500 hover:bg-red-600 text-white text-[13px]">Delete</a>
                  </form>
                </div>
              </div>
            ';
          }

          ?>

        </div>
      </div>
    </div>

          
      </div>

      <!--------------------------------------------- Comments   ------------------------------------------------------->

      <div class="comments hidden">
        
        <div class="w-full flex justify-between px-2">
          
          <h1 class="text-black text-4xl font-extrabold">Commanets</h1>

        </div>
        
          <div class="flex justify-between py-10 px-1">

            <h1 class="text-gray-400 text-3xl font-bold">All comments</h1>

          </div>

          <div class="overflow-x-auto font-[sans-serif]">
          <table class="min-w-full bg-white">
              <thead class="bg-gray-800 whitespace-nowrap">
                <tr>
                  <th class="p-4 text-left text-sm font-medium text-white">
                    Username
                  </th>
                  <th class="p-4 text-left text-sm font-medium text-white">
                    Email
                  </th>
                  <th class="p-4 text-left text-sm font-medium text-white">
                    Comment
                  </th>
                  <th class="p-4 text-left text-sm font-medium text-white">
                    Created at
                  </th>
                  <th class="p-4 text-left text-sm font-medium text-white">
                    Actions
                  </th>
                </tr>
              </thead>

        <tbody class="whitespace-nowrap">
          <?php 
            $comments = mysqli_query($connexion , "SELECT * FROM comments c join article a on c.id_article = a.id_article join auteur au on a.id_auteur = au.id_auteur where au.id_auteur = $id");
            while($resul = mysqli_fetch_assoc($comments)){
              echo '
                   <tr class="even:bg-blue-50">
                      <td class="p-4 text-sm text-black">
                        '.$resul["visiteur_name"].'
                      </td>
                      <td class="p-4 text-sm text-black">
                        '.$resul["visiteur_email"].'
                      </td>
                      <td class="p-4 text-sm text-black">
                        '.$resul["content"].'
                      </td>
                      <td class="p-4 text-sm text-black">
                        '.$resul["created_at"].'
                      </td>
                      <td class="p-4">
                      <form method="GET">
                        <a href="comments.php?idComment='.$resul["id_comments"].'" class="mr-4" title="Delete">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                            <path
                              d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                              data-original="#000000" />
                            <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                              data-original="#000000" />
                          </svg>
                        </a>
                        </form>
                      </td>
                    </tr>    
              ';
            }
          ?>
        </tbody>
      </table>
          </div>


       

      </div>


    </section>



<script src="dashboard.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

<?php 

  $select = mysqli_query($connexion , "SELECT COUNT(*) as totaleArticle , SUM(views) as totaleViews , SUM(likes) as totaleLikes FROM article where id_auteur = $id");
  $values = mysqli_fetch_assoc($select);

  $comment = mysqli_query($connexion , "SELECT COUNT(id_comments) as totalComments FROM comments c join article a on c.id_article = a.id_article join auteur au on a.id_auteur = au.id_auteur where au.id_auteur = $id");
  $commentValue = mysqli_fetch_assoc($comment);

?>

var blogData = [

      <?php

          echo $values["totaleArticle"].','.$values["totaleViews"].','.$values["totaleLikes"].','.$commentValue["totalComments"];

        
      ?>

];

</script>


<script>

  const ctx1 = document.getElementById('myChart1');
  const ctx2 = document.getElementById('myChart2');

  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: ['Article' , 'Likes' , 'Views', 'Comments'],
      datasets: [{
        label: 'Total',
        data: blogData,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });


  new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Article' , 'Likes' , 'Views', 'Comments'],
      datasets: [{
        label: 'Total',
        data: blogData,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</body>
</html>


