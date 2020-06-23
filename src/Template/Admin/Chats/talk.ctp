<?php foreach ($chats as $chat): ?>
  <?php if($chat->user->id == $user_id) {
      echo "<div class=\"box1\">";
  } else {
      echo "<div class=\"box2\">"; 
  } ?>
  	<div><?= h($chat->user->email) ?></div>
  	<div><?= h($chat->body) ?></div>
  	<div><?= h($chat->modified->format("Y年m月d日H時i分")) ?></div>
  </div>
  <div class="clear"></div>
<?php endforeach; ?>

<table class="now" cellpadding="0" cellspacing="0">
<tr>
  <th scope="col">投稿</th>
</tr>
<tr>
  <td><?php
    echo $this->Form->create('chats', ['url' => ['action' => 'add', $id], 'type' => 'post']);
    echo $this->Form->text('body');
    echo $this->Form->hidden('user_id', ['value'=>$user_id]);
    echo $this->Form->hidden('event_id', ['value'=>$id]);
    echo $this->Form->button("投稿");
    echo $this->Form->end();
  ?></td>
</tr>
</table>