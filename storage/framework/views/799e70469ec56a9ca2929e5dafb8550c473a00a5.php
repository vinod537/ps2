<?php $__env->startSection('post-aria-expanded'); ?>

    aria-expanded="true"

<?php $__env->stopSection(); ?>

<?php $__env->startSection('post-show'); ?>

    show

<?php $__env->stopSection(); ?>

<?php $__env->startSection('post'); ?>

    active

<?php $__env->stopSection(); ?>

<?php $__env->startSection('post-active'); ?>

    active

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

    <?php echo $__env->make('gallery::image-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('gallery::video-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('content'); ?>



    <div class="dashboard-ecommerce">

        <div class="container-fluid dashboard-content ">

            <!-- page info start-->

            <?php echo Form::open(['route'=>['update-press-release','article',$post->id],'method' => 'post','enctype'=>'multipart/form-data']); ?>


            <input type="hidden" id="images" value="<?php echo e($countImage); ?>">

            <input type="hidden" id="videos" value="<?php echo e($countVideo); ?>">

            <input type="hidden" id="imageCount" value="1">

            <div class="row clearfix">

                <div class="col-12">

                    <div class="add-new-header clearfix m-b-20">

                        <div class="row">

                            <div class="col-6">

                                <div class="block-header">

                                    <h2><?php echo e(__('update_post')); ?></h2>

                                </div>

                            </div>

                            

                            <div class="col-6 text-right">

                                <div class="form-group">

                                    <label class="custom-control" for="btnSubmit"></label>

                                    <button type="submit" name="btnSubmit" class="btn btn-primary pull-right"><i

                                            class="m-r-10 mdi mdi-content-save-all"></i><?php echo e(__('Update Press Release')); ?>


                                    </button>

                                    <label class="" for="btnSubmit"></label>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-12">

                            <?php if(session('error')): ?>

                                <div id="error_m" class="alert alert-danger">

                                    <?php echo e(session('error')); ?>


                                </div>

                            <?php endif; ?>

                            <?php if(session('success')): ?>

                                <div id="success_m" class="alert alert-success">

                                    <?php echo e(session('success')); ?>


                                </div>

                            <?php endif; ?>

                            <?php if($errors->any()): ?>

                                <div class="alert alert-danger">

                                    <ul>

                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <li><?php echo e($error); ?></li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>

                                </div>

                            <?php endif; ?>

                        </div>



                        <!-- Main Content section start -->

                        <div class="col-12 col-lg-9">

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2><?php echo e(__('posts_details')); ?></h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_title" class="col-form-label"><?php echo e(__('title')); ?>*</label>

                                        <input id="post_title" name="title" value="<?php echo e($post->title); ?>" type="text"

                                               class="form-control" required>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post-slug" class="col-form-label"><b><?php echo e(__('slug')); ?></b>

                                            (<?php echo e(__('slug_message')); ?>)</label>

                                        <input id="post-slug" value="<?php echo e($post->slug); ?>" name="slug" type="text"

                                               class="form-control">

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                <div class="form-group">
                                        <label for="post_company_name" class="col-form-label"><?php echo e(__('company_name')); ?>

                                            (<?php echo e(__('company_name')); ?>)</label>
                                        <input id="post_company_name"  value="<?php echo e($post->company_name); ?>" name="company_name" type="text" value="<?php echo e(old('company_name')); ?>"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <label for="post_product" class="col-form-label"><?php echo e(__('product')); ?>

                                            (<?php echo e(__('product')); ?>)</label>
                                        <input id="post_product"   value="<?php echo e($post->product); ?>" name="product" type="text" value="<?php echo e(old('product')); ?>"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div>

                                <!-- tinemcey start -->

                                <div class="row p-l-15">
                                    <div class="col-12">
                                        <label for="post_contentnews" class="col-form-label"><?php echo e(__('Content')); ?>*</label>
                                        <textarea name="post_contentnews"  value="<?php echo e(old('post_contentnews')); ?>" id="post_contentnews"
                                                  cols="30" rows="5"><?php echo $post->content; ?></textarea>
                                    </div>
                                </div>

                                

                                <!-- tinemcey end -->

                            </div>


                        

                     

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2><?php echo e(__('seo_details')); ?></h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="meta_title"><b><?php echo e(__('title')); ?></b> (<?php echo e(__('meta_title')); ?>)</label>

                                        <input class="form-control meta" value="<?php echo e($post->meta_title ?? $post->title); ?>"

                                               id="meta_title" name="meta_title" data-type="title">

                                        <p class="display-nothing alert alert-danger mt-2" role="alert">

                                            <?php echo e(__('current_characters')); ?>: <span class="characters"></span>, <?php echo e(__('meta_title').' '. __('should_bd') .' '. __('in_between') .' '. '30-60 ' . __('characters')); ?>


                                        </p>

                                        <p class="display-nothing alert alert-success mt-2" role="alert">

                                            <?php echo e(__('current_characters')); ?>: <span class="characters"></span>

                                        </p>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post-keywords" class="col-form-label"><b><?php echo e(__('keywords')); ?></b>

                                            </label>

                                        <input id="post-keywords" name="meta_keywords"

                                               value="<?php echo e($post->meta_keywords); ?>" type="text" class="form-control">

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_tags" class="col-form-label"><?php echo e(__('tags')); ?>(<?php echo e(__('meta_tag')); ?>)</label>

                                        <input id="post_tags" name="tags" type="text" value="<?php echo e($post->tags); ?>"

                                               data-role="tagsinput" class="form-control"/>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_desc"><b><?php echo e(__('description')); ?></b> (<?php echo e(__('meta_description')); ?>


                                            )</label>

                                        <textarea class="form-control meta" id="meta_description" name="meta_description" data-type="description"

                                                  rows="3"><?php echo e($post->meta_description); ?></textarea>

                                        <p class="display-nothing alert alert-danger mt-2" role="alert">

                                            <?php echo e(__('current_characters')); ?>: <span class="characters"></span>, <?php echo e(__('meta_title').' '. __('should_bd') .' '. __('in_between') .' '. '30-60 ' . __('characters')); ?>


                                        </p>

                                        <p class="display-nothing alert alert-success mt-2" role="alert">

                                            <?php echo e(__('current_characters')); ?>: <span class="characters"></span>

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <!-- SEO section end -->

                        </div>

                        <!-- Main Content section end -->



                        <!-- right sidebar start -->

                        <div class="col-12 col-lg-3">                           

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="post_language"><?php echo e(__('select_language')); ?>*</label>

                                        <select class="form-control dynamic-category" id="post_language" name="language"

                                         data-dependent="category_id">

                                            <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <option

                                                    <?php if($post->language==$lang->code): ?> Selected

                                                    <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>


                                                </option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_language"><?php echo e(__('Date')); ?>*</label>
                                        <?php
                                        
                                        $date =      date('Y-m-d\TH:i', strtotime($post->created_at));
                                        ?>
                                        <input type="datetime-local" name="update_date" value="<?php echo e($date); ?>"id="update_date" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="post_user_id"><?php echo e(__('Select User')); ?>*</label>
                                            <?php 
                                            // print_r($users);
                                            ?>
                                            <select class="form-control dynamic-category" id="post_user_id" name="user_id"
                                            required>
                                            <?php
                                            $keys = 0;
                                            ?>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($user->withActivation != null): ?>
                                        
                                            <?php $__currentLoopData = $user->withRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php  $keys++; ?>
                                                <?php if($role->role_id !='4'): ?> 
                                                    <option  <?php if($user->id == $post->user_id): ?> Selected  <?php endif; ?> value="<?php echo e($user->id); ?>"> <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>  </option>
                                                <?php endif; ?> 
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="category_id"><?php echo e(__('category')); ?>*</label>
                                        <?php 
                                        $postcategory = json_decode($post->category_id);
                                       // print_r($postcategory);
                             
                             ?>
                                        <select class="form-control dynamic select2 category-multiple" multiple="multiple" id="category_id" name="category_id[]"

                                                data-dependent="sub_category_id" required>

                                            <option value=""><?php echo e(__('select_category')); ?></option>

                                            
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          

                                                <option <?php if(in_array($category->id, $postcategory)): ?> Selected

                                                        <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <label for="sub_category_id"><?php echo e(__('sub_category')); ?></label>

                                        <select class="form-control dynamic" id="sub_category_id" name="sub_category_id">

                                            <option value=""><?php echo e(__('select_sub_category')); ?></option>

                                            <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <option <?php if($post->sub_category_id == $subCategory->id): ?> Selected

                                                        <?php endif; ?> value="<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->sub_category_name); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="col-md-12">

                                    <div class="block-header">

                                        <h2><?php echo e(__('article_detail')); ?></h2>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label class="custom-control custom-radio detail-control-inline">

                                                

                                                <input type="radio" name="layout" id="detail_style_1" value="default" <?php echo e(@$post->layout=="default" ? 'checked': ''); ?>  class="custom-control-input">

                                                <span class="custom-control-label"></span>

                                            </label>

                                            <img src="<?php echo e(static_asset('default-image/Detail/detail_1.png')); ?>" alt="" class="img-responsive cat-block-img">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label class="custom-control custom-radio detail-control-inline">

                                                <input type="radio" name="layout" id="detail_style_2" value="style_2" <?php echo e(@$post->layout=="style_2" ? 'checked': ''); ?>  class="custom-control-input">

                                                <span class="custom-control-label"></span>

                                            </label>

                                            <img src="<?php echo e(static_asset('default-image/Detail/detail_2.png')); ?>" alt="" class="img-responsive cat-block-img">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label class="custom-control custom-radio detail-control-inline">

                                                <input type="radio" name="layout" id="detail_style_3" value="style_3" <?php echo e(@$post->layout=="style_3" ? 'checked': ''); ?>  class="custom-control-input">

                                                <span class="custom-control-label"></span>

                                            </label>

                                            <img src="<?php echo e(static_asset('default-image/Detail/detail_3.png')); ?>" alt="" class="img-responsive cat-block-img">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="add-new-page  bg-white p-20 m-b-20">

                                <div class="block-header">

                                    <h2><?php echo e(__('publish')); ?>*</h2>

                                </div>

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <select class="form-control" id="post_status" name="status" required>

                                            <option <?php if($post->status==1 && $post->scheduled==0): ?> selected

                                                    <?php endif; ?> value="1"><?php echo e(__('published')); ?></option>

                                            

                                            

                                        </select>

                                    </div>

                                </div>

                                <div class="col-sm-12 divScheduleDate"

                                     <?php if($post->post_status==0 && $post->scheduled==1): ?> <?php else: ?> id="display-nothing" <?php endif; ?>>

                                    <label for="scheduled_date"><?php echo e(__('schedule_date')); ?></label>

                                    <div class="input-group">

                                        <label class="input-group-text" for="scheduled_date"><i

                                                class="fa fa-calendar-alt"></i></label>

                                        <input type="text" class="form-control date" id="scheduled_date"

                                               value="<?php echo e(Carbon\Carbon::parse($post->scheduled_date)->format('m/d/Y g:i A')); ?>"

                                               name="scheduled_date"/>

                                    </div>

                                </div>

                                

                            </div>

                        </div>

                        <!-- right sidebar end -->

                    </div>

                </div>

            </div>

        <?php echo Form::close(); ?>


        <!-- page info end-->

        </div>

    </div>





<?php $__env->startSection('script'); ?>

    <script>
        $(document).ready(function () {

            $('.dynamic-category').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "<?php echo e(csrf_token()); ?>";
                    $.ajax({
                        url: "<?php echo e(route('category-fetch')); ?>",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });

            $(".category-multiple").select2({
                placeholder: "Select a Category"
            });

            $('#post_language').change(function () {
                $('#category_id').val('');
                $('#sub_category_id').val('');
            });

            $('.dynamic').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "<?php echo e(csrf_token()); ?>";
                    $.ajax({
                        url: "<?php echo e(route('subcategory-fetch')); ?>",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });


            $('#category').change(function () {
                $('#sub_category_id').val('');
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo e(static_asset('js/post.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(static_asset('js/tagsinput.js')); ?>"></script>
    <script>
        addContent = function(value) {

            var content_number = $("#content_number").val();
            content_number++;

            $.ajax({
                url: "<?php echo e(route('add-content')); ?>",
                method: "GET",
                data: {value: value, content_count:content_number},
                success: function (result) {
                     $('.content-area').append(result);
                    $("#content_number").val(content_number);

                    // auto scrolling to newly added element
                    var newlyAdded = 'content_'+content_number;
                    $('body, html').animate({ scrollTop: $('.'+newlyAdded).offset().top }, 1000);

                }

            });
        }

        $(document).on("click", ".add-new-page .row_remove", function () {
            let element = $(this).parents('.add-new-page');
            //element.remove(1000);
            element.hide("slow", function(){ $(this).remove(); })
        });
    </script>
<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_contentnews', {
        extraPlugins: 'image2, uploadimage, sourcedialog, iframe',

        toolbar: [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'insert',
                items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            {
                name: 'document',
                items: ['Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates']
            },
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
            },
            {
                name: 'links',
                items: ['Link', 'Unlink', 'Anchor']
            },
           
            {
                name: 'tools',
                items: ['Maximize', 'ShowBlocks']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'forms',
                items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']
            },
            {
                name: 'editing',
                items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
            }
        ],

       

        // Configure your file manager integration. This example uses CKFinder 3 for PHP.
        filebrowserBrowseUrl: '/apps/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '/apps/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '/apps/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '/apps/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

        // Upload dropped or pasted images to the CKFinder connector (note that the response type is set to JSON).
        uploadUrl: '/apps/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

        // Reduce the list of block elements listed in the Format drop-down to the most commonly used.
        format_tags: 'p;h1;h2;h3;pre',
        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',
        height: 450,
        removeButtons: 'PasteFromWord'
    });
</script>
   

<?php $__env->stopSection(); ?>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>

        $(document).ready(function () {



             $('.dynamic-category').change(function () {

                if ($(this).val() != '') {

                    var select = $(this).attr("id");

                    var value = $(this).val();

                    var dependent = $(this).data('dependent');

                    var _token = "<?php echo e(csrf_token()); ?>";

                    $.ajax({

                        url: "<?php echo e(route('category-fetch')); ?>",

                        method: "POST",

                        data: {select: select, value: value, _token: _token},

                        success: function (result) {

                            $('#' + dependent).html(result);

                        }



                    })

                }

            });



            $('#post_language').change(function () {

                $('#category_id').val('');

                $('#sub_category_id').val('');

            });







            $('.dynamic').change(function () {

                if ($(this).val() != '') {

                    var select = $(this).attr("id");

                    var value = $(this).val();

                    var dependent = $(this).data('dependent');

                    var _token = "<?php echo e(csrf_token()); ?>";

                    $.ajax({

                        url: "<?php echo e(route('subcategory-fetch')); ?>",

                        method: "POST",

                        data: {select: select, value: value, _token: _token},

                        success: function (result) {

                            $('#' + dependent).html(result);

                        }



                    })

                }

            });



            $('#category_id').change(function () {

                $('#sub_category_id').val('');

            });





        });



    </script>

    <script>

        addContent = function(value) {



            var content_number = $("#content_number").val();

            content_number++;



            $.ajax({

                url: "<?php echo e(route('add-content')); ?>",

                method: "GET",

                data: {value: value, content_count:content_number},

                success: function (result) {

                    $('.content-area').append(result);

                    $("#content_number").val(content_number);



                    // auto scrolling to newly added element

                    var newlyAdded = 'content_'+content_number;

                    $('body, html').animate({ scrollTop: $('.'+newlyAdded).offset().top }, 1000);

                }



            });

        }





        $(document).on("click", ".add-new-page .row_remove", function () {

            let element = $(this).parents('.add-new-page');

            //element.remove(1000);

            element.hide("slow", function(){ $(this).remove(); })

        });

    </script>



    <script type="text/javascript" src="<?php echo e(static_asset('js/post.js')); ?>"></script>

    <script src="<?php echo e(static_asset('js/tagsinput.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/press_release_edit.blade.php ENDPATH**/ ?>