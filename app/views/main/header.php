<div class="header">
    <nav class="center_headers">
        <ul>
            <li class="center_headers"><a href="/manaoproject">Home page</a></li>
        </ul>
    </nav>
    <nav>
        <ul>
            <?php if (isset($_SESSION['userName'])): ?>
                <li class="btn"><a  href="/manaoproject/user/logout">Log out</a></li>
            <?php else: ?>
                <li class="btn"><a class="btn" href="/manaoproject/user/login">Sign in</a></li>
                <li class="btn"><a class="btn" href="/manaoproject/user/register">Sign up</a></li>
            <?php endif; ?>

        </ul>
    </nav>

</div>