<?php

function dbConnect() 
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "todo_list";
    
    $conn = mysqli_connect ($servername, $username, $password, $dbname) or die ("Connection failed: ". $conn -> connect_error);
    return $conn;
}
$conn = dbConnect();

function isEmailValid($email) 
{
    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function checkLogin($email, $password) 
{
    $conn = dbConnect();
    $sql = "SELECT email FROM users WHERE email='$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function createUser($email, $password)
{
    $conn = dbConnect();
    $sql = "INSERT INTO users (email, password) VALUES ('$email','$password')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function getHead()
{
    $pageTitle = dynamicTitle();
    $output = '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://localhost/ToDo_List/bootstrap/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>'. $pageTitle .'</title>';

    echo $output;
}

function getHeader()
{
    $output = '<header class="py-3 mb-4 border-bottom bg-dark">
    <div class="d-flex flex-wrap justify-content-center  container">
    <a href="todos.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <img class="me-2" src="logo.png" alt="" width="50" height="50">
      <span class="fs-4 me-4 text-white">ToDo_List</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="todos.php" class="nav-link active me-2" aria-current="page">Home</a></li>
      <li class="nav-item"><a href="add-todo.php" class="nav-link text-white bg-secondary me-2">Add Todo</a></li>
      <li class="nav-item"><a href="logout.php" class="nav-link bg-danger text-white">Logout</a></li>
    </ul>
    </div>
  </header>';

    echo $output;
}

function textLimit($string, $limit)
{
    if (strlen($string) > $limit) {
        return substr($string, 0, $limit)."...";
    } else {
        return $string;
    }
}

function getTodo($todo)
{
    $output = '<div class="card shadow-sm">
    <div class="card-body bg-white">
        <h4 class="card-title">'. textLimit($todo['title'], 25) .'</h4>
        <p class="card-text">'. textLimit($todo['description'], 75) .'</p>
    <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <a href="view-todo.php?id='. $todo['id'] .'" class="btn btn-sm btn-outline-secondary">View</a>
          <a href="edit-todo.php?id='. $todo['id'] .'" class="btn btn-sm btn-outline-secondary">Edit</a>
        </div>
        <small class="text-muted">'. $todo['date'] .'</small>
    </div>
    </div>
  </div>';

  echo $output;
}

function dynamicTitle() 
{
    global $conn;
    $filename = basename($_SERVER["PHP_SELF"]);
    $pageTitle = "";
    switch ($filename) {
        case 'index.php':
            $pageTitle = "Home";
            break;

        case 'todos.php':
            $pageTitle = "Todo List";
            break;

        case 'add-todo.php':
            $pageTitle = "Add Todo";
            break;

        case 'edit-todo.php':
            $pageTitle = "Edit Todo";
            break;

        case 'view-todo.php':
            $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
            $sql1 = "SELECT * FROM todos WHERE id='{$todoId}'";
            $res1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($res1) > 0) {
                foreach ($res1 as $todo) {
                    $pageTitle = $todo["title"];
                }
            }
            break;

        default:
            $pageTitle = "Todo List";
            break;
    }

    return $pageTitle;
}