<?php 
require_once "pdo.php";
session_start();
?>

<html>
<head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">

    <?php
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) ){
        $sql = "INSERT INTO users(name, email, password) VALUES(:name, :email, :password)";

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
        if(isset($_SESSION['error'])){
            echo '<p style="color:red">' . $_SESSION['error'] . "</p> \n";
            unset($_SESSION['error']);
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name'=>$_POST['name'],
            ':email'=>$_POST['email'],
            ':password'=>$_POST['password']
        ));

        $_SESSION['success'] = 'Record Added';
        header('Location: index.php');
        return;
    }
    ?>
    <h3>Add a New User</h3>
    <form class="crudform" style="margin-top: 20px;" method="post">
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Full Name</label>
            <input type="text" id="form1Example1" class="form-control" name="name"/>
        </div>

        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example1">Email address</label>
            <input type="email" id="form1Example1" class="form-control" name="email"/>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form1Example2">Password</label>
            <input type="password" id="form1Example2" class="form-control" name="password"/>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Add New</button>
    </form>
</div>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<body>
</html>