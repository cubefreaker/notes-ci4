<?= $this->extend('layout') ?>

<?= $this->section('title') ?>
List of Notes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <section class="home">
        <div class="notes-box">
            <div class="notes-header">
                <h1>List Note</h1>
                <div class="user_info">
                    <p><?= session('email') ?></p>
                    <a href="/logout" style="color: #1da1f2; text-decoration: none;">Logout</a>
                </div>
                <button onclick="location.href='<?= url_to('note-add') ?>'">Add Note</button>
            </div>
            <div class="notes-container">
                <?php foreach ($notes as $note): ?>
                <div class="note_list">
                    <div class="head">
                        <h3><?= $note['title'] ?></h3>
                        <div class="button_group">
                            <button onclick="location.href='<?= url_to('note-edit', $note['id']) ?>'">Edit</button>
                            <button onclick="location.href='<?= url_to('note-delete', $note['id']) ?>'">Delete</button>
                        </div>
                    </div>
                    <p><?= $note['content'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>
