
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeigniter website</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</head>

<body class="d-flex align-items-center justify-content-center " style="height:100vh;">
        <div style="width: 400px;">
            <h1>Login</h1>
            <form action="<?php echo base_url();?>" method="post">
              <?php
              if($this->session->flashdata('registration')){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>'.$this->session->flashdata('registration').'</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
              if($this->session->flashdata('loginError')){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>'.$this->session->flashdata('loginError').'</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
              }
              ?>
               
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo set_value('email'); ?>" required>
                  <span class="text-danger"><?php echo form_error('email'); ?></span>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo set_value('password'); ?>" required>
                  <span class="text-danger"><?php echo form_error('password'); ?></span>
                </div>
                
                <button type="submit" class="btn btn-primary" name="login">Submit</button>
              </form>
              <p class="mt-3">Need a account <a href="<?php echo base_url('login/register');?>">Sign Up</a></p>
        </div>

</body>

</html>