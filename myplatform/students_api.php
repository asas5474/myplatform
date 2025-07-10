<?php
// filepath: c:\Users\AL-MONTHER-PC\Desktop\myplatform\js\js\students_api.php

header("Content-Type: application/json");

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "myplatform");
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "msg" => "DB connection failed"]);
    exit;
}

// إضافة طالب جديد
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $major = $_POST['major'] ?? '';
    $gpa = $_POST['gpa'] ?? 0;
    $semester1 = $_POST['semester1'] ?? '';
    $semester2 = $_POST['semester2'] ?? '';
    $semester3 = $_POST['semester3'] ?? '';
    $semester4 = $_POST['semester4'] ?? '';
    $semester5 = $_POST['semester5'] ?? '';
    $semester6 = $_POST['semester6'] ?? '';
    $semester7 = $_POST['semester7'] ?? '';
    $semester8 = $_POST['semester8'] ?? '';

    $stmt = $conn->prepare("INSERT INTO students (name, major, gpa, semester1, semester2, semester3, semester4, semester5, semester6, semester7, semester8) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddddddddd", $name, $major, $gpa, $semester1, $semester2, $semester3, $semester4, $semester5, $semester6, $semester7, $semester8);
    $stmt->execute();

    echo json_encode(["status" => "success"]);
    exit;
}

// عرض جميع الطلاب
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query("SELECT * FROM students ORDER BY id DESC");
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode($students);
    exit;
}
?>