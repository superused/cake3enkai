<h1 class="page-header">イベント詳細</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
  <th scope="col">イベント名</th>
  <th scope="col">最大参加者数</th>
  <th scope="col">カテゴリ</th>
  <th scope="col">管理ユーザ</th>
  <th scope="col">最終更新日時</th>
</tr>
<tr>
  <td><?= $this->Number->format($event->id) ?></td>
  <td><?= h($event->name) ?></td>
  <td><?= h($event->max_participant) ?></td>
  <td><?= h($event->category->name) ?></td>
  <td><?= h($event->user->email) ?></td>
  <td><?= h($event->modified->format("Y年m月d日H時i分")) ?></td>
</tr>
</table>

<table class="now" cellpadding="0" cellspacing="0">
<tr>
  <th scope="col">現在の参加者数</th>
</tr>
<tr>
  <td><?= h(count($event->event_users)) ?></td>
</tr>
</table>

<?php echo $this->Html->link(
    'ログインする',
    array('controller' => 'users', 'action' => 'login'),
    array('class' => 'btn btn-primary', 'role' => 'button')
)."<br/>"; ?>