
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="mt-5">
            <div class="d-flex justify-content-between">
                <h1>Notes Crud</h1>
                <div>
                   <span class="me-3"><?php echo $this->session->userdata('user');?></span> <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
                </div>
            </div>
                    </div>
         <?php
         if($this->session->flashdata('alert')){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>'.$this->session->flashdata('alert').'</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
         }
         if($this->session->flashdata('success')){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>'.$this->session->flashdata('success').'</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
       }
         ?>           

        <form action="<?php echo base_url('home/create');?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>

            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <input type="text" class="form-control" id="desc" name="desc" required>

            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="img">

            </div>


            <button type="submit" name="add" class="btn btn-primary">Submit</button>
        </form>

        <table class="table mt-3">
            <tr>
                <th>Sr No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            if(!empty($rows)){
              $sr = 0;
            foreach($rows as $row){ $sr = $sr+1; ?>
              <tr>
                <td><?php echo $sr;?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['description'];?></td>
                <td>
                <?php if(!empty($row['image']) && file_exists('./public/'.$row['image'])){;?>
                        <img src="<?php echo base_url().'public/'.$row['image']; ?>"  style="width:40px; height:40px; object-fit:cover;"  alt="" srcset="">
                      <?php }
                      else{
                        ;?> <img src="<?php echo base_url().'public/no-image.jpg'?>"  style="width:40px; height:40px; object-fit:cover;"  alt="" srcset="">
                      <?php }; ?>
                </td>
                <td>
                    <a href="<?php echo base_url('home/edit/').$row['id'];?>"  class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger del-btn" value=<?php echo $row['id'];?>  data-bs-target="#deleteModal">Delete</button>
                </td>
            </tr>
           <?php }
            }else{?>
            <tr>
              <td colspan="6" class="text-center">No Record Found yet. Please insert.</td>
            </tr>
           <?php }
            ?>
               
                               
        </table>
    </div>

    <!-- logout modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="<?php echo base_url('login/logout'); ?>" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- delete notes modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="" class="btn btn-primary delete">Delete</a>
      </div>
    </div>
  </div>
</div>

 <!-- jquery -->
 <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
$('.del-btn').on('click', function(){
    let id = $(this).val();
    let link = '<?php echo base_url('home/delete/');?>'+id;
    $('a.delete').attr("href", link);
   $('#deleteModal').modal('toggle');
})
</script>
</body>

</html>