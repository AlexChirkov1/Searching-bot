<?php
include "./header.php";

$file = file_get_contents('./credentials.txt', true);
$file = explode(',', $file);

$msg = '';

if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    if ($_POST['username'] == $file[0] && $_POST['password'] == $file[1]) {
        session_start();
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $file[0];
        header('location:./savedsearch.php');
    } else {
        $msg = 'Wrong username or password';
    }
}
?>
<div class="centered">

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
        <h4 class="form-signin-heading"><?php echo $msg; ?></h4>
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" placeholder="Enter your login" name="username"
                autocomplete="off">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password"
                autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
    </form>
</div>

<?php
include "./footer.php";
?>