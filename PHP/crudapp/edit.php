<?php
require_once "pdo.php";
session_start();

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['user_id']) && isset($_POST['password']) ){
     //Data validation
     if(strlen($_POST['name']) < 1 || strlen($_POST['password']) <1){
        $_SESSION['error'] = 'Missing Data';
        header("Location: add.php");
        return;
    }
    if(strpos($_POST['email'], '@' === false)){
        $_SESSION['error'] = "Bad data";
        header("Location: add.php");
        return;
    }

    $sql = "UPDATE users SET name=:name, email=:email, password=:password WHERE user_id=:user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name'=>$_POST['name'],
        ':email'=>$_POST['email'],
        ':password'=>$_POST['password'],
        ':user_id'=>$_POST['user_id'],
    ));

    $_SESSION['success'] = "Record Updated";
    header('Location: index.php');
    return;
}

if(isset($_SESSION['error'])){
    echo '<p style="color:red">' . $_SESSION['error'] . "</p> \n";
    unset($_SESSION['error']);
}
$stmt=$pdo->prepare("SELECT * FROM users WHERE user_id=:xyz");
$stmt->execute(array(":xyz"=>$_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row === false){
    $_SESSION['error'] = 'Bad Value for user_id';
    header('Location: index.php');
    return;
}

$n = htmlentities($row['name']);
$e = htmlentities($row['email']);
$p = htmlentities($row['password']);
$user_id = $row['user_id'];
?>

<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
<h3>Edit User</h3>
    <form class="crudform" style="margin-top: 20px;" method="post">
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Full Name</label>
            <input type="text" id="form1Example1" class="form-control" name="name" value="<?= $n ?>" />
        </div>

        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Email address</label>
            <input type="email" id="form1Example1" class="form-control" name="email" value="<?= $e ?>"/>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example2">Password</label>
            <input type="password" id="form1Example2" class="form-control" name="password"  value="<?= $p ?>"/>
        </div>

        <input type="hidden" name="user_id" value="<?= $user_id ?>"/>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Update</button>
    </form>
</div>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<body>
</html>
