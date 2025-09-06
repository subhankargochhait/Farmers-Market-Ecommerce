<?php
include "../config/db.php";

$action = $_REQUEST['action'] ?? '';

if($action=="add"){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $season = $_POST['season'];
    $image = "";

    if(!empty($_FILES['image']['name'])){
        $image = "uploads/".time()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$image);
    }

    $sql = "INSERT INTO products (name,category,price,stock,season,image) VALUES ('$name','$category','$price','$stock','$season','$image')";
    mysqli_query($conn,$sql);
    echo "Product added!";
}

elseif($action=="fetch"){
    $res = mysqli_query($conn,"SELECT * FROM products ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($res)){
        echo "<tr>
            <td>{$row['id']}</td>
            <td><img src='{$row['image']}' class='thumb'></td>
            <td>{$row['name']}</td>
            <td>{$row['category']}</td>
            <td>₹{$row['price']}</td>
            <td>{$row['stock']}</td>
            <td>{$row['season']}</td>
            <td>
                <button class='btn btn-info' onclick='viewProduct({$row['id']})'><i class='fas fa-eye'></i></button>
                <button class='btn btn-warning' onclick='editProduct({$row['id']})'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger' onclick='deleteProduct({$row['id']})'><i class='fas fa-trash'></i></button>
            </td>
        </tr>";
    }
}

elseif($action=="view"){
    $id = $_GET['id'];
    $res = mysqli_query($conn,"SELECT * FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    echo "<h2>{$row['name']}</h2>
          <img src='{$row['image']}' style='width:150px'><br>
          <p>Category: {$row['category']}</p>
          <p>Price: ₹{$row['price']}</p>
          <p>Stock: {$row['stock']}</p>
          <p>Season: {$row['season']}</p>
          <p>Created: {$row['created_at']}</p>";
}

elseif($action=="edit_form"){
    $id = $_GET['id'];
    $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM products WHERE id=$id"));
    echo "<form id='editForm' enctype='multipart/form-data'>
        <input type='text' name='name' value='{$row['name']}'><br><br>
        <input type='number' name='price' value='{$row['price']}'><br><br>
        <input type='number' name='stock' value='{$row['stock']}'><br><br>
        <input type='file' name='image'><br><br>
        <button type='button' class='btn btn-primary' onclick='saveEdit({$row['id']})'>Save Changes</button>
    </form>";
}

elseif($action=="update"){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $imageSQL = "";

    if(!empty($_FILES['image']['name'])){
        $image = "uploads/".time()."_".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$image);
        $imageSQL = ", image='$image'";
    }

    $sql = "UPDATE products SET name='$name', price='$price', stock='$stock' $imageSQL WHERE id=$id";
    mysqli_query($conn,$sql);
    echo "Product updated!";
}

elseif($action=="delete"){
    $id = $_POST['id'];
    mysqli_query($conn,"DELETE FROM products WHERE id=$id");
    echo "Product deleted!";
}
