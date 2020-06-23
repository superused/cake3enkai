<h1 class="page-header">受注一覧</h1>
<table class="table table-striped" cellpadding="0" cellspacing="0">
<tr>
  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
  <th scope="col">カテゴリ名</th>
  <th scope="col">最終更新日時</th>
  <th scope="col">操作</th>
</tr>
<?php foreach ($categories as $category): ?>
<tr>
  <td><?= $this->Number->format($category->id) ?></td>
  <td><?= h($category->name) ?></td>
  <td><?= h($category->modified->format("Y年m月d日H時i分")) ?></td>
  <td><?php echo $this->Html->link(
    '編集',
    array('controller' => 'categories', 'action' => 'edit', $category->id),
    array('class' => 'btn btn-primary', 'role' => 'button'))."&nbsp;";
    echo $this->Html->link(
    '削除',
    array('controller' => 'categories', 'action' => 'delete', $category->id),
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