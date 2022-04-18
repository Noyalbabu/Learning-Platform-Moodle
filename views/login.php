<?php
include $_SERVER["DOCUMENT_ROOT"] . "/learning-platform-moodle/includes/auth.php";
include ("../config/Connection.php");
include ("../includes/header.php");
$isError = false;
global $conn;
if(isset($_POST["student-id"]) && isset($_POST["password"])){
    $userId= $_POST["student-id"];
    $password = $_POST["password"];
    if($userId && $password){
        $sqlQuery = "SELECT * FROM user";
        $res = mysqli_query($conn, $sqlQuery);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_array($res)){
                if($row["id"] == $userId && $row["password"] == $password && $row["userAuthorised"] == 1 ){
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["userId"] = $userId;
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["userType"] = $row["userType"];
                    header('Location: ./dashboard.php');
                    break;
                }
            }
            $isError = true;
            echo "<p>Unauthorised access! Sorry our admin has not authorised you. Please wait.....</p>";
        }
    } else {
        $isError = true;
    }
}
?>

<div class="flex-column wrapper-center " >
    <form action="login.php" method="POST" class="flex-form">
        <h2>Login</h2>
        <label for="student-id">Identity Number</label>
        <input type="text" name="student-id" id="student-id"/>
        <label for="password">Password</label>
        <input type="text" name="password" id="password"/>
        <button type="submit">Login</button>
        <?php
        if($isError){?>
            <p>Credenitals not found!</p>
        <?php }?>
        <p>Don't have an account?</p>
        <a href="signup.php" class="button">Sign up</a>
    </form>

</div>
?>