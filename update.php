<?php
include 'crud/htmlheader.php';

$id = $_GET['updateid'];

$sql = "SELECT * FROM pract WHERE id=$id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$username = $row['username'];
$email = $row['email'];
$pic = $row['pictures'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $new_picture = $_FILES['pictures']['name'];

    // Handle file upload
    if ($_FILES['pictures']['error'] === UPLOAD_ERR_OK) {
        $temp_picture = $_FILES['pictures']['tmp_name'];
        move_uploaded_file($temp_picture, "picture/" . $new_picture);
    } else {
        // No new picture uploaded, retain the existing picture
        $new_picture = $pic;
    }

    // Update data in the database
    $sql = "UPDATE `pract` SET name='$name', username='$username', email='$email', pictures='$new_picture' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>window.location.href="display.php?useradd=update";</script>';
      

        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<style>
    .size {
        width: 100%;
        border: 1px;
    }
</style>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="size">
            <div>
                <label for="username">Name :</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
            <div>
                <label for="username">Username :</label>
                <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
            </div>
            <div>
                <label for="username">Email :</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
            <div>
                <label for="username">Pic :</label>
                <input type="file" class="form-control" name="pictures">
                <div><img src="picture/<?php echo $pic; ?>" width="100px" class="p-2 m-3 outline-danger" /></div>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-danger">Update</button>
            </div>
        </div>
    </form>
</div>

<?php include 'crud/htmlfooter.php'; ?>
