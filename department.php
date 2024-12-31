<!-- Connection -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if(!$conn){
        die("Connection failed ". mysqli_connect_error());
    }
?>

<!-- Frontend -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
</head>
<body>
    <form action="" method="post">
        <table>
            <tr>
                <td>Enter the department name</td>
                <td><input type="text" name = "department_name"></td>
            </tr>
            <tr>
                <td colspan = "2" align="center">
                    <input type="submit" name="submit-1" value="Insert">
                    <input type="submit" name="submit-2" value="Display">
                    
                </td>
            </tr>
        </table>
    </form>

    <button onclick = "window.location.href = 'employee.php';">Employee</button>

</body>
</html>

<!-- Backend -->
<?php
    //insert operation
    if(isset($_POST["submit-1"])){
        $query = "INSERT into department (department_name) values ('$_POST[department_name]')";

        if(mysqli_query($conn,$query)){
            echo "Record updated successfully";
        }
        else{
            echo "Error: ". mysqli_error($conn);
        }
    }

    //display operation
    if(isset($_POST['submit-2'])){
        $query = "SELECT * from department";

        $res = mysqli_query($conn,$query);

        echo "<table border=1>";
            echo "<tr><th>Department Id</th><th>Department Name</th></tr>";
            while ($row = mysqli_fetch_assoc($res)){
                echo "<tr>
                    <td>{$row['department_id']}</td>
                    <td>{$row['department_name']}</td>
                </tr>";
            }
        echo "</table>";
    }
?>