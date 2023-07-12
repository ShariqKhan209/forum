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
        min-height : 433px;
      }
    </style>
    <title>TechyForum</title>
  </head>
  <body>

  <!-- Connecting files -->
  <?php require 'partials/_dbconnect.php' ?>
  <?php require 'partials/_header.php' ?>


<!-- The upper jumbotron which contains the question title and description -->
  <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $threadid = $row['thread_id'];
      $threadtitle = $row['thread_title'];
      $threaddesc = $row['thread_desc'];
      $threadusername = $row['thread_username'];
    }
  ?>

<!-- Storing the inputted comments in database -->
<!-- Putting this below header because of the alert message it shows below header -->
<?php
  $showAlert = false;
    $id = $_GET['threadid'];
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST'){
      $cmnt_desc = $_POST['desc'];
      $cmnt_desc = str_replace("<", "&lt;", "$cmnt_desc");
      $cmnt_desc = str_replace(">", "&gt;", "$cmnt_desc");
      $username = $_SESSION['username'];
      $sql = "INSERT INTO `comments` (`comment_desc`, `thread_id`, `comment_by`, `timestamp`) VALUES ('$cmnt_desc', '$id', '$username', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      $showAlert = true;
      if($showAlert){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your comment has been added successfully.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        ';}
     }
?>

<div class="container my-3">
  <div class="jumbotron">
  <h1 class="display-4"><?php echo $threadtitle; ?></h1>
  <hr class="my-4">
  <p><?php echo $threaddesc; ?></p>
  <p>Posted by:<em> <?php echo $threadusername; ?></em></p>  
</div>
  </div>


<!-- Input form to get the input of comments -->
  <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  echo '<div class="container">
  <h1 class="my-3">Enter your Comment here</h1>
    <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
      <div class="form-group">
        <label for="desc"><h4>Solution description</h4></label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <input type="hidden" id="username" name="username">
      <button type="submit" class="btn btn-primary btn-success">Submit</button>
    </form>
  </div>';
}
  else{
    echo '<div class="container">
    <h1 class="my-3">Enter your Comment here</h1>
    <p class="lead">You are not logged in. Please login to enter a comment</p>
  </div>';
  }
?>


<!-- Displaying the comments from the database -->
  <div class="container my-3" id="ques">
    <h1>Discussions</h1>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
    $noResult = true;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $noResult = false;
      $commentid = $row['comment_id'];
      $threaddesc = $row['comment_desc'];
      $cmnt_username = $row['comment_by'];
      $time = $row['timestamp'];
   
    echo '<div class="my-3">
     <div class="media">
        <img src="img/userdefault.png" class="mr-3" width=55px alt="...">
        <div class="media-body">
          '.$threaddesc.'        
          <p><small>Posted by '.$cmnt_username.' at '.$time.'</small></p>
          </div>
     </div>
    </div>' ;

  }
  if ($noResult){
    echo '<div class="jumbotron jumbotron-fluid my-4">
    <div class="container">
      <h2>No Discussions</h2>
      <p class="lead">Be the first one to answer.</p>
    </div>
  </div>';
  }
  ?>
  </div>


    <!-- <div class="container mb-2">
     <div class="media">
        <img src="img/userdefault.png" class="mr-3" width=65px alt="...">
        <div class="media-body">
        <h5 class="mt-0">Media heading</h5>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
     </div>
    </div> -->

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