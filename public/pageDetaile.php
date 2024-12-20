<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['idArticle']) && is_numeric($_GET['idArticle'])) {
        $idArticle = intval($_GET['idArticle']);

        $stmt = $connexion->prepare("SELECT * FROM article a JOIN auteur au ON au.id_auteur = a.id_auteur WHERE a.id_article = ?");
        $stmt->bind_param('i', $idArticle);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                // Affichage du champ "name" s'il est défini
                //echo htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
                $name =  $_POST["name"];
                $email = $_POST["email"];
                $comment = $_POST["comment"];

                mysqli_query($connexion , "INSERT INTO comments( content, visiteur_name , visiteur_email , id_article) VALUES('$comment' , '$name' , '$email' , '$idArticle')");


                header("Location: pageDetaile.php?idArticle=" . $idArticle);

                

        }

        $stmt->close();
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="max-w-5xl mx-auto">

<div class="bg-gradient-to-r from-blue-700 to-[#B06AB3] font-sans px-6 py-12">
      <div class="container mx-auto flex flex-col justify-center items-center text-center">
        <h2 class="text-white sm:text-4xl text-3xl font-bold mb-4"><?php echo $row["title"] ?></h2>
        <p class="text-white text-base text-center mb-8"><?php echo $row["content"] ?></p>
        <p class="text-white">By <?php echo $row["username"] ?> | <span class="text-gray-200">Posted on <?php echo $row["created_at"] ?></span></p>
        <a href="Home.php" class="mt-5 bg-white pointer text-sm text-blue-600 font-semibold py-3 px-6 rounded-lg hover:bg-slate-100">
            Back Home
        </a>

      </div>
    </div>
  <!-- Article Header -->
  <div class="border-b pb-6 mb-6">
   
    <div class="mt-4 flex items-center space-x-6">
      <!-- Views -->
      <div class="flex items-center text-gray-500">
        <span class="mr-2">👁️</span>
        <span><?php echo $row["views"] ?> Views</span>
      </div>
      <!-- Likes -->
      <div class="flex items-center text-gray-500">

        <form  method="GET"> 
            <a <?php echo 'href="likes.php?idArticle='.$idArticle.'"';?>  type="submit" name="like" class="text-blue-500 hover:text-blue-700">
            <span class="mr-2">❤️</span>
                Like
        </a>
        </form>
        
        <span class="ml-2"><?php echo $row["likes"] ?> Likes</span>
      </div>
    </div>
  </div>

  <!-- Article Content -->
  <div class="mb-8">
    <p class="text-lg text-gray-800">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. 
    </p>
    <p class="text-lg text-gray-800 mt-4">
      Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.
    </p>
  </div>

  <!-- Comment Section -->
  <div class="border-t pt-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Comments</h2>
    
    <div class="mb-6">
      <form method="POST">
        <div class="mb-4">
          <input type="text" name="name" class="w-full p-4 border rounded-lg shadow-sm" placeholder="Your Name...">
        </div>
        <div class="mb-4">
          <input type="email" name="email" class="w-full p-4 border rounded-lg shadow-sm" placeholder="Your email...">
        </div>
        <div class="mb-4">
          <textarea name="comment" class="w-full p-4 border rounded-lg shadow-sm" rows="4" placeholder="Leave a comment..."></textarea>
        </div>
        <div class="flex justify-between">
          <button type="submit" name="add" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-700">Post Comment</button>
        </div>
      </form>
    </div>
    
    <div class="max-w-xm mx-auto bg-gray-100 p-6 font-[sans-serif] rounded-md">
      <div>
        <h3 class="font-bold text-base">All Commentts</h3>
        <div class="mt-6 space-y-4">


        <?php

            $commentaire = mysqli_query($connexion , "SELECT * FROM article a JOIN comments c on a.id_article = c.id_article where a.id_article = $idArticle");

            while($roww = mysqli_fetch_assoc($commentaire)){

                echo '
                    <div class="flex items-start">
                        <img src="https://readymadeui.com/team-2.webp" class="w-12 h-12 rounded-full border-2 border-white" />
                        <div class="ml-3">
                                <h4 class="text-gray-800 text-sm font-bold">'.$roww["visiteur_name"].'</h4>
                                <div class="flex space-x-1 mt-1">
                                    <svg class="w-3 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-3 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-3 fill-[#facc15]" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-3 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-3 fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <p class="text-gray-500 text-xs !ml-2 font-semibold">2 mins ago</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-3">'.$roww["content"].'</p>
                                </div>
                            </div>
                
                ';


            }

            
        
        
        ?>
          




        </div>
      </div>
    </div>
  </div>
</div>
    
</body>
</html>