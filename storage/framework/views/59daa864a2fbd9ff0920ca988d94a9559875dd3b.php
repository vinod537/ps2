<?php if(Request::url() === url('/')): ?>
    <meta name="title" content="<?php echo e(settingHelper('seo_title')); ?>" />
    <meta name="description" content="<?php echo e(settingHelper('seo_meta_description')); ?>" />
    <meta name="keywords" content="<?php echo e(settingHelper('seo_keywords')); ?>" />
    <meta name="author" content="<?php echo e(settingHelper('author_name')); ?>" />
    <meta name="language" content="<?php echo e(settingHelper('default_language')); ?>" />
    <link rel="canonical" href="<?php echo e(url('/')); ?>"/>
    <meta property="og:title" content="<?php echo e(settingHelper('og_title')); ?>" />
    <meta property="og:author" content="<?php echo e(settingHelper('author_name')); ?>" />
    <meta property="og:description" content="<?php echo e((settingHelper('og_description'))); ?>" />
    <meta property="og:locale" content="<?php echo e(settingHelper('default_language')); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta property="og:url" content="<?php echo e(url('/')); ?>" />
    <?php if(settingHelper('og_image') != Null): ?>
        <meta property="og:image" content="<?php echo e(static_asset(settingHelper('og_image'))); ?>" />
    <?php else: ?>
        <meta property="og:image" content="<?php echo e(static_asset('default-image/default-730x400.png')); ?>" alt="<?php echo settingHelper('og_title'); ?>" />
    <?php endif; ?>

    
    <meta name="twitter:title" content="<?php echo e(settingHelper('og_title')); ?>" />
    <meta name="twitter:description" content="<?php echo e(strip_tags(settingHelper('og_description'))); ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:domain" content="<?php echo e(url('/')); ?>" />
    <meta name="twitter:url" content="<?php echo e(url('/')); ?>">
    <?php if(settingHelper('og_image') != Null): ?>
        <meta name="twitter:image" content="<?php echo e(static_asset(settingHelper('og_image'))); ?>" />
    <?php else: ?>
        <meta name="twitter:image" content="<?php echo e(static_asset('default-image/default-730x400.png')); ?>" alt="<?php echo settingHelper('og_title'); ?>" />
    <?php endif; ?>
<?php endif; ?>

<?php if(!blank(\Request::route())): ?>
    <?php if(\Request::route()->getName() == "article.detail"): ?>
        <?php if(isset($post)): ?>
            <title><?php echo e($post->title); ?></title>
            <meta name="title" content="<?php echo e($post->meta_title); ?>" />
            <meta name="description" content="<?php echo e($post->meta_description); ?>" />
            <meta name="keywords" content="<?php echo e($post->meta_keywords); ?>" />
            <meta name="news_keywords" content="<?php echo e($post->tags); ?>"/>
            <meta name="author" content="<?php echo e(Sentinel::findById($post->user_id)->roles->first()->name); ?>" />
            <meta name="language" content="<?php echo e($post->language); ?>" />
            <link rel="canonical" href="<?php echo e(route('article.detail', ['slug' => $post->slug, 'id' => $post->id])); ?>"/>
            <meta property="og:title" content="<?php echo e($post->title); ?>" />
            <meta property="og:author" content="<?php echo e(Sentinel::findById($post->user_id)->roles->first()->name); ?>" />
            <meta property="og:description" content="<?php echo e(strip_tags(\Illuminate\Support\Str::limit($post->meta_description, 130))); ?>" />
            <meta property="og:locale" content="<?php echo e($post->language); ?>" />
            <meta property="og:type" content="article"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:url" content="<?php echo e(route('article.detail', ['slug' => $post->slug, 'id' => $post->id])); ?>" />

            <?php if(isFileExist(@$post->image, @$post->image->og_image)): ?>
                <meta property="og:image" content="<?php echo e(basePath(@$post->image)); ?>/<?php echo e(@$post->image->og_image); ?>" alt="<?php echo $post->title; ?>"/>
            <?php else: ?>
                <meta property="og:image" content="<?php echo e(static_asset('default-image/default-730x400.png')); ?>" alt="<?php echo $post->title; ?>"/>
            <?php endif; ?>
            <meta name="twitter:title" content="<?php echo e($post->title); ?>" />
            <meta name="twitter:description" content="<?php echo e(strip_tags(\Illuminate\Support\Str::limit($post->meta_description, 130))); ?>" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:domain" content="<?php echo e(url('/')); ?>" />
            <meta name="twitter:url" content="<?php echo e(route('article.detail', ['slug' => $post->slug, 'id' => $post->id])); ?>">

            <?php if(isFileExist(@$post->image, @$post->image->og_image)): ?>
                <meta name="twitter:image" content="<?php echo e(basePath(@$post->image)); ?>/<?php echo e(@$post->image->og_image); ?>" alt="<?php echo $post->title; ?>"/>
            <?php else: ?>
                <meta name="twitter:image" content="<?php echo e(static_asset('default-image/default-730x400.png')); ?>" alt="<?php echo $post->title; ?>"/>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if(isset($page)): ?>
    <?php if(!blank(\Request::route())): ?>
        <?php if(\Request::route()->getName()== "site.page"): ?>
            <title><?php echo e($page->title); ?></title>
            <meta name="title" content="<?php echo e($page->meta_title); ?>" />
            <meta name="description" content="<?php echo e($page->meta_description); ?>" />
            <meta name="keywords" content="<?php echo e($page->meta_keywords); ?>" />

            <meta name="language" content="<?php echo e($page->language); ?>" />
            <link rel="canonical" href="<?php echo e(route('site.page', ['slug' => $page->slug])); ?>"/>
            <meta property="og:title" content="<?php echo e($page->meta_title); ?>" />
            <meta property="og:description" content="<?php echo e(strip_tags(\Illuminate\Support\Str::limit($page->meta_description, 130))); ?>" />
            <meta property="og:locale" content="<?php echo e($page->language); ?>" />
            <meta property="og:type" content="article"/>
            <meta property="og:image:width" content="1200"/>
            <meta property="og:image:height" content="630"/>
            <meta property="og:url" content="<?php echo e(route('site.page', ['slug' => $page->slug])); ?>" />
           <?php if(isFileExist(@$page->image, @$page->image->og_image)): ?>
                <meta property="og:image" content="<?php echo e(basePath(@$page->image)); ?>/<?php echo e(@$page->image->og_image); ?>" alt="<?php echo $page->title; ?>"/>
            <?php else: ?>
                <meta property="og:image" content="<?php echo e(static_asset('default-image/default-730x400.png')); ?>" alt="<?php echo $page->title; ?>"/>
            <?php endif; ?>

            
            <meta name="twitter:title" content="<?php echo e($page->title); ?>" />
            <meta name="twitter:description" content="<?php echo e(strip_tags(\Illuminate\Support\Str::limit($page->meta_description, 130))); ?>" />
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:domain" content="<?php echo e(url('/')); ?>" />
            <meta name="twitter:url" content="<?php echo e(route('site.page', ['slug' => $page->slug])); ?>">
            <?php if(isFileExist(@$page->image, @$page->image->og_image)): ?>
                <meta name="twitter:image" content="<?php echo e(basePath(@$page->image)); ?>/<?php echo e(@$page->image->og_image); ?>" alt="<?php echo $page->title; ?>"/>
            <?php else: ?>
                <meta name="twitter:image" content="<?php echo e(static_asset('default-image/default-730x400.png')); ?>" alt="<?php echo $page->title; ?>"/>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/site/partials/seo_og.blade.php ENDPATH**/ ?>