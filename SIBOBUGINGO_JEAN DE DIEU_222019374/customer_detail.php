 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Proper character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
  <title>Workerinfo</title>
  <link rel="stylesheet" type="text/css" href="style.css"> <!-- External CSS -->
  <style>
    /* CSS styles for consistent styling */
    a {
      padding: 15px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown;
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 20px; 
      margin-top: 7px;
    }

    input.form-control {
      padding: 10px;
    }

    table {
      width: 100%; /* Set table to full width */
      border-collapse: collapse; /* Merge borders */
    }

    th, td {
      border: 2px solid black; /* Table borders */
      padding: 10px; /* Padding for readability */
      text-align: left;
    }

    th {
      background-color: orange; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
    }

    footer {
      text-align: center; 
      padding: 20px; 
      background-color: darkgray; /* Footer background color */
    }
  </style>
  <!-- JavaScript function for insert confirmation -->
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: lightblue;"> <!-- Corrected placement of body tag -->
  <header>
    <ul style="list-style-type: none; padding: 0;"> <!-- No list-style -->
      <li style="display: inline; margin-right: 10px;">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer_detail.php">CUSTOMER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./account_detail.php">ACCOUNT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction_detail.php">TRANSACTION</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./card_detail.php"> CARD</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./branch_detail.php">BRANCH</a></li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenyellow;
        <div class="dropdown-contents>
          <a href="login.php">Login</a>
          <a href="register.php">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>
<body style="background-color: yellowgreen;">

    <h1>customer Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="customer_id">customer ID:</label>
        <input type="number" id="customer_id" name="customer_id" required><br><br>

        <label for="first_name">first_name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>


        <label for="last_name">last_name:</label>
        <input type="number" id="last_name" name="last_name" required><br><br>

        <label for="e_mail">e_mail:</label>
        <input type="text" id="e_mail" name="e_mail" required><br><br>

         <label for="phone">phone:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a> <!-- Corrected the path to start with "./" -->
    </form>

    <?php
    include('database_connection.php'); // Include the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Retrieve input values from POST request
        $customer_id = $_POST['customer_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $e_mail = $_POST['e_mail'];
        $phone = $_POST['phone'];
         

        // Prepare SQL statement for insertion
        $stmt = $connection->prepare("INSERT INTO customer_detail (customer_id, first_name,last_name,e_mail,phone) VALUES (?, ?,?,?,?)");
        $stmt->bind_param("issss", $customer_id, $first_name,$last_name,$e_mail,$phone); // Bind parameters

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br><a href='customer_detail.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
    ?>

    <section>
        <h2>Customer Detail</h2>
        <table>
            <tr>
                <th>customer_id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E_mail</th>
                <th>Phone</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Select all departments from the database
            $sql = "SELECT * FROM customer_detail";
            $result = $connection->query($sql); // Execute the query

            if ($result->num_rows > 0) {
                // Loop through the results and generate table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['customer_id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['e_mail']}</td>
                            <td>{$row['phone']}</td>
                      
                            <td><a style='padding:4px' href='delete_customer_detail.php?customer_id={$row['customer_id']}'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_customer_detail.php?customer_id={$row['customer_id']}'>Update</a></td> 
                          </tr>";
                }
            } else {
                // If no data is found, display a message in the table
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <h2>UR CBE BIT &copy; 2024 &reg; Designed by: @Jean  Sibo</h2> <!-- Corrected "Designer" to "Designed" -->
    </footer>

</body>
</html>