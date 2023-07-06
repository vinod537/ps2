<?php $__env->startSection('post-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('create_article'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
    <?php echo $__env->make('gallery::image-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('gallery::video-gallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<style>

.col-12.errormessagepreview p {
    padding: -6px;
    margin: 3px;
    color: red;
}
</style>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <?php echo Form::open(['route' => ['save-new-post','article'],'class' => ['previewpostform'], 'method' => 'post','enctype'=>'multipart/form-data']); ?>

            <input type="hidden" id="images" value="<?php echo e($countImage); ?>">
            <input type="hidden" id="videos" value="<?php echo e($countVideo); ?>">
            <input type="hidden" id="imageCount" value="1" class="imageCount">
            <input type="hidden" id="videoCount" value="1">
            <div class="row clearfix">
                <div class="col-12">
                    <div class="add-new-header clearfix m-b-20">
                        <div class="row">
                        <div class="col-12 errormessagepreview">
                            </div>
                            <div class="col-6">
                                <div class="block-header">
                                    <h2><?php echo e(__('add_post')); ?></h2>
                                </div>
                            </div>
                            
                           
                            <div class="col-6 text-right">
                            
                                <div class="form-group">
                                    <label class="custom-control" for="btnSubmit"></label>
                                    
                                  
                                    <button type="submit" name="btnSubmit"  class="btn btn-primary pull-right"><i
                                    class="m-r-10 mdi mdi-plus"></i><?php echo e(__('Publish Post')); ?></button>

                                    <button type="button" name="previewpost" value="1" class="btn btn-success  previewpost pull-right"><i
                                            class="m-r-10 mdi mdi-plus"></i><?php echo e(__('Preview Post')); ?></button>

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
                                        <input id="post_title" onkeyup="metaTitleSet()" name="title"
                                               value="<?php echo e(old('title')); ?>" type="text" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post-slug" class="col-form-label"><b><?php echo e(__('slug')); ?></b>
                                            (<?php echo e(__('slug_message')); ?>)</label>
                                        <input id="post-slug" name="slug" value="<?php echo e(old('slug')); ?>" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post-press_release_link" class="col-form-label"><b><?php echo e(__('Press Release Link')); ?></b>
                                            (<?php echo e(__('Press Release Link')); ?>)</label>
                                        <input id="post-press_release_link" name="press_release_link" value="<?php echo e(old('Press Release Link')); ?>" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_company_name" class="col-form-label"><?php echo e(__('Company Name')); ?>

                                            </label>
                                        <input id="post_company_name" name="company_name" type="text" value="<?php echo e(old('company_name')); ?>"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_product" class="col-form-label"><?php echo e(__('Product')); ?>

                                            </label>
                                        <input id="post_product" name="product" type="text" value="<?php echo e(old('product')); ?>"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div> -->

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_company" class="col-form-label"><?php echo e(__('Company')); ?>

                                            </label>
                                        

                                        <select class="form-control  select2  select2 company-multiple"
                                            multiple="multiple" id="company_name" name="company_name[]" name="company_name"
                                            data-dependent="product_name" required>
                                            <option value=""><?php echo e(__('select Company')); ?></option>
                                            <?php $__currentLoopData = \Modules\Post\Entities\Company::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-slug="<?php echo e($company->id); ?>"  value="<?php echo e($company->slug); ?>"><?php echo e($company->company_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </select>

                                    </div>
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_product_name" class="col-form-label"><?php echo e(__('Product Name')); ?>

                                            </label>
                                        

                                        <select class="form-control select2  select2 product-multiple"
                                            multiple="multiple" id="product_name" name="product_name[]"
                                            data-dependent="product_name">
                                            <option value=""><?php echo e(__('select product')); ?></option>
                                            <!-- <?php $__currentLoopData = \Modules\Post\Entities\Product::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option data-slug="<?php echo e($product->id); ?>"  value="<?php echo e($product->slug); ?>"><?php echo e($product->product_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                                        </select>
                                    </div>
                                </div>

                                
                                <!-- tinemcey start -->
                                <div class="row p-l-15">
                                    <div class="col-12">
                                        <label for="post_content" class="col-form-label"><?php echo e(__('Content')); ?>*</label>
                                        <textarea  name="content" value="<?php echo e(old('content')); ?>" id="post_content_article"
                                                  cols="30" rows="5"></textarea>
                                    </div>
                                </div>         

                                
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20 add-new-content">
                                <div class="block-header">
                                    <h2><?php echo e(__('add_content')); ?></h2>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('text')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/text.png')); ?>"><br>
                                            <label><?php echo e(__('text')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('image')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/image.png')); ?>"><br>
                                            <label><?php echo e(__('image')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('image-text')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/image-text.png')); ?>"><br>
                                            <label><?php echo e(__('image_left')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('text-image')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/text-image.png')); ?>"><br>
                                            <label><?php echo e(__('image_right')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('text-image-text')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/text-image-text.png')); ?>"><br>
                                            <label><?php echo e(__('image_center')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('video')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/video.png')); ?>"><br>
                                            <label><?php echo e(__('video')); ?></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('ads')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/ads.png')); ?>"><br>
                                            <label><?php echo e(__('ads')); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-header">
                                    <h2><?php echo e(__('embadded')); ?></h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('code')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/code.png')); ?>"><br>
                                            <label><?php echo e(__('code')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('twitter-embed')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/twitter.png')); ?>"><br>
                                            <label><?php echo e(__('twitter')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('vimeo-embed')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/vimeo.png')); ?>"><br>
                                            <label><?php echo e(__('vimeo')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center area">
                                        <div class="item" onclick="addContent('youtube-embed')">
                                            <img class="pb-3" src="<?php echo e(static_asset('default-image/content-icon/youtube.png')); ?>"><br>
                                            <label><?php echo e(__('youtube')); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-area">
                                
                            </div>
                            <!-- visibility section start -->
                            <div class="add-new-page  bg-white p-20 m-b-20">
                                <div class="block-header">
                                    <h2><?php echo e(__('visibility')); ?></h2>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-12 col-md-4">
                                        <div class="form-title">
                                            <label for="visibility"><?php echo e(__('visibility')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="visibility" id="visibility_show" checked value="1"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"><?php echo e(__('show')); ?></span>
                                        </label>
                                    </div>
                                    <div class="col-3 col-md-2">
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" name="visibility" id="visibility_hide" value="0"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"><?php echo e(__('hide')); ?></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="featured_post"><?php echo e(__('add_to_featured')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="featured_post" name="featured"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="add_to_breaking"><?php echo e(__('add_to_breaking')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="add_to_breaking" name="breaking"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="add_to_slide"><?php echo e(__('add_to_slider')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="add_to_slide" name="slider"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="recommended"><?php echo e(__('add_to_recommended')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="recommended" name="recommended"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label for="editor_picks"><?php echo e(__('add_to_editor_picks')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="editor_picks" name="editor_picks"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="auth_required"><?php echo e(__('show_only_to_authenticate_users')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="auth_required" name="auth_required"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="top_20"><?php echo e(__('top_20')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="top_20" name="top_20"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="insights_plus"><?php echo e(__('insights_plus')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="insights_plus" name="insights_plus"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="viewpoint"><?php echo e(__('viewpoint')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="viewpoint" name="viewpoint"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="events"><?php echo e(__('events')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="events" name="events"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row p-l-15">
                                    <div class="col-8 col-md-4">
                                        <div class="form-title">
                                            <label
                                                for="advertisement"><?php echo e(__('advertisement')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" id="advertisement" name="advertisement"
                                                   class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                </div>


                                
                            </div>
                            <!-- visibility section end -->
                            <!-- SEO section start -->
                            <div class="add-new-page  bg-white p-20 m-b-20" id="post_meta">
                                <div class="block-header">
                                    <h2><?php echo e(__('seo_details')); ?></h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="meta_title"><b><?php echo e(__('title')); ?></b> (<?php echo e(__('meta_title')); ?>)</label>
                                        <input id="meta_title" class="form-control meta" value="" data-type="title"
                                               name="meta_title">
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
                                               value="" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_tags" class="col-form-label"><?php echo e(__('tags')); ?>

                                            (<?php echo e(__('meta_tags')); ?>)</label>
                                        <input id="post_tags" name="tags" type="text" value="<?php echo e(old('tags')); ?>"
                                               data-role="tagsinput" class="form-control"/>

                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_desc">
                                            <b><?php echo e(__('description')); ?></b> (<?php echo e(__('meta_description')); ?>)
                                        </label>
                                        <textarea class="form-control meta" id="meta_description"
                                                  value="" name="meta_description" data-type="description"
                                                  rows="3"></textarea>
                                        <p class="display-nothing alert alert-danger mt-2" role="alert">
                                            <?php echo e(__('current_characters')); ?>: <span class="characters"></span>, <?php echo e(__('meta_description').' '. __('should_bd') .' '. __('in_between') .' '. '50-160 ' . __('characters')); ?>

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
                                <div class="block-header">
                                    <h2><?php echo e(__('image')); ?></h2>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <!-- Large modal -->
                                        <button type="button" id="btn_image_modal"
                                                class="btn btn-primary btn-image-modal" data-id="1" data-toggle="modal"
                                                data-target=".image-modal-lg"><?php echo e(__('add_image')); ?></button>
                                        <input id="image_id" name="image_id" type="hidden" class="form-control image_id">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-group text-center">
                                            <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " id="image_preview"
                                                 width="200" height="200" alt="image"
                                                 class="img-responsive img-thumbnail image_preview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-new-page  bg-white p-20 m-b-20">


                              <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="alt_tag"><?php echo e(__('Alt Tag')); ?></label>
                                        <input type="text" value="" name="alt_tag" id="alt_tag"  class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="old_id"><?php echo e(__('Old ID')); ?></label>
                                        <input type="text" name="old_id" id="old_id"  class="form-control">
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_language"><?php echo e(__('select_language')); ?>*</label>
                                        <select class="form-control dynamic-category" id="post_language" name="language"
                                        data-dependent="category_id" required>
                                            <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    <?php if(App::getLocale()==$lang->code): ?> Selected
                                                    <?php endif; ?> value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="post_language"><?php echo e(__('Date')); ?>*</label>
                                        <input type="datetime-local" name="update_date" id="update_date" required class="form-control">
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
                                                    <option  <?php if($keys == '1'): ?> Selected  <?php endif; ?> value="<?php echo e($user->id); ?>"> <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>  </option>
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
                                       

                                        <select class="form-control dynamic select2  select2 category-multiple" multiple="multiple" id="category_id" name="category_id[]" name="category_id"
                                                data-dependent="sub_category_id" required>
                                            <option value=""><?php echo e(__('select_category')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option
                                                    value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_category_id"><?php echo e(__('sub_category')); ?></label>
                                        <select class="form-control dynamic" id="sub_category_id" name="sub_category_id">
                                            <option value=""><?php echo e(__('select_sub_category')); ?></option>
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
                                                <input type="radio" name="layout" id="detail_style_1" value="default" checked  class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                            <img src="<?php echo e(static_asset('default-image/Detail/detail_1.png')); ?>" alt="" class="img-responsive cat-block-img">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="custom-control custom-radio detail-control-inline">
                                                <input type="radio" name="layout" id="detail_style_2" value="style_2"  class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                            <img src="<?php echo e(static_asset('default-image/Detail/detail_2.png')); ?>" alt="" class="img-responsive cat-block-img">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="custom-control custom-radio detail-control-inline">
                                                <input type="radio" name="layout" id="detail_style_3" value="style_3"  class="custom-control-input">
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
                                            <option value="1"><?php echo e(__('published')); ?></option>
                                            <option value="0"><?php echo e(__('draft')); ?></option> 
                                             <option value="2"><?php echo e(__('scheduled')); ?></option> 
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 divScheduleDate">
                                    <label for="scheduled_date"><?php echo e(__('schedule_date')); ?></label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="scheduled_date"><i
                                                class="fa fa-calendar-alt"></i></label>
                                        <input type="text" class="form-control date" id="scheduled_date"
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


    <input type="hidden" value="0" id="content_number">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<!-- <script src="<?php echo e(static_asset('vendor/tinymce/tinymce.min.js')); ?>"></script> -->
<script src="https://cdn.ckeditor.com/4.17.1/standard-all/ckeditor.js"></script>
<script>
    CKEDITOR.replace('post_content_article', {

        // allowedContent: {
        //     'b i ul ol table big small': true,
        //     'h1 h2 h3 p blockquote li': {
        //         styles: 'text-align'
        //     },
        //     a: { attributes: '!href,target' },
        //     img: {
        //         attributes: '!src,alt',
        //         styles: 'width,height',
        //         classes: 'left,right'
        //     }
        // },
        extraPlugins: 'image2, uploadimage, sourcedialog, iframe',

        toolbar: [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
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
                name: 'insert',
                items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
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
<!-- <script src="https://cdn.tiny.cloud/1/nnd7pakaxqr7isf3oqefsdlew1jsidgl78umfeus6tg21ng0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->



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

            $(".product-multiple").select2({
                placeholder: "Select a Product"
            });


            $(".company-multiple").select2({
                placeholder: "Select a Company"
            });



            $('.company-multiple').change(function () {
                var select = $(this).attr("id");
                //  var value = $(this).val();
                    var value = $(".company-multiple option:selected").map(function() {
                    return $(this).data("slug");
                    }).get();
                var dependent = $(this).data('dependent');
                var _token = "<?php echo e(csrf_token()); ?>";
                
                $.ajax({
                    url: "<?php echo e(route('product-fetch')); ?>",
                    method: "POST",
                    data: {select: select, value: value, _token: _token},
                    success: function (result) {
                        $('#' + dependent).html(result);
                    }

                })
            });

            // $('.product-multiple').change(function () {
            //     var select = $(this).attr("id");
            //     //  var value = $(this).val();
            //         var value = $(".product-multiple option:selected").map(function() {
            //         return $(this).data("slug");
            //         }).get();
            //     var dependent = $(this).data('dependent');
            //     var _token = "<?php echo e(csrf_token()); ?>";

            //     $.ajax({
            //         url: "<?php echo e(route('company-fetch')); ?>",
            //         method: "POST",
            //         data: {select: select, value: value, _token: _token},
            //         success: function (result) {
            //             $('#' + dependent).html(result);
            //         }

            //     })
            // });



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


        $('.errormessagepreview').html('');
        $('body').on('click', '.previewpost', function (e) {
            $('.errormessagepreview').html('');

            for (instance in CKEDITOR.instances) 
{
    CKEDITOR.instances[instance].updateElement();
}
            e.preventDefault();
            $.ajax({
                    type: 'POST',
                    url: "<?php echo e(route('save-new-preview-post',['article'])); ?>",
                    data: $('.previewpostform').serialize() ,
                    dataType : 'JSON',
                    //contentType: "application/x-www-form-urlencoded",
                    success: function (data) { 
                        if(data.status == '1'){
                            window.open(data.url, '_blank');
                        }else{
                            $('.errormessagepreview').html(data.message)

                        }
                    },
                    error:function(xhr, textStatus, thrownError, data)
                    {

                        $('.errormessagepreview').html('<p>The title field is required.</p><p>The content field is required.</p><p>The category id field is required.</p><p>The Date field is required.</p>')


                    }
                        });



            // var popup = document.getElementById("myPopup");
            // popup.classList.toggle("show");

        });


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/article_create.blade.php ENDPATH**/ ?>