 <?php
include('database_connection.php');

if(isset($_REQUEST[' card_number'])) {
    $card_number = $_REQUEST['card_number'];
    
    $stmt = $connection->prepare("SELECT * FROM card_detail WHERE card_number=?");
    $stmt->bind_param("i", $card_number);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['card_number'];
        $y = $row['card_type'];
        $z = $row['transaction_date'];
    } else {
        echo "card_detail not found.";
        exit; // Exit script if platform feedback not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update card_detail</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">

        <label for="card_number">card_number:</label>
        <input type="text" name="card_number" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="card_type">card_type:</label>
        <input type="text" name="card_type" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="expiry_date">expiry_date:</label>
        <input type="date" name="expiry_date" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
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
    $card_number = $_POST['card_number'];
    $card_type = $_POST['card_type'];
    $expiry_date = $_POST['expiry_date'];
    
    
    $stmt = $connection->prepare("UPDATE card_detail SET card_type=?, expiry_date=? WHERE card_number=?");
    $stmt->bind_param("ssi", $card_type, $expiry_date, $card_number);
    $stmt->execute();

    header('Location: card_detail.php');
    exit(); 
}
?>