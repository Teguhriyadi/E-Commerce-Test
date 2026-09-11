<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fa fa-check-circle mr-2"></i>
            <div>
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fa fa-exclamation-circle mr-2"></i>
            <div>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        </div>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>