<?php $__env->startSection('post-aria-expanded'); ?>
    aria-expanded="true"
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post-show'); ?>
    show
<?php $__env->stopSection(); ?>
<?php $__env->startSection('post'); ?>
    active
<?php $__env->stopSection(); ?>
<?php $__env->startSection('product-active'); ?>
    active
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- page info start-->
            <form action="#" method="post">
                <div class="row clearfix">
                    <div class="col-12">
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
                            <div class="col-12 col-lg-5">
                                <?php echo Form::open(['route'=>'save-new-product','method' => 'post']); ?>

                                <div class="add-new-page  bg-white p-20 m-b-20">
                                    <div class="block-header">
                                        <h2><?php echo e(__('Add Product')); ?></h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="language"><?php echo e(__('select_language')); ?>*</label>


                                            <select class="form-control dynamic-company" id="language" name="language"
                                        data-dependent="company_id" required>
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
                                            <label for="product-name"
                                                   class="col-form-label"><?php echo e(__('Product Name')); ?>*</label>
                                            <input id="product-name" name="product_name" type="text"
                                                   class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="company-name" class="col-form-label"><?php echo e(__('company Name')); ?> </label>

                                            <select class="form-control dynamic select2  select2 company-multiple"
                                                multiple="multiple" id="company_id" name="company_id[]" name="company_id"
                                                data-dependent="sub_company_id" required>
                                                <option value=""><?php echo e(__('select company')); ?></option>
                                                <?php 
                                               // dd($companies);
                                                ?>
                                                
                                                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($company->id); ?>"><?php echo e($company->company_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-slug"
                                                   class="col-form-label"><b><?php echo e(__('Slug')); ?></b>
                                                (<?php echo e(__('Slug Message')); ?>)</label>
                                            <input id="product-slug" name="slug" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-desc"
                                                   class="col-form-label"><b><?php echo e(__('Description')); ?></b>
                                                (<?php echo e(__('Meta Tag')); ?>)</label>
                                            <input id="product-desc" name="meta_description" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product-keywords"
                                                   class="col-form-label"><b><?php echo e(__('Keywords')); ?></b>
                                                (<?php echo e(__('Meta Tag')); ?>)</label>
                                            <input id="product-keywords" name="meta_keywords" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 m-t-20">
                                            <div class="form-group form-float form-group-sm text-right">
                                                <button type="submit" name="btnSubmit"
                                                        class="btn btn-primary pull-right"><i
                                                        class="m-r-10 mdi mdi-plus"></i><?php echo e(__('Add Product')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                            <!-- Main Content section end -->

                            <!-- right sidebar start -->
                            <div class="col-12 col-lg-7">
                                <div class="add-new-page row  bg-white p-20 m-b-20">

                                <div class="col-12 col-lg-12">

<?php echo Form::open(['route' => 'products','method' => 'GET']); ?>


<div class="item-table-filter  col-sm-8">
    <p class="text-muted"><small><?php echo e(__('search')); ?></small></p>
    <input name="search_key" class="form-control" placeholder="<?php echo e(__('Type Product Name')); ?>"
            type="search"  value="<?php echo e($search_key); ?>">
</div>

<div class="item-table-filter md-top-10 item-table-style  col-sm-2">
    <p>&nbsp;</p>
    <button type="submit" class="btn bg-primary"><?php echo e(__('filter')); ?></button>
</div>
<?php echo Form::close(); ?>

</div>


                                    <div class="block-header m-b-20 col-lg-12">
                                        <h2><?php echo e(__('Products')); ?></h2>
                                    </div>
                                        


                                    <div class="table-responsive all-pages">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th><?php echo e(__('Product Name')); ?></th>
                                                
                                                <?php if(Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete'])): ?>
                                                    <th><?php echo e(__('options')); ?></th>
                                                <?php endif; ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr role="row" class="odd" id="row_<?php echo e($product->id); ?>">
                                                    <td class="sorting_1"><?php echo e($product->id); ?></td>
                                                    <td><?php echo e($product->product_name); ?></td>
                                                    
                                                    <?php if(Sentinel::getUser()->hasAccess(['sub_category_write']) || Sentinel::getUser()->hasAccess(['sub_category_delete'])): ?>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button
                                                                    class="btn bg-primary dropdown-toggle btn-select-option"
                                                                    type="button" data-toggle="dropdown">...<span
                                                                        class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu options-dropdown">
                                                                    <?php if(Sentinel::getUser()->hasAccess(['sub_category_write'])): ?>
                                                                        <li>
                                                                            <a href="<?php echo e(route('edit-product',['id'=>$product])); ?>"><i
                                                                                    class="fa fa-edit option-icon"></i><?php echo e(__('edit')); ?>

                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if(Sentinel::getUser()->hasAccess(['sub_category_delete'])): ?>
                                                                        <li>
                                                                            <a href="javascript:void(0)"
                                                                               onclick="delete_item('products','<?php echo e($product->id); ?>')"><i
                                                                                    class="fa fa-trash option-icon"></i><?php echo e(__('delete')); ?>

                                                                            </a>
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
                                                <h2><?php echo e(__('showing')); ?> <?php echo e($products->firstItem()); ?> <?php echo e(__('to')); ?> <?php echo e($products->lastItem()); ?>

                                                    of <?php echo e($products->total()); ?> <?php echo e(__('entries')); ?></h2>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 text-right">
                                            <div class="table-info-pagination float-right">
                                                <nav aria-label="Page navigation example">
                                                    <!-- <?php echo $products->render(); ?> -->
                                                    <?php echo e($products->appends(request()->query())->links()); ?>

                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- right sidebar end -->
                        </div>
                    </div>
                </div>
            </form>
            <!-- page info end-->
        </div>
    </div>
<?php $__env->startSection('script'); ?>

    <script>
        $(document).ready(function () {

            $('.dynamic-company').change(function () {
                if ($(this).val() != '') {
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    var dependent = $(this).data('dependent');
                    var _token = "<?php echo e(csrf_token()); ?>";
                    $.ajax({
                        url: "<?php echo e(route('company-fetch')); ?>",
                        method: "POST",
                        data: {select: select, value: value, _token: _token},
                        success: function (result) {
                            $('#' + dependent).html(result);
                        }

                    })
                }
            });

            $('#language').change(function () {
                $('#company_id').val('');
            });
        });
    </script>


<script>
        $(document).ready(function () {


            $(".company-multiple").select2({
                placeholder: "Select a Company"
            });

        });
    </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('common::layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Modules/Post/Providers/../Resources/views/products.blade.php ENDPATH**/ ?>