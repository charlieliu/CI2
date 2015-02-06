<?php foreach ($type_arr as $data): ?>
    <div class="mg1em" style="height:100px;">
        <div class="mg1em float_left" style="width:100px;">
            <?=$data['type']?>
        </div>
        <div class="mg1em float_left" style="text-align:center;">
            <table border="1">
                <tr>
                    <?php foreach ($data['browser_support'] as $key => $value): ?><th><?=$key?></th><?PHP endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($data['browser_support'] as $key => $value): ?><td><?=(empty($value)?'X':'O')?></td><?PHP endforeach; ?>
                </tr>
            </table>
        </div>
        <div class="mg1em float_left">
            <input type="<?=$data['type']?>" name="<?=$data['type']?>" id="<?=$data['type']?>" required><br>
            &lt;input type="<?=$data['type']?>" name="<?=$data['type']?>" id="<?=$data['type']?>" required&gt;
        </div>
    </div>
<?PHP endforeach; ?>
