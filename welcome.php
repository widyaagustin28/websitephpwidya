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

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $kritik = $_POST["kritik"];

        //Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //Check connection
        if ($conn->connect_error) {
            die("Connection failed:" . $conn->connect_error);
        }

        $sql = "INSERT INTO myguests (nama, email, kritik )
        VALUES ('$nama','$email','$kritik')";

        if ($conn->query($sql) === TRUE) {
            echo "<br>" . "New records created succesfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT nama,email,kritik FROM myguests";
        ?>
    </div>
</body>

</html>