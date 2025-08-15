<?php
$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "shafeeqsharafi@gmail.com";
    $subject = "New Employee Survey Submission";

    function safePost($key) {
        return isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
    }

    // Collect form values
    $roleSatisfaction = safePost('roleSatisfaction');
    $workLifeBalance = safePost('workLifeBalance');
    $companyCulture = safePost('companyCulture');
    $recognition = safePost('recognition');
    $developmentOpportunities = safePost('developmentOpportunities');
    $cultureImprovement = nl2br(safePost('cultureImprovement'));
    $skillsDevelopment = nl2br(safePost('Other_Comment'));
    $HR_Admin_Department_Comment = nl2br(safePost('HR_Admin_Department_Comment'));
    $Accounts_Department_Comment = nl2br(safePost('Accounts_Department_Comment'));
    $Management_Comment = nl2br(safePost('Management_Comment'));
    $Operations_Department_Comment = nl2br(safePost('Operations_Department_Comment'));
    $IT_Department_Comment = nl2br(safePost('IT_Department_Comment'));
    $Other_Department_Comment = nl2br(safePost('Other_Department_Comment'));
    $employeeConcern = nl2br(safePost('Concern_'));
    $enjoyment = isset($_POST['enjoyment']) ? $_POST['enjoyment'] : [];
    $enjoymentList = !empty($enjoyment) ? implode(", ", array_map('htmlspecialchars', $enjoyment)) : 'None';

    $message = "
    <html>
    <head>
      <title>Employee Survey Submission</title>
      <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
      </style>
    </head>
    <body>
      <h2>New Employee Survey Submission</h2>
      <table>
        <tr><th>Question</th><th>Answer</th></tr>
        <tr><td>How satisfied are you with your current role?</td><td>{$roleSatisfaction}</td></tr>
        <tr><td>How would you rate your work-life balance?</td><td>{$workLifeBalance}</td></tr>
        <tr><td>What aspects of your job do you enjoy the most?</td><td>{$enjoymentList}</td></tr>
        <tr><td>How would you rate our company culture?</td><td>{$companyCulture}</td></tr>
        <tr><td>Do you feel your contributions are recognized and valued?</td><td>{$recognition}</td></tr>
        <tr><td>What is one thing we could improve about our company culture?</td><td>{$cultureImprovement}</td></tr>
        <tr><td>How satisfied are you with the learning and development opportunities available to you?</td><td>{$developmentOpportunities}</td></tr>
        <tr><td>Other Comments</td><td>{$skillsDevelopment}</td></tr>
        <tr><td>Is there any comment on HR & Admin Department?</td><td>{$HR_Admin_Department_Comment}</td></tr>
        <tr><td>Is there any comment on Accounts Department?</td><td>{$Accounts_Department_Comment}</td></tr>
        <tr><td>Is there any comment on Management?</td><td>{$Management_Comment}</td></tr>
        <tr><td>Is there any comment on Operations Department?</td><td>{$Operations_Department_Comment}</td></tr>
        <tr><td>Is there any comment on IT Department?</td><td>{$IT_Department_Comment}</td></tr>
        <tr><td>Is there any comment on Other Department?</td><td>{$Other_Department_Comment}</td></tr>
        <tr><td>Challenges with Employees</td><td>{$employeeConcern}</td></tr>
      </table>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: feedback@mafmep.ae\r\n";

    if (mail($to, $subject, $message, $headers)) {
        $successMessage = "✅ Feedback submitted successfully!";
    } else {
        $errorMessage = "❌ Error sending survey. Please try again later.";
    }
}
?>