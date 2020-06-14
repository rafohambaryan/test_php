<!doctype html>
<html lang="en">
<?php require_once VIEWS . "{$this->permission}components/head.php" ?>
<body>
<?php require_once VIEWS . "{$this->permission}components/header.php" ?>
<?php if (file_exists(VIEWS . "{$this->permission}pages/{$this->file}.php")): ?>
    <?php require_once VIEWS . "{$this->permission}pages/{$this->file}.php"; ?>
<?php else: ?>
    <h2><?= $this->file; ?> view not fount</h2>
<?php endif; ?>
<?php require_once VIEWS . "{$this->permission}components/footer.php" ?>
<?= $this->javascript ?>
</body>
</html>