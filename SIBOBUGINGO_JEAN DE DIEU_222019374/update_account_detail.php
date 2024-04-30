  <?php
include('database_connection.php');

if(isset($_REQUEST[' account_number'])) {
    $account_number = $_REQUEST['account_number'];
    
    $stmt = $connection->prepare("SELECT * FROM account_detail WHERE account_number=?");
    $stmt->bind_param("i", $account_number);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $w = $row['account_number'];
        $x = $row['account_name'];
        $y = $row['account_type'];
        $z = $row['openning_balance'];

    } else {
        echo "account_detail not found.";
        exit; // Exit script if platform feedback not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update account_detail</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">

        <label for="account_number">account_number:</label>
        <input type="text" name="account_number" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="account_name">account_name:</label>
        <input type="text" name="account_name" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="account_type">account_type:</label>
        <input type="text" name="account_type" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

         <label for="openning_balance">openning_balance:</label>
        <input type="date" name="openning_balance" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
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
    $account_number = $_POST['account_number'];
    $account_name = $_POST['account_name'];
    $account_type = $_POST['account_type'];
     $openning_balance = $_POST['openning_balance'];
    
    
    $stmt = $connection->prepare("UPDATE account_detail SET account_name=?, account_type=?,openning_balance=? WHERE account_number=?");
    $stmt->bind_param("sssi", $account_name, $account_type, $account_number, $openning_balance);
    $stmt->execute();

    header('Location: account_detail.php');
    exit(); 
}
?>