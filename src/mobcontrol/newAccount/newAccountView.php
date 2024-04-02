<div class="d-flex justify-content-center w-100 pt-4">
    <div style="width:350px">
        <h1 class="text-center fs-3 mb-3">
            <?= $lang->newAccount['createYurAccountOn']; ?>
        </h1>
        <div class="bg-light border rounded p-3">
            <div id="alert" class="alert alert-danger d-none text-center" role="alert">

            </div>
            <form id="addNew">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="NAME" name="NAME"
                        placeholder="<?= $lang->newAccount['name']; ?>" required>
                    <label for="name">
                        <?= $lang->newAccount['name']; ?>
                    </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="SURNAME" name="SURNAME"
                        placeholder="<?= $lang->newAccount['surname']; ?>" required>
                    <label for="SURNAME">
                        <?= $lang->newAccount['surname']; ?>
                    </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="EMAIL" name="EMAIL"
                        placeholder="<?= $lang->newAccount['emailAddress']; ?>" required>
                    <label for="EMAIL">
                        <?= $lang->newAccount['emailAddress']; ?>
                    </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="USERNAME" name="USERNAME"
                        placeholder="<?= $lang->newAccount['username']; ?>" required autocomplete="username">
                    <label for="USERNAME">
                        <?= $lang->newAccount['username']; ?>
                    </label>
                </div>
                <div class="form-floating mb-1">
                    <input type="password" class="form-control" id="PASSWORD" name="PASSWORD"
                        placeholder="<?= $lang->newAccount['createPassword']; ?>" required
                        autocomplete="current-password">
                    <label for="PASSWORD">
                        <?= $lang->newAccount['createPassword']; ?>
                    </label>
                </div>
                <div class="progress mb-3" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" id="PROGRESSBAR" style="width: 0%"></div>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="BIRTH" name="BIRTH"
                        placeholder="<?= $lang->newAccount['dateOfBirth']; ?>">
                    <label for="BIRTH">
                        <?= $lang->newAccount['dateOfBirth']; ?>
                    </label>
                </div>
                <button id="btnSub" type="submit" class="btn btn-lg btn-primary w-100">
                    <span id="spin" class="spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                    <span role="status"><?= $lang->newAccount['register']; ?></span>
                </button>
            </form>
        </div>
        <a href="/access" id="toLogin" class="text-center new-account">
            <?= $lang->newAccount['returnToLogin']; ?>
        </a>
    </div>
</div>