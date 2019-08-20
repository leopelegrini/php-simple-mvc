<?php require APP_ROOT . '/views/inc/header.php'; ?>

<h4 class="mb-4"">Tasks</h4>

<div class="card card-body">
    <p class="card-text"><?php echo $data['task']->description; ?></p>
    <small>
        written by <?php echo $data['task']->author . ' at ' . $data['task']->task_created_at ?>
    </small>
</div>

<?php if($data['task']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <form action="<?php echo(URL_ROOT . '/tasks/delete?task_id=' . $data['task']->task_id); ?>" method="task">
        <a href="<?php echo(URL_ROOT . '/tasks/edit?task_id=' . $data['task']->task_id); ?>" class="btn btn-primary">
            Edit
        </a>
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>
<?php endif; ?>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>