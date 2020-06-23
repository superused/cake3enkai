<h1 class="page-header">マイイベント一覧</h1>
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
  <td><?= h(count($event->event_users)) ?></td>
  <td><?= h($event->category->name) ?></td>
  <td><?= h($event->user->email) ?></td>
  <td><?= h($event->modified->format("Y年m月d日H時i分")) ?></td>
  <td><?php echo $this->Html->link(
    '編集',
    array('controller' => 'events', 'action' => 'edit', $event->id),
    array('class' => 'btn btn-primary', 'role' => 'button'))."&nbsp;";
    echo $this->Html->link(
    '削除',
    array('controller' => 'events', 'action' => 'delete', $event->id),
    array('class' => 'btn btn-primary', 'role' => 'button'));
    ?>
    </td>
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