<!-- connection -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "management";

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if(!$conn){
        die("Failed connection: ".mysqli_connect_error());
    }
?>

<!-- Frontend -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>
<body>
    <form action="" method="post" name="form-1">
        <table>
            <tr>
                <td>Enter name </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Enter email </td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Enter city </td>
                <td><input type="text" name="city"></td>
            </tr>
            <tr>
                <td>Enter department Id </td>
                <td><input type="text" name="department_id"></td>
            </tr>
            <tr>
                <td colspan = "2" align="center">
                    <input type="submit" name="submit-1" value="insert">
                    <input type="submit" name="submit-2" value="update">
                    <input type="submit" name="submit-3" value="delete">
                    <input type="submit" name="submit-4" value="display">
                    <input type="submit" name="submit-5" value="search">

                </td>
            </tr>
        </table>
    </form>

    <button onclick="window.location.href='department.php';">Department</button>

</body>
</html>

<!-- Backend -->
<?php
    // insert operation
    if(isset($_POST["submit-1"])){
        $query = "INSERT INTO employee (username, email, city, department_id) VALUES ('$_POST[username]','$_POST[email]','$_POST[city]','$_POST[department_id]')";

        if(mysqli_query($conn,$query)){
            echo "Record inserted successfully";
        }
        else{
            echo "Error ". mysqli_error($conn);
        }
    }

    // update operation
    if(isset($_POST["submit-2"])){
        $query = "UPDATE employee SET city='$_POST[city]', department_id='$_POST[department_id]' WHERE username='$_POST[username]'";
        if(mysqli_query($conn,$query)){
            echo "Record updated successfully";
        }
        else{
            echo "Error ". mysqli_error($conn);
        }
    }

    //delete operation
    if(isset($_POST["submit-3"])){
        $query = "DELETE FROM employee WHERE username='$_POST[username]'";
        if(mysqli_query($conn,$query)){
            echo "Record Deleted successfully";
        }
        else{
            echo "Error ". mysqli_error($conn);
        }
    }

    //display operation
    if(isset($_POST["submit-4"])){
        $query = "SELECT employee.username, employee.email, employee.city, department.department_name from employee join department on employee.department_id = department.department_id";
        
        $res = mysqli_query($conn,$query);

        echo "<table border=1>";
            echo "<tr><th>Name</th><th>Email</th><th>City</th><th>Department</th></tr>";
            while($row = mysqli_fetch_assoc($res)){
                echo "<tr>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['department_name']}</td>
                </tr>";
            }
        echo "</table>";
    }

    //search operation
    if(isset($_POST["submit-5"])){
        $query = "SELECT employee.username, employee.email, employee.city, department.department_name from employee join department on employee.department_id = department.department_id where employee.username='$_POST[username]'";

        $res = mysqli_query($conn,$query);

        echo "<table border=1>";
        echo "<tr><th>Name</th><th>Email</th><th>City</th><th>Department</th></tr>";
        while($row = mysqli_fetch_assoc($res)){
            echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['city']}</td>
                <td>{$row['department_name']}</td>
            </tr>";
        }
    echo "</table>";

    }
?>