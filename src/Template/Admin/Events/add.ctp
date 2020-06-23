<h1 class="page-header">イベント新規追加</h1>
<?php
echo $this->Form->create($event);
echo $this->Form->input('name');
echo $this->Form->input('detail');
echo $this->Form->input('max_participant');
echo $this->Form->input('category_id', ['options' => $categories, "empty" => "選択"]);
echo $this->Form->input('user_id', ['options' => $users, "empty" => "選択"]);
echo $this->Form->button("登録");
echo $this->Form->end();
?>