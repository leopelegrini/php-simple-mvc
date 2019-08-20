<?php require APP_ROOT . '/views/inc/header.php'; ?>

<h4 class="mb-4">Posts</h4>

<div class="mb-4">
    <a href="<?php echo(URL_ROOT . '/posts/create'); ?>" class="btn btn-primary">Adicionar</a>
</div>

<?php flash('post_message'); ?>

<?php foreach($data['posts'] as $post) : ?>
<div class="card card-body mb-3">
    <h5 class="card-title"><?php echo $post->title; ?></h5>
    <small>
        written by <?php echo $post->author . ' at ' . $post->post_created_at ?>
    </small>
    <p class="card-text mt-3"><?php echo $post->body; ?></p>
    <a href="<?php echo(URL_ROOT . '/posts/show?post_id='.$post->post_id) ?>" class="card-link">Read</a>
</div>
<?php endforeach; ?>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>