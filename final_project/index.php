<!DOCTYPE html>
<html>
    <body>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "websiteproject";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT Student_ID, Student_NAME, Student_AGE, Student_PROGRAM, Student_PROFILE_PICTURE FROM STUDENT";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table width='800' border='1' align='center'cellpadding='0' cellspacing='0' border='1' style='border-collapse:collapse #FF6600'>";
                while ($row = $result->fetch_assoc()) {
                    $image_data = $row["Student_PROFILE_PICTURE"];
                    $encoded_image = base64_encode($image_data);
            
                    $Hinh = "<img height='100' WIDTH='100' src='data:image/jpeg;base64,{$encoded_image}' alt='Profile Picture'>";
            
                    echo "<tr><td align='center'>" . $row["Student_ID"] . "</td>";
                    echo "<td align='center'>" . $row["Student_NAME"] . "</td>";
                    echo "<td align='center'>" . $row["Student_AGE"] . "</td>";
                    echo "<td align='center'>" . $row["Student_PROGRAM"] . "</td>";
                    echo "<td align='center'>" . $Hinh . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }

            echo "<br/>";

            $sql = "SELECT Picture_ID, Picture_PICTURE, Picture_StudentID FROM PICTURES";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                echo "<table width='800' border='1' align='center'cellpadding='0' cellspacing='0' border='1' style='border-collapse:collapse #FF6600'>";
                while ($row = $result->fetch_assoc()) {
                    $image_data = $row["Picture_PICTURE"];
                    $encoded_image = base64_encode($image_data);
            
                    $Hinh = "<img height='100' WIDTH='100' src='data:image/jpeg;base64,{$encoded_image}' alt='Profile Picture'>";
            
                    echo "<tr><td align='center'>" . $row["Picture_ID"] . "</td>";
                    echo "<td align='center'>" . $row["Picture_StudentID"] . "</td>";
                    echo "<td align='center'>" . $Hinh . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            
            $conn->close();
        ?>

    </body>
</html>
