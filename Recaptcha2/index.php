<?php 
    
// Checking valid form is submitted or not 
if (isset($_POST['submit_btn'])) { 
      
    // Storing name in $name variable 
    $name = $_POST['name']; 
    
    // Storing google recaptcha response 
    // in $recaptcha variable 
    $recaptcha = $_POST['g-recaptcha-response']; 
  
    // Put secret key here, which we get 
    // from google console 
    $secret_key = '6LepFMcpAAAAAMmImkxlOJqoZDVuP6G7qnqIOFQN'; 
  
    // Hitting request to the URL, Google will 
    // respond with success or error scenario 
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha; 
  
    // Making request to verify captcha 
    $response = file_get_contents($url); 
  
    // Response return by google is in 
    // JSON format, so we have to parse 
    // that json 
    $response = json_decode($response); 
  
    // Checking, if response is true or not 
    if ($response->success) { 
        echo '<script>alert("Google reCAPTACHA verified")</script>'; 
    } else { 
        echo '<script>alert("Error in Google reCAPTACHA")</script>'; 
    } 
} 
  
?>
<!DOCTYPE html>
<html lang="es">
<head> 
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css"> 
  
    <!-- Google reCAPTCHA CDN -->
    <script src="https://www.google.com/recaptcha/api.js" async defer> 
    </script> 
</head> 
  
<body> 
    <div class="container"> 
        <h1>Google reCAPTCHA</h1> 
  
        <!-- HTML Form -->
        <form action="index.php" method="post"> 
            <input type="text" name="name" id="name" 
                placeholder="Enter Name" required> 
            <br> 
  
            <!-- div to show reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LepFMcpAAAAANGy8gE82lJ_DACfBje-nkIzYl3G"> 
            </div> 
            <br> 
  
            <button type="submit" name="submit_btn"> 
                Submit 
            </button> 
        </form> 
    </div> 
</body> 
  
</html>