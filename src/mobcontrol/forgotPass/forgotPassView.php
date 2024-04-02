<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div style="width:350px">
        <h2 class="text-center mb-3">
            <?= $lang->forgotPass['title']; ?>
        </h2>
        <div id="success" class="alert alert-light" role="alert">
            <?= $lang->forgotPass['message']; ?>
        </div>
        <div id="danger" class="alert d-none alert-danger" role="alert">
            
        </div>
        <div id="frm" class="bg-light border rounded p-3">
            <form id="forgot">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameUser" name="nameUser"
                        placeholder="<?= $lang->forgotPass['nameUser']; ?>" required>
                    <label for="nameUser">
                        <?= $lang->forgotPass['nameUser']; ?>
                    </label>
                </div>
                <button id="submit" class="btn btn-lg btn-primary btn-block w-100 mb-3" type="submit">
                    <span id="spinner" class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                    <span id="status" role="status"><?= $lang->forgotPass['newPass']; ?></span>
                </button>
            </form>
        </div>
        <a href="/access/" class="text-center new-account">
            <?= $lang->newAccount['returnToLogin']; ?>
        </a>
    </div>
</div>