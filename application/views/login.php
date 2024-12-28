<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="<?= base_url('assets/admin2/') ?>images/aset_atk.png" alt="" class="img-fluid mb-0" width="150" height="150">
		<h3 class="text-black">E-Inventory</h3>
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
						<form action="<?= base_url('auth'); ?>" method="post">
							<h4 class="mb-3 f-w-400">LOGIN</h4>
							<hr>
							<?= $this->session->flashdata('message'); ?>
							<div class="form-group mb-3">
								<input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?= set_value('username'); ?>" autocomplete="off">
							</div>
							<?= form_error('username', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
							<div class="form-group mb-4 password-field">
								<input type="password" class="form-control" id="password" placeholder="Password" name="password">
								<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							</div>
							<?= form_error('password', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
							<button type=" submit" class="btn btn-block btn-primary mb-4">Masuk</button>
							<hr>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>