<?php $this->layout('layout', ['title' => 'User Profile']) ?>
<h1>Posts</h1>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-5">
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <th><?= $post['id'] ?></th>
                <td><a class="text-reset text-decoration-none" href="/show/<?= $post['id'] ?>"><?= $post['title'] ?></a></td>
                <td>
                    <a href="edit.php" class="btn btn-warning">Edit</a>
                    <a href="/delete/<?= $post['id'] ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>
    </div>
</div>