<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bài tập trắc nghiệm</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Bài tập trắc nghiệm</h2>

        <?php
        $filename = "question.txt";
        if (!file_exists($filename)) {
            echo "<div class='alert alert-danger'>Không tìm thấy file câu hỏi!</div>";
            exit;
        }

        $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $current_question = [];
        $all_questions = [];

        foreach ($questions as $line) {
            if (strpos($line, "Câu") === 0) {
                if (!empty($current_question)) {
                    $all_questions[] = $current_question; // Lưu câu hỏi cũ
                }
                $current_question = []; // Bắt đầu câu hỏi mới
            }
            $current_question[] = $line;
        }
        if (!empty($current_question)) {
            $all_questions[] = $current_question;
        }

        echo "<form method='POST' action='ketqua.php'>"; // Form nộp bài
        foreach ($all_questions as $index => $question) {
            echo "<div class='card mb-4'>";
            echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
            echo "<div class='card-body'>";
            for ($i = 1; $i <= 4; $i++) { // Duyệt 4 đáp án
                $answer = substr($question[$i], 0, 1); // A, B, C, D
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='question{$index}' value='{$answer}' id='question{$index}{$answer}'>";
                echo "<label class='form-check-label' for='question{$index}{$answer}'>{$question[$i]}</label>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        echo "<button type='submit' class='btn btn-primary'>Nộp bài</button>";
        echo "</form>";
        ?>
    </div>
</body>

</html>