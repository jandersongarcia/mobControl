<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div style="width:350px">
        <div id="message" class="alert alert-light" role="alert">
            <?= $lang->newPass['message']; ?>
        </div>
        <div id="box" class="bg-light border rounded p-3">
            <form id="myForm">
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" id="newPass" name="newPass"
                        placeholder="<?= $lang->newPass['newPass']; ?>" required>
                    <label for="newPass">
                        <?= $lang->newPass['newPass']; ?>
                    </label>
                </div>
                <div class="progress mb-3" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div id="progress" class="progress-bar bg-danger" style="width: 0%"></div>
                </div>
                <div class="border rounded bg-white p-2 mb-3">
                    <?= $lang->newPass['tip'] ?>
                </div>
                <div class="d-flex justify-content-between gap-2">
                    <div id="generate" class="btn btn-secondary btn-block w-100 mb-3">
                        <?= $lang->newPass['generate']; ?>
                    </div>
                    <button id="button" class="btn btn-primary btn-block w-100 mb-3" type="submit">
                        <span id="spinner" class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                        <span ><?= $lang->newPass['savePass']; ?></span>
                    </button>
                </div>
            </form>
        </div>
        <a href="/access/" class="text-center new-account">
            <?= $lang->newAccount['returnToLogin']; ?>
        </a>
    </div>
</div>