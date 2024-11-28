<?php
$tệp = "questions.txt";
$questions = file($tệp, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$curr_question = [];
$all_question = [];
$all_answer = [];
$correct_answer = [];
$stt_answer = 0;

foreach ($questions as $curr) {

    if (strpos($curr, "Câu") === 0) {
        if (!empty($curr_question)) {

            $all_question[] = $curr_question[0];
            $all_answer[] = array_slice($curr_question, 1, 4); 

            preg_match('/Đáp án: ([A-D])/', $curr_question[5], $matches);
            $correct_answer[] = $matches[1];
        }
        $curr_question = [];
        $stt_answer++;
    }
    $curr_question[] = $curr;
}




if (!empty($curr_question)) {
    $all_question[] = $curr_question[0];
    $all_answer[] = array_slice($curr_question, 1, 4);
    preg_match('/Đáp án: ([A-D])/', $curr_question[5], $matches);
    $correct_answer[] = $matches[1];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập trắc nghiệm</title> <!-- Tiêu đề bài tập trắc nghiệm -->
    <style>
        /* Căn giữa tiêu đề */
        h1 {
            text-align: center;
        }

        /* Căn giữa toàn bộ form */
        form {
            width: 60%; /* Bạn có thể điều chỉnh độ rộng của form */
            margin: 0 auto; /* Căn giữa form */
        }

        /* Căn giữa các câu hỏi */
        fieldset {
            margin-bottom: 15px;
        }

        /* In đậm câu hỏi */
        .question {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Bài tập trắc nghiệm</h1> <!-- Tiêu đề bài tập trắc nghiệm ở phần thân -->
    <form action="process.php" method="POST">
        <?php
        foreach ($all_question as $index => $question) {
            echo "<fieldset>";
            // Thêm class "question" để in đậm câu hỏi
            echo "<div class='question'>" . $question . "</div><br>";

            $answers = $all_answer[$index];
            foreach ($answers as $key => $answer) {
                $option = chr(65 + $key);
                echo "<label><input type='radio' name='answer" . ($index + 1) . "' value='$option' /> $answer</label><br>";
            }
            echo "</fieldset>";
        }
        ?>
        <input type="submit" value="Nộp bài">
    </form>
</body>
</html>
