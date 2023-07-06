<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- favicon -->

    <link rel="icon" href="<?php echo e(static_asset(SettingHelper('favicon'))); ?>" type="image/png"/>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- end favicon -->
    <title><?php echo e(settingHelper('application_name')); ?></title>
    <link href="<?php echo e(static_asset('vendor')); ?>/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(static_asset('vendor')); ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('vendor')); ?>/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('vendor')); ?>/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('vendor')); ?>/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('css')); ?>/style.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('css')); ?>/custom.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('css')); ?>/custom2.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('vendor')); ?>/datepicker/tempusdominus-bootstrap-4.css" />
    
    <link rel="stylesheet" href="<?php echo e(static_asset('css')); ?>/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="<?php echo e(static_asset('css/tagsinput.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(static_asset('css/flatpickr.min.css')); ?>">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo e(static_asset('css/bootstrap-select.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(static_asset('site/css/font-awesome.min.css')); ?>">

    <!-- tinymce Css-->
    <link href="<?php echo e(static_asset('vendor')); ?>/tinymce/skins/lightgray/skin.min.css" rel="stylesheet" />

    <!-- select2 -->
    <link href="<?php echo e(static_asset('Select2/css/select2.css')); ?>" rel="stylesheet" />

    <script src="<?php echo e(static_asset('js/prebid-ads.js')); ?>"></script>

    <?php echo $__env->yieldContent('style'); ?>

</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
    <?php echo $__env->make('common::layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('common::layouts.left-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->


    <!-- jquery 3.3.1 -->
    <script src="<?php echo e(static_asset('vendor')); ?>/jquery/jquery-3.3.1.min.js"></script>

    <!-- bootstap bundle js -->
    <script src="<?php echo e(static_asset('vendor')); ?>/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Tinemce -->
    <script src="<?php echo e(static_asset('vendor/tinymce/tinymce.min.js')); ?>"></script>
    <script>
         //TinyMCE
            tinymce.init({
                selector: "textarea#post_content",
                theme: "modern",
                height: 400,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            // tinymce.suffix = ".min";
            // tinyMCE.baseURL = 'vendor/tinymce';
            tinymce.init({
                selector: "textarea#content",
                theme: "modern",
                height: 400,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            // tinymce.suffix = ".min";
            // tinyMCE.baseURL = 'vendor/tinymce';

    </script>
    <!-- slimscroll js -->
    <script src="<?php echo e(static_asset('vendor')); ?>/slimscroll/jquery.slimscroll.js"></script>

    <!-- main js -->
    <script src="<?php echo e(static_asset('js')); ?>/main-js.js"></script>
    <script src="<?php echo e(static_asset('js')); ?>/drag-n-drop-js.js"></script>
    <!-- notify -->
    <script src="<?php echo e(static_asset('js/notify.min.js')); ?>"></script>

    <script src="<?php echo e(static_asset('vendor')); ?>/datepicker/moment.js"></script>
    <script src="<?php echo e(static_asset('vendor')); ?>/datepicker/tempusdominus-bootstrap-4.js"></script>
    <script src="<?php echo e(static_asset('vendor')); ?>/datepicker/datepicker.js"></script>
    <script type="text/javascript" src="<?php echo e(static_asset('js/custom.js')); ?>"></script>


    <script src="<?php echo e(static_asset('js/flatpickr.js')); ?>"></script>
    <script>
    const fp = flatpickr(".date", {
        enableTime: true,
        dateFormat: "F j, Y h:i K",
        minDate: "today",
        weekNumbers: true,
        minTime: "now",
    });
    </script>

    <!-- SwAl -->

    <script src="<?php echo e(static_asset('js/sweetalert.min.js')); ?>"></script>

    <script type="text/javascript">
        function delete_item(table_name, row_id) {
            var table_row = '#row_' + row_id
            if(table_name == 'quiz_questions'){
                var table_row = '#panel_quiz_question_' + row_id
            }

            if(table_name == 'quiz_answers'){
                var table_row = '#quiz_answer_' + row_id
            }

            if(table_name == 'quiz_results'){
                var table_row = '#panel_quiz_result_' + row_id
            }
            var token =  "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('delete')); ?>"

            swal({
                title: "<?php echo e(__('are_you_sure?')); ?>",
                text: "<?php echo e(__('it_will_be_deleted_permanently')); ?>",
                icon: "warning",
                buttons: true,
                buttons: ["<?php echo e(__('cancel')); ?>", "<?php echo e(__('delete')); ?>"],
                dangerMode: true,
                closeOnClickOutside: false
                })
            .then(function(confirmed){
                if (confirmed){
                     $.ajax({
                        url: url,
                        type: 'post', 
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'row_id=' + row_id + '&table_name=' + table_name+'&_token='+token+ '&_method=DELETE',
                        dataType: 'json'
                     })
                     .done(function(response){
                        console.log(response);
                        swal.stopLoading();
                        if(response.status == "success"){
                            console.log(response);
                            swal("<?php echo e(__('deleted')); ?>!", response.message, response.status);
                            $(table_row).fadeOut(2000).remove();
                            if(table_name=='menu'){
                                 window.location = response.url
                            }

                        }else{
                            swal("Error!", response.message, response.status);
                        }
                     })
                     .fail(function(){
                        swal('Oops...', '<?php echo e(__('something_went_wrong_with_ajax')); ?>', 'error');
                     })
                }
            })
        }
    </script>

    <script type="text/javascript">
        function remove_post_form(page,feature, row_id) {
            var table_row = '#row_' + row_id
            var token =  "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('remove-post-form')); ?>"

            swal({
                title: "<?php echo e(__('are_you_sure?')); ?>",
                text: "<?php echo e(__('it_will_be_remove_form_this_feature')); ?>",
                icon: "warning",
                buttons: true,
                buttons: ["<?php echo e(__('cancel')); ?>", "<?php echo e(__('remove')); ?>"],
                dangerMode: true,
                closeOnClickOutside: false
                })
            .then(function(confirmed){
                if (confirmed){
                     $.ajax({
                        url: url,
                        type: 'post', 
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'post_id=' + row_id + '&feature=' + feature+'&_token='+token+ '&_method=DELETE',
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal.stopLoading();
                        if(response.status == "success"){
                            console.log(response);
                            swal("<?php echo e(__('removed')); ?>!", response.message, response.status);
                            if(page=='index'){
                                window.location.reload();
                            }else{
                                $(table_row).fadeOut(2000);
                            }

                        }else{
                            swal("Error!", response.message, response.status);
                        }
                     })
                     .fail(function(){
                        swal('Oops...', '<?php echo e(__('something_went_wrong_with_ajax')); ?>', 'error');
                     })
                }
            })
        }
    </script>

    <script type="text/javascript">
        function add_post_to(feature, row_id) {
            var table_row = '#row_' + row_id
            var token =  "<?php echo e(csrf_token()); ?>";
            url = "<?php echo e(route('add-to')); ?>"

            swal({
                title: "<?php echo e(__('are_you_sure?')); ?>",
                text: "<?php echo e(__('it_will_be_added_to_this_feature')); ?>",
                icon: "info",
                buttons: true,
                buttons: ["<?php echo e(__('cancel')); ?>", "<?php echo e(__('add')); ?>"],
                dangerMode: false,
                closeOnClickOutside: false
                })
            .then(function(confirmed){
                if (confirmed){
                     $.ajax({
                        url: url,
                        type: 'post',
                        data: 'post_id=' + row_id + '&feature=' + feature+'&_token='+token,
                        dataType: 'json'
                     })
                     .done(function(response){
                        swal.stopLoading();
                        if(response.status == "success"){
                            console.log(response);
                            swal("<?php echo e(__('added')); ?>!", response.message, response.status);
                            window.location.reload();
                        }else{
                            swal("Error!", response.message, response.status);
                        }
                     })
                     .fail(function(){
                        swal('Oops...', '<?php echo e(__('something_went_wrong_with_ajax')); ?>', 'error');
                     })
                }
            })
        }
    </script>


    <!-- ajax modal  -->
    <div id="common-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-primary">
                    <div class="modal-header">
                        <h5 class="modal-title" id="common-modal-title">Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-loader"> <img src="<?php echo e(static_asset('/preloader.gif')); ?>" /> </div>
                        <!-- content will be load here -->
                        <div id="dynamic-content"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <script src="<?php echo e(static_asset('js/ajax-modal.js')); ?>"></script>
    <!-- END Ajax modal  -->
    <?php echo $__env->yieldContent('modal'); ?>


    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo e(static_asset('js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(static_asset('vendor/parsley/parsley.js')); ?>"></script>

    <script>
        $('form').parsley();
    </script>

    <script src="<?php echo e(static_asset('js/collapse.js')); ?>"> </script>
    <script src="<?php echo e(static_asset('Select2/js/select2.js')); ?>"></script>

    <?php echo $__env->yieldContent('script'); ?>

    <?php echo $__env->yieldPushContent('include_js'); ?>

</body>

</html>
<?php /**PATH /var/www/html/Modules/Common/Providers/../Resources/views/layouts/master.blade.php ENDPATH**/ ?>