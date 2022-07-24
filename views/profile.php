<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Profile</title>
</head>

<body>
    <?php
// Userのクラスを読み込み、セッションスタート
    include "../classes/user.php";
    session_start();

    $user = new User;
    $user_details = $user->getUser($_SESSION['user_id']);

    ?>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="dashboard.php" class="navbar-brand">
            <h1 class="h3">The Company</h1>
        </a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="profile.php" class="nav-link"><?=$_SESSION['username'];?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <main class="card w-25 my-5">
            <img src="../images/<?= $user_details['photo']; ?>" alt="Profile Picture" class="card-img-top">
            <div class="card-body">
                <form enctype="multipart/form-data" action="../actions/uploadPhoto.php" method="POST" >
                    <div class="custom-file mb-2">
                        <label for="photo" class="custom-file-label">Choose Photo</label>
                        <input type="file" name="photo" id="photo" class="custom-file-input" required>
                    </div>

                    <input type="submit" value="Update Photo" class="btn btn-outline-primary btn-sm btn-block">
                </form>
            </div>
            <div class="card-footer border-0 bg-white">
                <p class="lead font-weight-bold mb-0"><?= $user_details['first_name']." ".$user_details['last_name']; ?></p>
                <p></p>
            </div>

        </main>
        </div>

</body>

</html>