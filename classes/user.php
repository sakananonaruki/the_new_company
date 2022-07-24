<?php

// Databaseが親クラス、Userが子クラス
require_once "database.php";

class User extends Database{

    // サインアップのファンクション　データベースに入力内容を登録
    public function createUser($first_name, $last_name, $username, $password){
        // mySQLのリスト「users」のそれぞれの項目に、フォームから取得した値を代入
        $sql = "INSERT INTO  `users` (`first_name`, `last_name`, `username`, `password`)
        VALUES ('$first_name', '$last_name', '$username', '$password')";
        // クエリ（sqlへのデータ挿入）が実行されたら、viewsに移動
        if($this->conn->query($sql)){
            header("location: ../views");
        }
        else{
            die("Error in creating the user". $this->conn->connect_error);
        }

    }

    // ログインのファンクション
    public function login($username, $password){
        // mySQLのリスト「users」のusernameがフォームで入力されたものと一致する行からid, username, passwordを取得
        $sql = "SELECT id, username, password FROM users WHERE `username` ='$username'"; 
        // クエリ（SQLからのデータ取得）が実行されたら、$resultに取得された上記の値を代入
        $result = $this -> conn -> query($sql);

        // SQLにクエリして取得した行が１行ならば、取得したデータ（$result）をfetch_assoc(羅列)して$user_detailsに代入
        if($result->num_rows==1){
            $user_details = $result->fetch_assoc();

            // パスワード確認の既存メソッドでPW一致が確認出来たらセッションスタート
            if(password_verify($password, $user_details['password'])){
                session_start();
                // $user_id、$usernameに、ＳＱＬから取得したid、usernameをそれぞれ代入
                $_SESSION['user_id'] = $user_details['id'];
                $_SESSION['username'] = $user_details['username'];

                // ダッシュボードに移動して終了
                header("location: ../views/dashboard.php");
                exit;
            }
            else{
                die("Password incorrect");
            }
        }
        else{
            die("Username is incorrect");
        }
    }

    // 全ユーザー情報取得のファンクション
    public function getUsers(){
        // mySQLのリスト「user」からそれぞれの情報をクエリして取得
        $sql ="SELECT id, first_name, last_name, username FROM users";

        if($result = $this->conn->query($sql)){
            return $result;
        }
        else{
            die("Error in retrieving the users".$this->conn->error);
        }
    }

    // 特定のユーザー情報取得の団くしょん
    public function getUser($user_id){
        $sql = "SELECT * FROM users WHERE `id` ='$user_id'"; 

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }
        else{
            die("Error in retrieving the user".$this->conn->error);
        }
    }
}

?>