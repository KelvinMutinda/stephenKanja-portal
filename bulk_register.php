
<?php
/*
 * bulk_register.php
 * =================
 * Place this file in the SAME folder as RegisterStudent.php.
 *
 * Accepts:  POST  Content-Type: application/json
 *           Body: { "students": [ { upi, assessment, firstName, middleName,
 *                                   surname, dob, grade, birthCert }, ... ] }
 *
 * Returns:  { "success": true,  "imported": N, "skipped": M, "errors": [...] }
 *        or { "success": false, "message": "reason" }
 *
 * IMPORTANT:
 *   Any PHP error/warning that prints to the output will break the JSON
 *   response and cause the "non-JSON" error in the browser.
 *   We use output buffering to catch and discard stray output,
 *   and set error_reporting to 0 so warnings don't leak.
 */

/* ── Suppress stray PHP output / warnings ── */
error_reporting(0);
ini_set('display_errors', '0');
ob_start();               // catch any accidental output before we're ready

/* ── Headers ── */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');          // allow same-origin fetch
header('Access-Control-Allow-Headers: Content-Type');

/* ── Only accept POST ── */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    ob_end_clean();
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed. Use POST.']);
    exit;
}

/* ── Parse JSON body ── */
$raw  = file_get_contents('php://input');
$body = json_decode($raw, true);

if (!$body || !isset($body['students']) || !is_array($body['students'])) {
    ob_end_clean();
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request body. Expected JSON with "students" array.'
    ]);
    exit;
}

$students = $body['students'];

if (count($students) === 0) {
    ob_end_clean();
    echo json_encode(['success' => true, 'imported' => 0, 'skipped' => 0, 'errors' => []]);
    exit;
}

/* ── Database connection ── */
include 'conn.php';   // must define $conn as a mysqli object

if (!isset($conn) || $conn->connect_error) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . ($conn->connect_error ?? 'conn.php did not set $conn')
    ]);
    exit;
}

/* ── Prepare statements ── */
$checkStmt = $conn->prepare(
    "SELECT id FROM Student WHERE UPI = ? OR Assesment = ? LIMIT 1"
);

if (!$checkStmt) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'DB prepare failed: ' . $conn->error]);
    exit;
}

$insertStmt = $conn->prepare(
    "INSERT INTO Student
       (UPI, Assesment, firstName, middleName, surname, DOB, Grade, birthNo, role)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'user')"
);

if (!$insertStmt) {
    ob_end_clean();
    echo json_encode(['success' => false, 'message' => 'DB prepare failed: ' . $conn->error]);
    exit;
}

/* ── Process rows ── */
$imported = 0;
$skipped  = 0;
$errors   = [];

foreach ($students as $idx => $s) {
    $upi        = trim((string)($s['upi']        ?? ''));
    $assessment = trim((string)($s['assessment'] ?? ''));
    $firstName  = trim((string)($s['firstName']  ?? ''));
    $middleName = trim((string)($s['middleName'] ?? ''));
    $surname    = trim((string)($s['surname']    ?? ''));
    $dob        = trim((string)($s['dob']        ?? ''));
    $grade      = intval($s['grade'] ?? 0);
    $birthCert  = trim((string)($s['birthCert']  ?? ''));

    /* Server-side validation */
    $rowErrors = [];
    if ($upi === '')        $rowErrors[] = 'UPI missing';
    if ($assessment === '') $rowErrors[] = 'Assessment No missing';
    if ($firstName === '')  $rowErrors[] = 'First name missing';
    if ($surname === '')    $rowErrors[] = 'Surname missing';
    if ($dob === '')        $rowErrors[] = 'DOB missing';
    if ($grade < 1 || $grade > 9) $rowErrors[] = 'Grade out of range';
    if ($dob !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) $rowErrors[] = 'DOB format invalid';

    if (!empty($rowErrors)) {
        $skipped++;
        $errors[] = 'Row ' . ($idx + 2) . ': ' . implode(', ', $rowErrors);
        continue;
    }

    /* Duplicate check */
    $checkStmt->bind_param('ss', $upi, $assessment);
    $checkStmt->execute();
    $checkStmt->store_result();
    $isDuplicate = $checkStmt->num_rows > 0;
    $checkStmt->free_result();

    if ($isDuplicate) {
        $skipped++;
        $errors[] = 'Row ' . ($idx + 2) . ": Duplicate UPI ($upi) or Assessment ($assessment) — skipped";
        continue;
    }

    /* Insert */
    $insertStmt->bind_param('ssssssis',
        $upi, $assessment, $firstName, $middleName,
        $surname, $dob, $grade, $birthCert
    );

    if ($insertStmt->execute()) {
        $imported++;
    } else {
        $skipped++;
        $errors[] = 'Row ' . ($idx + 2) . ': Insert failed — ' . $insertStmt->error;
    }
}

$checkStmt->close();
$insertStmt->close();
$conn->close();

/* ── Discard any stray output and send clean JSON ── */
ob_end_clean();

echo json_encode([
    'success'  => true,
    'imported' => $imported,
    'skipped'  => $skipped,
    'errors'   => $errors
]);
exit;
