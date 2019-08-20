<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="card card-body bg-light mt-5">

    <div class="form-group">
        <h5>Create post</h5>
    </div>
    <form action="<?php echo(URL_ROOT); ?>/posts/create" method="POST">
        <div class="form-group">
            <label>Post title</label>
            <input type="text" name="title" class="form-control <?php echo(!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title'] ?>">
            <span class="invalid-feedback"><?php echo $data['title_error']; ?></span>
        </div>
        <div class="form-group">
            <label>Post content</label>
            <textarea name="body" class="form-control <?php echo(!empty($data['body_error'])) ? 'is-invalid' : ''; ?>">
                <?php echo $data['body'] ?>
            </textarea>
            <span class="invalid-feedback"><?php echo $data['body_error']; ?></span>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-block">Save</button>
            </div>
            <div class="col">
                <a href="<?php echo URL_ROOT ?>/posts" class="btn btn-light btn-block">Cancel</a>
            </div>
        </div>
    </form>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>