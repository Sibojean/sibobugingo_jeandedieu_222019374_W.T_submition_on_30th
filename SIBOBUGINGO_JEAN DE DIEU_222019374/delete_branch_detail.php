 <?php
    // Connection details
    include('database_connection.php');

    // Check if branch_id is set
    if(isset($_REQUEST['branch_id'])) {
        $bid = $_REQUEST['branch_id'];

        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM branch_detail WHERE branch_id=?");
        $stmt->bind_param("i", $bid);

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
                <input type="hidden" name="branch_id" value="<?php echo $bid; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='branch_detail.php'>OK</a>";
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
        echo "branch_id is not set.";
    }

    $connection->close();
?>
