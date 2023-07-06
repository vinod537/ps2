<div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
   
     <?php if(Session::has('message')): ?>
            <div class="alert alert-success">
               <strong>Success!</strong> <?php echo e(Session::get('message')); ?>

          </div>
        <?php endif; ?>

     <!-- Form -->
     <form method='POST' action="<?php echo e(route('importPost')); ?>" enctype='multipart/form-data' >
       <?php echo e(csrf_field()); ?>

       <input type='file' name='file' required >
       <br>
       <input type='submit' name='submit' class='btn btn-primary' value='Import'>
     </form>

     
</div>
</div><?php /**PATH /var/www/html/Modules/Common/Providers/../Resources/views/import_post.blade.php ENDPATH**/ ?>