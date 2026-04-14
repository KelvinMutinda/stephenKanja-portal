<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Results — Stephen Kanja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink:       #0f1923;
            --ink-soft:  #3d4f5c;
            --ink-mute:  #7a909e;
            --paper:     #f5f2ee;
            --cream:     #faf8f5;
            --white:     #ffffff;
            --gold:      #c8992a;
            --gold-pale: #f5e9c8;
            --blue:      #1a4a7a;
            --blue-pale: #dce8f5;
            --border:    rgba(15,25,35,0.1);
            --shadow:    0 4px 24px rgba(15,25,35,0.08);
            --shadow-lg: 0 12px 48px rgba(15,25,35,0.14);
            --ee: #16a34a; --ee-bg: #dcfce7;
            --me: #1a4a7a; --me-bg: #dce8f5;
            --ae: #92400e; --ae-bg: #fef3c7;
            --be: #991b1b; --be-bg: #fee2e2;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--paper);
            color: var(--ink);
            min-height: 100vh;
            font-size: 15px;
            line-height: 1.6;
        }

        /* ══════ HEADER ══════ */
        .page-header {
            background: var(--ink);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 10% 50%, rgba(200,153,42,0.18) 0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at 90% 20%, rgba(26,74,122,0.25) 0%, transparent 60%);
            pointer-events: none;
        }
        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 32px 40px;
            position: relative;
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .header-crest {
            width: 68px; height: 68px;
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 28px;
            box-shadow: 0 0 0 4px rgba(200,153,42,0.25);
        }
        .header-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 900;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }
        .header-text .subtitle {
            margin-top: 6px;
            font-size: 0.82rem;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            letter-spacing: 2.5px;
            text-transform: uppercase;
        }
        .header-rule {
            height: 3px;
            background: linear-gradient(90deg, var(--gold) 0%, transparent 100%);
        }

        /* ══════ MAIN WRAPPER ══════ */
        .results {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 24px 80px;
        }

        /* ══════ FILTER FORM ══════ */
        .filter-form {
            background: var(--white);
            border-radius: 16px;
            padding: 32px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            margin-bottom: 36px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px 16px;
            align-items: end;
        }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--ink-mute);
        }
        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            background: var(--cream) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237a909e' stroke-width='1.8' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 14px center;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 11px 38px 11px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--ink);
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s;
            width: 100%;
        }
        .form-group select:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 3px var(--blue-pale);
        }
        .btn-view {
            background: var(--ink);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 12px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
            height: 44px;
        }
        .btn-view:hover { background: var(--blue); box-shadow: 0 6px 20px rgba(26,74,122,0.3); transform: translateY(-1px); }
        .btn-view:active { transform: translateY(0); }

        /* ══════ SECTION LABEL ══════ */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 36px 0 20px;
        }
        .section-divider h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.1rem, 2.2vw, 1.45rem);
            font-weight: 700;
            white-space: nowrap;
            color: var(--ink);
        }
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }
        .section-badge {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            background: var(--ink);
            color: var(--gold);
            padding: 3px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        /* ══════ KPI STRIP ══════ */
        .kpi-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 28px;
        }
        .kpi-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px 18px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            animation: fadeUp 0.4s ease both;
        }
        .kpi-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }
        .kpi-card.kpi-total::before { background: var(--ink); }
        .kpi-card.kpi-ee::before    { background: var(--ee); }
        .kpi-card.kpi-me::before    { background: var(--me); }
        .kpi-card.kpi-below::before { background: var(--be); }
        .kpi-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--ink-mute);
            margin-bottom: 8px;
        }
        .kpi-val {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            font-weight: 900;
            line-height: 1;
            color: var(--ink);
        }
        .kpi-sub { font-size: 0.78rem; color: var(--ink-mute); margin-top: 6px; }

        /* ══════ PERFORMANCE BANDS ══════ */
        .bands-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }
        .band-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: var(--shadow);
            animation: fadeUp 0.4s 0.1s ease both;
        }
        .band-card h3 {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--ink-mute);
            margin-bottom: 18px;
        }
        .band-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }
        .band-label {
            font-size: 0.75rem;
            font-weight: 600;
            width: 110px;
            flex-shrink: 0;
        }
        .band-bar-wrap {
            flex: 1;
            background: var(--paper);
            border-radius: 99px;
            height: 10px;
            overflow: hidden;
        }
        .band-bar {
            height: 100%;
            border-radius: 99px;
            transition: width 1s cubic-bezier(0.4,0,0.2,1);
        }
        .band-count {
            font-size: 0.78rem;
            font-weight: 700;
            width: 70px;
            text-align: right;
            color: var(--ink-soft);
            flex-shrink: 0;
        }
        .band-ee { background: var(--ee); }
        .band-me { background: var(--me); }
        .band-ae { background: #d97706; }
        .band-be { background: var(--be); }

        /* ══════ CHART GRID ══════ */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }
        .chart-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: var(--shadow);
            animation: fadeUp 0.4s 0.15s ease both;
        }
        .chart-card.full-width { grid-column: 1 / -1; }
        .chart-card h3 {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--ink-mute);
            margin-bottom: 18px;
        }
        .chart-wrap { position: relative; height: 260px; }
        .chart-wrap.tall { height: 320px; }

        /* ══════ COMPARISON CARD ══════ */
        .compare-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: var(--shadow);
            margin-bottom: 28px;
            animation: fadeUp 0.4s 0.2s ease both;
        }
        .compare-card h3 {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--ink-mute);
            margin-bottom: 18px;
        }
        .compare-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }
        .compare-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--ink-soft);
        }
        .compare-pill-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .no-prev {
            text-align: center;
            padding: 28px;
            color: var(--ink-mute);
            font-size: 0.88rem;
            background: var(--paper);
            border-radius: 10px;
        }

        /* ══════ SUBJECT MEANS TABLE ══════ */
        .means-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: var(--shadow);
            margin-bottom: 28px;
            overflow-x: auto;
            animation: fadeUp 0.4s 0.22s ease both;
        }
        .means-card h3 {
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--ink-mute);
            margin-bottom: 18px;
        }
        .means-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            min-width: 700px;
        }
        .means-table th {
            background: var(--ink);
            color: rgba(255,255,255,0.7);
            padding: 10px 14px;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .means-table td {
            padding: 10px 14px;
            border-bottom: 1px solid rgba(15,25,35,0.06);
            color: var(--ink-soft);
        }
        .means-table tr:last-child td { border-bottom: none; }
        .means-table tr:hover td { background: #f0f6ff; }
        .means-table .mean-val { font-weight: 700; color: var(--ink); }
        .means-table .trend-up   { color: var(--ee); font-weight: 700; }
        .means-table .trend-down { color: var(--be); font-weight: 700; }
        .means-table .trend-same { color: var(--ink-mute); }

        /* ══════ RESULTS TABLE ══════ */
        .table-scroll {
            overflow-x: auto;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            -webkit-overflow-scrolling: touch;
            animation: fadeUp 0.4s 0.25s ease both;
        }
        .results-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
            background: var(--white);
            font-size: 0.875rem;
        }
        .results-table thead tr { background: var(--ink); color: var(--white); }
        .results-table thead th {
            padding: 14px;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .results-table thead th:first-child { padding-left: 20px; }
        .results-table thead th:last-child  { padding-right: 20px; }
        .results-table tbody tr {
            border-bottom: 1px solid rgba(15,25,35,0.06);
            transition: background 0.15s;
        }
        .results-table tbody tr:hover { background: #f0f6ff; }
        .results-table tbody tr:last-child { border-bottom: none; }
        .results-table td {
            padding: 11px 14px;
            color: var(--ink-soft);
            white-space: nowrap;
        }
        .results-table td:first-child { padding-left: 20px; }
        .results-table td:last-child  { padding-right: 20px; font-weight: 700; color: var(--ink); }

        .rank-badge {
            display: inline-flex;
            align-items: center; justify-content: center;
            width: 30px; height: 30px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 0.8rem;
            background: var(--blue-pale);
            color: var(--blue);
        }
        .rank-badge.gold   { background: var(--gold-pale); color: #7a5a10; }
        .rank-badge.silver { background: #e8e8f0; color: #4a4a6a; }
        .rank-badge.bronze { background: #f0e6d8; color: #7a4a2a; }

        .mean-row { background: var(--ink) !important; }
        .mean-row td { color: rgba(255,255,255,0.85) !important; padding-top: 14px !important; padding-bottom: 14px !important; font-weight: 600; }
        .mean-row td:first-child { color: var(--white) !important; font-size: 0.72rem; letter-spacing: 1.5px; text-transform: uppercase; }

        .award, .mean-award {
            display: inline-block;
            font-size: 0.6rem;
            font-weight: 700;
            padding: 2px 5px;
            border-radius: 4px;
            letter-spacing: 0.4px;
            vertical-align: middle;
            margin-left: 3px;
        }
        .award.ee, .mean-award.excellent { background: var(--ee-bg); color: var(--ee); }
        .award.me, .mean-award.merit     { background: var(--me-bg); color: var(--me); }
        .award.ae, .mean-award.average   { background: var(--ae-bg); color: var(--ae); }
        .award.be, .mean-award.below     { background: var(--be-bg); color: var(--be); }
        .mean-row .mean-award.excellent  { background: rgba(22,163,74,0.35); color: #86efac; }
        .mean-row .mean-award.merit      { background: rgba(26,74,122,0.4); color: #a0ccf5; }
        .mean-row .mean-award.average    { background: rgba(200,153,42,0.35); color: #f5d88a; }
        .mean-row .mean-award.below      { background: rgba(153,27,27,0.35); color: #fca5a5; }

        /* ══════ MESSAGES ══════ */
        .no-results {
            background: var(--white);
            border: 1.5px dashed var(--border);
            border-radius: 14px;
            padding: 48px 32px;
            text-align: center;
            color: var(--ink-mute);
            font-size: 0.95rem;
            line-height: 2;
        }
        .no-results::before { content: '📋'; display: block; font-size: 2rem; margin-bottom: 12px; }

        .scroll-hint { display: none; font-size: 0.76rem; color: var(--ink-mute); text-align: right; margin-bottom: 8px; }

        /* ══════ ANIMATION ══════ */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ══════ RESPONSIVE ══════ */
        @media (max-width: 900px) {
            .kpi-strip      { grid-template-columns: repeat(2, 1fr); }
            .bands-grid     { grid-template-columns: 1fr; }
            .charts-grid    { grid-template-columns: 1fr; }
            .charts-grid .chart-card.full-width { grid-column: 1; }
        }
        @media (max-width: 700px) {
            .header-inner  { padding: 28px 18px 24px; gap: 14px; }
            .header-crest  { width: 48px; height: 48px; font-size: 20px; }
            .filter-form   { grid-template-columns: 1fr 1fr; padding: 20px 16px; gap: 14px 10px; }
            .btn-view      { grid-column: 1 / -1; }
            .results       { padding: 20px 14px 60px; }
            .scroll-hint   { display: block; }
            .kpi-strip     { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 420px) {
            .filter-form { grid-template-columns: 1fr; }
            .kpi-strip   { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<header class="page-header">
    <div class="header-inner">
        <div class="header-crest">🏫</div>
        <div class="header-text">
            <h1>Stephen Kanja Primary &amp; Junior School</h1>
            <p class="subtitle">Academic Performance Transcript</p>
        </div>
    </div>
    <div class="header-rule"></div>
</header>

<div class="results">

    <!-- FILTER FORM -->
    <form method="GET" action="" class="filter-form">
        <div class="form-group">
            <label>Grade</label>
            <select name="grade" required>
                <option value="">— Select —</option>
                <?php
                $selectedGrade = $_GET['grade'] ?? '';
                for ($g = 1; $g <= 9; $g++) {
                    $sel = ($selectedGrade == $g) ? 'selected' : '';
                    echo "<option value='$g' $sel>Grade $g</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Term</label>
            <select name="term" required>
                <option value="">— Select —</option>
                <?php
                $selectedTerm = $_GET['term'] ?? '';
                foreach (['Term 1','Term 2','Term 3'] as $t) {
                    $sel = ($selectedTerm === $t) ? 'selected' : '';
                    echo "<option value='$t' $sel>$t</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Exam Type</label>
            <select name="exam_type" required>
                <option value="">— Select —</option>
                <?php
                $selectedExam = $_GET['exam_type'] ?? '';
                foreach (['opener'=>'Opener','mid-term'=>'Mid-Term','end-term'=>'End Term'] as $v=>$l) {
                    $sel = ($selectedExam === $v) ? 'selected' : '';
                    echo "<option value='$v' $sel>$l</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Year</label>
            <select name="year" required>
                <option value="">— Select —</option>
                <?php
                $selectedYear = $_GET['year'] ?? '';
                for ($y = 2026; $y <= 2030; $y++) {
                    $sel = ($selectedYear == $y) ? 'selected' : '';
                    echo "<option value='$y' $sel>$y</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn-view">View Results</button>
    </form>

<?php
include 'conn.php';

/* ── Award helpers ── */
function getAward($score) {
    if ($score > 74)     return "<span class='award ee'>E.E</span>";
    elseif ($score > 49) return "<span class='award me'>M.E</span>";
    elseif ($score > 25) return "<span class='award ae'>A.E</span>";
    else                 return "<span class='award be'>B.E</span>";
}
/* Total is out of 900 (9 subjects × 100) */
function getTotalAward($score) {
    if ($score > 674)     return "<span class='award ee'>E.E</span>";
    elseif ($score > 449) return "<span class='award me'>M.E</span>";
    elseif ($score > 224) return "<span class='award ae'>A.E</span>";
    else                  return "<span class='award be'>B.E</span>";
}
function getMeanAward($score) {
    if ($score > 74)     return "<span class='mean-award excellent'>E.E</span>";
    elseif ($score > 49) return "<span class='mean-award merit'>M.E</span>";
    elseif ($score > 25) return "<span class='mean-award average'>A.E</span>";
    else                 return "<span class='mean-award below'>B.E</span>";
}
function bandLabel($score) {
    if ($score > 74)     return 'ee';
    elseif ($score > 49) return 'me';
    elseif ($score > 25) return 'ae';
    else                 return 'be';
}

/* ── Parameters ── */
$termLabel  = $_GET['term']      ?? '';
$examLabel  = $_GET['exam_type'] ?? '';
$year       = $_GET['year']      ?? '';
$grade      = $_GET['grade']     ?? '';

$termMap    = ['Term 1'=>'1','Term 2'=>'2','Term 3'=>'3'];
$term       = $termMap[$termLabel] ?? $termLabel;
$examMap    = ['opener'=>'opener','mid-term'=>'midterm','end-term'=>'endterm'];
$exam_type  = $examMap[$examLabel] ?? $examLabel;
$examDisplayMap = ['opener'=>'Opener','mid-term'=>'Mid-Term','end-term'=>'End Term'];
$examDisplay    = $examDisplayMap[$examLabel] ?? $examLabel;

$subjects      = ['math','eng','kisw','sst','scie','ca','agri','re','pretec'];
$subjectLabels = ['Mathematics','English','Kiswahili','Social Studies','Science','C/A','Agriculture','RE','Pre-Tech'];
$subjectCount  = count($subjects); // 9

if ($grade && $term && $exam_type && $year) {

    /* ════ FETCH CURRENT RESULTS ════ */
    $sql    = "SELECT DISTINCT * FROM exam2 WHERE grade='$grade' AND term='$term' AND exam_type='$exam_type' AND year='$year'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $subjectTotals = array_fill_keys($subjects, 0);
        $subjectBands  = array_fill_keys($subjects, ['ee'=>0,'me'=>0,'ae'=>0,'be'=>0]);
        $classBands    = ['ee'=>0,'me'=>0,'ae'=>0,'be'=>0];
        $totalSum      = 0;
        $students      = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $subs = [];
            foreach ($subjects as $s) $subs[$s] = (int)($row[$s] ?? 0);
            $total = array_sum($subs); // out of 900
            $row['total']    = $total;
            $row['subjects'] = $subs;
            $students[]      = $row;

            foreach ($subs as $s => $score) {
                $subjectTotals[$s] += $score;
                $subjectBands[$s][bandLabel($score)]++;
            }
            /* Band classification based on per-subject average */
            $avgPerSubject = $total / $subjectCount;
            $classBands[bandLabel($avgPerSubject)]++;
            $totalSum += $total;
        }

        $studentCount = count($students);
        /* Class mean out of 900 */
        $classMeanOf900 = round($totalSum / $studentCount, 1);
        /* Class mean per subject (out of 100) */
        $classMeanPerSubject = round($classMeanOf900 / $subjectCount, 1);

        /* Sort by total descending */
        usort($students, fn($a,$b) => $b['total'] <=> $a['total']);
        $rank = 1; $prevTotal = null; $repeatCount = 0;
        foreach ($students as $i => $student) {
            if ($student['total'] === $prevTotal) {
                $students[$i]['rank'] = $rank;
                $repeatCount++;
            } else {
                $rank += $repeatCount;
                $students[$i]['rank'] = $rank;
                $prevTotal = $student['total'];
                $repeatCount = 1;
            }
        }

        /* Subject means (out of 100 per subject) */
        $subjectMeans = [];
        foreach ($subjects as $s) $subjectMeans[$s] = round($subjectTotals[$s] / $studentCount, 1);

        /* ════ FETCH PREVIOUS RESULTS ════ */
        $prevMeans = [];
        $prevLabel = '';
        $hasPrev   = false;

        $prevExamMap  = ['opener'=>null, 'midterm'=>'opener', 'endterm'=>'midterm'];
        $prevExamType = $prevExamMap[$exam_type] ?? null;

        if ($prevExamType) {
            $prevLabel  = ucfirst($prevExamType);
            $prevSql    = "SELECT * FROM exam2 WHERE grade='$grade' AND term='$term' AND exam_type='$prevExamType' AND year='$year'";
            $prevResult = mysqli_query($conn, $prevSql);
            if ($prevResult && mysqli_num_rows($prevResult) > 0) {
                $prevTotals = array_fill_keys($subjects, 0);
                $prevCount  = 0;
                while ($pr = mysqli_fetch_assoc($prevResult)) {
                    foreach ($subjects as $s) $prevTotals[$s] += (int)($pr[$s] ?? 0);
                    $prevCount++;
                }
                if ($prevCount > 0) {
                    foreach ($subjects as $s) $prevMeans[$s] = round($prevTotals[$s] / $prevCount, 1);
                    $hasPrev = true;
                }
            }
        }

        /* Fallback: previous year same exam */
        if (!$hasPrev && (int)$year > 2026) {
            $prevYear  = (int)$year - 1;
            $prevLabel = "Year $prevYear ($examDisplay)";
            $prevSql   = "SELECT * FROM exam2 WHERE grade='$grade' AND term='$term' AND exam_type='$exam_type' AND year='$prevYear'";
            $prevResult = mysqli_query($conn, $prevSql);
            if ($prevResult && mysqli_num_rows($prevResult) > 0) {
                $prevTotals = array_fill_keys($subjects, 0);
                $prevCount  = 0;
                while ($pr = mysqli_fetch_assoc($prevResult)) {
                    foreach ($subjects as $s) $prevTotals[$s] += (int)($pr[$s] ?? 0);
                    $prevCount++;
                }
                if ($prevCount > 0) {
                    foreach ($subjects as $s) $prevMeans[$s] = round($prevTotals[$s] / $prevCount, 1);
                    $hasPrev = true;
                }
            }
        }

        /* ── JSON for JS charts ── */
        $jsSubjectLabels = json_encode($subjectLabels);
        $jsSubjectMeans  = json_encode(array_values($subjectMeans));
        $jsPrevMeans     = $hasPrev ? json_encode(array_values($prevMeans)) : 'null';
        $jsBandsEE       = json_encode(array_map(fn($s) => $subjectBands[$s]['ee'], $subjects));
        $jsBandsME       = json_encode(array_map(fn($s) => $subjectBands[$s]['me'], $subjects));
        $jsBandsAE       = json_encode(array_map(fn($s) => $subjectBands[$s]['ae'], $subjects));
        $jsBandsBE       = json_encode(array_map(fn($s) => $subjectBands[$s]['be'], $subjects));
        $jsClassBands    = json_encode([$classBands['ee'],$classBands['me'],$classBands['ae'],$classBands['be']]);
        $jsStudentCount  = $studentCount;

        $eeCount = $classBands['ee'];
        $meCount = $classBands['me'];
        $aeCount = $classBands['ae'];
        $beCount = $classBands['be'];
        $eeP = $studentCount ? round($eeCount/$studentCount*100) : 0;
        $meP = $studentCount ? round($meCount/$studentCount*100) : 0;
        $aeP = $studentCount ? round($aeCount/$studentCount*100) : 0;
        $beP = $studentCount ? round($beCount/$studentCount*100) : 0;

        /* ════ OUTPUT ════ */
        echo "
        <div class='section-divider'>
            <h2>Grade $grade &mdash; $examDisplay ($termLabel, $year)</h2>
            <span class='section-badge'>$studentCount Students</span>
        </div>

        <!-- KPI STRIP -->
        <div class='kpi-strip'>
            <div class='kpi-card kpi-total' style='animation-delay:0.04s'>
                <div class='kpi-label'>Total Students</div>
                <div class='kpi-val'>$studentCount</div>
                <div class='kpi-sub'>in this grade &amp; exam</div>
            </div>
            <div class='kpi-card kpi-ee' style='animation-delay:0.08s'>
                <div class='kpi-label'>Exceeding Expectations</div>
                <div class='kpi-val'>$eeCount</div>
                <div class='kpi-sub'>$eeP% of class &mdash; Avg &gt;74/subject</div>
            </div>
            <div class='kpi-card kpi-me' style='animation-delay:0.12s'>
                <div class='kpi-label'>Class Mean Score</div>
                <div class='kpi-val'>$classMeanOf900</div>
                <div class='kpi-sub'>out of 900 &mdash; $classMeanPerSubject avg per subject</div>
            </div>
            <div class='kpi-card kpi-below' style='animation-delay:0.16s'>
                <div class='kpi-label'>Below Expectations</div>
                <div class='kpi-val'>$beCount</div>
                <div class='kpi-sub'>$beP% of class &mdash; Avg &lt;26/subject</div>
            </div>
        </div>
        ";

        /* ── PERFORMANCE BANDS ── */
        echo "
        <div class='section-divider'><h2>Performance Analysis</h2></div>
        <div class='bands-grid'>
            <div class='band-card'>
                <h3>Student Achievement Bands (Overall)</h3>
                <div class='band-row'>
                    <div class='band-label' style='color:var(--ee)'>&#9679; Exceeding (E.E)</div>
                    <div class='band-bar-wrap'><div class='band-bar band-ee' style='width:{$eeP}%'></div></div>
                    <div class='band-count'>$eeCount ($eeP%)</div>
                </div>
                <div class='band-row'>
                    <div class='band-label' style='color:var(--me)'>&#9679; Meeting (M.E)</div>
                    <div class='band-bar-wrap'><div class='band-bar band-me' style='width:{$meP}%'></div></div>
                    <div class='band-count'>$meCount ($meP%)</div>
                </div>
                <div class='band-row'>
                    <div class='band-label' style='color:#d97706'>&#9679; Approaching (A.E)</div>
                    <div class='band-bar-wrap'><div class='band-bar band-ae' style='width:{$aeP}%'></div></div>
                    <div class='band-count'>$aeCount ($aeP%)</div>
                </div>
                <div class='band-row'>
                    <div class='band-label' style='color:var(--be)'>&#9679; Below (B.E)</div>
                    <div class='band-bar-wrap'><div class='band-bar band-be' style='width:{$beP}%'></div></div>
                    <div class='band-count'>$beCount ($beP%)</div>
                </div>
            </div>
            <div class='band-card'>
                <h3>Subject Means vs Benchmark (out of 100)</h3>
        ";

        $barColors = ['ee'=>'var(--ee)','me'=>'var(--me)','ae'=>'#d97706','be'=>'var(--be)'];
        foreach ($subjects as $idx => $s) {
            $mean = $subjectMeans[$s];
            $label = $subjectLabels[$idx];
            $pct  = min(100, round($mean));
            $cls  = bandLabel($mean);
            $col  = $barColors[$cls];
            echo "
                <div class='band-row'>
                    <div class='band-label'>$label</div>
                    <div class='band-bar-wrap'><div class='band-bar' style='background:$col;width:{$pct}%'></div></div>
                    <div class='band-count'>$mean</div>
                </div>
            ";
        }
        echo "</div></div>";

        /* ── CHARTS ── */
        echo "
        <div class='charts-grid'>
            <div class='chart-card'>
                <h3>Subject Mean Scores (out of 100)</h3>
                <div class='chart-wrap'><canvas id='subjectMeansChart'></canvas></div>
            </div>
            <div class='chart-card'>
                <h3>Class Achievement Distribution</h3>
                <div class='chart-wrap'><canvas id='classBandsChart'></canvas></div>
            </div>
            <div class='chart-card full-width'>
                <h3>Per-Subject Band Breakdown (All Students)</h3>
                <div class='chart-wrap tall'><canvas id='subjectBandsChart'></canvas></div>
            </div>
        </div>
        ";

        /* ── PREVIOUS COMPARISON ── */
        echo "<div class='section-divider'><h2>Comparison with Previous Exam</h2></div>";
        if ($hasPrev) {
            echo "
            <div class='compare-card'>
                <h3>Current ($examDisplay) vs Previous ($prevLabel) — Subject Means</h3>
                <div class='compare-meta'>
                    <div class='compare-pill'>
                        <div class='compare-pill-dot' style='background:var(--blue)'></div>
                        Current: $examDisplay $termLabel $year
                    </div>
                    <div class='compare-pill'>
                        <div class='compare-pill-dot' style='background:rgba(15,25,35,0.3)'></div>
                        Previous: $prevLabel
                    </div>
                </div>
                <div class='chart-wrap tall'><canvas id='compareChart'></canvas></div>
            </div>
            ";

            echo "
            <div class='means-card'>
                <h3>Subject-by-Subject Comparison Table</h3>
                <table class='means-table'>
                    <thead><tr>
                        <th>Subject</th><th>Current Mean</th><th>Previous Mean</th><th>Change</th>
                        <th>E.E</th><th>M.E</th><th>A.E</th><th>B.E</th>
                    </tr></thead>
                    <tbody>
            ";
            foreach ($subjects as $idx => $s) {
                $cur  = $subjectMeans[$s];
                $prev = $prevMeans[$s] ?? null;
                $diff = $prev !== null ? round($cur - $prev, 1) : null;
                $trendClass = $diff === null ? 'trend-same' : ($diff > 0 ? 'trend-up' : ($diff < 0 ? 'trend-down' : 'trend-same'));
                $trendStr   = $diff === null ? '—' : ($diff > 0 ? "▲ +$diff" : ($diff < 0 ? "▼ $diff" : "→ 0"));
                $prevStr    = $prev !== null ? $prev : '—';
                $eeC = $subjectBands[$s]['ee'];
                $meC = $subjectBands[$s]['me'];
                $aeC = $subjectBands[$s]['ae'];
                $beC = $subjectBands[$s]['be'];
                echo "<tr>
                    <td><strong>{$subjectLabels[$idx]}</strong></td>
                    <td class='mean-val'>$cur ".getMeanAward($cur)."</td>
                    <td>$prevStr</td>
                    <td class='$trendClass'>$trendStr</td>
                    <td>$eeC</td><td>$meC</td><td>$aeC</td><td>$beC</td>
                </tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<div class='compare-card'><div class='no-prev'>📊 No previous exam data found to compare against.<br>
            <small>Previous comparison shows when prior exam data exists for the same grade and term.</small></div></div>";
        }

        /* ── RESULTS TABLE ── */
        echo "
        <div class='section-divider'><h2>Full Results Table</h2></div>
        <p class='scroll-hint'>← Scroll sideways to see all columns →</p>
        <div class='table-scroll'>
        <table class='results-table'>
            <thead><tr>
                <th>Rank</th><th>Assess. No</th><th>First Name</th><th>Surname</th>
                <th>Maths</th><th>English</th><th>Kiswahili</th><th>S/ST</th>
                <th>Science</th><th>C/A</th><th>Agriculture</th><th>RE</th><th>Pre-Tech</th>
                <th>Total (/900)</th>
            </tr></thead>
            <tbody>
        ";

        foreach ($students as $student) {
            $r  = $student['rank'];
            $bc = $r===1 ? 'gold' : ($r===2 ? 'silver' : ($r===3 ? 'bronze' : ''));
            echo "<tr>
                <td><span class='rank-badge $bc'>$r</span></td>
                <td>{$student['Assesment']}</td>
                <td><strong>{$student['firstName']}</strong></td>
                <td>{$student['lastName']}</td>";
            foreach ($student['subjects'] as $sub => $score) echo "<td>{$score} ".getAward($score)."</td>";
            echo "<td>{$student['total']} ".getTotalAward($student['total'])."</td></tr>";
        }

        /* Mean row — per subject means + total mean out of 900 */
        echo "<tr class='mean-row'><td colspan='4'>Class Mean</td>";
        foreach ($subjects as $s) {
            $sm = round($subjectTotals[$s] / $studentCount, 1);
            echo "<td>$sm ".getMeanAward($sm)."</td>";
        }
        echo "<td>$classMeanOf900 ".getMeanAward($classMeanPerSubject)."</td>";
        echo "</tr></tbody></table></div>";

        /* ── CHART.JS INLINE (loaded at bottom so canvases exist in DOM) ── */
        echo "
        <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js'></script>
        <script>
        (function() {
            const subjectLabels = $jsSubjectLabels;
            const subjectMeans  = $jsSubjectMeans;
            const prevMeans     = $jsPrevMeans;
            const bandsEE       = $jsBandsEE;
            const bandsME       = $jsBandsME;
            const bandsAE       = $jsBandsAE;
            const bandsBE       = $jsBandsBE;
            const classBands    = $jsClassBands; // [ee, me, ae, be]
            const n             = $jsStudentCount;

            const shortLabels = ['Maths','Eng','Kisw','SST','Sci','CA','Agri','RE','PreTec'];

            Chart.defaults.font.family = \"'DM Sans', sans-serif\";
            Chart.defaults.color       = '#7a909e';

            /* ── Subject Means Bar ── */
            const ctx1 = document.getElementById('subjectMeansChart');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: shortLabels,
                        datasets: [{
                            label: 'Mean Score',
                            data: subjectMeans,
                            backgroundColor: subjectMeans.map(v =>
                                v > 74 ? 'rgba(22,163,74,0.75)' :
                                v > 49 ? 'rgba(26,74,122,0.75)' :
                                v > 25 ? 'rgba(217,119,6,0.75)' :
                                         'rgba(153,27,27,0.75)'
                            ),
                            borderRadius: 6,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    afterLabel: ctx => {
                                        const v = ctx.raw;
                                        return v > 74 ? 'Exceeding Expectations' :
                                               v > 49 ? 'Meeting Expectations' :
                                               v > 25 ? 'Approaching Expectations' : 'Below Expectations';
                                    }
                                }
                            }
                        },
                        scales: {
                            y: { min: 0, max: 100, grid: { color: 'rgba(0,0,0,0.05)' },
                                 ticks: { callback: v => v } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            /* ── Class Bands Doughnut ── */
            const ctx2 = document.getElementById('classBandsChart');
            if (ctx2) {
                new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: ['Exceeding (E.E)','Meeting (M.E)','Approaching (A.E)','Below (B.E)'],
                        datasets: [{
                            data: classBands,
                            backgroundColor: [
                                'rgba(22,163,74,0.8)',
                                'rgba(26,74,122,0.8)',
                                'rgba(217,119,6,0.8)',
                                'rgba(153,27,27,0.8)'
                            ],
                            borderWidth: 2,
                            borderColor: '#ffffff',
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        cutout: '60%',
                        plugins: {
                            legend: { position: 'bottom', labels: { padding: 16, boxWidth: 12, borderRadius: 4 } },
                            tooltip: {
                                callbacks: {
                                    label: ctx => {
                                        const v = ctx.raw;
                                        const pct = n ? Math.round(v/n*100) : 0;
                                        return ' ' + v + ' students (' + pct + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            /* ── Per-Subject Stacked Band Chart ── */
            const ctx3 = document.getElementById('subjectBandsChart');
            if (ctx3) {
                new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels: shortLabels,
                        datasets: [
                            { label:'Exceeding (E.E)', data: bandsEE, backgroundColor:'rgba(22,163,74,0.8)',  borderRadius: 0 },
                            { label:'Meeting (M.E)',   data: bandsME, backgroundColor:'rgba(26,74,122,0.8)',  borderRadius: 0 },
                            { label:'Approaching (A.E)',data: bandsAE,backgroundColor:'rgba(217,119,6,0.8)', borderRadius: 0 },
                            { label:'Below (B.E)',     data: bandsBE, backgroundColor:'rgba(153,27,27,0.8)', borderRadius: {topLeft:4,topRight:4} }
                        ]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: {
                            legend: { position:'bottom', labels:{ padding:16, boxWidth:12, borderRadius:4 } },
                            tooltip: {
                                callbacks: {
                                    label: ctx => {
                                        const v = ctx.raw;
                                        const pct = n ? Math.round(v/n*100) : 0;
                                        return ' ' + ctx.dataset.label + ': ' + v + ' (' + pct + '%)';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { stacked: true, grid: { display: false } },
                            y: { stacked: true, grid: { color: 'rgba(0,0,0,0.05)' },
                                 ticks: { stepSize: 1 },
                                 title: { display: true, text: 'No. of Students' } }
                        }
                    }
                });
            }

            /* ── Comparison Line Chart ── */
            const ctx4 = document.getElementById('compareChart');
            if (ctx4 && prevMeans !== null) {
                new Chart(ctx4, {
                    type: 'line',
                    data: {
                        labels: shortLabels,
                        datasets: [
                            {
                                label: 'Current Exam',
                                data: subjectMeans,
                                borderColor: 'rgba(26,74,122,1)',
                                backgroundColor: 'rgba(26,74,122,0.1)',
                                borderWidth: 3,
                                pointRadius: 5, pointHoverRadius: 8,
                                tension: 0.35, fill: true
                            },
                            {
                                label: 'Previous Exam',
                                data: prevMeans,
                                borderColor: 'rgba(15,25,35,0.4)',
                                backgroundColor: 'rgba(15,25,35,0.05)',
                                borderWidth: 2,
                                borderDash: [6,4],
                                pointRadius: 4, pointHoverRadius: 7,
                                tension: 0.35, fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true, maintainAspectRatio: false,
                        plugins: {
                            legend: { position:'bottom', labels:{ padding:16, boxWidth:14, borderRadius:4 } },
                            tooltip: {
                                callbacks: {
                                    afterBody: items => {
                                        if (items.length === 2) {
                                            const diff = parseFloat((items[0].raw - items[1].raw).toFixed(1));
                                            if (diff > 0) return ['▲ Improved by ' + diff];
                                            if (diff < 0) return ['▼ Dropped by ' + Math.abs(diff)];
                                            return ['→ No change'];
                                        }
                                    }
                                }
                            }
                        },
                        scales: {
                            y: { min: 0, max: 100, grid: { color: 'rgba(0,0,0,0.05)' } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        })();
        </script>
        ";

    } else {
        echo "<p class='no-results'>No results found for the selected filters.</p>";
    }

} else {
    echo "<p class='no-results'>Select a grade, term, exam type, and year above to view results.</p>";
}
?>

</div><!-- .results -->
</body>
</html>