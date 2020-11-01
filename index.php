<?php
// INSERT INTO `notes` (`sno`, `title`, `description`, `timestamp`) VALUES ('1', 'Study ML', 'Shivam you need to study for Machine Learning Reinforcment part and study CNN also Delete this after studying', '2020-09-12 22:10:29');   
$insert = false;
$update = false;
$delete = false;

$username = 'epiz_27100336';
$password = '5TRPiGn0zOB';
$servername = 'sql210.epizy.com';
$database = 'epiz_27100336_assi';
$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("Connection failed because ".mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno`=$sno";
  $result = mysqli_query($conn,$sql);
}
// echo $_SERVER['REQUEST_METHOD'];
// echo $_POST['snoEdit'];
// echo $_GET['update'];
// exit();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['snoEdit'])){
    // echo $sno;
    $sno = $_POST['snoEdit'];
    // echo $sno;
    $title = $_POST['edittitle'];
    $description = $_POST['editdescription'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d h:i:s');
    $sql = "UPDATE `notes` SET `title`='$title',`description`='$description' WHERE `notes`.`sno` =$sno";   
    $result = mysqli_query($conn,$sql);
    if($result){
      $update = true;
      
    }
    else{
      echo "We cannot update the query";

    }

  }
  else{
  $title = $_POST['title'];
  $description = $_POST['description'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d h:i:s');
  $sql = "INSERT INTO `notes` ( `title`, `description`, `timestamp`) VALUES ( '$title', '$description', '$date')";   
  $result = mysqli_query($conn,$sql);
  if($result){
    // echo "The record has been successfully inserted";
    // echo '<br>';
    $insert = true;
    
  }
  else{
    echo "The record was not inserted because ".mysqli_error($conn);
  }
}
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  
    
    
    <title>Project1 crud</title>
   
</head>

<body>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit Modal
</button> -->

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action= '/crud/index.php' method = 'post'>
          <input type="hidden" name="snoEdit" id = "snoEdit">
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="edittitle" aria-describedby="emailHelp" name="edittitle">

            </div>

            <div class="form-group">
                <label for="description">Note Description</label>
                <textarea name="editdescription" class="form-control" id="editdescription" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Note</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <!-- <h1>Crud applications</h1> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">PHP crud</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li> -->
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    if($insert){
      echo "<div class='alert alert-warning alert-primary fade show' role='alert'>
      <strong>Success!</strong> Your notes have been saved successfully   
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    if($delete){
      echo "<div class='alert alert-warning alert-primary fade show' role='alert'>
      <strong>Success!</strong> Your notes have been deleted successfully   
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
      if($update){
      echo "<div class='alert alert-warning alert-primary fade show' role='alert'>
      <strong>Success!</strong> Your notes have been updated successfully   
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    
    ?>
    <div class="container my-3">
        <h3>Add a Note</h3>
        <form action= '/crud/index.php?update=true' method = 'post'>
            <div class="form-group">
                <label for="title">Note Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp" name="title">

            </div>

            <div class="form-group">
                <label for="description">Note Description</label>
                <textarea name="description" class="form-control" id="descriptiond" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>

    </div>
    <div class="container">
        <?php
        $sql = "SELECT * FROM `employeerinfo`";
        $result = mysqli_query($conn,$sql);
        // echo $result;
        // $num = mysqli_num_rows($result);
        // $date = date("F dS Y, g:i A");
        // echo $num;
   
        ?>
        <table class="table" id= "myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col">SNO</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Time</th>
      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($conn,$sql);
    // echo $result;
    $num = mysqli_num_rows($result);
    $date = date("F dS Y, g:i A");
    // echo $num;
    $sno = 1;
    while($row = mysqli_fetch_assoc($result)){
        // echo $row['sno']. " Hello Shivam do you remember ".$row['title']." for details ".$row['description']."also you added this note on ".$row['timestamp'];
    echo "<tr>
    <th scope='row'>".$sno."</th>
    <td>".$row['title']."</td>
    <td>".$row['description']."</td>
    <td>".$row['timestamp'  ]."</td>
    <td>    <button class='delete btn btn-sm btn-primary' id=d".$row['sno']." >Delete</button> <button class='edit my-3 btn btn-sm btn-primary' id= ".$row['sno']." >Edit</button></td>
  </tr>";
    $sno = $sno+1;
    }

    
    ?>
    
  </tbody>
</table>





    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        console.log(title);
        description = tr.getElementsByTagName("td")[1].innerText
        console.log(description);
        editdescription.value = description;
        edittitle.value = title;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        console.log(snoEdit.value);
        $('#editModal').modal('toggle');

      });
    });
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element)=>{
      element.addEventListener("click",(e)=>{
        console.log("edit ");
        sno = e.target.id.substr(1,)
        if(confirm("Press a Button!") ){
          console.log("yes");
          window.location = `index.php?delete=${sno}`;
        }       
        else{
          console.log("no");
        }

      });
    });
    </script>
</body>

</html>