<h1 class="page-header">イベント一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
  <th scope="col">イベント名</th>
  <th scope="col">最大参加者数</th>
  <th scope="col">現在の参加者数</th>
  <th scope="col">カテゴリ</th>
  <th scope="col">管理ユーザ</th>
  <th scope="col">最終更新日時</th>
  <th scope="col">操作</th>
</tr>
<?php foreach ($events as $event): ?>
<tr>
  <td><?= $this->Number->format($event->id) ?></td>
  <td><?= h($event->name) ?></td>
  <td><?= h($event->max_participant) ?></td>
  <td><?= h($event->max_participant) ?></td>
  <td><?= h($event->categories->name) ?></td>
  <td><?= h($event->users->email) ?></td>
  <td><?= h($event->modified->format("Y年m月d日H時i分")) ?></td>
  <td><?= $this->Html->link("表示",["controller" => "events", "action" => "view", $event->id]) ?></td>
</tr>
<?php endforeach; ?>
</table>
<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->numbers([
        'before' => $this->Paginator->first("<<"),
        'after' => $this->Paginator->last(">>"),
    ]) ?>
  </ul>
</div>