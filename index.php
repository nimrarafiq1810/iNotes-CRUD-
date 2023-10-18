<?php
$servername="localhost";
$username="root";
$password="";
$database="notes";

$conn = mysqli_connect($servername,$username,$password,$database);
if($conn)
{
  echo 'CONNECTION IS SUCESSFUL';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PHP CRUD</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    
  </head>
  <body>

  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
 Edit Modal
</button>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">iNotes</a>
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
              <a class="nav-link" href="#">Contact Us</a>
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
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
   $title= $_POST['title'];  
   $description=$_POST['description'];
  $sql= "INSERT INTO `notesdata` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($conn,$sql);

if($result)
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  your note is added successfully
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
else{
    echo 'sorry there is issue in submitting data';
}
  }
?>
    <div class="container">
      <h2>ADD YOUR NOTE</h2>
      <form action="/CRUD/index.php" method="POST">
        <div class="mb-3">
          <label for="title" class="form-label">Note Title</label>
          <input
            type="text"
            class="form-control"
            id="title"
            name="title"
            aria-describedby="emailHelp"
          />
        </div>

        <div class="mb-3">
          <label for="description">Note Description</label>
          <textarea
            class="form-control"
            id="description"
            name="description"
            rows="3"
          ></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add in List</button>
      </form>
    </div>
    <div class="container">


<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
      
      $sql= "SELECT * FROM `notesdata`";
      $result=mysqli_query($conn,$sql);
      $num= mysqli_num_rows($result);
    
      if($num>0)
      {
          for($num; $num>0;$num--){
         $row= mysqli_fetch_assoc($result);
         echo "<tr>
         <th scope='row'>".$row['sr.no']."</th>
         <td>".$row['title']."</td>
         <td>".$row['description']."</td>
         <td><a href='/edit'>Edit </a> / <a href='/delete'>Delete </a></td>
       </tr>";
          };
        
      };
      
  
      ?>
 

  </tbody>
</table>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>let table = new DataTable('#myTable');</script>
  </body>
</html>
