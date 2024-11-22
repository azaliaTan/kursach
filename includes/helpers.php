<?php

function paginateLimit()
{
  return 2;
}

function pdo()
{
  global $link;
  return $link;
}


function paginateSqlQuery($query)
{
  $sql = $query;

  $sqlLimit = " LIMIT " . paginateLimit();
  $sql .= $sqlLimit;
  if (isset($_GET['cursor'])) {
    $sqlPaginate = " OFFSET " . ((int)$_GET['cursor'] * paginateLimit() - paginateLimit());
    $sql .= $sqlPaginate;
  }

  return $sql;
}

function paginationButtons($table, $modifyQuery = '')
{
  $sql = "SELECT CEIL(COUNT(*) / " . paginateLimit() . ") as tovar_count FROM " . $table . $modifyQuery;

  $pages = pdo()->query($sql)->fetch(PDO::FETCH_ASSOC)['tovar_count'];

  for ($i = 1; $i <= $pages; $i++) {
    $id = $i === (int)($_GET['cursor'] ?? 1) ? 'fpag' : '';
?>
<li id="<?= $id  ?>">
 
<a href="?page=admin&cursor=<?= $i ?>"><?= $i ?></a> 
</li>
<?php
  }
}
