<?php $this->layout('layout', ['title' => 'Sign in']) ?>
<main class="form-signin">
    <form action="/login" method="POST">
        <h1 class="text-center h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="text-center checkbox mb-3">
            <label>
                <input id="remember-me" name="remember_me" type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button id="sign-in-btn" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="text-center mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
</main>