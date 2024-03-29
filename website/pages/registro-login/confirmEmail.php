<?php
    session_start();
    $code = crypt($_SESSION['email'], $_SESSION['name']);
    $from = "From: noreplyTwenty@gmail.com";
    $sent = mail($_SESSION['email'], "Twenty - Confirm your email address", wordwrap("Your confirm code is \"" . $code . "\""), $from);
    if(!$sent)
    {
        echo "ERROR PLEASE TRY LATER";
        die;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Email</title>

    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <!-- CSS LOCAL -->
    <link rel="stylesheet" href="../css/confirmEmail.css">
</head>
<body>
    <main>
        <h1 class="text-primary">Confirm email</h1>
        <p class="text-secondary">A code was sent to the email <?php echo $_SESSION['email']; ?></p>
        <form action="../../php/confirmEmail.php" method='post'>
            <input type="text" name="code" id="code" class="form-control">
            <input type="submit" value="Confirm code" class="btn btn-primary">
        </form>
        <a href="register.html">This is not my email</a>
    </main>
</body>
</html>