<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
            body { background-color: #fff; }
            h1 { margin: 150px auto 30px auto; text-align: center; color: #fff; }
            #slider-image {
                background-image: url("images/background.jpg"); 
                background-repeat: no-repeat;
                background-size: 100% 100%;
                height: 400px;
            }
    </style>
</head>
<body>
    <!--<div id="menu">
        <ul>
            <li>Home</li>
            <li>Categories</li>
            <li>Pages</li>
        </ul>
    </div>-->
    <div id="slider-image">
    </div>
	<!--<div class="container dnWaterfall">-->
    <div class="container" style="margin-top: 10px;">
		<!-- Trigger the modal with a button -->
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "websiteproject";

                // Create connection
		$con = new mysqli($servername, $username, $password, $dbname);
                // Check connection
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		} ?>

		<?php
		$s = "SELECT * FROM Pictures"; 
		$r = mysqli_query($con,$s);

		while ($row=mysqli_fetch_array($r))
		{
			$picture_id = $row['Picture_ID'];
			$n = $row['Picture_Picture'];
			$d = $row['Picture_StudentID'];
			    
        $student ="SELECT * FROM `student` where Student_ID = '$d'";
		$stud_r = mysqli_query($con,$student);
        $row1=mysqli_fetch_array($stud_r);

        $sid= $row1['Student_ID'];

             $encoded_image = base64_encode($n);
                            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $encoded_image));
                            file_put_contents('images\img'.$picture_id.'.jpg', $data);
                            $Hinh = "<a class='btn update' href='#editModal$picture_id'data-toggle='modal'>
                            <img height='180px' width='180px' style='margin:0px 8px;' src='images/img$picture_id.jpg' data-toggle='modal' data-target='#myModal'></a>";     
                            echo $Hinh;
                            ?>
				<div id="editModal<?php echo $picture_id; ?>" class="modal fade in" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Student Details</h4>
							</div>
							<div class="modal-body  table-responsive">
                               <div id="stud_details">
                                    <div id="stud_pic" style="float: left; height: 200px;">
                                        <?php
                                         $encoded_image = base64_encode($row1['Student_PROFILE_PICTURE']);
                                                    $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $encoded_image));
                                                    file_put_contents('images\stud_img'.$sid.'.jpg', $data);
                                                    $Hinh = "<img style='text-align:center;' height='150px' width='150px' src='images/stud_img$sid.jpg'/>";     
                                                    echo $Hinh;
                                                ?>
                                    </div>
                                    <div id="stud_data" style="float: left; padding-left: 20px;">
                                          <table class='table'>
                                    
                                    <tbody>
                                        <tr>
                                         <th>ID</th><td><?php echo $row1['Student_ID'];?></td></tr>
								            <tr><th>NAME</th><td><?php echo $row1['Student_NAME'] ?></td></tr>
                                            <tr><th>AGE</th><td><?php echo $row1['Student_AGE'] ?></td></tr>
                                            <tr><th>PROGRAM</th><td><?php echo $row1['Student_PROGRAM'] ?></td></tr>
                                            
                                            </tbody>
                                </table>
                                    </div>
                                </div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>
		<?php }?>
        </div>
	</body>
	</html>
