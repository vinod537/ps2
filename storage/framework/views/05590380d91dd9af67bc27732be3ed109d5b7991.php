<?php

$messages = $validator->errors()->getMessages();
foreach ($messages as $key => $value) { ?>
    <p class="errorshows"><?php echo $value[0]; ?></p>
<?php
}

?>
<?php /**PATH /var/www/html/resources/views/site/layouts/error_messages.blade.php ENDPATH**/ ?>