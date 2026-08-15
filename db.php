<?php
// بيانات الاتصال بقاعدة البيانات - غيّرها ببياناتك من InfinityFree
$host = "sql108.infinityfree.com";      // اسم السيرفر (Hostname)
$user = "if0_42423213";                // اسم المستخدم
$pass = "TgzN3LZpt6Er24";           // كلمة المرور
$dbname = "if0_42423213_db_robb";   // اسم قاعدة البيانات

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "فشل الاتصال: " . $conn->connect_error]));
}
?>