<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-6 order-md-2">
				<img src="<?= base_url('assets/login2/') ?>images/login2.svg" alt="Image" class="img-fluid">
			</div>

			<div class="col-md-6 contents">
				<div class="row justify-content-center">
					<form action="<?= base_url('auth'); ?>" method="post">
						<div class="col-md-12">
							<div class="mb-4">
								<h3>Login</h3>
								<p class="mb-4">Aplikasi Administrasi Aset dan Alat Tulis Kantor (ATK).</p>
							</div>
							<?= $this->session->flashdata('message'); ?>
							<div class="form-group first">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= set_value('username'); ?>">
								<?= form_error('username', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
							</div>
							<div class="form-group last mb-4">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password">
								<?= form_error('password', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
							</div>

							<input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
						</div>
					</form>
				</div>

			</div>

		</div>
	</div>
</div>