      <div class="sufee-login d-flex align-content-center flex-wrap">
          <div class="container">
              <div class="login-content">
                  <div class="login-logo">
                      <div class="logo-img front">
                          <img src="../img/<?= $this->company_info->get_company_logo(); ?>" class="smooth-shadow" alt="logo">
                          <img src="../assets/img/loader.gif" class="bg-logo" alt="logo">
                      </div>
                      <h3 class="font-weight-bold">
                          <?= $this->company_info->get_company_name(); ?>
                      </h3>
                  </div>
                  <div class="login-form smooth-shadow">
                      <?php if ($error) { ?>

                          <div class="alert alert-danger"><?= $error; ?></div>
                      <?php } ?>

                      <form action="<?= base_url("auth/login"); ?>" method="post">
                          <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" class="form-control">
                          </div>
                          <div class="form-group mb-5">
                              <label>Password</label>
                              <input type="password" class="form-control" name="password">
                          </div>
                          <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>