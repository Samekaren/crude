<?php 
include 'crud/htmlheader.php'; 
session_start();

if(isset($_POST['deletedata'])){
    $id = $_POST['deleteid'];
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM `pract` WHERE id = ?");
    $stmt->bind_param("i", $id);
    if($stmt->execute()) {
        // Redirect after delete
        echo '<script>window.location.href="display.php?user=delete";</script>';

        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}

?>
<div class="container">

<div class="row">
  <div class="col-md-12">


  <a href="form.php"><button class="btn btn-info">Add New</button></a>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <?php if(isset($_REQUEST['useradd']) == 'update'){ ?>
                <span style="color:red;font-size:22px;">User Update Successfully</span>
            <?php } ?>

            <?php if(isset($_REQUEST['usercreat']) == 'created'){ ?>
                <span style="color:red;font-size:22px;">User Created Successfully</span>
            <?php } ?>

            <?php if(isset($_REQUEST['user']) == 'delete'){ ?>
                <span style="color:red;font-size:22px;">User delete Successfully</span>
            <?php } ?>
        </div>
    </div>
</div>
<table class="table w-100">
    <thead>
        <tr class="bg-danger text-white">
            <th scope="col" class="text-lg-start">sr.no</th>
            <th scope="col">Name</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Pic</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT * FROM `pract`";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $Name = $row['name'];
                $username = $row['username'];
                $email = $row['email'];
                $pic = $row['pictures'];
                echo '
                <tr>
                    <td class="w-25">'.$i.'</td>
                    <td class="w-25">'.$Name.'</td>
                    <td class="w-25">'.$username.'</td>
                    <td class="w-25">'.$email.'</td>
                    <td class="w-25"><img src="picture/'.$pic.'" width="100px" class=" " /></td>
                    <td class="w-25">
                        <form method="post">
                            <input type="hidden" name="deleteid" value="'.$id.'">
                            <input type="submit" name="deletedata" value="Delete" class="btn btn-danger">
                        </form>
                        <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">update</a></button>
                    </td>
                </tr>
                ';
                $i++;
            }
        }
        ?>

    </tbody>
</table>
  
  </div>
</div>
</div>


<?php include 'crud/htmlfooter.php'; ?>
