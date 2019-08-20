<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="card card-body bg-light mt-5">

    <div class="form-group">
        <h5>Adicionar tarefa</h5>
    </div>
    <form action="<?php echo(URL_ROOT); ?>/tasks/create" method="POST">
        <div class="form-group">
            <label>Texto</label>
            <textarea name="description" rows="8" class="form-control <?php echo(!empty($data['description_error'])) ? 'is-invalid' : ''; ?>"><?php echo $data['description'] ?></textarea>
            <span class="invalid-feedback"><?php echo $data['description_error']; ?></span>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success btn-block">Salvar</button>
            </div>
            <div class="col">
                <a href="<?php echo URL_ROOT ?>/tasks" class="btn btn-light btn-block">Cancelar</a>
            </div>
        </div>
    </form>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>