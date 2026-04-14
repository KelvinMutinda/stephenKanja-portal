<?php
include 'conn.php';

if (isset($_POST['grade'])) {
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $query = "SELECT DISTINCT Assesment, firstName, surname FROM Student WHERE Grade='$grade'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
           <td><input type='text' name='assesment[]' value='{$row['Assesment']}' readonly></td>
            <td><input type='text' name='firstName[]' value='{$row['firstName']}' readonly></td>
            <td><input type='text' name='surname[]' value='{$row['surname']}' readonly></td>
            <td class='col-subj' data-subj='MATH'><input type='number' name='MATH[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='ENG'><input type='number' name='ENG[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='KISW'><input type='number' name='KISW[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='SCIE'><input type='number' name='SCIE[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='sst'><input type='number' name='sst[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='ca'><input type='number' name='ca[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='AGRI'><input type='number' name='AGRI[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='re'><input type='number' name='re[]' placeholder='—' min='0' max='100'></td>
            <td class='col-subj' data-subj='pretec'><input type='number' name='pretec[]' placeholder='—' min='0' max='100'></td>
            <td><input type='hidden' name='grade[]' value='{$grade}'></td>
        </tr>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Results — Stephen Kanja School</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --gold:      #f0c040;
      --gold-dim:  #c9a030;
      --black:     #111111;
      --dark:      #1a1a1a;
      --mid:       #2a2a2a;
      --bg:        #f4f4f2;
      --bg-card:   #ffffff;
      --bg-input:  #f8f8f6;
      --text-primary:   #1a1a18;
      --text-secondary: #5f5e5a;
      --text-tertiary:  #888780;
      --border:    rgba(0,0,0,0.09);
      --radius-md: 8px;
      --radius-lg: 12px;
      --sidebar-w: 260px;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text-primary);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ══════════ OVERLAY ══════════ */
    .overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      z-index: 200;
      backdrop-filter: blur(2px);
    }
    .overlay.active { display: block; }

    /* ══════════ HEADER ══════════ */
    .site-header {
      position: sticky;
      top: 0;
      z-index: 300;
      background: var(--black);
      border-bottom: 3px solid var(--gold);
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 0 1.6rem;
      height: 62px;
      flex-shrink: 0;
    }

    .hamburger {
      display: none;
      background: var(--mid);
      border: none;
      cursor: pointer;
      color: #fff;
      font-size: 14px;
      width: 34px; height: 34px;
      border-radius: 7px;
      align-items: center; justify-content: center;
      flex-shrink: 0;
      transition: background 0.2s;
    }
    .hamburger:hover { background: var(--gold); color: var(--black); }

    .school-logo {
      width: 36px; height: 36px;
      border-radius: 8px;
      background: var(--gold);
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .school-logo i { color: var(--black); font-size: 16px; }

    .school-name-wrap { flex: 1; min-width: 0; }
    .school-name {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.4rem;
      letter-spacing: 0.12em;
      color: #fff;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1;
    }
    .school-name span { color: var(--gold); }
    .school-motto {
      font-size: 10px;
      color: #666;
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      margin-top: 2px;
    }

    .header-tag {
      font-size: 11px;
      color: #555;
      letter-spacing: 0.05em;
      display: flex;
      align-items: center;
      gap: 6px;
      flex-shrink: 0;
    }
    .header-tag i { color: var(--gold); font-size: 10px; }

    /* ══════════ LAYOUT ══════════ */
    .layout { display: flex; flex: 1; }

    /* ══════════ SIDEBAR ══════════ */
    .sidebar {
      width: var(--sidebar-w);
      background: var(--black);
      border-right: 1px solid var(--mid);
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
      position: relative;
      overflow: hidden;
    }

    .sidebar::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 3px; height: 100%;
      background: linear-gradient(to bottom, var(--gold) 0%, transparent 100%);
    }

    .sidebar-inner {
      flex: 1;
      overflow-y: auto;
      padding: 1.2rem 0;
      scrollbar-width: thin;
      scrollbar-color: var(--mid) transparent;
    }

    .nav-label {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: #444;
      padding: 0.8rem 1.4rem 0.4rem;
    }

    .sidebar nav {
      display: flex;
      flex-direction: column;
      gap: 2px;
      padding: 0 0.75rem;
    }

    .sidebar nav a {
      display: flex;
      align-items: center;
      gap: 11px;
      padding: 9px 13px;
      border-radius: var(--radius-md);
      font-size: 13.5px;
      font-weight: 400;
      color: #aaa;
      text-decoration: none;
      border-left: 3px solid transparent;
      transition: all 0.18s;
    }

    .sidebar nav a i {
      width: 17px;
      text-align: center;
      font-size: 13px;
      color: #555;
      flex-shrink: 0;
      transition: color 0.15s;
    }

    .sidebar nav a:hover { background: rgba(255,255,255,0.04); color: #fff; border-left-color: var(--gold); }
    .sidebar nav a:hover i { color: var(--gold); }
    .sidebar nav a.active { background: rgba(240,192,64,0.08); color: #fff; font-weight: 500; border-left-color: var(--gold); }
    .sidebar nav a.active i { color: var(--gold); }

    .sidebar-footer {
      padding: 1rem 1.4rem;
      border-top: 1px solid var(--mid);
      font-size: 11px;
      color: #444;
      letter-spacing: 0.04em;
    }

    /* ══════════ MAIN ══════════ */
    .main {
      flex: 1;
      min-width: 0;
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    /* ── Page title ── */
    .page-title-bar {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .page-eyebrow {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--gold-dim);
      margin-bottom: 4px;
    }

    .page-title {
      font-family: 'DM Sans', sans-serif;
      font-size: 24px;
      font-weight: 400;
      color: var(--text-primary);
      line-height: 1.2;
    }

    /* ══════════════════════════════════
       FILTER CARD
    ══════════════════════════════════ */
    .filter-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
      animation: fadeUp 0.4s 0.05s ease both;
    }

    .filter-card-head {
      background: var(--black);
      border-bottom: 2px solid var(--gold);
      padding: 0.8rem 1.4rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-card-head span {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1rem;
      letter-spacing: 0.1em;
      color: #fff;
    }

    .filter-card-head i { color: var(--gold); font-size: 13px; }

    .filter-body {
      padding: 1.4rem 1.6rem;
    }

    .filter-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem 1.2rem;
      align-items: end;
    }

    .filter-field {
      display: flex;
      flex-direction: column;
      gap: 6px;
      width: 100%;
    }

    .filter-field label {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-secondary);
      white-space: nowrap;
      display: block;
    }

    .filter-field select {
      width: 100%;
      padding: 9px 32px 9px 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: 13.5px;
      color: var(--text-primary);
      background-color: var(--bg-input);
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23888780' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 10px center;
      border: 1px solid rgba(0,0,0,0.1);
      border-radius: var(--radius-md);
      outline: none;
      appearance: none;
      -webkit-appearance: none;
      cursor: pointer;
      transition: border-color 0.15s, box-shadow 0.15s;
      display: block;
    }

    .filter-field select:focus {
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(240,192,64,0.12);
    }

    /* ── Status banner ── */
    .status-bar {
      display: none;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      background: #fffbea;
      border: 1px solid var(--gold);
      border-radius: var(--radius-md);
      font-size: 13px;
      color: #7a5c00;
    }
    .status-bar.visible { display: flex; }
    .status-bar i { color: var(--gold-dim); flex-shrink: 0; }

    /* ── Table card ── */
    .table-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
      animation: fadeUp 0.4s 0.12s ease both;
    }

    .table-card-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.9rem 1.4rem;
      background: var(--black);
      border-bottom: 2px solid var(--gold);
    }

    .table-card-header span.label {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1rem;
      letter-spacing: 0.1em;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .table-card-header span.label i { color: var(--gold); }

    .count-badge {
      background: var(--gold);
      color: var(--black);
      font-size: 11px;
      font-weight: 700;
      padding: 2px 10px;
      border-radius: 20px;
      letter-spacing: 0.04em;
    }

    /* ══════════════════════════════════
       MOBILE SUBJECT SELECTOR
       Only visible on screens ≤ 700px.
       Hidden completely on desktop —
       zero layout impact above breakpoint.
    ══════════════════════════════════ */
    .mobile-subject-bar { display: none; }

    @media (max-width: 700px) {
      .mobile-subject-bar {
        display: block;
        background: var(--bg-card);
        border-bottom: 1px solid var(--border);
      }

      .subject-mode-row {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        background: var(--bg-input);
        border-bottom: 1px solid var(--border);
      }

      .subject-mode-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-tertiary);
        white-space: nowrap;
      }

      .subject-mode-btn {
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 500;
        padding: 5px 12px;
        border-radius: 6px;
        cursor: pointer;
        border: 1px solid var(--border);
        background: var(--bg-card);
        color: var(--text-secondary);
        transition: all 0.15s;
      }

      .subject-mode-btn.active {
        background: var(--black);
        color: var(--gold);
        border-color: transparent;
      }

      .subject-chip-scroll {
        display: none;
        overflow-x: auto;
        gap: 6px;
        padding: 8px 12px;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
        border-bottom: 1px solid var(--border);
      }
      .subject-chip-scroll::-webkit-scrollbar { display: none; }
      .subject-chip-scroll.visible { display: flex; }

      .subject-chip {
        font-size: 11px;
        font-weight: 500;
        padding: 5px 13px;
        border-radius: 20px;
        white-space: nowrap;
        cursor: pointer;
        border: 1px solid var(--border);
        background: var(--bg-input);
        color: var(--text-secondary);
        flex-shrink: 0;
        transition: all 0.15s;
      }

      .subject-chip.active {
        background: var(--gold);
        color: var(--black);
        border-color: transparent;
        font-weight: 600;
      }

      .active-subject-banner {
        display: none;
        align-items: center;
        gap: 7px;
        padding: 7px 12px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #7a5c00;
        background: #fffbea;
        border-bottom: 1px solid var(--gold);
      }
      .active-subject-banner.visible { display: flex; }
      .active-subject-banner-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--gold);
        flex-shrink: 0;
      }

      /* Hide subject columns when in single-subject mode */
      .results-table .col-subj.hidden-col { display: none; }
    }

    /* ── Table scroll ── */
    .table-scroll {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    table.results-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 12.5px;
      min-width: 900px;
    }

    .results-table thead tr.col-row th {
      background: #fafafa;
      color: var(--text-tertiary);
      font-size: 10.5px;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 10px 10px;
      border-bottom: 1px solid rgba(0,0,0,0.07);
      text-align: left;
      white-space: nowrap;
    }

    .results-table tbody tr {
      border-bottom: 1px solid rgba(0,0,0,0.05);
      transition: background 0.12s;
    }
    .results-table tbody tr:hover { background: var(--bg-input); }
    .results-table tbody tr:last-child { border-bottom: none; }

    .results-table td {
      padding: 7px 8px;
      vertical-align: middle;
    }

    /* Readonly text inputs */
    .results-table input[readonly] {
      width: 100%;
      padding: 6px 8px;
      background: var(--bg-input);
      border: 1px solid transparent;
      border-radius: 6px;
      font-family: 'DM Sans', sans-serif;
      font-size: 12px;
      color: var(--text-secondary);
      font-weight: 500;
      min-width: 80px;
    }

    /* Mark number inputs */
    .results-table input[type="number"] {
      width: 58px;
      padding: 6px;
      background: var(--bg-input);
      border: 1px solid rgba(0,0,0,0.1);
      border-radius: 6px;
      font-family: 'DM Sans', sans-serif;
      font-size: 12px;
      color: var(--text-primary);
      text-align: center;
      outline: none;
      transition: border-color 0.15s, box-shadow 0.15s;
      -moz-appearance: textfield;
    }
    .results-table input[type="number"]::-webkit-inner-spin-button,
    .results-table input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; }
    .results-table input[type="number"]:focus {
      border-color: var(--gold);
      background: #fff;
      box-shadow: 0 0 0 2px rgba(240,192,64,0.12);
    }

    /* Empty / loading states */
    .empty-state {
      text-align: center;
      padding: 3.5rem 2rem;
    }
    .empty-icon {
      width: 56px; height: 56px;
      background: var(--black);
      border-radius: 14px;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 1rem;
    }
    .empty-icon i { color: var(--gold); font-size: 22px; }
    .empty-state p { font-size: 14px; color: var(--text-tertiary); }

    .spinner {
      display: none;
      text-align: center;
      padding: 2.5rem;
      color: var(--text-tertiary);
      font-size: 13px;
    }
    .spinner i { color: var(--gold); margin-right: 6px; }

    /* ── Submit footer ── */
    .submit-section {
      display: none;
      align-items: center;
      justify-content: flex-end;
      gap: 0.75rem;
      padding: 1rem 1.4rem;
      border-top: 1px solid var(--border);
      background: var(--bg-input);
      flex-wrap: wrap;
    }

    .btn-reset-marks {
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 500;
      color: var(--text-secondary);
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius-md);
      padding: 9px 18px;
      cursor: pointer;
      transition: all 0.15s;
      display: flex; align-items: center; gap: 6px;
    }
    .btn-reset-marks:hover { border-color: rgba(0,0,0,0.2); color: var(--text-primary); }

    .btn-submit {
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: var(--black);
      background: var(--gold);
      border: none;
      border-radius: var(--radius-md);
      padding: 10px 26px;
      cursor: pointer;
      display: flex; align-items: center; gap: 8px;
      transition: background 0.15s, transform 0.1s;
    }
    .btn-submit:hover { background: var(--gold-dim); }
    .btn-submit:active { transform: scale(0.98); }

    /* ── Footer ── */
    .site-footer {
      background: var(--black);
      border-top: 2px solid var(--gold);
      padding: 1rem 1.5rem;
      text-align: center;
      font-size: 11px;
      color: #444;
      letter-spacing: 0.04em;
    }

    /* ══════════ ANIMATIONS ══════════ */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ══════════ RESPONSIVE ══════════ */

    /* Tablet: 2 columns */
    @media (max-width: 900px) {
      .sidebar {
        position: fixed;
        top: 62px; left: 0; bottom: 0;
        z-index: 250;
        transform: translateX(-100%);
        box-shadow: 6px 0 30px rgba(0,0,0,0.4);
      }
      .sidebar.open { transform: translateX(0); }
      .hamburger { display: flex; }
      .header-tag { display: none; }
      .main { padding: 1.25rem 1rem 3rem; }

      .filter-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    /* Mobile: 1 column */
    @media (max-width: 520px) {
      .school-name { font-size: 1.1rem; }
      .filter-body { padding: 1rem; }

      .filter-grid {
        grid-template-columns: 1fr;
        gap: 0.85rem;
      }

      .filter-field select { font-size: 14px; }

      .btn-submit,
      .btn-reset-marks { width: 100%; justify-content: center; }

      .submit-section { flex-direction: column; align-items: stretch; }
    }
  </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<!-- ════════════ HEADER ════════════ -->
<header class="site-header">
  <button class="hamburger" id="hamburger" aria-label="Open menu">
    <i class="fa-solid fa-bars"></i>
  </button>
  <div class="school-logo"><i class="fa-solid fa-graduation-cap"></i></div>
  <div class="school-name-wrap">
    <div class="school-name">Stephen Kanja <span>School</span></div>
    <div class="school-motto">Aim Higher</div>
  </div>
  <div class="header-tag"><i class="fa-solid fa-circle-dot"></i> Upload Results</div>
</header>

<div class="layout">

  <!-- ════════════ SIDEBAR ════════════ -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-inner">
      <p class="nav-label">Main</p>
      <nav>
        <a href="teacherpanel.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="Students.php"><i class="fa-solid fa-user-graduate"></i> Students</a>
        <a href="progress.php"><i class="fa-solid fa-chart-line"></i> Progress Records</a>
      </nav>
      <p class="nav-label">Academics</p>
      <nav>
        <a href="ViewResults.php"><i class="fa-solid fa-chart-pie"></i> Results</a>
        <a href="UploadResults.php" class="active"><i class="fa-solid fa-upload"></i> Upload Results</a>
        <a href="track.php"><i class="fa-solid fa-bullseye"></i> Track Performance</a>
        <a href="LearningMaterials.php"><i class="fa-solid fa-book"></i> Learning Materials</a>
      </nav>
      <p class="nav-label">Administration</p>
      <nav>
        <a href="RegisterStudent.php"><i class="fa-solid fa-user-plus"></i> Register Learners</a>
        <a href="RegisterTeacher.php"><i class="fa-solid fa-user-plus"></i> Register Teachers</a>
      </nav>
      <p class="nav-label">Finance</p>
      <nav>
        <a href="Fee.php"><i class="fa-solid fa-coins"></i> Finances</a>
      </nav>
    </div>
    <div class="sidebar-footer">© 2026 Kelvin Mutinda</div>
  </aside>

  <!-- ════════════ MAIN ════════════ -->
  <main class="main">

    <div class="page-title-bar">
      <div>
        <p class="page-eyebrow">Academic Records</p>
        <h1 class="page-title">Upload Results</h1>
        <p style="font-size:13px;color:var(--text-tertiary);margin-top:4px;">
          Select a grade and enter marks for each subject below.
        </p>
      </div>
    </div>

    <form method="POST" action="upload.php" id="resultsForm">

      <!-- ── Filter Card ── -->
      <div class="filter-card">
        <div class="filter-card-head">
          <i class="fa-solid fa-sliders"></i>
          <span>Filter Options</span>
        </div>
        <div class="filter-body">
          <div class="filter-grid">

            <div class="filter-field">
              <label for="gradeSelect">Grade</label>
              <select id="gradeSelect" name="grade" required>
                <option value="">— Select Grade —</option>
                <?php for ($i = 1; $i <= 9; $i++) echo "<option value='$i'>Grade $i</option>"; ?>
              </select>
            </div>

            <div class="filter-field">
              <label for="termSelect">Term</label>
              <select id="termSelect" name="term" required>
                <option value="">— Select Term —</option>
                <option value="1">Term 1</option>
                <option value="2">Term 2</option>
                <option value="3">Term 3</option>
              </select>
            </div>

            <div class="filter-field">
              <label for="examSelect">Exam Type</label>
              <select id="examSelect" name="examType" required>
                <option value="">— Select Type —</option>
                <option value="opener">Opener</option>
                <option value="midterm">Midterm</option>
                <option value="endterm">End Term</option>
              </select>
            </div>

            <div class="filter-field">
              <label for="yearSelect">Year</label>
              <select id="yearSelect" name="year" required>
                <option value="">— Select Year —</option>
                <?php for ($y = 2026; $y <= 2030; $y++) echo "<option value='$y'>$y</option>"; ?>
              </select>
            </div>

          </div>
        </div>
      </div>

      <!-- ── Status banner ── -->
      <div class="status-bar" id="statusBar">
        <i class="fa-solid fa-circle-info"></i>
        <span id="statusText">Students loaded. Fill in the marks and submit.</span>
      </div>

      <!-- ── Table Card ── -->
      <div class="table-card">
        <div class="table-card-header">
          <span class="label"><i class="fa-solid fa-table"></i> Student Results</span>
          <span class="count-badge" id="studentCount">0 students</span>
        </div>

        <!-- ══ MOBILE SUBJECT SELECTOR ══
             Shown only on screens ≤ 700px.
             Lets the teacher switch between
             "All subjects" (horizontal scroll)
             or "One subject" (pick a chip →
             only that column is visible).
        ════════════════════════════════ -->
        <div class="mobile-subject-bar" id="mobileSubjectBar">

          <div class="subject-mode-row">
            <span class="subject-mode-label">View:</span>
            <button type="button" class="subject-mode-btn active" id="modeAll"
                    onclick="setSubjectMode('all')">
              <i class="fa-solid fa-table-columns" style="font-size:10px;margin-right:4px;"></i>All subjects
            </button>
            <button type="button" class="subject-mode-btn" id="modeOne"
                    onclick="setSubjectMode('one')">
              <i class="fa-solid fa-crosshairs" style="font-size:10px;margin-right:4px;"></i>One subject
            </button>
          </div>

          <div class="subject-chip-scroll" id="subjectChips">
            <div class="subject-chip active"  onclick="pickSubject(this,'MATH')">Maths</div>
            <div class="subject-chip"         onclick="pickSubject(this,'ENG')">English</div>
            <div class="subject-chip"         onclick="pickSubject(this,'KISW')">Kiswahili</div>
            <div class="subject-chip"         onclick="pickSubject(this,'SCIE')">Science</div>
            <div class="subject-chip"         onclick="pickSubject(this,'sst')">SST</div>
            <div class="subject-chip"         onclick="pickSubject(this,'ca')">C/A</div>
            <div class="subject-chip"         onclick="pickSubject(this,'AGRI')">Agriculture</div>
            <div class="subject-chip"         onclick="pickSubject(this,'re')">RE</div>
            <div class="subject-chip"         onclick="pickSubject(this,'pretec')">Pre-Tech</div>
          </div>

          <div class="active-subject-banner" id="activeSubjectBanner">
            <div class="active-subject-banner-dot"></div>
            <span id="activeSubjectName">Maths</span>
          </div>

        </div>
        <!-- ══ END MOBILE SUBJECT SELECTOR ══ -->

        <div class="table-scroll">
          <div class="spinner" id="spinner">
            <i class="fa-solid fa-circle-notch fa-spin"></i> Loading students…
          </div>

          <table class="results-table">
            <thead>
              <tr class="col-row">
                <th>Assess. No</th>
                <th>First Name</th>
                <th>Surname</th>
                <th class="col-subj" data-subj="MATH">Maths</th>
                <th class="col-subj" data-subj="ENG">English</th>
                <th class="col-subj" data-subj="KISW">Kiswahili</th>
                <th class="col-subj" data-subj="SCIE">Science</th>
                <th class="col-subj" data-subj="sst">Soc. Studies</th>
                <th class="col-subj" data-subj="ca">C/A</th>
                <th class="col-subj" data-subj="AGRI">Agriculture</th>
                <th class="col-subj" data-subj="re">RE</th>
                <th class="col-subj" data-subj="pretec">Pre-Tech</th>
              </tr>
            </thead>
            <tbody id="studentTable">
              <tr>
                <td colspan="12">
                  <div class="empty-state">
                    <div class="empty-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                    <p>Select a grade above to load students</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="submit-section" id="submitSection">
          <button type="button" class="btn-reset-marks" onclick="clearTable()">
            <i class="fa-solid fa-rotate-left"></i> Clear Marks
          </button>
          <button type="submit" class="btn-submit">
            <i class="fa-solid fa-floppy-disk"></i> Submit Results
          </button>
        </div>
      </div>

    </form>

  </main>
</div>

<!-- ════════════ FOOTER ════════════ -->
<footer class="site-footer">
  &copy; Designed by Kelvin Mutinda 2026. All rights reserved.
</footer>

<script>
  /* ── Sidebar toggle ── */
  const hamburger = document.getElementById('hamburger');
  const sidebar   = document.getElementById('sidebar');
  const overlay   = document.getElementById('overlay');

  function openSidebar() {
    sidebar.classList.add('open');
    overlay.classList.add('active');
    hamburger.innerHTML = '<i class="fa-solid fa-xmark"></i>';
    document.body.style.overflow = 'hidden';
  }
  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
    document.body.style.overflow = '';
  }
  hamburger.addEventListener('click', () =>
    sidebar.classList.contains('open') ? closeSidebar() : openSidebar()
  );
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSidebar(); });

  /* ── Grade select → AJAX load ── */
  $('#gradeSelect').on('change', function () {
    const grade      = $(this).val();
    const statusBar  = $('#statusBar');
    const spinner    = $('#spinner');
    const submitSec  = $('#submitSection');
    const countBadge = $('#studentCount');

    if (grade) {
      spinner.show();
      $('#studentTable').html('');
      statusBar.removeClass('visible');
      submitSec.hide();

      $.ajax({
        url: 'UploadResults.php',
        method: 'POST',
        data: { grade: grade },
        success: function (response) {
          spinner.hide();
          $('#studentTable').html(response);

          const count = $('#studentTable tr').length;
          countBadge.text(count + ' student' + (count !== 1 ? 's' : ''));
          statusBar.addClass('visible');
          $('#statusText').text(count + ' students loaded for Grade ' + grade + '. Enter marks and submit.');
          submitSec.css('display', 'flex');

          /* Re-apply mobile subject filter after new rows are injected */
          applyMobileSubjectFilter();
        },
        error: function () {
          spinner.hide();
          $('#studentTable').html(
            '<tr><td colspan="12"><div class="empty-state">' +
            '<div class="empty-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>' +
            '<p>Error loading students. Please try again.</p>' +
            '</div></td></tr>'
          );
        }
      });
    } else {
      $('#studentTable').html(
        '<tr><td colspan="12"><div class="empty-state">' +
        '<div class="empty-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>' +
        '<p>Select a grade above to load students</p>' +
        '</div></td></tr>'
      );
      countBadge.text('0 students');
      statusBar.removeClass('visible');
      submitSec.hide();
    }
  });

  function clearTable() {
    $('#studentTable input[type="number"]').val('');
  }

  /* ══════════════════════════════════════════
     MOBILE SUBJECT SELECTOR
     State is kept in two variables.
     applyMobileSubjectFilter() reads them and
     toggles .hidden-col on every .col-subj cell
     (both <th> and <td>) in the table.
  ══════════════════════════════════════════ */
  let mobileSubjectMode   = 'all';   /* 'all' | 'one' */
  let mobileActiveSubject = 'MATH';  /* matches data-subj values */

  function setSubjectMode(mode) {
    mobileSubjectMode = mode;

    document.getElementById('modeAll').classList.toggle('active', mode === 'all');
    document.getElementById('modeOne').classList.toggle('active', mode === 'one');
    document.getElementById('subjectChips').classList.toggle('visible', mode === 'one');
    document.getElementById('activeSubjectBanner').classList.toggle('visible', mode === 'one');

    applyMobileSubjectFilter();
  }

  function pickSubject(el, subjKey) {
    mobileActiveSubject = subjKey;

    /* Update chip highlight */
    document.querySelectorAll('.subject-chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');

    /* Update banner label */
    document.getElementById('activeSubjectName').textContent = el.textContent.trim();

    applyMobileSubjectFilter();
  }

  function applyMobileSubjectFilter() {
    /* Target both thead <th> and tbody <td> cells */
    document.querySelectorAll('.results-table .col-subj').forEach(function(el) {
      if (mobileSubjectMode === 'all') {
        el.classList.remove('hidden-col');
      } else {
        const match = el.dataset.subj === mobileActiveSubject;
        el.classList.toggle('hidden-col', !match);
      }
    });
  }
</script>

</body>
</html>