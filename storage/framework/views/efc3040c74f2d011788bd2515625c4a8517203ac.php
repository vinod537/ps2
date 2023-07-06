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
                                            <h2><?php echo e(__('posts')); ?></h2>
                                        </div>
                                    </div>
                                    <?php if(Sentinel::getUser()->hasAccess(['post_write'])): ?>
                                        <div class="col-6 text-right">
                                            <a href="<?php echo e(route('create-article')); ?>"
                                            class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('create_article')); ?>

                                            </a>
                                            <a href="<?php echo e(route('create-video-post')); ?>"
                                               class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('create_video_post')); ?>

                                            </a>
                                            <a href="<?php echo e(route('create-audio-post')); ?>"
                                               class="btn btn-primary btn-sm btn-add-new"><i class="mdi mdi-plus"></i>
                                                <?php echo e(__('create_audio_post')); ?>

                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive all-pages">
                                <!-- Table Filter -->
                                <div class="row table-filter-container m-b-20">
                                    <div class="col-sm-12">
                                        <?php echo Form::open(['route' => 'filter-post','method' => 'GET']); ?>

                                        <!-- <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('language')); ?></small></p>
                                            <select class="form-control" name="language">
                                                <?php $__currentLoopData = $activeLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($lang->code); ?>"><?php echo e($lang->name); ?> </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div> -->

                                        <!-- <div class="item-table-filter">
                                            <p class="text-muted"><small><?php echo e(__('post_type')); ?></small></p>
                                            <select name="post_type" class="form-control">
                                                <option value=""><?php echo e(__('all')); ?></option>
                                                <option value="article"><?php echo e(__('article')); ?></option>
                                                <option value="video"><?php echo e(__('video')); ?></option>
                                            </select>
                                        </div> -->

                                        <div class="item-table-filter col-sm-2">
                                            <p class="text-muted"><small><?php echo e(__('category')); ?></small></p>
                                            <select class="form-control dynamic" id="category_id" name="category_id"
                                                    data-dependent="sub_category_id">
                                                <option value=""><?php echo e(__('all')); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($category_id == $category->id): ?> selected <?php endif; ?>
                                                        value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <!-- <div class="item-table-filter">
                                            <div class="form-group">
                                                <p class="text-muted"><small><?php echo e(__('sub_category')); ?></small></p>
                                                <select class="form-control dynamic" id="sub_category_id"
                                                        name="sub_category_id">
                                                    <option value=""><?php echo e(__('all')); ?></option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="item-table-filter  col-sm-2">
                                            <div class="form-group">
                                                <p class="text-muted"><small><?php echo e(__('From')); ?></small></p>
                                                <input name="from_date" value="<?php echo e($from_date); ?>" class="form-control" placeholder="<?php echo e(__('search')); ?>"
                                                   type="date">                                                
                                            </div>
                                        </div>

                                        <div class="item-table-filter  col-sm-2">
                                            <div class="form-group">
                                                <p class="text-muted"><small><?php echo e(__('To')); ?></small></p>
                                                <input name="to_date" value="<?php echo e($to_date); ?>"  class="form-control" placeholder="<?php echo e(__('search')); ?>"
                                                   type="date">                                              
                                            </div>
                                        </div>

                                        <div class="item-table-filter  col-sm-2">
                                            <p class="text-muted"><small><?php echo e(__('search')); ?></small></p>
                                            <input name="search_key" class="form-control" placeholder="<?php echo e(__('search')); ?>"
                                                   type="search"  value="<?php echo e($search_key); ?>">
                                        </div>

                                        <div class="item-table-filter md-top-10 item-table-style  col-sm-2">
                                            <p>&nbsp;</p>
                                            <button type="submit" class="btn bg-primary"><?php echo e(__('filter')); ?></button>
                                        </div>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                                <!-- Table Filter -->
                                <table class="table table-bordered table-striped" role="grid">
                                    <thead>
                                    <tr role="row">
                                        
                                        <th width="20">#</th>
                                        <th><?php echo e(__('post')); ?></th>
                                        <!-- <th><?php echo e(__('language')); ?></th> -->
                                        <th><?php echo e(__('post_type')); ?></th>
                                        <th><?php echo e(__('Old ID')); ?></th>
                                        <th><?php echo e(__('Categories')); ?></th>
                                        <th><?php echo e(__('post_by')); ?></th>
                                        <th><?php echo e(__('visibility')); ?></th>
                                        <th><?php echo e(__('view')); ?></th>
                                        <th><?php echo e(__('added_date')); ?></th>
                                        <?php if(Sentinel::getUser()->hasAccess(['post_write']) || Sentinel::getUser()->hasAccess(['post_delete'])): ?>
                                            <th><?php echo e(__('options')); ?></th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="row_<?php echo e($post->id); ?>">
                                            
                                            <td><?php echo e($post->id); ?></td>
                                            <td>
                                                <div class="post-image">

                                                    <?php if(isFileExist(@$post->image, $result = @$post->image['thumbnail'])): ?>
                                                        <img
                                                            src=" <?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?> "
                                                            data-src="<?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?>"
                                                            alt="image" class="img-responsive img-thumbnail lazyloaded">

                                                    <?php else: ?>
                                                        <img src="<?php echo e(static_asset('default-image/default-100x100.png')); ?> " width="200"
                                                             height="200" alt="image"
                                                             class="img-responsive img-thumbnail">
                                                    <?php endif; ?>
                                                </div> 
                                                <a href="<?php if($post->old_id): ?> <?php echo e(route('article.detail', [$post->old_id, $post->slug])); ?> <?php else: ?> <?php echo e(route('article.detail', [$post->id, $post->slug])); ?> <?php endif; ?>"><?php echo e($post->title); ?> </a>                                            </td>
                                            <!-- <td><?php echo e($post->language); ?> </td> -->
                                            <td class="td-post-type"><?php echo e($post->post_type); ?></td>
                                            <td>
                                                <label class="category-label m-r-5 label-table"
                                                      id="breaking-post-bgc">
                                                    <?php echo e($post->old_id); ?> </label>

                                            </td>
                                            <td>
                                                <?php 
                                                  $category_id =   json_decode($post->category_id);
                                                  foreach ($category_id as $key => $value) { ?>
                                                      <label class="label label-success label-table">
                                                    <?php echo e(\Modules\Post\Entities\Category::where('id', $value)->first()->category_name); ?>

                                                        
                                                        </label>
                                                  <?php }
                                                ?>

                                            </td>
                                            <td>
                                                <a href="#" target="_blank" class="table-user-link">
                                                    <strong>
                                                        <?php
                                                            $roles=Sentinel::findById($post->user_id)->roles->first();
                                                        ?>
                                                        <?php echo e($roles->name); ?>

                                                    </strong>
                                                </a>
                                            </td>
                                            <td class="td-post-sp">
                                                <?php if($post->visibility==1): ?>
                                                    <label class="label label-success label-table"><i
                                                            class="fa fa-eye"></i></label>
                                                <?php else: ?>
                                                    <label class="label label-default label-table"><i
                                                            class="fa fa-eye-slash"></i></label>
                                                <?php endif; ?>
                                                <?php if($post->breaking==1): ?>
                                                    <label class="label bg-red label-table"><?php echo e(__('breaking')); ?></label>
                                                <?php endif; ?>
                                                <?php if($post->featured==1): ?>
                                                    <label
                                                        class="label bg-warning label-table"><?php echo e(__('featured')); ?></label>
                                                <?php endif; ?>
                                                <?php if($post->recommended==1): ?>
                                                    <label
                                                        class="label bg-aqua label-table"><?php echo e(__('recommended')); ?></label>
                                                <?php endif; ?>
                                                <?php if($post->editor_picks==1): ?>
                                                    <label
                                                        class="label bg-success label-table"><?php echo e(__('editor_picks')); ?></label>
                                                <?php endif; ?>
                                                <?php if($post->slider==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('slider')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->top_20==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('top_20')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->insights_plus==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('insights_plus')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->daily_news==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('daily_news')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->viewpoint==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('viewpoint')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->events==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('events')); ?></label>
                                                <?php endif; ?>

                                                <?php if($post->advertisement==1): ?>
                                                    <label class="label bg-teal label-table"><?php echo e(__('advertisement')); ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($post->total_hit); ?></td>
                                            <td><?php echo e($post->created_at); ?></td>
                                            <?php if(Sentinel::getUser()->hasAccess(['post_write']) || Sentinel::getUser()->hasAccess(['post_delete'])): ?>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn bg-primary dropdown-toggle btn-select-option"
                                                                type="button" data-toggle="dropdown">...<span
                                                                class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu options-dropdown">
                                                            <?php if(Sentinel::getUser()->hasAccess(['post_delete'])): ?>
                                                                <li>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_item('posts','<?php echo e($post->id); ?>')"><i
                                                                            class="fa fa-trash option-icon"></i><?php echo e(__('delete')); ?>

                                                                    </a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <?php if(Sentinel::getUser()->hasAccess(['post_write'])): ?>
                                                                
                                                                <!-- <li>
                                                                    <?php if($post->slider==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','slider','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('slider')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('slider','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('slider')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li>

                                                                    <?php if($post->featured==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','featured','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('featured')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('featured','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('featured')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>

                                                                    <li>

                                                                    <?php if($post->top_20==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','top_20','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('top_20')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('top_20','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('top_20')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    </li>


                                                                    <li>

                                                                    <?php if($post->insights_plus==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','insights_plus','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('insights_plus')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('insights_plus','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('insights_plus')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    </li> -->

                                                                    <li>

                                                                    <?php if($post->daily_news==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','daily_news','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('daily_news')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('daily_news','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('daily_news')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    </li>


<!-- 
                                                                    <li>

                                                                    <?php if($post->viewpoint==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','viewpoint','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('viewpoint')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('viewpoint','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('viewpoint')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    </li>



                                                                    <li>

                                                                    <?php if($post->events==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','events','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('events')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('events','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('events')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    </li>

                                                                    <li>

                                                                    <?php if($post->advertisement==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="remove_post_form('index','advertisement','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('advertisement')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                        onclick="add_post_to('advertisement','<?php echo e($post->id); ?>')"
                                                                        name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('advertisement')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                    </li>



                                                                <li>

                                                                    <?php if($post->breaking==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','breaking','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('breaking')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('breaking','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('breaking')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li>

                                                                    <?php if($post->recommended==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','recommended','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('recommend')); ?>

                                                                        </a>
                                                                        
                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('recommended','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('recommend')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li>

                                                                    <?php if($post->editor_picks==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','editor_picks','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-minus option-icon"></i><?php echo e(__('editor_picks')); ?>

                                                                        </a>
                                                                        
                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('editor_picks','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-plus option-icon"></i><?php echo e(__('editor_picks')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li> -->

                                                                <li>
                                                                    <a href="<?php echo e(route('edit-post',['type'=>$post->post_type,'id'=>$post->id])); ?>"><i
                                                                            class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <?php if($post->visibility==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','visibility','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fas fa-eye-slash option-icon"></i><?php echo e(__('invisibile')); ?>

                                                                        </a>
                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('visibility','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-eye option-icon"></i> <?php echo e(__('visibile')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li>
                                                                    <?php if($post->status==1): ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="remove_post_form('index','status','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fas fa-times option-icon"></i></i><?php echo e(__('unpublish')); ?>

                                                                        </a>

                                                                    <?php else: ?>
                                                                        <a href="javascript:void(0)"
                                                                           onclick="add_post_to('status','<?php echo e($post->id); ?>')"
                                                                           name="option" class="btn-list-button">
                                                                            <i class="fa fa-check option-icon"></i> <?php echo e(__('publish')); ?>

                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>

                                                            <?php endif; ?>
                                                            
                                                        </ul>
                                                    </div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2><?php echo e(__('Showing')); ?> <?php echo e($posts->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($posts->lastItem()); ?> <?php echo e(__('of')); ?> <?php echo e($posts->total()); ?> <?php echo e(__('entries')); ?></h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                    <?php echo e($posts->appends(request()->query())->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page info end-->
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {

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
                $('#sub_category').val('');
            });


        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/index.blade.php ENDPATH**/ ?>