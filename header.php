<style>
* {
    padding: 0;
    margin: 0;
}

a {
    text-decoration: none;
    color: white;
}

body {
    background-color: beige;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

header {
    background-color: blueviolet;
    display: flex;
    justify-content: space-evenly;
    padding: 20px;
}

footer {
    padding: 20px;
    text-align: center;
    background-color: #eee;
}

.chk {
    display: flex;
    flex-direction: column;
    text-align: center;
    justify-content: center;
}
</style>
<header>
    <div><a href="index.php">Home</a></div>
    <div><a href="profile.php">Profile</a></div>
    <?php if (empty($_SESSION["logged"])):?>
    <div><a href="login.php">Login</a></div>
    <div><a href="signup.php">Signup</a></div>
    <?php else:?>
    <div><a href="logout.php">Logout</a></div>
    <?php endif;?>
</header>