<?php
session_start();
require '../../includes/datacon.php';

$request_id = $_POST['request_id'];
$action = $_POST['action'];

if ($action === 'accept') {
    $query = "UPDATE session_requests SET status = 'accepted' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$request_id]);
} elseif ($action === 'decline') {
    $query = "UPDATE session_requests SET status = 'declined' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$request_id]);
} elseif ($action === 'reschedule' && !empty($_POST['reschedule_date'])) {
    $reschedule = $_POST['reschedule_date'];
    $query = "UPDATE session_requests SET status = 'rescheduled', reschedule_date = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$reschedule, $request_id]);
}

header("Location: trainer_dashboard.php");
exit();
