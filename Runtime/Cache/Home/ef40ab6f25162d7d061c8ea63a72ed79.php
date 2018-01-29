<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>小伙伴</title>
    <link rel='stylesheet'  href='/Application/Home/Static/css/amazeui.css' type='text/css' media='all' />
    <![endif]-->
    <script type="text/javascript" src="/Application/Home/Static/js/jquery.js"></script>
    <script type="text/javascript" src="/Application/Home/Static/js/amazeui.js"></script>
</head>
<body>
<br>
<p STYLE="padding-left: 15px"><?php echo ($alert); ?></p>
<br>
<table class="am-table am-table-striped am-table-hover am-table-centered">
    <thead>
    <tr>
        <th>姓名</th>
        <?php if($root): ?><th>微信</th>
                <th>QQ</th>
                <th>手机号码</th>
                <th>学校</th>
            <?php else: ?>
                <th>备注</th><?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($item["name"]); ?></td>
            <?php if($root): ?><td><?php echo ($item["wx"]); ?></td>
                    <td><?php echo ($item["qq"]); ?></td>
                    <td><?php echo ($item["telephone"]); ?></td>
                    <td><?php echo ($item["address"]); ?></td>
                <?php else: ?>
                    <td><?php echo html_entity_decode($item["shuoming"]);?></td><?php endif; ?>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
</body>
</html>