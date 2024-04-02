<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row">
        <h1 class="text-center login-title">
            <?= $lang->login['title']; ?>
        </h1>
        <div class="account-wall">
            <img class="profile-img" src="/packages/mobcontrol/assets/no-avatar.png" alt="">
            <form id="myForm" class="form-signin">
                <div class="alert alert-danger d-none text-center" role="alert" id="alert">
                    A simple danger alert—check it out!
                </div>
                <input type="text" name="LOGIN" class="form-control" placeholder="<?= $lang->login['userOrEmail']; ?>"
                    required autofocus autocomplete="username">
                <input type="password" name="PASSWORD" class="form-control"
                    placeholder="<?= $lang->login['password']; ?>" required autocomplete="current-password">
                <button class="btn btn-lg btn-primary btn-block w-100 mb-3" type="submit">
                    <?= $lang->login['signIn']; ?>
                </button>
                <label class="checkbox pull-left w-100">
                    <input type="checkbox" value="remember" name="REMEMBER">
                    <?= $lang->login['rememberMe']; ?>
                </label>
                <a href="/access/forgot-pass" class="pull-right need-help">
                    <?= $lang->login['needHelp']; ?>
                </a><span class="clearfix"></span>
            </form>
        </div>
        <a href="/access/new-account" class="text-center new-account">
            <?= $lang->login['createAccount']; ?>
        </a>
    </div>
</div>