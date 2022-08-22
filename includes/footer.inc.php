<footer>
    <ul>
        <li>Footer Nav</li>
        <?php if ($user) : ?>
            <a href="logout.php">Logout</a>
        <?php else : ?>
            <a href="logout.php">Login</a>
        <?php endif ?>
    </ul>
</footer>
</body>

</html>