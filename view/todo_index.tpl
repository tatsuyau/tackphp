<form action="todo_add" method="post">
<input type="text" name="title">
<input type="submit" value="add">
</form>

<form action="todo" method="post">
<input type="text" name="title">
<input type="submit" value="search">
</form>

<?php if($data): ?>
<?php foreach($data as $item): ?>

<?php if($item['status'] != 1): ?>
<p><?php echo $item['title']; ?> <a href="todo_update?id=<?php echo $item['id']; ?>&status=1">done</a></p>

<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
