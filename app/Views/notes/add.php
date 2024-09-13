<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Add Note
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="add form-container">
        <form action="<?= url_to('note-add') ?>" method="POST">
            <h1>Add Note</h1>
            <input type="text" name="title" placeholder="Title" value="<?= old('title', '') ?>">
            <textarea name="content" placeholder="Content"><?= old('content', '') ?></textarea>
            <div class="button_group">
                <button type="button" onclick="location.href='<?= base_url() ?>'">Cancel</button>
                <button type="submit">Add</button>
            </div>
        </form>
    </section>
<?= $this->endSection() ?>
