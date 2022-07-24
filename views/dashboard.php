<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <title>Dashboard</title>
</head>

<body>
    <?php
// Userのクラスを読み込み、セッションスタート
    include "../classes/user.php";
    session_start();

// Userのクラスを使い、インスタンス化　$user_listに、$userのgetUsersのファンクションを実行した値を代入　 
    $user = new User;
    $user_list = $user->getUsers();
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

    <main class="container-fluid" style="padding: top 80px;">

        <div class="row">
            <div class="col-6 mx-auto">
                <h2 class="text-muted">Lists of Users</h2>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            while($user_details = $user_list->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?= $user_details['id'] ?></td>
                            <td><?= $user_details['first_name'] ?></td>
                            <td><?= $user_details['last_name'] ?></td>
                            <td><?= $user_details['username'] ?></td>
                            <td>
                                <a href="editUser.php?user_id=<?= $user_details['id'] ?>" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="../actions/removeUser.php?user_id=<?= $user_details['id'] ?>" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>