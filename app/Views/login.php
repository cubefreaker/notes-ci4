<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="login form-container">
        <form action="/login" method="POST">
            <h1><?= $title ?></h1>
            <input type="text" name="email" placeholder="Email" value="<?= old('email', '') ?>">
            <input type="password" name="password" placeholder="Password">
            <div class="button_group">
                <button type="submit">Login</button>
            </div>
            <p class="switch_link"><a href="/register">Don't have an account? Register here.</a></p>
        </form>
    </section>
<?= $this->endSection() ?>
