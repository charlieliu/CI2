<?php foreach ($redis_act as $data): ?>
    <div class="content_block">
        <form class="redis_test" method="POST">
            <input type="hidden" name="redis_act" value="<?=$data?>">
            <input type="text" name="key_str" value="" placeholder="key">
            <input type="text" name="val_str" value="" placeholder="value">
            <input type="hidden" name="{csrf_name}" value="{csrf_value}">
            <input type="submit" value="<?=$data?>">
        </form>
    </div>
<?PHP endforeach; ?>