<?php require APP_ROOT . '/views/inc/header.php'; ?>

<h4 class="mb-4">Tasks</h4>

<div class="mb-4">
    <a href="<?php echo(URL_ROOT . '/tasks/create'); ?>" class="btn btn-primary">Adicionar</a>
</div>

<?php flash('task_message'); ?>

<?php if(count($data['tasks'])) : ?>
    <?php foreach($data['tasks'] as $task) : ?>
    <div class="card card-body mb-3">
        <p class="card-text"><?php echo $task->description; ?></p>
        <small>
            <?php echo $task->task_created_at ?>
        </small>
        <a href="<?php echo(URL_ROOT . '/tasks/show?task_id='.$task->task_id) ?>" class="card-link mt-1">Read</a>
    </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="alert alert-warning">
        Nenhuma tarefa cadastrada
    </div>
<?php endif; ?>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>