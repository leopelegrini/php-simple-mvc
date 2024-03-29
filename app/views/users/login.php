<?php require APP_ROOT . '/views/inc/header.php'; ?>

<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card card-body bg-light mt-5">

			<?php flash('register_success'); ?>

			<div class="form-group">
				<h5>Login</h5>
			</div>
			<form action="<?php echo(URL_ROOT); ?>/users/login" method="POST">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control <?php echo(!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email'] ?>">
					<span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control <?php echo(!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password'] ?>">
					<span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
				</div>
				<div class="row">
					<div class="col">
						<button type="submit" class="btn btn-success btn-block">Register</button>
					</div>
					<div class="col">
						<a href="<?php echo URL_ROOT ?>/users/register" class="btn btn-light btn-block">Create account</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require APP_ROOT . '/views/inc/footer.php'; ?>