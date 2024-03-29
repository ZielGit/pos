<?php

use Controllers\UserController;

?>
<div class="login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h1><b>Admin</b>LTE</h1>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            <!-- /.col -->
          </div>
          <?php
            $login = new UserController();
            $login -> ctrIngresoUsuario();
          ?>
        </form>
        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
</div>