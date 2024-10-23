<?php
    require_once "pdo.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Crud App</title>
</head>
<body>
    <div class="container">
        <h3 style="text-align: center;">Basic CRUD App</h1>
        <?php 
            if(isset($_SESSION['error'])){
                echo('<p style="color: red">' . $_SESSION['error'] . '</p>');
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['success'])){
                echo('<p style="color: green">' . $_SESSION['success'] . '</p>');
                unset($_SESSION['success']);
            }

            echo('<table class="table" border="1">' . "\n");
            echo('<thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>' . "\n"
            );
            $stmt = $pdo->query('SELECT * FROM users');
            $i = 0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo("<tr><td>");
                echo(++$i);
                echo('</td><td>');
                echo(htmlentities($row['name']));
                echo('</td><td>');
                echo(htmlentities($row['email']));
                echo('</td><td>');
                echo(htmlentities($row['password']));
                echo('</td><td>');
                echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a>' . " | ");
                echo('<a href="delete.php?user_id='.$row['user_id'].'">Delete</a>');
                echo('</td>');
            }
        ?>
        </table>
        <a href="add.php">Add New</a>
    </div>

    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>