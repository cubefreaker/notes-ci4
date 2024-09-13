<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Register
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="register form-container">
        <form action="/register" method="POST">
            <h1><?= $title ?></h1>
            <input type="text" name="username" placeholder="Username" value="<?= old('username', '') ?>">
            <input type="email" name="email" placeholder="Email" value="<?= old('email', '') ?>">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <div class="button_group">
                <button type="submit">Register</button>
            </div>
            <p class="switch_link"><a href="/login">Already have an account? Login here.</a></p>
        </form>
    </section>
<?= $this->endSection() ?>
