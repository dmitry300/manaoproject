<div class="header">
    <nav class="center_headers">
        <ul>
            <li class="center_headers"><a href="">Home page</a></li>
        </ul>
    </nav>
    <nav>
        <ul>
            <?php if (isset($_SESSION['userName'])): ?>
                <li class="btn"><a  href="user/logout">Log out</a></li>
            <?php else: ?>
                <li class="btn"><a class="btn" href="/user/login">Sign in</a></li>
                <li class="btn"><a class="btn" href="/user/register">Sign up</a></li>
            <?php endif; ?>

        </ul>
    </nav>

</div>