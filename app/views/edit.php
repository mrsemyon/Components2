<?php $this->layout('layout', ['title' => 'User Profile']) ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="/edit" method="POST">
                    <div class="form-group mt-5">
                        <label for="title">Enter new value</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group mt-5">
                        <button class="btn btn-warning">Edit post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>