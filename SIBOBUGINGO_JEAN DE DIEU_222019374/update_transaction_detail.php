 <?php
include('database_connection.php');

if(isset($_REQUEST[' transaction_id'])) {
    $transaction_id = $_REQUEST['transaction_id'];
    
    $stmt = $connection->prepare("SELECT * FROM transaction_detail WHERE transaction_id=?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['transaction_id'];
        $y = $row['transaction_number'];
        $z = $row['transaction_date'];
    } else {
        echo "transaction_detail not found.";
        exit; // Exit script if platform feedback not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update transaction_detail</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">

        <label for="transaction_id">Transaction ID:</label>
        <input type="text" name="transaction_id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="transaction_number">Transaction Number:</label>
        <input type="text" name="transaction_number" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="transaction_date">Transaction Date:</label>
        <input type="date" name="transaction_date" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
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
    $transaction_id = $_POST['transaction_id'];
    $transaction_number = $_POST['transaction_number'];
    $transaction_date = $_POST['transaction_date'];
    
    
    $stmt = $connection->prepare("UPDATE transaction_detail SET transaction_number=?, transaction_date=? WHERE transaction_id=?");
    $stmt->bind_param("ssi", $transaction_number, $transaction_date, $transaction_id);
    $stmt->execute();

    header('Location: transaction_detail.php');
    exit(); 
}
?>