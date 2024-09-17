<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_GET['action'])&& $_GET['action']=='delete')
{
    delfeedback();
}

// Pagination variables
$linesPerPage = 10; // Number of lines to display per page
$current = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page number

// Calculate the offset for the query
$offset = ($current - 1) * $linesPerPage;

// Fetch feedbacks with pagination
$query = "SELECT * FROM feedback ORDER BY feedbackid DESC LIMIT $offset, $linesPerPage";
$go_query = mysqli_query($conn, $query);

// Count total feedbacks
$totalFeedbacksQuery = "SELECT COUNT(*) AS total FROM feedback";
$totalFeedbacksResult = mysqli_query($conn, $totalFeedbacksQuery);
$totalFeedbacksRow = mysqli_fetch_assoc($totalFeedbacksResult);
$totalFeedbacks = $totalFeedbacksRow['total'];

// Calculate total pages
$totalPages = ceil($totalFeedbacks / $linesPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    body{
        background-color: #ebf2fa !important;
    }
</style>
<body>
<?php include 'header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Welcome Admin,
                    <span class="text-danger">
                        <?php 
                        if(isset($_SESSION['admin']))
                        {echo $_SESSION['admin'];}
                        else{$_SESSION['admin']="";}
                        ?>
                    </span>
                </h2>
            </div>
        </div>
        <div class="mt-3 d-flex justify-content-center px-5 row">
            <div class="col-md-9">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="10%" scope="col">ID</th>
                            <th width="75%" scope="col">User Feedbacks</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                        <?php
                            if(isset($_GET['id'])&& $_GET['action']=='delete'){
                            delfeedback();
                            }
                            // $query="Select * from feedback order by feedbackid desc";
                            // $go_query=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($go_query))
                        {
                            $feedbackid=$row['feedbackid'];
                            $feedback=$row['feedback'];
                            echo "<tr>";
                            echo "<td>{$feedbackid}</td>";
                            echo "<td>{$feedback}</td>";
                            echo "<td><a href='feedbacks.php?action=delete&id={$feedbackid}' class='btn btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a></td>";
                            echo "</tr>";                  
                        } 
                        ?>
                </table>
            </div>
   
        </div>
        <?php function generatePaginationLinks($totalPages, $current) {
  $output = '<nav aria-label="Page navigation example">';
  $output .= '<ul class="pagination justify-content-center">';

  // Previous page link
  if ($current > 1) {
    $output .= '<li class="page-item"><a class="page-link" href="?page=' . ($current - 1) . '" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
  }

  // Page number links
  for ($i = 1; $i <= $totalPages; $i++) {
    $output .= '<li class="page-item ' . ($current == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
  }

  // Next page link
  if ($current < $totalPages) {
    $output .= '<li class="page-item"><a class="page-link" href="?page=' . ($current + 1) . '" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
  }

  $output .= '</ul>';
  $output .= '</nav>';

  return $output;
}
?>

<!-- Output the pagination links -->
<?php echo generatePaginationLinks($totalPages, $current); ?> 

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>