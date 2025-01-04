<?php
$servername   = getenv("DATABASE_URI");
$databasename = getenv("DATABASE_NAME");
$username     = getenv("DATABASE_USER");
$password     = getenv("DATABASE_PASSWORD");

$conn = new PDO("mysql:host=$servername;dbname=$databasename;charset=UTF8", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$is_post = $_SERVER["REQUEST_METHOD"] === "POST";

if ($is_post) {
  $insert_statement = $conn->prepare("
    INSERT INTO `abcd` (`id`, `name`, `number`, `date`)
    VALUES (NULL, :name, :number, current_timestamp())
    RETURNING id, name, number, date
  ");
  $insert_statement->execute([
    ":name" => $_POST["name"],
    ":number" => $_POST["number"]
  ]);
  $insert_data = $insert_statement->fetch(PDO::FETCH_ASSOC);
}

$statement = $conn->prepare("SELECT * FROM abcd");
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
?> 

<!DOCTYPE html>
<html>
<body>

<h1>My First Heading</h1>
<p><?php echo "My first paragraph. This time with php!"; ?></p>

<?php if($is_post) { ?>
  <p>This is a POST request!</p>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Number</th>
      <th>Date</th>
    </tr>
    <tr>
      <td><?php echo $insert_data["id"]; ?></td>
      <td><?php echo $insert_data["name"]; ?></td>
      <td><?php echo $insert_data["number"]; ?></td>
      <td><?php echo $insert_data["date"]; ?></td>
    </tr>
  </table>
<?php } else { ?>
  <p>Just a GET request.</p>
<?php } ?>

<h2>Data</h2>
<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Number</th>
    <th>Date</th>
  </tr>
  <?php foreach ($data as &$entry) { ?>
  <tr>
    <td><?php echo $entry["id"]; ?></td>
    <td><?php echo $entry["name"]; ?></td>
    <td><?php echo $entry["number"]; ?></td>
    <td><?php echo $entry["date"]; ?></td>
  </tr>
  <?php } ?>
</table>

<h3>Insert</h3>
<form action="index.php" method="POST">
  Name: <input type="text" name="name" required><br>
  Number: <input type="number" name="number" required><br>
  <input type="submit">
</form>

</body>
</html> 
