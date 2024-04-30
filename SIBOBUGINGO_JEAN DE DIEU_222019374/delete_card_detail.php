 <?php
    // Connection details
    include('database_connection.php');

    // Check if card_number is set
    if(isset($_REQUEST['card_number'])) {
        $cnum = $_REQUEST['card_number'];

        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM card_detail WHERE card_number=?");
        $stmt->bind_param("i", $cnum);

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
                <input type="hidden" name="card_number" value="<?php echo $cnum; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='card_detail.php'>OK</a>";
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
        echo "card_number is not set.";
    }

    $connection->close();
?>
