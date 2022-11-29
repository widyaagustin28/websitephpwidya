<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bromo</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
        <div class="header-list">
            <ul>
                <li>Blog</li>
                <li>Wisata</li>
                <li>Kritik Saran</li>
            </ul>
        </div>
    </div>
    <div class="text-center" style=" text-align: center;">
        <h1>Welcome!</h1>
        Username:
        <?php echo $_POST["nama"]; ?><br>
        Email:
        <?php echo $_POST["email"]; ?><br>
        Kritik dan Saran:
        <?php echo $_POST["kritik"];

        $servername = "ec2-34-235-31-124.compute-1.amazonaws.com"; 
        $username = "hmuleddupvjlqq"; 
        $password = "61bdcc145d14048026d4157aa48cf6a37c5dd771a64473921e5b14ef35e66d5f"; 
        $dbname = "d1nla41q66dkk5";
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $kritik = $_POST["kritik"];
        try {
  $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // begin the transaction
  $conn->beginTransaction();
  // our SQL statements
  $conn->exec("INSERT INTO MyGuests (firstname, lastname, email)
  VALUES ($nama, $kritik, $email)");

  // commit the transaction
  $conn->commit();
  echo "New records created successfully";
} catch(PDOException $e) {
  // roll back the transaction if something failed
  $conn->rollback();
  echo "Error: " . $e->getMessage();
}

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}


try {
  $conn = new PDO("pgsql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT id, firstname, lastname FROM MyGuests");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
    </div>
</body>

</html>
