 <?php
include('database_connection.php');

if(isset($_REQUEST[' branch_id'])) {
    $branch_id = $_REQUEST['branch_id'];
    
    $stmt = $connection->prepare("SELECT * FROM brach_detail WHERE branch_id=?");
    $stmt->bind_param("i", $branch_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['branch_id'];
        $y = $row['branch_name'];
        $z = $row['branch_city'];
    } else {
        echo "branch_detail not found.";
        exit; // Exit script if platform feedback not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update brach_detail</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">

        <label for="branch_id">Branch ID:</label>
        <input type="text" name="branch_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="branch_name">Branch Name:</label>
        <input type="text" name="branch_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="branch_city ">Branch City:</label>
        <input type="date" name=" branch_city" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $branch_id = $_POST['branch_id'];
    $branch_name = $_POST['branch_name'];
    $branch_city = $_POST['branch_city'];
    
    
    $stmt = $connection->prepare("UPDATE branch_detail SET branch_name=?, branch_city=? WHERE branch_id=?");
    $stmt->bind_param("ssi", $branch_id, $branch_city, $branch_city);
    $stmt->execute();

    header('Location: brach_detail.php');
    exit(); 
}
?>