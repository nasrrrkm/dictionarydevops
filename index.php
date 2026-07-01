<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "dictionary_db";

// الاتصال بقاعدة البيانات
$conn = mysqli_init(); mysqli_options($conn, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1); @mysqli_real_connect($conn, $host, $user, $pass, $db);

$meaning = "";
$search_word = "";

if (isset($_POST['search'])) {
    $search_word = $conn->real_escape_string($_POST['word']);
    $result = $conn->query("SELECT meaning FROM words WHERE LOWER(word) = LOWER('$search_word')");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $meaning = $row['meaning'];
    } else {
        $meaning = "عذراً، هذه الكلمة غير موجودة في قاعدة البيانات.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>مشروع قاموس السيرفر</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color: #f4f4f4; }
        .container { background: white; padding: 20px; display: inline-block; border-radius: 10px; box-shadow: 0px 0px 10px #ccc; }
        input[type="text"] { padding: 10px; width: 200px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="submit"] { padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .result { margin-top: 20px; font-size: 18px; color: #333; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 مشروع قاموس لينكس (ويب + قاعدة بيانات) 📚</h2>
        <form method="POST">
            <input type="text" name="word" placeholder="اكتب الكلمة بالإنجليزية..." value="<?php echo htmlspecialchars($search_word); ?>" required>
            <input type="submit" name="search" value="ابحث عن المعنى">
        </form>
        <?php if ($meaning): ?>
            <div class="result"><?php echo $meaning; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
