<?php
    $user= Modules\User\Entities\User::find($param[0]);
?>

<?php echo Form::open(['route' => ['update-user-info',$param[0]], 'method' => 'post','enctype'=>'multipart/form-data']); ?>

    <div class="modal-body">

        <div class="form-group">
            <label for="first_name" class="col-form-label"><?php echo e(__('first_name')); ?></label>
            <input id="first_name" name="first_name" value="<?php echo e($user->first_name); ?>" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name" class="col-form-label"><?php echo e(__('last_name')); ?></label>
            <input id="last_name" name="last_name" value="<?php echo e($user->last_name); ?>" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label"><?php echo e(__('email')); ?></label>
            <input id="email" disabled value="<?php echo e($user->email); ?>" type="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone" class="col-form-label"><?php echo e(__('phone')); ?></label>
            <input id="phone" name="phone" value="<?php echo e($user->phone); ?>" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="dob" class="col-form-label"><?php echo e(__('dob')); ?></label>
            <input id="dob" name="dob" value="<?php echo e($user->dob); ?>" type="date" max="<?php echo e(date('Y-m-d')); ?>" pattern="\d{4}-\d{2}-\d{2}" class="form-control">
        </div>

        <div class="form-group">
            <label for="social_media" class="col-form-label"><?php echo e(__('Linkedin')); ?></label>
            <input id="social_media" name="social_media" value="<?php echo e($user->social_media); ?>" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="position" class="col-form-label"><?php echo e(__('Position')); ?></label>
            <input id="position" name="position" value="<?php echo e($user->position); ?>" type="text" class="form-control">
        </div>


        <div class="form-group">
            <label for="about" class="col-form-label"><?php echo e(__('about')); ?></label>
            <textarea name="about" class="form-control"><?php echo e($user->about); ?></textarea>
        </div>


        <div class="form-group">
            <label for="newsletter" class="col-form-label"><?php echo e(__('gender')); ?></label>
            <select class="form-control" name="gender" id="gender">
                <option><?php echo e(__('select_option')); ?></option>
                <?php $__currentLoopData = __('genders.genderType'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($user->gender ==$value): ?> Selected
                            <?php endif; ?> value="<?php echo e($value); ?>"><?php echo e($item); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group">
            <label for="newsletter" class="col-form-label"><?php echo e(__('Status (About Page)')); ?></label>
            <select class="form-control" name="status_about" id="status_about">
                <option value=""><?php echo e(__('select_option')); ?></option>
                <option <?php if($user->status_about =='show'): ?> Selected
                    <?php endif; ?> value="show"><?php echo e(__('Show')); ?></option>
                <option <?php if($user->status_about =='hide'): ?> Selected
                    <?php endif; ?> value="hide"><?php echo e(__('Hide')); ?></option>
                
            </select>
        </div>

        <div class="form-group">
            <label for="newsletter" class="col-form-label"><?php echo e(__('Order (About Page)')); ?></label>
            <select class="form-control" name="order_about" id="order_about">
                <option value=""><?php echo e(__('select_option')); ?></option>                
                <option <?php if($user->order_about =='1'): ?> Selected
                    <?php endif; ?> value="1">1</option>
                <option <?php if($user->order_about =='2'): ?> Selected
                    <?php endif; ?> value="2"><?php echo e(__('2')); ?></option>
                <option <?php if($user->order_about =='3'): ?> Selected
                    <?php endif; ?> value="3"><?php echo e(__('3')); ?></option>
                <option <?php if($user->order_about =='4'): ?> Selected
                    <?php endif; ?> value="4"><?php echo e(__('4')); ?></option>
                <option <?php if($user->order_about =='5'): ?> Selected
                    <?php endif; ?> value="5"><?php echo e(__('5')); ?></option>
                <option <?php if($user->order_about =='6'): ?> Selected
                    <?php endif; ?> value="6"><?php echo e(__('6')); ?></option>
                <option <?php if($user->order_about =='7'): ?> Selected
                    <?php endif; ?> value="7"><?php echo e(__('7')); ?></option>
                <option <?php if($user->order_about =='8'): ?> Selected
                    <?php endif; ?> value="8"><?php echo e(__('8')); ?></option>
                <option <?php if($user->order_about =='9'): ?> Selected
                    <?php endif; ?> value="9"><?php echo e(__('9')); ?></option>
            </select>
        </div>


        <div class="form-group">
            <label for="newsletter" class="col-form-label"><?php echo e(__('newsletter')); ?></label>
            <select name="newsletter_enable" class="form-control">
                <option value="0" <?php if($user->newsletter_enable==0): ?> selected <?php endif; ?>><?php echo e(__('disable')); ?></option>
                <option value="1" <?php if($user->newsletter_enable==1): ?> selected <?php endif; ?>><?php echo e(__('enable')); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label for="profile_image" class="upload-file-btn btn btn-primary"><i
                    class="fa fa-folder input-file"
                    aria-hidden="true"></i> <?php echo e(__('select_image')); ?></label>
            <input id="profile_image" name="profile_image" onChange="swapImage(this)" data-index="0"
                   type="file" class="form-control d-none" accept="image/*">
        </div>
        <div class="form-group text-center">
            <?php if(profile_exist($user->profile_image) && $user->profile_image!=null): ?>
                <img src="<?php echo e(static_asset($user->profile_image)); ?>" data-index="0"
                     height="200" width="200" alt="img">
            <?php else: ?>
                <img src="<?php echo e(static_asset('default-image/user.jpg')); ?>" height="200" width="200" data-index="0" alt="user" class="img-responsive ">
            <?php endif; ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="m-r-10 fas fa-window-close"></i><?php echo e(__('close')); ?></button>
        <button type="submit" class="btn btn-primary"><i class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('save')); ?></button>
    </div>
<?php echo e(Form::close()); ?>

<?php /**PATH /var/www/html/Modules/Common/Providers/../Resources/views/modal/edit-user.blade.php ENDPATH**/ ?>