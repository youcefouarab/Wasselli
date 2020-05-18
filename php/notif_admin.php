 <?php
    require 'dbh.inc.php';
    $e = 0 ;
    $sql = "SELECT * FROM notifications_admin WHERE vu = '$e'";
    $result = mysqli_query($conn,$sql);
    $count= mysqli_num_rows($result);
    if($count!=0) echo "<div class='label label-danger'>$count</div>";
?>