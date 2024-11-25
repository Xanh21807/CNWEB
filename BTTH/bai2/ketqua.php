<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kết quả bài tập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Kết quả bài tập</h2>

        <?php
        $filename = "question.txt";
        if (!file_exists($filename)) {
            echo "<div class='alert alert-danger'>Không tìm thấy file câu hỏi!</div>";
            exit;
        }

        $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Trích xuất đáp án đúng
        $answers = [];
        foreach ($questions as $line) {
            if (strpos($line, "Đáp án:") !== false) {
                $answers[] = trim(substr($line, strpos($line, ":") + 1));
            }
        }

        // So sánh câu trả lời của người dùng với đáp án đúng
        $score = 0;
        foreach ($_POST as $key => $userAnswer) {
            $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
            if (isset($answers[$questionNumber]) && $answers[$questionNumber] === $userAnswer) {
                $score++;
            }
        }

        echo "<div class='alert alert-success text-center'>";
        echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
        echo "</div>";

        echo "<a href='test.php' class='btn btn-primary'>Làm lại</a>";
        ?>
    </div>
</body>

</html>