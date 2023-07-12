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

  <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE `category_id` = $id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $catid = $row['category_id'];
      $catname = $row['category_name'];
      $catdesc = $row['category_desc'];
    }
  ?>

<?php
    $showAlert = false;
    $id = $_GET['catid'];
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST'){
      $th_title = $_POST['title'];
      $th_title = str_replace("<", "&lt;", "$th_title");
      $th_title = str_replace(">", "&gt;", "$th_title");
      $th_desc = $_POST['desc'];
      $th_desc = str_replace("<", "&lt;", "$th_desc");
      $th_desc = str_replace(">", "&gt;", "$th_desc");
      $th_username = $_SESSION['username'];
      $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_username`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$th_username', current_timestamp())";
      $result = mysqli_query($conn, $sql);
      $showAlert = true;
      if($showAlert){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your thread has been added successfully.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        ';
      }    }
?>
    
  
  <div class="container my-3">
  <div class="jumbotron">
  <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
  <p class="lead"><?php echo $catdesc; ?></p>
  <hr class="my-4">
  <p>This forum is for sharing knowledge about <?php echo $catname; ?> with each other.</p>
  <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
</div>
  </div>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  echo '<div class="container">
  <h1 class="my-3">Start a Discussion</h1>
    <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
      <div class="form-group">
        <label for="title"><h4>Problem Title</h4></label>
        <input type="text" class="form-control" id="title" name="title">
        <small class="form-text text-muted">Keep your question short and crisp.</small>
      </div>
      <div class="form-group">
        <label for="desc"><h4>Problem description</h4></label>
        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-success">Submit</button>
    </form>
  </div>';
}
  else{
    echo '<div class="container">
    <h1 class="my-3">Start a Discussion</h1>
    <p class="lead">You are not logged in. Please login to start a discussion</p>
  </div>';
  }
?>





  <div class="container" id="ques">
    <h1 class="my-3">Browse Questions</h1>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
    $noResult = true;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
      $noResult = false;
      $threadid = $row['thread_id'];
      $threadtitle = $row['thread_title'];
      $threaddesc = $row['thread_desc'];
      $threadusername = $row['thread_username'];
      $time = $row['timestamp'];
   
    echo '<div class="my-3">
     <div class="media">
        <img src="img/userdefault.png" class="mr-3" width=55px alt="...">
        <div class="media-body">
        <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid=' . $threadid . '">'.$threadtitle.'</a></h5>
          '.$threaddesc.'        
          <p><small>Posted by '.$threadusername.' at '.$time.'</small></p>
          </div>
     </div>
    </div>' ;

  }
  if ($noResult){
    echo '<div class="jumbotron jumbotron-fluid my-4">
    <div class="container">
      <h2>No Question</h2>
      <p class="lead">Be the first to ask a question.</p>
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