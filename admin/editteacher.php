<?php include("header.php"); ?>
<?php require_once("db.php"); ?>
<?php
$teacherName =$contactNumber =$description=$position =$teacherId ="";

$teacherId = $_GET['teacherId'];

$sql = "SELECT id, teachername, position, contact, description FROM teacher_details WHERE id = $teacherId";
$result = mysqli_query($con, $sql);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $teacherId = $row['id'];
        $teacherName = $row['teachername'];
        $position = $row['position'];
        $contactNumber = $row['contact'];
        $description = $row['description'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacherId = $_POST['teacherId'];
    $editedTeacherName = $_POST['tname'];
    $editedPosition = $_POST['tposition'];
    $editedContactNumber = $_POST['contact'];
    $editedDescription = $_POST['description'];

    // Update the teacher details in the database
    $sql = "UPDATE teacher_details SET teachername=?, position=?, contact=?, description=? WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $editedTeacherName, $editedPosition, $editedContactNumber, $editedDescription, $teacherId);

        if (mysqli_stmt_execute($stmt)) {
            echo "Teacher details updated successfully.";
            header("Location: teacher.php");
        } else {
            echo "Failed to update teacher details: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Preparation of the statement failed: " . mysqli_error($con);
    }
}
?>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Courses</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Courses</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Type here...">
                </div>
            </div>

            <?php include("navbar.php"); ?>

        </div>
    </div>
</nav> <!-- End Navbar -->

<div class="container-fluid py-4">
    <div class="col-md-12 text-right">
        <a class="btn bg-gradient-dark mb-0" href="add-course.php"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Course</a>
    </div><br>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Course Detail</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <div class="card-body">
                            <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-5 col-md-7 mx-auto">
                                        <div class="mb-3">
                                            <input type="hidden" name="teacherId" value="<?php echo $teacherId; ?>">

                                            <label for="tname">Teacher Name</label>
                                            <input type="text" class="form-control" name="tname" id="tname" aria-label="Teacher Name" value="<?php echo $teacherName; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-5 col-md-7 mx-auto">
                                        <div class="mb-3">
                                            <label for="tposition">Teacher Position</label>
                                            <input type="text" class="form-control" name="tposition" id="tposition" value="<?php echo $position; ?>" aria-label="Teacher Position" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-5 col-md-7 mx-auto">
                                        <div class="mb-3">
                                            <label for="contact">Contact Number</label>
                                            <input type="text" class="form-control" name="contact" id="contact" value="<?php echo $contactNumber; ?>" aria-label="Contact Number" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-5 col-md-7 mx-auto">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description" id="description" value="<?php echo $description; ?>" aria-label="Description" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-25 my-4 mb-2">Submit</button>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</main>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.2"></script>
</body>

</html>