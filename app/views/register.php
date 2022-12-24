<?php $this->layout('layout', ['title' => 'Sign up']) ?>
<main class="form-signin">
    <form>
        <h1 class="text-center h3 mb-3 fw-normal">Please sign up</h1>

        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <div class="form-floating">
            <input name="password_again" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password again</label>
        </div>
        <button id="sign-up-btn" class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
        <p class="text-center mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>