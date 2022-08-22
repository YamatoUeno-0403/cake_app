<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <?= $this->Html->script('/js/common') ?>
</head>
<body>
<div class="<?= h($class) ?>" onclick="this.classList.add('hidden');"><?= $message ?></div>
</body>
</html>
