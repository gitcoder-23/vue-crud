<?php
$conn = new mysqli('localhost', 'root', '', 'vue_crud');
if($conn->connect_error){
    die('Connection Failed!!'.$conn->connect_error);
}
// echo('Success');

$result = array('error'=>false);
$action = '';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}


//List Data
if($action == 'read'){
    $sql = $conn->query('SELECT * FROM users');
    $users = array();
    while($row = $sql-> fetch_assoc()){
        array_push($users, $row);
    }

    $result['users'] = $users;
}


//create Data
if($action == 'create'){
    $u_name = $_POST['u_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("INSERT INTO users 
                (u_name, email, phone) 
                VALUES 
                ('$u_name', '$email', '$phone')");
    if($sql){
        $result['message'] = "User added successfully!";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to add user!";
    }
}

//update Data
if($action == 'update'){
    $id = $_POST['id'];
    $u_name = $_POST['u_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = $conn->query("UPDATE users SET
                u_name = '$u_name',
                email = '$email',
                phone = '$phone'
                WHERE id = '$id'");
    if($sql){
        $result['message'] = "User updated successfully!";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to update user!";
    }
}

//delete Data
if($action == 'delete'){
    $id = $_POST['id'];
    
    $sql = $conn->query("DELETE FROM users 
                WHERE id = '$id'");
    if($sql){
        $result['message'] = "User deleted successfully!";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to delete user!";
    }
}


$conn-> close();
echo json_encode($result);

?>