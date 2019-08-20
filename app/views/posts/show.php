<?php require APP_ROOT . '/views/inc/header.php'; ?>

<h4 class="mb-4"">Posts</h4>

<div class="card card-body">
    <h5 class="card-title"><?php echo $data['post']->title; ?></h5>
    <small>
        written by <?php echo $data['post']->author . ' at ' . $data['post']->post_created_at ?>
    </small>
    <p class="card-text mt-3"><?php echo $data['post']->body; ?></p>
</div>

<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
    <hr>
    <form action="<?php echo(URL_ROOT . '/posts/delete?post_id=' . $data['post']->post_id); ?>" method="POST">
        <a href="<?php echo(URL_ROOT . '/posts/edit?post_id=' . $data['post']->post_id); ?>" class="btn btn-primary">
            Edit
        </a>
        <button type="submit" class="btn btn-danger">
            Delete
        </button>
    </form>
<?php endif; ?>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>