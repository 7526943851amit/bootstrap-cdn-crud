<!-- data base connection -->
<?php
$insert = false;
$servername = 'localhost';
$username = "root";
$password = "";
$database = "gurkaran";

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn) {
  die("data is not connected" . mysqli_connect_error());
}
// ends

// my sql query
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['update'])){
        $sno = $_POST['serialnoedit']; // Add this line to fetch sno from the form
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
        $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";
        $result_update = mysqli_query($conn, $sql);
        if($result_update){
            $record_update = "Record updated successfully";
        } else {
            echo "We could not update the data";
        }
    }
    
  if(isset($_POST['save'])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);
    if($result){
      $insert = true;
    }
    else{
      echo "data is not connected after post" . mysqli_error($conn);
  }
}   
// }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title class="text-center">PHP CRUD</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  </head>
  <script>
$(document).ready( function () {
    $('#myTable').DataTable();
});
    </script>
  <body>
    <!-- edit modal -->
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
  Edit Modal
</button> -->

<!--update Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editmodalLabel">Edit Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
        <input type="hidden" name="serialnoedit" id ="serialnoedit">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Note Description</label>
          <textarea type="textarea" id="descriptionEdit" name="descriptionEdit" class="form-control" id="exampleInputPassword1">
            </textarea>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary" name="update"
        >Update </button>
      
        
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="save">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- edit modal ends -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">PHP CRUD</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" href="#">Contact US</a>
            </li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>
    <?php
  if($insert) { 
   echo "Data is inserted";
    }
    ?>
    <div class="container my-3">
      <h2>Add Note</h2>
      <form action="" method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Note Description</label>
          <textarea type="textarea" id="description" name="description" class="form-control" id="exampleInputPassword1">
            </textarea>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">insert Note</button>
      </form>
    </div>
    <div class="container my-5">
      <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
      $sql = "SELECT * FROM `notes`";
      $result = mysqli_query($conn, $sql);
      $sno = 0;
      while ($row = mysqli_fetch_assoc($result)) {
      $sno = $sno +1;
      echo "<tr>
        <th scope='row'>". $sno . "</th>
        <td>". $row['title'] . "</td>
        <td>". $row['description'] . "</td>
        <td> <button class='btn btn-sm btn-primary edit' id=".$row['sno'].">Edit</button> 
        
            
        <button class='btn btn-sm btn-primary delete'>Delete</button> </td>
      </tr>";
      }
      ?>
  </tbody>
</table>
    </div>
    <hr>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    <script>
    edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((el) => {
    el.addEventListener("click", (e) => {
        console.log("edit", e.target.parentNode.parentNode);
        tr = e.target.parentNode.parentNode
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        descriptionEdit.value = description;
        titleEdit.value = title;
        serialnoedit.value = e.target.id;
        console.log(e.target.id);
        $('#editmodal').modal('toggle');
    })
});

    </script>
  </body>
</html>