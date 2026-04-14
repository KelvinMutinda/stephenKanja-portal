<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kanja Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,400;0,500;0,600;1,400&display=swap">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --gold: #f0c040;
      --gold-dim: #c9a030;
      --black: #111111;
      --dark: #1a1a1a;
      --mid: #2a2a2a;
      --bg: #f4f4f2;
      --white: #ffffff;
      --border: #e4e4e0;
      --muted: #999;
      --sidebar-w: 260px;
      --green: #16a34a; --green-bg: #dcfce7;
      --blue: #1a4a7a;  --blue-bg: #dce8f5;
      --red: #991b1b;   --red-bg: #fee2e2;
      --amber: #92400e; --amber-bg: #fef3c7;
    }

    html { scroll-behavior: smooth; }
    body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--black); min-height: 100vh; }

    /* ── overlay ── */
    .overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:200; backdrop-filter:blur(2px); }
    .overlay.active { display:block; }

    /* ══ SIDEBAR ══ */
    .sidebar {
      position:fixed; top:0; left:0; width:var(--sidebar-w); height:100vh;
      background:var(--black); display:flex; flex-direction:column; z-index:300;
      transition:transform 0.32s cubic-bezier(0.4,0,0.2,1); overflow:hidden;
    }
    .sidebar::before { content:''; position:absolute; top:0; left:0; width:3px; height:100%; background:linear-gradient(to bottom,var(--gold) 0%,transparent 100%); }
    .sidebar-brand { padding:1.6rem 1.4rem 1.2rem; border-bottom:1px solid var(--mid); display:flex; align-items:center; gap:10px; }
    .sidebar-brand .brand-icon { width:36px; height:36px; background:var(--gold); border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .sidebar-brand .brand-icon i { color:var(--black); font-size:16px; }
    .sidebar-brand .brand-text { display:flex; flex-direction:column; line-height:1.1; }
    .sidebar-brand .brand-text span:first-child { font-family:'Bebas Neue',sans-serif; font-size:1.15rem; letter-spacing:0.12em; color:var(--white); }
    .sidebar-brand .brand-text span:last-child { font-size:10px; color:var(--muted); letter-spacing:0.08em; text-transform:uppercase; }
    .sidebar-close { display:none; position:absolute; top:1rem; right:1rem; background:var(--mid); border:none; color:var(--white); width:30px; height:30px; border-radius:6px; cursor:pointer; align-items:center; justify-content:center; font-size:13px; transition:background 0.2s; }
    .sidebar-close:hover { background:var(--gold); color:var(--black); }
    .sidebar-nav { flex:1; overflow-y:auto; padding:1rem 0; scrollbar-width:thin; scrollbar-color:var(--mid) transparent; }
    .nav-label { font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:#555; padding:0.8rem 1.4rem 0.4rem; font-weight:600; }
    .sidebar-nav a { display:flex; align-items:center; gap:11px; padding:0.7rem 1.4rem; color:#aaa; text-decoration:none; font-size:13.5px; font-weight:500; border-left:3px solid transparent; transition:all 0.18s; }
    .sidebar-nav a:hover, .sidebar-nav a.active { color:var(--white); background:rgba(255,255,255,0.04); border-left-color:var(--gold); }
    .sidebar-nav a.active { background:rgba(240,192,64,0.08); }
    .sidebar-nav a i { width:18px; text-align:center; font-size:13px; flex-shrink:0; }
    .sidebar-nav a:hover i, .sidebar-nav a.active i { color:var(--gold); }
    .sidebar-footer { padding:1rem 1.4rem; border-top:1px solid var(--mid); font-size:11px; color:#444; letter-spacing:0.04em; }

    /* ══ MAIN ══ */
    .main { margin-left:var(--sidebar-w); min-height:100vh; display:flex; flex-direction:column; transition:margin-left 0.32s cubic-bezier(0.4,0,0.2,1); }
    .topbar { background:var(--black); border-bottom:3px solid var(--gold); padding:0.95rem 2rem; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:100; }
    .topbar-left { display:flex; align-items:center; gap:14px; }
    .menu-toggle { display:none; background:var(--mid); border:none; color:var(--white); width:34px; height:34px; border-radius:7px; cursor:pointer; align-items:center; justify-content:center; font-size:14px; transition:background 0.2s; flex-shrink:0; }
    .menu-toggle:hover { background:var(--gold); color:var(--black); }
    .topbar h2 { font-family:'Bebas Neue',sans-serif; font-size:1.6rem; letter-spacing:0.12em; color:var(--white); }
    .topbar h2 span { color:var(--gold); }
    .topbar-right { display:flex; align-items:center; gap:8px; font-size:12px; color:var(--muted); letter-spacing:0.04em; }
    .topbar-right i { color:var(--gold); font-size:11px; }

    .content { flex:1; padding:2rem; }

    /* ── Section heads ── */
    .section-head {
      font-family:'Bebas Neue',sans-serif; font-size:1.8rem; letter-spacing:0.1em;
      color:var(--black); margin:0 0 1.4rem; padding-bottom:0.5rem;
      border-bottom:2px solid var(--border); display:flex; align-items:center; gap:10px;
    }
    .section-head::before { content:'◆'; color:var(--gold); font-size:0.85rem; }
    .section-head.mt { margin-top:2.5rem; }

    /* ── KPI strip ── */
    .stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1.2rem; margin-bottom:2.5rem; }
    .stat-card {
      background:var(--white); border:1px solid var(--border); border-top:3px solid var(--black);
      border-radius:12px; padding:1.4rem 1.6rem; position:relative; overflow:hidden;
      transition:transform 0.22s,box-shadow 0.22s; animation:fadeUp 0.45s ease both;
    }
    .stat-card:hover { transform:translateY(-4px); box-shadow:0 14px 36px rgba(0,0,0,0.1); }
    .stat-card .big-num { font-family:'Bebas Neue',sans-serif; font-size:3.2rem; color:var(--black); line-height:1; margin-bottom:6px; }
    .stat-card h3 { font-size:12px; font-weight:600; letter-spacing:0.08em; text-transform:uppercase; color:var(--black); margin:6px 0 4px; }
    .stat-card p { font-size:12px; color:var(--muted); }
    .stat-card .card-icon { position:absolute; top:1.2rem; right:1.4rem; width:34px; height:34px; background:var(--gold); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:14px; color:var(--black); }

    /* ── Term finance cards ── */
    .finance-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.2rem; margin-bottom:2rem; }
    .finance-card { background:var(--white); border:1px solid var(--border); border-radius:12px; padding:1.4rem 1.6rem; transition:transform 0.22s,box-shadow 0.22s; animation:fadeUp 0.45s ease both; }
    .finance-card:hover { transform:translateY(-3px); box-shadow:0 10px 28px rgba(0,0,0,0.07); }
    .finance-card h3 { font-family:'Bebas Neue',sans-serif; font-size:1.05rem; letter-spacing:0.1em; color:var(--black); margin:0 0 1rem; padding-bottom:0.6rem; border-bottom:1px solid var(--border); display:flex; align-items:center; gap:6px; }
    .finance-card h3 .term-badge { display:inline-block; background:var(--gold); color:var(--black); font-size:10px; font-family:'DM Sans',sans-serif; font-weight:700; letter-spacing:0.06em; padding:2px 7px; border-radius:4px; margin-left:auto; }
    .fin-rows { display:flex; flex-direction:column; gap:9px; }
    .fin-row { display:flex; justify-content:space-between; align-items:center; padding:6px 0; }
    .fin-row + .fin-row { border-top:1px solid #f5f5f2; }
    .fin-row .lbl { font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:0.05em; }
    .fin-row .val { font-family:'Bebas Neue',sans-serif; font-size:1.2rem; color:var(--black); letter-spacing:0.04em; }
    .fin-row .val.red { color:#c0392b; }
    .fin-row .val.green { color:var(--green); }

    /* ── Chart card ── */
    .chart-card {
      background:var(--white); border:1px solid var(--border); border-radius:12px;
      overflow:hidden; margin-bottom:2rem; animation:fadeUp 0.45s ease both;
    }
    .chart-card-header {
      background:var(--black); border-bottom:2px solid var(--gold);
      padding:1rem 1.6rem; display:flex; align-items:center; gap:8px;
    }
    .chart-card-header h3 { font-family:'Bebas Neue',sans-serif; font-size:1.1rem; letter-spacing:0.1em; color:var(--white); }
    .chart-card-header h3::before { content:'◆ '; color:var(--gold); font-size:0.7rem; }
    .chart-card-body { padding:1.4rem 1.6rem; }
    .chart-inner { position:relative; }
    .chart-inner.h300 { height:300px; }
    .chart-inner.h360 { height:360px; }
    .chart-inner.h280 { height:280px; }

    /* two-col chart layout */
    .charts-2col { display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; margin-bottom:2rem; }
    .charts-2col .chart-card { margin-bottom:0; }

    /* ── Grade breakdown table ── */
    .table-card { background:var(--white); border:1px solid var(--border); border-radius:12px; overflow:hidden; margin-bottom:2rem; animation:fadeUp 0.45s ease both; }
    .table-card-header { background:var(--black); border-bottom:2px solid var(--gold); padding:0.9rem 1.6rem; display:flex; align-items:center; justify-content:space-between; }
    .table-card-header span { font-family:'Bebas Neue',sans-serif; font-size:1.1rem; letter-spacing:0.1em; color:var(--white); display:flex; align-items:center; gap:8px; }
    .table-card-header span i { color:var(--gold); }
    .table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
    table.data-table { width:100%; border-collapse:collapse; font-size:13px; min-width:700px; }
    table.data-table thead tr.col-row th { background:#fafafa; color:#888; font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; padding:10px 14px; border-bottom:1px solid var(--border); text-align:left; white-space:nowrap; }
    table.data-table tbody tr { border-bottom:1px solid #f2f2ef; transition:background 0.15s; }
    table.data-table tbody tr:hover { background:#fafafa; }
    table.data-table tbody tr:last-child { border-bottom:none; }
    table.data-table tbody td { padding:10px 14px; color:#333; font-size:13px; vertical-align:middle; }
    table.data-table tfoot tr td { background:#fafafa; font-weight:700; padding:10px 14px; font-size:13px; border-top:2px solid var(--border); }

    /* debt badge */
    .debt-pill { display:inline-block; font-size:11px; font-weight:700; padding:2px 8px; border-radius:12px; }
    .debt-pill.none { background:var(--green-bg); color:var(--green); }
    .debt-pill.low  { background:var(--amber-bg); color:var(--amber); }
    .debt-pill.high { background:var(--red-bg);   color:var(--red); }

    /* progress bar mini */
    .mini-bar-wrap { background:#eee; border-radius:99px; height:7px; width:100px; display:inline-block; vertical-align:middle; margin-left:6px; overflow:hidden; }
    .mini-bar { height:100%; border-radius:99px; }
    .mini-bar.green { background:var(--green); }
    .mini-bar.amber { background:#d97706; }
    .mini-bar.red   { background:#dc2626; }

    /* performance award colours */
    .award-ee { background:var(--green-bg); color:var(--green); }
    .award-me { background:var(--blue-bg);  color:var(--blue); }
    .award-ae { background:var(--amber-bg); color:var(--amber); }
    .award-be { background:var(--red-bg);   color:var(--red); }
    .award-lbl { display:inline-block; font-size:10px; font-weight:700; padding:2px 6px; border-radius:4px; }

    /* ── Teachers table ── */
    .table-wrap { background:var(--white); border:1px solid var(--border); border-radius:12px; overflow:hidden; margin-bottom:2rem; }
    table.teachers-table { width:100%; border-collapse:collapse; font-size:13px; min-width:640px; }
    table.teachers-table thead tr.banner-row th { background:var(--black); color:var(--gold); font-family:'Bebas Neue',sans-serif; font-size:1.3rem; letter-spacing:0.14em; text-align:center; padding:1rem; border-bottom:2px solid var(--gold); }
    table.teachers-table thead tr.col-row th { background:#fafafa; color:#888; font-size:11px; font-weight:600; letter-spacing:0.07em; text-transform:uppercase; padding:10px 16px; border-bottom:1px solid var(--border); text-align:left; white-space:nowrap; }
    table.teachers-table tbody tr { border-bottom:1px solid #f2f2ef; transition:background 0.15s; }
    table.teachers-table tbody tr:hover { background:#fafafa; }
    table.teachers-table tbody td { padding:11px 16px; color:#333; font-size:13px; }

    /* ── Footer ── */
    .footer { text-align:center; padding:1.4rem 2rem; border-top:1px solid var(--border); font-size:11px; color:#bbb; letter-spacing:0.04em; }

    /* ── Animations ── */
    @keyframes fadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
    .stat-card:nth-child(1){animation-delay:0.05s}.stat-card:nth-child(2){animation-delay:0.14s}.stat-card:nth-child(3){animation-delay:0.23s}
    .finance-card:nth-child(1){animation-delay:0.08s}.finance-card:nth-child(2){animation-delay:0.18s}.finance-card:nth-child(3){animation-delay:0.28s}

    /* ── Responsive ── */
    @media(max-width:900px) {
      .sidebar{transform:translateX(-100%)}
      .sidebar.open{transform:translateX(0);box-shadow:8px 0 40px rgba(0,0,0,0.4)}
      .sidebar-close{display:flex} .main{margin-left:0} .menu-toggle{display:flex}
      .topbar-right{display:none} .content{padding:1.2rem}
      .charts-2col{grid-template-columns:1fr}
    }
    @media(max-width:520px) {
      .topbar{padding:0.8rem 1rem} .topbar h2{font-size:1.3rem}
      .content{padding:1rem} .section-head{font-size:1.5rem}
    }
  </style>
</head>
<body>

<?php
include('conn.php');

/* ══════════════════════════════════════════════
   DATA COLLECTION
══════════════════════════════════════════════ */

/* 1. Student & teacher counts */
$totalStudents = (int)(mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS c FROM Student"))['c'] ?? 0);
$totalTeachers = (int)(mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS c FROM Teachers"))['c'] ?? 0);

/* 2. Term finance totals */
function termFinance($conn, $term) {
    $r = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT COALESCE(SUM(Fee),0) AS fee,
                COALESCE(SUM(Assesment),0) AS assess,
                COALESCE(SUM(Activity),0) AS activity,
                COALESCE(SUM(Other),0) AS other
         FROM Fees WHERE Term=$term"));
    return $r;
}
$t1 = termFinance($conn, 1);
$t2 = termFinance($conn, 2);
$t3 = termFinance($conn, 3);
$grandTotal = ($t1['fee']+$t1['assess']+$t1['activity']+$t1['other'])
            + ($t2['fee']+$t2['assess']+$t2['activity']+$t2['other'])
            + ($t3['fee']+$t3['assess']+$t3['activity']+$t3['other']);

/* 3. Per-grade fee breakdown */
$gradeFeeSql = "SELECT Grade,
    COALESCE(SUM(Fee),0)       AS fee,
    COALESCE(SUM(Assesment),0) AS assess,
    COALESCE(SUM(Activity),0)  AS activity,
    COALESCE(SUM(Other),0)     AS other,
    COUNT(*)                   AS records
FROM Fees GROUP BY Grade ORDER BY Grade+0";
$gradeFeeRes = mysqli_query($conn, $gradeFeeSql);
$gradeData = [];
while ($row = mysqli_fetch_assoc($gradeFeeRes)) $gradeData[] = $row;

/* 4. Grade student counts */
$gradeStudentRes = mysqli_query($conn, "SELECT Grade, COUNT(*) AS cnt FROM Student GROUP BY Grade ORDER BY Grade+0");
$gradeStudents = [];
while ($r = mysqli_fetch_assoc($gradeStudentRes)) $gradeStudents[$r['Grade']] = (int)$r['cnt'];

/* 5. Debt: estimate expected fee vs collected per grade
   We treat the average fee record amount × student count as "expected".
   Debt = (students × avg per-student fee paid by those who paid) - total paid
   Simpler: debt = 0 if every student has a record, else flag missing records.
   We compare: enrolled students vs students with at least one fee record.
*/
$gradeFeePaidRes = mysqli_query($conn,
    "SELECT Grade, COUNT(DISTINCT Assesment) AS paid_students,
            COALESCE(SUM(Fee+Assesment+Activity+Other),0) AS total_paid
     FROM Fees GROUP BY Grade ORDER BY Grade+0");
$gradeFeePaid = [];
while ($r = mysqli_fetch_assoc($gradeFeePaidRes)) $gradeFeePaid[$r['Grade']] = $r;

/* 6. Performance data – mean per grade per exam */
$perfRes = mysqli_query($conn,
    "SELECT grade, term, exam_type, year,
            AVG(math+eng+kisw+sst+scie+ca+agri+re+pretec) AS total_mean,
            (AVG(math)+AVG(eng)+AVG(kisw)+AVG(sst)+AVG(scie)+AVG(ca)+AVG(agri)+AVG(`re`)+AVG(pretec))/9 AS subject_mean
     FROM exam2
     GROUP BY grade, term, exam_type, year
     ORDER BY year, grade+0, term, exam_type");
$perfRows = [];
while ($r = mysqli_fetch_assoc($perfRes)) $perfRows[] = $r;

/* Performance per grade (latest exam mean) */
$latestGradePerf = [];
foreach ($perfRows as $p) {
    $g = $p['grade'];
    $latestGradePerf[$g] = $p; // last one wins (highest year/term)
}

/* For timeline chart: all exams × grades */
$timelineLabels = [];
$timelineByGrade = [];
foreach ($perfRows as $p) {
    $lbl = "G{$p['grade']} T{$p['term']} {$p['exam_type']} {$p['year']}";
    $g   = 'Grade '.$p['grade'];
    if (!in_array($lbl,$timelineLabels)) $timelineLabels[] = $lbl;
    $timelineByGrade[$g][] = ['label'=>$lbl, 'mean'=>round((float)$p['subject_mean'],1)];
}

/* Grade-level mean (latest) for bar chart */
$gradePerfLabels = [];
$gradePerfMeans  = [];
for ($g=1;$g<=9;$g++) {
    $gradePerfLabels[] = "Grade $g";
    $gradePerfMeans[]  = isset($latestGradePerf[$g]) ? round((float)$latestGradePerf[$g]['subject_mean'],1) : 0;
}

/* Fee chart data per grade */
$chartGrades=[]; $chartFees=[]; $chartAssess=[]; $chartAct=[]; $chartOther=[];
foreach ($gradeData as $gd) {
    $chartGrades[] = "Grade {$gd['Grade']}";
    $chartFees[]   = (float)$gd['fee'];
    $chartAssess[] = (float)$gd['assess'];
    $chartAct[]    = (float)$gd['activity'];
    $chartOther[]  = (float)$gd['other'];
}

/* Band distribution across all students (latest exam) */
$bandCounts = ['ee'=>0,'me'=>0,'ae'=>0,'be'=>0];
$bandRes = mysqli_query($conn,
    "SELECT (math+eng+kisw+sst+scie+ca+agri+re+pretec)/9 AS avg_score FROM exam2");
while ($b = mysqli_fetch_assoc($bandRes)) {
    $s = (float)$b['avg_score'];
    if ($s>74) $bandCounts['ee']++;
    elseif ($s>49) $bandCounts['me']++;
    elseif ($s>25) $bandCounts['ae']++;
    else $bandCounts['be']++;
}

/* Teachers */
$teachersRes = mysqli_query($conn,"SELECT * FROM Teachers");
?>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- ░░ SIDEBAR ░░ -->
<aside class="sidebar" id="sidebar">
  <button class="sidebar-close" onclick="closeSidebar()"><i class="fa-solid fa-xmark"></i></button>
  <div class="sidebar-brand">
    <div class="brand-icon"><i class="fa-solid fa-graduation-cap"></i></div>
    <div class="brand-text">
      <span>Kanja School</span>
      <span>Management System</span>
    </div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-label">Main</div>
    <a href="Hoi.php" class="active"><i class="fa-solid fa-house"></i> Home</a>
    <a href="Students.php"><i class="fa-solid fa-user-graduate"></i> Students</a>
    <a href="Progress.php"><i class="fa-solid fa-chart-line"></i> Progress Records</a>
    <div class="nav-label">Administration</div>
    <a href="RegisterStudent.php"><i class="fa-solid fa-user-plus"></i> Register Learners</a>
        <a href="attendance.php"><i class="fa-solid fa-user-plus"></i> Learners attendance</a>
    <a href="RegisterTeacher.php"><i class="fa-solid fa-user-plus"></i> Register Teachers</a>
       <a href="notice.php"><i class="fa-solid fa-bullseye"></i> Notices</a>
    <div class="nav-label">Academics</div>
    <a href="ViewResults.php"><i class="fa-solid fa-chart-pie"></i> Results</a>
      <a href="Timetable.php"><i class="fa-solid fa-chart-pie"></i>TimeTable</a>
    <a href="UploadResults.php"><i class="fa-solid fa-upload"></i> Upload Results</a>
     <a href="LearningMaterials.php"><i class="fa-solid fa-upload"></i>Learning Materials</a>
    <a href="track.php"><i class="fa-solid fa-bullseye"></i> Track Performance</a>
    <a href="settings.php"><i class="fa-solid fa-gear"></i></i> Settings</a>
    <div class="nav-label">Finance</div>
    <a href="Fee.php"><i class="fa-solid fa-coins"></i> Finances(Pay)</a>
     <a href="viewFees.php"><i class="fa-solid fa-coins"></i> Track Fees</a>
  </nav>
  <div class="sidebar-footer">© 2026 Kelvin Mutinda</div>
</aside>

<!-- ░░ MAIN ░░ -->
<div class="main" id="main">

  <header class="topbar">
    <div class="topbar-left">
      <button class="menu-toggle" onclick="openSidebar()"><i class="fa-solid fa-bars"></i></button>
      <h2>Stephen Kanja <span>School</span></h2>
    </div>
    <div class="topbar-right"><i class="fa-solid fa-circle-dot"></i> Dashboard Live</div>
  </header>

  <div class="content">

    <!-- ══════════ SECTION 1: OVERVIEW KPIs ══════════ -->
    <h1 class="section-head">School Dashboard</h1>
    <div class="stat-grid">
      <div class="stat-card">
        <div class="card-icon"><i class="fa-solid fa-user-graduate"></i></div>
        <div class="big-num"><?= $totalStudents ?></div>
        <h3>No. of Learners</h3>
        <p>Active learners in the institution</p>
      </div>
      <div class="stat-card">
        <div class="card-icon"><i class="fa-solid fa-chalkboard-teacher"></i></div>
        <div class="big-num"><?= $totalTeachers ?></div>
        <h3>No. of Teachers</h3>
        <p>Available number of teachers</p>
      </div>
      <div class="stat-card">
        <div class="card-icon"><i class="fa-solid fa-door-open"></i></div>
        <div class="big-num">9</div>
        <h3>Classes</h3>
        <p>Total number of enrolled classes</p>
      </div>
      <div class="stat-card" style="border-top-color:var(--green)">
        <div class="card-icon" style="background:var(--green)"><i class="fa-solid fa-coins" style="color:#fff"></i></div>
        <div class="big-num" style="font-size:2rem">KES <?= number_format($grandTotal) ?></div>
        <h3>Total Revenue</h3>
        <p>All terms combined fee collection</p>
      </div>
    </div>

    <!-- ══════════ SECTION 2: FINANCES ══════════ -->
    <h1 class="section-head mt">Finances — Term Summaries</h1>
    <div class="finance-grid">
      <?php
      function renderTermCard2($term, $data, $label) {
          $total = $data['fee']+$data['assess']+$data['activity']+$data['other'];
          echo "<div class='finance-card'>
            <h3>$label <span class='term-badge'>T$term</span></h3>
            <div class='fin-rows'>
              <div class='fin-row'><span class='lbl'>School Fee</span><span class='val'>".number_format((float)$data['fee'],2)."</span></div>
              <div class='fin-row'><span class='lbl'>Assessment</span><span class='val'>".number_format((float)$data['assess'],2)."</span></div>
              <div class='fin-row'><span class='lbl'>Activity</span><span class='val'>".number_format((float)$data['activity'],2)."</span></div>
              <div class='fin-row'><span class='lbl'>Other</span><span class='val'>".number_format((float)$data['other'],2)."</span></div>
              <div class='fin-row'><span class='lbl'>Total</span><span class='val green'>".number_format($total,2)."</span></div>
            </div></div>";
      }
      renderTermCard2(1,$t1,'Term 1 Totals');
      renderTermCard2(2,$t2,'Term 2 Totals');
      renderTermCard2(3,$t3,'Term 3 Totals');
      ?>
    </div>

    <!-- Fee collection by grade chart -->
    <div class="chart-card">
      <div class="chart-card-header"><h3>Fee Collection by Grade — All Categories</h3></div>
      <div class="chart-card-body"><div class="chart-inner h360"><canvas id="gradeFeesChart"></canvas></div></div>
    </div>

    <!-- ══════════ SECTION 3: GRADE BREAKDOWN + DEBT ══════════ -->
    <h1 class="section-head mt">Grade-by-Grade Fee Breakdown &amp; Debt Analysis</h1>

    <div class="table-card">
      <div class="table-card-header">
        <span><i class="fa-solid fa-table"></i> Fee Collection Per Grade</span>
      </div>
      <div class="table-scroll">
        <table class="data-table">
          <thead>
            <tr class="col-row">
              <th>Grade</th>
              <th>Students Enrolled</th>
              <th>Students with Records</th>
              <th>School Fees (KES)</th>
              <th>Assessment (KES)</th>
              <th>Activity (KES)</th>
              <th>Other (KES)</th>
              <th>Grade Total (KES)</th>
              <th>Coverage</th>
              <th>Debt Status</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $grandFee=0; $grandAssess=0; $grandAct=0; $grandOther=0; $grandGTotal=0;
          for ($g=1;$g<=9;$g++) {
              $enrolled = $gradeStudents[$g] ?? 0;
              $paid     = $gradeFeePaid[$g]['paid_students'] ?? 0;
              $gTotal   = 0; $fee=$assess=$act=$other=0;
              foreach ($gradeData as $gd) {
                  if ((int)$gd['Grade'] === $g) {
                      $fee=$gd['fee']; $assess=$gd['assess']; $act=$gd['activity']; $other=$gd['other'];
                      $gTotal = $fee+$assess+$act+$other;
                  }
              }
              $grandFee+=$fee; $grandAssess+=$assess; $grandAct+=$act; $grandOther+=$other; $grandGTotal+=$gTotal;
              $coverage = $enrolled > 0 ? round($paid/$enrolled*100) : 0;
              $missing  = max(0, $enrolled - $paid);
              if ($coverage >= 90) { $debtClass='none'; $debtLabel='Low Risk'; }
              elseif ($coverage >= 60) { $debtClass='low'; $debtLabel='Moderate'; }
              else { $debtClass='high'; $debtLabel='High Risk'; }
              $barClass = $coverage>=90?'green':($coverage>=60?'amber':'red');
              echo "<tr>
                <td><strong>Grade $g</strong></td>
                <td>$enrolled</td>
                <td>$paid</td>
                <td>".number_format((float)$fee)."</td>
                <td>".number_format((float)$assess)."</td>
                <td>".number_format((float)$act)."</td>
                <td>".number_format((float)$other)."</td>
                <td><strong>".number_format($gTotal)."</strong></td>
                <td>
                  <span style='font-size:12px;font-weight:600'>$coverage%</span>
                  <span class='mini-bar-wrap'><span class='mini-bar $barClass' style='width:{$coverage}%'></span></span>
                  <br><small style='color:#aaa;font-size:10px'>$missing unpaid</small>
                </td>
                <td><span class='debt-pill $debtClass'>$debtLabel</span></td>
              </tr>";
          }
          ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"><strong>TOTALS</strong></td>
              <td><?= number_format($grandFee) ?></td>
              <td><?= number_format($grandAssess) ?></td>
              <td><?= number_format($grandAct) ?></td>
              <td><?= number_format($grandOther) ?></td>
              <td><strong><?= number_format($grandGTotal) ?></strong></td>
              <td colspan="2"></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <!-- Debt/coverage chart -->
    <div class="charts-2col">
      <div class="chart-card">
        <div class="chart-card-header"><h3>Fee Coverage % by Grade</h3></div>
        <div class="chart-card-body"><div class="chart-inner h280"><canvas id="coverageChart"></canvas></div></div>
      </div>
      <div class="chart-card">
        <div class="chart-card-header"><h3>Uncollected (Unpaid Student Records) by Grade</h3></div>
        <div class="chart-card-body"><div class="chart-inner h280"><canvas id="debtChart"></canvas></div></div>
      </div>
    </div>

    <!-- ══════════ SECTION 4: ACADEMIC PERFORMANCE ══════════ -->
    <h1 class="section-head mt">Academic Performance Analysis</h1>

    <!-- Grade vs mean bar -->
    <div class="chart-card">
      <div class="chart-card-header"><h3>Latest Exam — Average Subject Score by Grade</h3></div>
      <div class="chart-card-body"><div class="chart-inner h300"><canvas id="gradePerfChart"></canvas></div></div>
    </div>

    <!-- Class-wide band distribution doughnut + per-grade mini table -->
    <div class="charts-2col">
      <div class="chart-card">
        <div class="chart-card-header"><h3>Overall Student Achievement Bands (All Exams)</h3></div>
        <div class="chart-card-body"><div class="chart-inner h280"><canvas id="bandChart"></canvas></div></div>
      </div>
      <div class="chart-card">
        <div class="chart-card-header"><h3>Latest Exam Performance per Grade</h3></div>
        <div class="chart-card-body" style="overflow-x:auto">
          <table class="data-table" style="min-width:unset;font-size:12px">
            <thead>
              <tr class="col-row">
                <th>Grade</th><th>Mean /100</th><th>Band</th>
              </tr>
            </thead>
            <tbody>
              <?php
              for ($g=1;$g<=9;$g++) {
                  $mean = isset($latestGradePerf[$g]) ? round((float)$latestGradePerf[$g]['subject_mean'],1) : null;
                  if ($mean === null) { echo "<tr><td>Grade $g</td><td>—</td><td>—</td></tr>"; continue; }
                  if ($mean>74) { $bc='award-ee'; $bl='E.E'; }
                  elseif ($mean>49) { $bc='award-me'; $bl='M.E'; }
                  elseif ($mean>25) { $bc='award-ae'; $bl='A.E'; }
                  else { $bc='award-be'; $bl='B.E'; }
                  echo "<tr>
                    <td><strong>Grade $g</strong></td>
                    <td>$mean</td>
                    <td><span class='award-lbl $bc'>$bl</span></td>
                  </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Timeline line chart: all exams across time per grade -->
    <?php if (count($perfRows) > 0): ?>
    <div class="chart-card">
      <div class="chart-card-header"><h3>Grade Performance Timeline — All Exams</h3></div>
      <div class="chart-card-body"><div class="chart-inner h360"><canvas id="timelineChart"></canvas></div></div>
    </div>

    <!-- Detailed performance table: every exam every grade -->
    <div class="table-card">
      <div class="table-card-header"><span><i class="fa-solid fa-list-check"></i> All Exam Results Summary</span></div>
      <div class="table-scroll">
        <table class="data-table">
          <thead>
            <tr class="col-row">
              <th>Grade</th><th>Term</th><th>Exam Type</th><th>Year</th>
              <th>Avg Total /900</th><th>Avg /100 (Subject)</th><th>Band</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($perfRows as $p) {
                $mean = round((float)$p['subject_mean'],1);
                $tot  = round((float)$p['total_mean'],1);
                if ($mean>74) { $bc='award-ee'; $bl='E.E'; }
                elseif ($mean>49) { $bc='award-me'; $bl='M.E'; }
                elseif ($mean>25) { $bc='award-ae'; $bl='A.E'; }
                else { $bc='award-be'; $bl='B.E'; }
                $examDisp = ['opener'=>'Opener','midterm'=>'Mid-Term','endterm'=>'End Term'][$p['exam_type']] ?? $p['exam_type'];
                echo "<tr>
                  <td><strong>Grade {$p['grade']}</strong></td>
                  <td>Term {$p['term']}</td>
                  <td>$examDisp</td>
                  <td>{$p['year']}</td>
                  <td>$tot</td>
                  <td>$mean</td>
                  <td><span class='award-lbl $bc'>$bl</span></td>
                </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif; ?>

    <!-- ══════════ SECTION 5: TEACHING STAFF ══════════ -->
    <h1 class="section-head mt">Teaching Staff</h1>
    <div class="table-wrap">
      <div class="table-scroll">
        <table class="teachers-table">
          <thead>
            <tr class="banner-row"><th colspan="7">Our Esteemed Teaching Staff</th></tr>
            <tr class="col-row">
              <th>Name</th><th>Email</th><th>Phone</th><th>TSC No</th><th>Role</th><th>Class Teacher</th><th>Subject</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($teachersRes)): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['phoneNo']) ?></td>
              <td><?= htmlspecialchars($row['TscNo']) ?></td>
              <td><?= htmlspecialchars($row['role']) ?></td>
              <td><?= htmlspecialchars($row['classTeacher']) ?></td>
              <td><?= htmlspecialchars($row['subject']) ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div><!-- .content -->

  <div class="footer">&copy; Designed by Kelvin Mutinda 2026. All rights reserved.</div>
</div><!-- .main -->

<!-- ══════════ CHARTS JS ══════════ -->
<script>
(function() {
  Chart.defaults.font.family = "'DM Sans', sans-serif";
  Chart.defaults.color = '#888';

  const GOLD   = '#f0c040';
  const BLACK  = '#111111';
  const GREEN  = '#16a34a';
  const BLUE   = '#1a4a7a';
  const RED    = '#991b1b';
  const AMBER  = '#92400e';

  const gradeLabels = <?= json_encode($chartGrades) ?>;
  const fees        = <?= json_encode($chartFees, JSON_NUMERIC_CHECK) ?>;
  const assess      = <?= json_encode($chartAssess, JSON_NUMERIC_CHECK) ?>;
  const activity    = <?= json_encode($chartAct, JSON_NUMERIC_CHECK) ?>;
  const other       = <?= json_encode($chartOther, JSON_NUMERIC_CHECK) ?>;

  /* ── 1. Grade Fees Stacked Bar ── */
  new Chart(document.getElementById('gradeFeesChart'), {
    type: 'bar',
    data: {
      labels: gradeLabels,
      datasets: [
        { label:'School Fee',  data:fees,    backgroundColor:'rgba(240,192,64,0.85)',  borderRadius:0 },
        { label:'Assessment',  data:assess,  backgroundColor:'rgba(26,74,122,0.75)',   borderRadius:0 },
        { label:'Activity',    data:activity,backgroundColor:'rgba(22,163,74,0.75)',   borderRadius:0 },
        { label:'Other',       data:other,   backgroundColor:'rgba(100,100,100,0.6)', borderRadius:{topLeft:4,topRight:4} }
      ]
    },
    options: {
      responsive:true, maintainAspectRatio:false,
      plugins:{
        legend:{position:'bottom',labels:{padding:16,boxWidth:12,borderRadius:4}},
        tooltip:{callbacks:{label:ctx=>' KES '+ctx.raw.toLocaleString()}}
      },
      scales:{
        x:{stacked:true,grid:{display:false}},
        y:{stacked:true,grid:{color:'rgba(0,0,0,0.05)'},ticks:{callback:v=>'KES '+v.toLocaleString()}}
      }
    }
  });

  /* ── 2. Coverage % by Grade ── */
  <?php
  $covData = []; $debtData = [];
  for ($g=1;$g<=9;$g++) {
      $enrolled = $gradeStudents[$g] ?? 0;
      $paid     = $gradeFeePaid[$g]['paid_students'] ?? 0;
      $covData[] = $enrolled > 0 ? round($paid/$enrolled*100) : 0;
      $debtData[] = max(0, $enrolled-$paid);
  }
  ?>
  const coverageData = <?= json_encode($covData) ?>;
  const debtData     = <?= json_encode($debtData) ?>;
  const gradeAllLabels = ['Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6','Grade 7','Grade 8','Grade 9'];

  new Chart(document.getElementById('coverageChart'), {
    type:'bar',
    data:{
      labels:gradeAllLabels,
      datasets:[{
        label:'Coverage %',
        data:coverageData,
        backgroundColor:coverageData.map(v=>v>=90?'rgba(22,163,74,0.8)':v>=60?'rgba(217,119,6,0.8)':'rgba(153,27,27,0.8)'),
        borderRadius:6, borderSkipped:false
      }]
    },
    options:{
      responsive:true,maintainAspectRatio:false,
      plugins:{legend:{display:false},tooltip:{callbacks:{label:ctx=>` ${ctx.raw}% coverage`}}},
      scales:{
        x:{grid:{display:false}},
        y:{min:0,max:100,grid:{color:'rgba(0,0,0,0.05)'},ticks:{callback:v=>v+'%'}}
      }
    }
  });

  new Chart(document.getElementById('debtChart'), {
    type:'bar',
    data:{
      labels:gradeAllLabels,
      datasets:[{
        label:'Students Without Records',
        data:debtData,
        backgroundColor:debtData.map(v=>v===0?'rgba(22,163,74,0.7)':v<5?'rgba(217,119,6,0.8)':'rgba(153,27,27,0.8)'),
        borderRadius:6, borderSkipped:false
      }]
    },
    options:{
      responsive:true,maintainAspectRatio:false,
      plugins:{legend:{display:false},tooltip:{callbacks:{label:ctx=>` ${ctx.raw} students without fee records`}}},
      scales:{x:{grid:{display:false}},y:{grid:{color:'rgba(0,0,0,0.05)'},ticks:{stepSize:1}}}
    }
  });

  /* ── 3. Grade Performance Bar ── */
  const gradePerfMeans = <?= json_encode($gradePerfMeans, JSON_NUMERIC_CHECK) ?>;
  new Chart(document.getElementById('gradePerfChart'), {
    type:'bar',
    data:{
      labels:gradeAllLabels,
      datasets:[{
        label:'Avg Subject Score',
        data:gradePerfMeans,
        backgroundColor:gradePerfMeans.map(v=>
          v>74?'rgba(22,163,74,0.8)':v>49?'rgba(26,74,122,0.8)':v>25?'rgba(217,119,6,0.8)':'rgba(153,27,27,0.8)'
        ),
        borderRadius:6, borderSkipped:false
      }]
    },
    options:{
      responsive:true,maintainAspectRatio:false,
      plugins:{
        legend:{display:false},
        tooltip:{callbacks:{afterLabel:ctx=>{
          const v=ctx.raw;
          return v>74?'Exceeding Expectations':v>49?'Meeting Expectations':v>25?'Approaching Expectations':'Below Expectations';
        }}}
      },
      scales:{
        x:{grid:{display:false}},
        y:{min:0,max:100,grid:{color:'rgba(0,0,0,0.05)'},ticks:{callback:v=>v+'/100'}}
      }
    }
  });

  /* ── 4. Band Doughnut ── */
  const bandData = <?= json_encode(array_values($bandCounts)) ?>;
  new Chart(document.getElementById('bandChart'), {
    type:'doughnut',
    data:{
      labels:['Exceeding (E.E)','Meeting (M.E)','Approaching (A.E)','Below (B.E)'],
      datasets:[{
        data:bandData,
        backgroundColor:['rgba(22,163,74,0.8)','rgba(26,74,122,0.8)','rgba(217,119,6,0.8)','rgba(153,27,27,0.8)'],
        borderWidth:2, borderColor:'#fff', hoverOffset:8
      }]
    },
    options:{
      responsive:true,maintainAspectRatio:false,cutout:'60%',
      plugins:{legend:{position:'bottom',labels:{padding:14,boxWidth:12,borderRadius:4}}}
    }
  });

  /* ── 5. Timeline Line Chart ── */
  <?php
  $timelineJs = [];
  $allLabels   = [];
  // collect all unique exam labels in order
  foreach ($perfRows as $p) {
      $lbl = "T{$p['term']} ".ucfirst($p['exam_type'])." {$p['year']}";
      if (!in_array($lbl,$allLabels)) $allLabels[] = $lbl;
  }
  // per grade dataset
  $gradeDatasets = [];
  $colors = ['#f0c040','#1a4a7a','#16a34a','#991b1b','#92400e','#6366f1','#0891b2','#7c3aed','#be185d'];
  for ($g=1;$g<=9;$g++) {
      $pts = [];
      foreach ($allLabels as $lbl) {
          $found = null;
          foreach ($perfRows as $p) {
              $plbl = "T{$p['term']} ".ucfirst($p['exam_type'])." {$p['year']}";
              if ((int)$p['grade']===$g && $plbl===$lbl) { $found = round((float)$p['subject_mean'],1); break; }
          }
          $pts[] = $found;
      }
      // skip if all null
      if (array_filter($pts,fn($v)=>$v!==null)) {
          $gradeDatasets[] = [
              'label'           => "Grade $g",
              'data'            => $pts,
              'borderColor'     => $colors[$g-1],
              'backgroundColor' => 'transparent',
              'borderWidth'     => 2,
              'pointRadius'     => 4,
              'tension'         => 0.35,
              'spanGaps'        => true
          ];
      }
  }
  ?>
  <?php if (count($perfRows) > 0): ?>
  new Chart(document.getElementById('timelineChart'), {
    type:'line',
    data:{
      labels: <?= json_encode($allLabels) ?>,
      datasets: <?= json_encode($gradeDatasets) ?>
    },
    options:{
      responsive:true,maintainAspectRatio:false,
      plugins:{
        legend:{position:'bottom',labels:{padding:14,boxWidth:12,borderRadius:4,usePointStyle:true}},
        tooltip:{mode:'index',intersect:false}
      },
      scales:{
        x:{grid:{color:'rgba(0,0,0,0.04)'},ticks:{maxRotation:45,minRotation:30}},
        y:{min:0,max:100,grid:{color:'rgba(0,0,0,0.05)'},ticks:{callback:v=>v+'/100'},
           title:{display:true,text:'Avg Subject Score'}}
      }
    }
  });
  <?php endif; ?>

})();
</script>

<script>
  function openSidebar() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('overlay').classList.add('active');
    document.body.style.overflow='hidden';
  }
  function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('active');
    document.body.style.overflow='';
  }
  document.addEventListener('keydown',e=>{ if(e.key==='Escape') closeSidebar(); });
</script>

</body>
</html>