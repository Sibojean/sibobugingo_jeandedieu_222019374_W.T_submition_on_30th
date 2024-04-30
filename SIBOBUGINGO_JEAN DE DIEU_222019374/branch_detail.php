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
<body style="background-image: url('./image/downloa.jpeg'); background-repeat:no-repeat; background-size:cover ;">

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
  </ul>  </ul>
  <!-- <div class="col-3 offset">-->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
</header>
<section>
<body>
    <h1>Branch Details</h1>
    <form method="POST">
        <label for="branch_id"> Branch Id:</label><br>
        <input type="number" id="branch_id" name="branch_id"><br><br>
        
        <label for="branch_name">Branch Name:</label><br>
        <input type="text" id="branch_name" name="branch_name"><br><br>
        
        <label for="branch_city">Branch City:</label><br>
        <input type="text" id="branch_city" name="branch_city"><br><br>
        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>

<?php
// Connection details
include('database_connection.php');

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $branch_id = $_POST['branch_id'];
    $branch_name = $_POST['branch_name'];
    $branch_city = $_POST['branch_city'];
    $wc = $connection->prepare("INSERT INTO branch_detail (branch_id, branch_name, branch_city) VALUES (?,?,?)");
    $wc->bind_param("iss", $branch_id, $branch_name, $branch_city);

    if ($wc->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='home.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $wc->error;
    }

    $wc->close();
} 
?>
<center>
 <h2>Branch Listing</h2>
    <table>
        <tr>
            <th>Branch Id</th>
            <th>Branch NAme</th>
            <th>Branch City</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php
        include('database_connection.php');
        // SQL query to fetch data from the card_detail table
        $sql = "SELECT * FROM branch_detail";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["branch_id"] . "</td>
                    <td>" . $row["branch_name"] . "</td>
                    <td>" . $row["branch_city"] . "</td>
                    <td><a style='padding:4px' href='delete_branch_detail.php?branch_id=" . $row["branch_id"] . "'>Delete</a></td>
                    <td><a style='padding:4px' href='update_branch_detail.php?branch_id=" . $row["branch_id"] . "'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>

    </table>
</body>
</section>
   <footer>

  <!-- Footer content here -->
  <i style="color: green;">&copy; 2024</i><b>SIBO</b>
  </footer>
</center>
</body>
</html>