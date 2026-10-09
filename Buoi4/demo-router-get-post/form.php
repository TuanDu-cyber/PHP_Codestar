<?php
header("X-author: Dang Tuan Du");
?>
<h1>
    hello <?php echo $_SESSION['data'] ?? 11; ?>
</h1>

<?php $_SESSION['data2'] = 1; ?>
<?php $_SESSION['tenNguoiDung'] = "Du";  ?>
<p>
    Tên người dùng:
    <?php echo $_SESSION['tenNguoiDung']; ?>
</p>

<?php echo $_SESSION['data2']; ?>
<h2>Cùng 1 form, khác method</h2>
<div style="display:flex; gap:40px">
    <div>
        <h3>Form GET</h3>
        <form action="result.php" method="GET">
            <div>Username: <input type="text" name="username"></div>
            <div>Password: <input type="password" name="password"></div>
            <input type="submit" value="Gửi bằng GET">
        </form>
    </div>
    <div>
        <h3>Form POST</h3>
        <form action="result.php" method="POST">
            <div>Username: <input type="text" name="username"></div>
            <div>Password: <input type="password" name="password"></div>
            <input type="submit" value="Gửi bằng POST">
        </form>
    </div>
</div>
<p><a href="index.php">← Về demo router</a></p>