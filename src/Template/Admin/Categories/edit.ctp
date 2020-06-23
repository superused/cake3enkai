<h1 class="page-header">カテゴリ編集</h1>
<?php
echo $this->Form->create($category);
echo $this->Form->input('name');
echo $this->Form->button("登録");
echo $this->Form->end();
?>