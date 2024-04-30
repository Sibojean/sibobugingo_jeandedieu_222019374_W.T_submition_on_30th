 <?php 
include "database_connection.php";

$customer_id = $first_name = $last_name = $e_mail = $phone = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["customer_id"])) {
    $customer_id = $_GET["customer_id"];
    $stmt = $connection->prepare("SELECT * FROM customer_detail WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row["customer_id"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $e_mail = $row["e_mail"];
        $phone = $row["phone"];
    } else {
        header("location: /wet/customer_table.php");
        exit;
    }
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {
    $customer_id = $_POST["customer_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $e_mail = $_POST["e_mail"];
    $phone = $_POST["phone"];

    if (empty($customer_id) || empty($first_name) || empty($last_name) || empty($e_mail) || empty($phone)){
        echo "All fields are required!";
    } else {
        $stmt = $connection->prepare(" UPDATE customer_detail SET first_name=?, last_name=?, e_mail=? ,phone = ? WHERE customer_id=?");
        $stmt->bind_param("ssssi",$first_name, $last_name, $e_mail, $phone,$customer_id);
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("location:/wet/customer_table.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    }
}
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer details</title>
    <script>
        function confirmUpdate() {
            return confirm('do you want to updated this record?');
        }
    </script>
    <style>
        h2 {
            font-family: 'Castellar';
            color: darkblue;
        }
        label {
            font-family: 'Elephant';
            font-size: 20px;
        }
        .sb {
            font-family: 'Georgia';
            padding: 10px;
            border-color: blue;
            background-color: skyblue;
            width: 200px;
            margin-top: 5px;
            border-radius: 12px;
            font-weight: bold;
            color: blue;
        }
        .input {
            width: 350px;
            height: 35px;
            border-radius: 12px;
            border-color: green;
        }
    </style>
</head>
<body>
    <center>
        <h2>customer detail</h2>
        <h3 style="color: green;">UPDATE USER HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="confirmUpdate();">
                <label>Customer ID</label><br>
                <input type="text" name="customer_id" class="input" value="<?php echo htmlspecialchars($customer_id); ?>"><br>
                <label>First Name</label><br>
                <input type="text" name="first_name" class="input" value="<?php echo htmlspecialchars($first_name); ?>"><br> 
                <label>Last Name</label><br>
                <input type="text" name="last_name" class="input" value="<?php echo htmlspecialchars($last_name); ?>"><br>
                <label>E_mail</label><br>
                <input type="text" name="e_mail"  class="input" value="<?php echo htmlspecialchars($e_mail); ?>"><br>
                <label>phone</label><br>
                <input type="text" name="phone"  class="input" value="<?php echo htmlspecialchars($phone); ?>"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p>&copy; &reg; 2024 UR CBE BIT Year 2 @ Group B</p>
    </footer>
</body>
</html>