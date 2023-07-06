<?php if(!blank($feeds)): ?>
<?= '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<rss version="2.0" xml:base="https://pharmashots.com/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
    <title>PharmaShots | Incisive News in 3 Shots</title>
     
    <description>PharmaShots | Incisive News in 3 Shots</description>
        
        <?php $__currentLoopData = $feeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $result = @$post->image->original_image;
        ?>

        <item>
            <title> <![CDATA[<img align="left" hspace="5" src="<?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?>"/>]]><?php echo e($post->title); ?></title>
         

            <link><?php if($post->old_id): ?> <?php echo e(route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ])); ?> <?php else: ?> <?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug ])); ?> <?php endif; ?></link>
            <description>
        
        <?php echo e(strip_tags($post->content)); ?></description>
        <enclosure url="<?php echo e(basePath($post->image)); ?>/<?php echo e($result); ?>" length="640035" type="image/webp" />
                <guid isPermaLink="false"><?php if($post->old_id): ?> <?php echo e(route('article.detail', ['id' => $post->old_id, 'slug' => $post->slug ])); ?> <?php else: ?> <?php echo e(route('article.detail', ['id' => $post->id, 'slug' => $post->slug ])); ?> <?php endif; ?></guid>
                <pubDate><?php echo e($post->updated_at->tz('UTC')->toAtomString()); ?></pubDate>
                <source url="https://pharmashots.com/feeds"><?php echo e($post->title); ?></source>
                <changefreq>daily</changefreq>

        </item>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </channel>
</rss>
<?php endif; ?><?php /**PATH /var/www/html/resources/views/site/pages/feedPost.blade.php ENDPATH**/ ?>