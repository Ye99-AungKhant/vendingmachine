<?php require("header.php"); ?>
<div class="form-container">
    <h2>Register</h2>
    <form action="register" method="POST">
        <div class="input-field">
            <label for="username">Username</label>
            <input type="text" id="username" name="name" required>
            <span style="color: red;"><?php echo $errors['name'] ?? ''; ?></span>
        </div>
        <div class="input-field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <span style="color: red;"><?php echo $errors['email'] ?? ''; ?></span>
        </div>
        <div class="input-field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <span style="color: red;"><?php echo $errors['password'] ?? ''; ?></span>
        </div>
        <button type="submit">Register</button>
        <a href="login">Login</a>
    </form>
</div>
<?php require("./views/components/footer.php"); ?>