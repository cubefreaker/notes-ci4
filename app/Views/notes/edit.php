<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
Edit Note | "<?= $note['title'] ?>"
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="add form-container">
        <form action="<?= url_to('note-edit', $note['id']) ?>" method="POST">
            <h1>Add Note</h1>
            <input type="text" name="title" placeholder="Title" value="<?= old('title', $note['title']) ?>" >
            <textarea name="content" placeholder="Content"><?= old('content', $note['content']) ?></textarea>
            <div class="button_group">
                <button type="button" onclick="location.href='<?= base_url() ?>'">Cancel</button>
                <button type="submit">Edit</button>
            </div>
        </form>
    </section>
<?= $this->endSection() ?>
