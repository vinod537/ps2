<?php $__env->startSection('ads-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('youtubes'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('ads_active'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <div class="admin-section">
                <div class="row clearfix m-t-30">
                    <div class="col-12">
                        <div class="navigation-list bg-white p-20">
                            <div class="add-new-header clearfix m-b-20">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="block-header">
                                            <h2><?php echo e(__('youtubes')); ?></h2>
                                        </div>
                                    </div>
                                    <?php if(Sentinel::getUser()->hasAccess(['ads_write'])): ?>
                                        <div class="col-6 text-right">
                                            <a href="<?php echo e(route('create-youtube')); ?>" class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('create_youtube')); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr role="row">
                                        <th>#</th>
                                        <th><?php echo e(__('title')); ?></th>
                                        <th><?php echo e(__('Change status')); ?></th>
                                        <th><?php echo e(__('video')); ?></th>
                                        <th><?php echo e(__('options')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $youtubes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $youtube): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr role="row" id="row_<?php echo e($youtube->id); ?>" class="odd">
                                            <td class="sorting_1"><?php echo e($youtube->id); ?></td>
                                            <td> <?php echo e($youtube->video_title); ?> </td>

                                            <td>
                                           <div class="statuschange">
                                                <?php 
                                                if($youtube->status == '0'){
                                                    $classes = 'danger';
                                                    $classescontent = 'Pending';
                                                }else{
                                                    $classes = 'success';
                                                    $classescontent = 'Approved';
                                                }
                                                ?>  
                                                <p data-id="<?php echo e($youtube->id); ?>" data-status="<?php echo e($youtube->status); ?>" class="updatestatus updatestatus<?php echo e($youtube->id); ?> btn btn-small btn-<?php echo e($classes); ?>">
                                                    <?php echo e($classescontent); ?>

                                                </p>  
                                           </div>
                                            </td>
                                            <td> 
                                        
                                            <iframe width="200" height="200" src="<?php echo e($youtube->embed_video); ?>" title="LIFE SCIENCES DAILY NEWS OCTOBER 13, 2022" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </td>
                                            
                                            <?php if(Sentinel::getUser()->hasAccess(['ads_write']) || Sentinel::getUser()->hasAccess(['ads_delete']) ): ?>
                                                <td>
                                                  
                                                    <?php if(Sentinel::getUser()->hasAccess(['ads_delete'])): ?>
                                                        <a href="javascript:void(0)" class="btn btn-light active btn-xs"
                                                           onclick="delete_item('youtubes','<?php echo e($youtube->id); ?>')"><i
                                                                class="fa fa-trash"></i>
                                                            <?php echo e(__('delete')); ?>

                                                        </a>
                                                    <?php endif; ?>

                                                    <p data-id="<?php echo e($youtube->id); ?>" data-status="<?php echo e($youtube->status); ?>" class="changestatus changestatus<?php echo e($youtube->id); ?> btn btn-small btn-primary">
                                                        Change Status
                                                    </p> 
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>

$('body').on('click', '.changestatus', function(){

   var dataid =  $(this).data('id')
   var datastatus =  $(this).data('status')

    youtube_change_status(dataid, datastatus)
})


function youtube_change_status(id, status) {
    $.ajax({
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
                    },
            type: "POST",
            url: "<?php echo e(route('admin.youtube_change_status')); ?>",
            data : {id : id,status:status},
            success: function(response){
                response = JSON.parse(response)
                if (response.status == 'success') {   
                    if(status == 1){
                        $('.updatestatus'+id).removeClass('btn-success') 
                        $('.updatestatus'+id).addClass('btn-danger') 
                        $('.updatestatus'+id).text('Pending') 
                        $('.changestatus'+id).data('status', 0) 
                    }else{
                        $('.updatestatus'+id).removeClass('btn-danger') 
                        $('.updatestatus'+id).addClass('btn-success') 
                        $('.updatestatus'+id).text('Approved') 
                        $('.changestatus'+id).data('status', 1) 

                    }
                    
                }else{}  
            }
        });

}





    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Appearance/Providers/../Resources/views/youtubes.blade.php ENDPATH**/ ?>