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

<h2 class="page-header">イベント参加者</h2>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
  <th scope="col">ユーザID</th>
  <th scope="col">ユーザ名</th>
  <th scope="col">登録日時</th>
</tr>
<?php foreach ($eventusers as $eventuser): ?>
<tr>
  <td><?= $this->Number->format($eventuser->id) ?></td>
  <td><?= h($eventuser->user->email) ?></td>
  <td><?= h($eventuser->created->format("Y年m月d日H時i分")) ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php 
    if($join == 0){
	    echo $this->Html->link(
	    'このイベントに参加する',
	    array('controller' => 'event-users', 'action' => 'add', $event->id),
	    array('class' => 'btn btn-primary', 'role' => 'button'))."<br/>"; 
    } else {
	    echo $this->Html->link(
	    'チャットに参加する',
	    array('controller' => 'chats', 'action' => 'talk', $event->id),
	    array('class' => 'btn btn-primary', 'role' => 'button'))."&nbsp;"; 
	    echo $this->Html->link(
	    'このイベントから辞退する',
	    array('controller' => 'event-users', 'action' => 'delete', $event->id),
	    array('class' => 'btn btn-primary', 'role' => 'button'))."<br/>"; 
    }
?>