<?php require("header.php"); ?>
<div class="form-container">
    <h2>Login</h2>
    <form action="login" method="POST">
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
        <button type="submit">Login</button>
        <a href="register">Register</a>
    </form>
</div>
<?php require("./views/components/footer.php"); ?>