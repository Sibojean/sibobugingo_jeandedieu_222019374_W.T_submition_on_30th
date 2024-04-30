 <?php
    // Connection details
    include('database_connection.php');

    // Check if account_number is set
    if(isset($_REQUEST['account_number'])) {
        $anum = $_REQUEST['account_number'];

        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM account_detail WHERE account_number=?");
        $stmt->bind_param("i", $anum);

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Record</title>
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this record?");
                }
            </script>
        </head>
        <body>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="account_number" value="<?php echo $anum; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='account_detail.php'>OK</a>";
                } else {
                    echo "Error deleting data: " . $stmt->error;
                }
            }
            ?>
        </body>
        </html>
        <?php

        $stmt->close();
    } else {
        echo "account_number is not set.";
    }

    $connection->close();
?>
