<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php if ($this->session->userdata('peran_id') == 1) : ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        <?php elseif ($this->session->userdata('peran_id') == 2) : ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('aset'); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        <?php elseif ($this->session->userdata('peran_id') == 3) : ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('atk'); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        <?php elseif ($this->session->userdata('peran_id') == 4) : ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('unit'); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        <?php elseif ($this->session->userdata('peran_id') == 5) : ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('subunit'); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><?= $title; ?></li>
                        <?php endif; ?>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h4><strong>Cooming Soon!!</strong></h4>

                        <p> Halaman ini masih dalam perkembangan.</p>
                        <p> Mohon bersabar, Maturnuwun.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>