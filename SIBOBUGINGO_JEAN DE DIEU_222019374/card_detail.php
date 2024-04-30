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
   <u> <h1>CARD DETAIL</h1></u>
    <form method="POST" action="">
        <label for="card_number">Card Number:</label><br>
        <input type="text" id="card_number" name="card_number"><br><br>

        <label for="card_type">Card Type:</label><br>
        <input type="text" id="card_type" name="card_type"><br><br>
        
        <label for="expiry_date">Expiry Date:</label><br>
        <input type="date" id="expiry_date" name="expiry_date"><br><br>
        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    
    </form>

    <?php
   include('database_connection.php');
    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Insert section
        $card_number = $_POST['card_number'];
        $card_type = $_POST['card_type'];
        $expiry_date = $_POST['expiry_date'];
        $wc = $connection->prepare("INSERT INTO card_detail (card_number,card_type,expiry_date) VALUES (?, ?, ?)");
        $wc->bind_param("iss",$card_number,$card_type,$expiry_date);

        if ($wc->execute()) {
            echo "New record has been added successfully";
        } else {
            echo "Error inserting data: " . $wc->error;
        }

        $wc->close();
    } 
    ?>
<center> 
     <u> <h3>Card Listing</h3></u>
    <table>
        <tr>
            <th>Card Number</th>
            <th>Card Type</th>
            <th>Expiry Date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php
        // SQL query to fetch data from the card_detail table
        $sql = "SELECT * FROM card_detail";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>card_number
                    <td>" . $row["card_number"] . "</td>
                    <td>" . $row["card_type"] . "</td>
                    <td>" . $row["expiry_date"] . "</td>
                    <td><a style='padding:4px' href='delete_card_detail.php?card_number=" . $row["card_number"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_card_detail.php?card_number=" . $row["card_number"] . "'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
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