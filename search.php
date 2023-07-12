<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      #ques{
        min-height : 90vh;
      }
    </style>
    <title>TechyForum</title>
  </head>
  <body>

  <!-- Connecting files -->
  <?php require 'partials/_dbconnect.php' ?>
  <?php require 'partials/_header.php' ?>

  <!-- Fetching the search results -->
  

  <!-- Displaying the search results -->
  <div class="container" id="ques">
    <h1 class="my-3">Search results for '<em><?php echo $_GET['search'] ?></em>'</h1>
    <?php
    $noResult = true;
    $id = $_GET['search'];
    $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_desc) against ('$id');";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $threadid = $row['thread_id'];
      $threadtitle = $row['thread_title'];
      $threaddesc = $row['thread_desc'];
      $threadusername = $row['thread_username'];
      $url = "thread.php?threadid=". $threadid;
      $noResult = false;
      echo '<div class="my-3">
      <div class="media">
         <img src="img/userdefault.png" class="mr-3" width="55px" alt="...">
         <div class="media-body">
         <h5 class="mt-0"><a class="text-dark" href="' . $url . '">' . $threadtitle .'</a></h5>
         ' . $threaddesc .'
         
           <p><small>Posted by ' . $threadusername .'</small></p>
           </div>
      </div>
      </div>';
    }
    if ($noResult){
        echo '<div class="jumbotron jumbotron-fluid my-4">
        <div class="container">
        <h2 class="my-3">No search results found.</h2>
            <h4 class="my-3"> Suggestions:</h4>
            <ul>
              <li>  Make sure that all words are spelled correctly.</li>
              <li>  Try different keywords.</li>
              <li>  Try more general keywords.</li>
            </ul>
        </div>
      </div>';
      }
  ?>
</div>
  <!-- Footer -->
  <?php
   include 'partials/_footer.php';
  ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>