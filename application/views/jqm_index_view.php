<!DOCTYPE html>
<html>
<head>
    <title>My Page</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url()?>css/jquery.mobile-1.4.4.min.css" />
    <script src="<?=base_url()?>js/jquery-1.11.js"></script>
    <script src="<?=base_url()?>js/jquery.mobile-1.4.4.min.js"></script>
</head>
<body>

<div data-role="page">

    <div data-role="header" data-theme="b">
        <h1><?=$title?></h1>
        <!-- 左邊滑出選單 -->
        <a href="#left-panel" data-theme="f" data-icon="home" data-iconpos="notext" data-shadow="false" data-iconshadow="false" class="ui-icon-nodisc"></a>
        <!-- 右邊滑出選單 -->
        <a href="#right-panel" data-theme="f" data-icon="star" data-shadow="false" data-iconshadow="false" class="ui-icon-nodisc" data-iconpos="right">username</a>
    </div><!-- /header -->

    <div data-role="content">
        <p>Hello world</p>
    </div><!-- /content -->

    <div data-role="footer" data-theme="b" data-position="fixed">
    </div>

    <div data-role="panel" id="left-panel" data-position="left" data-theme="b">
        <div style="margin-left:1em;">
            <a href="<?=base_url()?>" data-ajax="false">
                <div style="padding:2px 6px;">
                    <div>Home</div>
                </div>
            </a>
        </div>
        <?php foreach ($head_list as $row): ?>
            <div style="margin-left:1em;">
                <a href="<?=$row['content_url']?>" data-ajax="false"><div style="padding:2px 6px;"><div><?=$row['content_title']?></div></div></a>
                <?PHP if(count($row['children'])): ?>
                    <?php foreach ($row['children'] as $val): ?>
                    <div style="margin-left:1em;">
                        <a href="<?=$val['content_url']?>" data-ajax="false"><div style="padding:2px 6px;"><div><?=$val['content_title']?></div></div></a>
                    </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>

    <div data-role="panel" id="right-panel" data-position="right" data-theme="b">
    </div>

</div><!-- /page -->

</body>
</html>