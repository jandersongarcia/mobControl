<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div style="width:350px">
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-x-circle-fill fs-1"></i>
            <div class="ms-2">
                <?= $lang->recoveryError['message']; ?>
            </div>
        </div>
        <a href="/access/" class="text-center new-account">
            <?= $lang->newAccount['returnToLogin']; ?>
        </a>
    </div>
</div>