<?php
/**
 * logger.php — Stephen Kanja School Site Monitor
 * Include this file at the TOP of every page you want to track.
 * Usage: include_once 'logger.php';
 *
 * Also call logLogin($username, $success, $conn) on your login form handler.
 */

if (!isset($conn)) {
    // Only load conn if not already loaded
    @include_once __DIR__ . '/conn.php';
}

if (!isset($conn) || !$conn) return;

/* ── Create tables if they don't exist ── */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS site_logs (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    session_id  VARCHAR(100),
    ip_address  VARCHAR(60),
    page        VARCHAR(500),
    referrer    VARCHAR(500),
    user_agent  VARCHAR(500),
    method      VARCHAR(10),
    status_code INT DEFAULT 200,
    visit_time  DATETIME DEFAULT CURRENT_TIMESTAMP,
    country     VARCHAR(80),
    device_type VARCHAR(30),
    browser     VARCHAR(80),
    os          VARCHAR(80),
    duration_ms INT DEFAULT 0
)
");

mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS login_logs (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(200),
    ip_address  VARCHAR(60),
    success     TINYINT(1) DEFAULT 0,
    user_agent  VARCHAR(500),
    login_time  DATETIME DEFAULT CURRENT_TIMESTAMP,
    session_id  VARCHAR(100),
    note        VARCHAR(300)
)
");

mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS active_sessions (
    session_id   VARCHAR(100) PRIMARY KEY,
    ip_address   VARCHAR(60),
    current_page VARCHAR(500),
    last_seen    DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_agent   VARCHAR(500),
    started_at   DATETIME DEFAULT CURRENT_TIMESTAMP
)
");

/* ── Helpers ── */
function _parseUA($ua) {
    $browser = 'Unknown';
    $os      = 'Unknown';
    $device  = 'Desktop';

    // Browser
    if (stripos($ua,'Edg')!==false)        $browser='Edge';
    elseif(stripos($ua,'OPR')!==false||stripos($ua,'Opera')!==false) $browser='Opera';
    elseif(stripos($ua,'Chrome')!==false)  $browser='Chrome';
    elseif(stripos($ua,'Firefox')!==false) $browser='Firefox';
    elseif(stripos($ua,'Safari')!==false)  $browser='Safari';
    elseif(stripos($ua,'MSIE')!==false||stripos($ua,'Trident')!==false) $browser='IE';

    // OS
    if     (stripos($ua,'Windows')!==false) $os='Windows';
    elseif (stripos($ua,'Android')!==false) $os='Android';
    elseif (stripos($ua,'iPhone')||stripos($ua,'iPad'))   $os='iOS';
    elseif (stripos($ua,'Linux')!==false)   $os='Linux';
    elseif (stripos($ua,'Mac')!==false)     $os='macOS';

    // Device
    if (stripos($ua,'Mobile')!==false||stripos($ua,'Android')!==false||stripos($ua,'iPhone')!==false) $device='Mobile';
    elseif (stripos($ua,'Tablet')!==false||stripos($ua,'iPad')!==false) $device='Tablet';

    return compact('browser','os','device');
}

function _getIP() {
    foreach (['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','HTTP_X_REAL_IP','REMOTE_ADDR'] as $k) {
        if (!empty($_SERVER[$k])) {
            $ip = trim(explode(',',$_SERVER[$k])[0]);
            if (filter_var($ip,FILTER_VALIDATE_IP)) return $ip;
        }
    }
    return '0.0.0.0';
}

/* ── Log the current page visit ── */
if (session_status()===PHP_SESSION_NONE) @session_start();
$_logSessId  = session_id() ?: 'nosess';
$_logIP      = _getIP();
$_logPage    = $_SERVER['REQUEST_URI'] ?? '/';
$_logRef     = $_SERVER['HTTP_REFERER'] ?? '';
$_logUA      = $_SERVER['HTTP_USER_AGENT'] ?? '';
$_logMethod  = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$_logParsed  = _parseUA($_logUA);

// Escape
$sSessId = mysqli_real_escape_string($conn, $_logSessId);
$sIP     = mysqli_real_escape_string($conn, substr($_logIP,0,60));
$sPage   = mysqli_real_escape_string($conn, substr($_logPage,0,500));
$sRef    = mysqli_real_escape_string($conn, substr($_logRef,0,500));
$sUA     = mysqli_real_escape_string($conn, substr($_logUA,0,500));
$sMethod = mysqli_real_escape_string($conn, $_logMethod);
$sBrow   = mysqli_real_escape_string($conn, $_logParsed['browser']);
$sOS     = mysqli_real_escape_string($conn, $_logParsed['os']);
$sDev    = mysqli_real_escape_string($conn, $_logParsed['device']);

mysqli_query($conn,
    "INSERT INTO site_logs (session_id,ip_address,page,referrer,user_agent,method,browser,os,device_type)
     VALUES ('$sSessId','$sIP','$sPage','$sRef','$sUA','$sMethod','$sBrow','$sOS','$sDev')"
);

// Upsert active sessions
mysqli_query($conn,
    "INSERT INTO active_sessions (session_id,ip_address,current_page,user_agent)
     VALUES ('$sSessId','$sIP','$sPage','$sUA')
     ON DUPLICATE KEY UPDATE current_page='$sPage', last_seen=NOW()"
);

// Clean stale sessions (> 10 min)
mysqli_query($conn,"DELETE FROM active_sessions WHERE last_seen < DATE_SUB(NOW(),INTERVAL 10 MINUTE)");

/* ── Login logger function ── */
function logLogin($username, $success, $conn, $note='') {
    if (!$conn) return;
    if (session_status()===PHP_SESSION_NONE) @session_start();
    $ua      = $_SERVER['HTTP_USER_AGENT']??'';
    $sessId  = session_id()?:'nosess';
    $ip      = '0.0.0.0';
    foreach(['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','REMOTE_ADDR'] as $k) {
        if (!empty($_SERVER[$k])){$ip=trim(explode(',',$_SERVER[$k])[0]);break;}
    }
    $u  = mysqli_real_escape_string($conn, substr((string)$username,0,200));
    $ip = mysqli_real_escape_string($conn, substr($ip,0,60));
    $ua = mysqli_real_escape_string($conn, substr($ua,0,500));
    $s  = (int)(bool)$success;
    $si = mysqli_real_escape_string($conn, $sessId);
    $nt = mysqli_real_escape_string($conn, substr($note,0,300));
    mysqli_query($conn,
        "INSERT INTO login_logs (username,ip_address,success,user_agent,session_id,note)
         VALUES ('$u','$ip',$s,'$ua','$si','$nt')"
    );
}
?>
