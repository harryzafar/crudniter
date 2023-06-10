
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php website</title>
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
            <h1>Sign Up</h1>
            <form action="<?php echo base_url('login/register');?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" value="<?php echo set_value('username'); ?>" name="username" required>
                    
                  </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo set_value('email'); ?>" name="email" aria-describedby="emailHelp" required>
                  <span class="text-danger"><?php echo form_error('email'); ?></span>                  
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                  <span class="text-danger" ><?php echo form_error('password'); ?></span>
                </div>
                
                <button type="submit" class="btn btn-primary" name="signup">Submit</button>
              </form>
              <p class="mt-3">Already have a account <a href="<?php echo base_url();?>">Login</a></p>
        </div>

</body>

</html>