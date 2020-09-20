<h1>Test</h1>
<form class="form pb-5 ajax" name="daily-add" method="post" data-reset="yes" data-func="o1" data-popup="yes" data-responsemodal="yes">
</form>
<?php
$users = $database->select('users','*');
var_dump($users);
