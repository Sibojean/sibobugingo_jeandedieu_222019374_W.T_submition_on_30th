   <!DOCTYPE html>
<html>
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About the System</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: white;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: green;
    }
    /* Unvisited link */
    a:link {
      color: green; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: white;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */
      padding: 8px;  
    }
    header{
  background-color: #567890;
  padding: 20px;
}
    section{
      padding:32px;
    }
    footer{
  background-color: #567890;
  padding: 20px;
}

  </style>
</head>
<header>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer_detail.php">CUSTOMER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./account_detail.php">ACCOUNT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction_detail.php">TRANSACTION</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./card_detail.php"> CARD</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./branch_detail.php">BRANCH</a></li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
  </ul></ul>
</header>
  </form>
</header>
<section>
<body>
    <u><h1>Transaction Details</h1></u>
    <form method="POST" action="">
        <label for="transaction_id">Transaction ID:</label><br>
        <input type="text" id="transaction_id" name="transaction_id"><br><br>

        <label for="transaction_number">Transaction Number:</label><br>
        <input type="text" id="transaction_number" name="transaction_number"><br><br>
        
        <label for="transaction_date">Transaction_Date:</label><br>
        <input type="date" id="transaction_date" name="transaction_date"><br><br>
        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    
    </form>

    <?php
   include('database_connection.php');
    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Insert section
        $transaction_id = $_POST['transaction_id'];
        $transaction_number = $_POST['transaction_number'];
        $transaction_date = $_POST['transaction_date'];
        $wc = $connection->prepare("INSERT INTO transaction_detail (transaction_id,transaction_number,transaction_date) VALUES (?, ?, ?)");
        $wc->bind_param("iss",$transaction_id,$transaction_number,$transaction_date);

        if ($wc->execute()) {
            echo "New record has been added successfully";
        } else {
            echo "Error inserting data: " . $wc->error;
        }

        $wc->close();
    } 
    ?>
<center> 
   <u> <h3>Transaction Listing </h3></u>
    <table>
        <tr>
            <th>Transaction_Id</th>
            <th>Transaction_Number</th>
            <th>Transaction_Date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php
        // SQL query to fetch data from the transaction_detail table
        $sql = "SELECT * FROM transaction_detail";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["transaction_id"] . "</td>
                    <td>" . $row["transaction_number"] . "</td>
                    <td>" . $row["transaction_date"] . "</td>
                    <td><a style='padding:4px' href='delete_transaction_detail.php?transaction_id=" . $row["transaction_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_transaction_detail.php?transaction_id=" . $row["transaction_id"] . "'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</body>
</section>
   <footer>
  <!-- Footer content here -->
   <i style="color: green;">&copy; 2024</i><b>WEB TECHNOLOGY CAT</b> 
  </footer>
</center>
</body>
</html>