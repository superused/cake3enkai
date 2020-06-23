<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
    <?=$this->Html->link("宴会くん",["controller"=>"Homes"] ,["class"=>"navbar-brand"]); ?>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <?=$this->Html->link("イベント","#",["data-toggle"=>"dropdown"]);?>
          <ul class="dropdown-menu">
            <li><?=$this->Html->link("マイイベント一覧","/admin/events/mylist");?></li>
            <li><?=$this->Html->link("新規追加","/admin/events/add");?></li>
          </ul>
        </li>
        <li class="dropdown">
          <?=$this->Html->link("カテゴリ","#",["data-toggle"=>"dropdown"]);?>
          <ul class="dropdown-menu">
            <li><?=$this->Html->link("カテゴリ一覧","/admin/categories/index");?></li>
            <li><?=$this->Html->link("新規追加","/admin/categories/add");?></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <p class="navbar-text">ようこそ、<?=$auth["email"]; ?></p>
        <li class="dropdown">
          <?=$this->Html->link("管理","#",["data-toggle"=>"dropdown"]);?>
          <ul class="dropdown-menu">
            <li><?=$this->Html->link("ユーザ一覧","/admin/users/index")?></li>
            <li><?=$this->Html->link("ユーザ編集","/admin/users/edit")?></li>
            <li><?=$this->Html->link("ログアウト","/admin/users/logout")?></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>