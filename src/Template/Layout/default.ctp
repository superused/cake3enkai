<?php
// 独自CSS
$this->prepend('css', $this->Html->css([
    'style.css'
]));
// BootstrapをCDNから取得
$this->prepend('css', $this->Html->css([
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
]));
// BootstrapのJSをCDNから取得
$this->prepend('script', $this->Html->script([
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
]));
// JQueryをCDNから取得
$this->prepend('script', $this->Html->script([
    '//code.jquery.com/jquery-2.2.4.js'
]));
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <?= $this->Html->meta('icon') ?>
    <title><?= $this->fetch('title') ?></title>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?= $this->element("menu/" . $menu)?>
    <?= $this->element('content')?>
    <?= $this->fetch('script')?>
</body>
</html>