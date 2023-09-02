<?php
    include('connect.php');

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nameErr = $numberErr = $emailErr = $subjectErr = $messageErr = "";
    $name = $number = $email = $subject = $message = "";

    if(isset($_POST['submit'])){
        if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        } else {
        $name = test_input($_POST["name"]);
        }
    
        if (empty($_POST["number"])) {
        $numberErr = "Phone Number is required";
        } else {
        $number = test_input($_POST["number"]);
        }
    
        if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        } else {
        $email = test_input($_POST["email"]);
        }
    
        if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
        } else {
        $subject = test_input($_POST["subject"]);
        }
    
        if (empty($_POST["message"])) {
        $messageErr = "Message is required";
        } else {
        $message = test_input($_POST["message"]);
        }

        if($nameErr == "" && $numberErr == "" && $emailErr == "" && $subjectErr == "" && $messageErr == ""){

            $query = "SELECT * FROM contact_form WHERE email = '$email' OR phone = '$number' ";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 0){
                $query1 = "INSERT INTO contact_form (name, phone, email, subject, message) values ('$name', '$number','$email','$subject','$message')";
                $result1 = mysqli_query($conn,$query1);

                // mail("example@gmail.com",$subject,$message);
                if($result1){
                echo "<script>
                        alert('Your message successfully send');
                    </script>";
                }else{
                echo "<script>alert('Your message send failed');</script>";
                }
            }else{
                echo "<script>
                        alert('This email is already used');
                    </script>";
            }
        }
  }
?>
<style>
    .error {color: #FF0000;}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container mt-4" style="margin-left: 35%;">
        <div style="margin-left: 10%;">
            <h2>Contact us</h2>
        </div><br>
        <form method="POST">
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label"><b>Full Name</b></label>
                <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="enter your full name">
            </div>
            <div>
               <span class="error"><?php echo $nameErr;?></span>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label"><b>Phone Number</b></label>
                <input type="text" class="form-control" name="number" id="exampleFormControlInput1" placeholder="enter mobile number">
            </div>
            <div>
                <span class="error"><?php echo $numberErr;?></span>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label"><b>Email</b></label>
                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div>
                <span class="error"><?php echo $emailErr;?></span>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label"><b>Subject</b></label>
                <input type="text" class="form-control" name="subject" id="exampleFormControlInput1">
            </div>
            <div>
                <span class="error"><?php echo $subjectErr;?></span>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label"><b>Message</b></label>
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div>
                <span class="error"><?php echo $messageErr;?></span>
            </div>
            <button type="submit" name="submit" class="btn btn-info">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>