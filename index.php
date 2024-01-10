<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        echo "Пожалуйста, заполните форму корректно.";
        exit;
    }
    $recipient = "your@email.com";
    $subject = "Новое сообщение от $name";

    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Сообщение:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        echo "Сообщение успешно отправлено.";
    } else {
        echo "Не удалось отправить сообщение.";
    }
} else {
    // Не POST запрос, перенаправляем на главную страницу
    header("Location: index.html");
    exit;
}
?>
