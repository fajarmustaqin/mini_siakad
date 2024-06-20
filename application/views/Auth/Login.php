
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Siakad</title>
        <link href="<?php base_url() ?>assets/css/styles.css" rel="stylesheet" />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' crossorigin='anonymous'>    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">LOGIN SIAKAD</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo base_url('auth')?>" method="post">
                                            <?= $this->session->flashdata('message'); ?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= set_value('username'); ?>"/>
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <small class="text-danger"><?= form_error('username'); ?></small>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>"/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <small class="text-danger"><?= form_error('password'); ?></small>
                                            <div class="form-floating mb-3">
                                                <span><?php echo $captcha_image; ?></span>
                                                <button class="btn btn-danger"><i class="fas fa-sync"></i></button>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="input_captcha" id="input_captcha" placeholder="Captcha">
                                                <label for="inputCaptcha">Captcha</label>
                                            </div>
                                            <small class="text-danger"><?= form_error('input_captcha') ?></small>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-outline-primary" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php base_url() ?>assets/js/scripts.js"></script>
    </body>
</html>
