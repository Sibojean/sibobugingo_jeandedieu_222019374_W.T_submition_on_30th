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


  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
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
  </ul>
</header>
  </form>
</header>
<section>
<body>
    <u><h1>Account Detail</h1></u>
    <form method="POST" action="">
        <label for="account_number">account_number:</label><br>
        <input type="number" id="account_number" name="account_number"><br><br>

        <label for="account_name">account_name:</label><br>
        <input type="text" id="account_name" name="account_name"><br><br>
        
        <label for="account_type">account_type:</label><br>
        <input type="text" id="account_type" name="account_type"><br><br>

        <label for="openning_balance">openning balance:</label><br>
        <input type="number" id="openning_balance" name="openning_balance"><br><br>
        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    
    </form>

    <?php
   include('database_connection.php');
    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Insert section
        $account_number = $_POST['account_number'];
        $account_name = $_POST['account_name'];
        $account_type = $_POST['account_type'];
        $openning_balance = $_POST['openning_balance'];
        $wc = $connection->prepare("INSERT INTO account_detail (account_number,account_name,account_type,openning_balance) VALUES (?,?, ?, ?)");
        $wc->bind_param("isss",$account_number,$account_name,$account_type,$openning_balance);

        if ($wc->execute()) {
            echo "New record has been added successfully";
        } else {
            echo "Error inserting data: " . $wc->error;
        }

        $wc->close();
    } 
    ?>
<center>
    <u><h3>Account  Listing</h3></u>
    <table>
        <tr>
            <th>Account Number</th>
            <th>Account Name</th>
            <th>Account Type</th>
            <th>Openning Balance</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php
        // SQL query to fetch data from the card_detail table
        $sql = "SELECT * FROM account_detail";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>account_number
                    <td>" . $row["account_number"] . "</td>
                    <td>" . $row["account_name"] . "</td>
                    <td>" . $row["account_type"] . "</td>
                    <td>" . $row["openning_balance"] . "</td>
                    <td><a style='padding:4px' href='delete_account_detail.php?account_number=" . $row["account_number"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_account_detail.php?account_number=" . $row["account_number"] . "'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</center>
</body>
</section>
   <footer>
  <!-- Footer content here -->
   <i style="color: green;">&copy; 2024</i><b>WEB TECHNOLOGY CAT</b> 
  </footer>
</body>
</html>