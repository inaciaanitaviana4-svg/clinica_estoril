<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Paciente</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004999;
            --primary-light: #3385d6;
            --secondary: #00a86b;
            --accent: #ff6b35;
            --text-dark: #1a1a1a;
            --text-gray: #666;
            --text-light: #999;
            --bg-light: #f4f7fb;
            --bg-white: #fff;
            --border: #e4e9f0;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, .07);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, .10);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, .14);
            --grad: linear-gradient(135deg, #0066cc 0%, #004999 100%);
            --sidebar-w: 260px;
            --topbar-h: 64px;
            --radius: 14px;
            --trans: all .25s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── SIDEBAR ─────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            background: var(--bg-white);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 200;
            box-shadow: 4px 0 24px rgba(0, 102, 204, .06);
            transition: transform .3s ease;
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--grad);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            flex-shrink: 0;
        }

        .sidebar-logo-text {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .sidebar-logo-sub {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 400;
        }

        .sidebar-patient {
            margin: 16px 12px;
            padding: 14px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, rgba(0, 102, 204, .08), rgba(0, 73, 153, .04));
            border: 1px solid rgba(0, 102, 204, .12);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .patient-ava {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--grad);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
        }

        .patient-info-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .patient-info-role {
            font-size: 11px;
            color: var(--primary);
            font-weight: 500;
        }

        .sidebar-nav {
            flex: 1;
            padding: 8px 10px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--text-light);
            padding: 14px 10px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--trans);
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text-gray);
            text-decoration: none;
            margin-bottom: 2px;
            position: relative;
        }

        .nav-item:hover {
            background: var(--bg-light);
            color: var(--text-dark);
        }

        .nav-item.active {
            background: linear-gradient(135deg, rgba(0, 102, 204, .12), rgba(0, 102, 204, .06));
            color: var(--primary);
            font-weight: 600;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 3px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: var(--trans);
        }

        .nav-item.active .nav-icon {
            background: rgba(0, 102, 204, .15);
        }

        .nav-icon svg {
            width: 16px;
            height: 16px;
        }

        .nav-badge {
            margin-left: auto;
            background: #ff6b35;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-gray);
            transition: var(--trans);
            background: none;
            border: none;
            width: 100%;
        }

        .logout-btn:hover {
            background: #fff0ee;
            color: #c0392b;
        }

        .logout-btn svg {
            width: 16px;
            height: 16px;
        }

        /* ── MAIN ────────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── TOPBAR ──────────────────────────────── */
        .topbar {
            height: var(--topbar-h);
            background: var(--bg-white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0, 0, 0, .05);
        }

        .topbar-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--text-dark);
            flex: 1;
        }

        .topbar-subtitle {
            font-size: 12px;
            color: var(--text-light);
            font-weight: 400;
            display: block;
            font-family: 'Outfit', sans-serif;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notif-btn {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--bg-light);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--trans);
        }

        .notif-btn:hover {
            background: #eaf2ff;
            border-color: rgba(0, 102, 204, .3);
        }

        .notif-btn svg {
            width: 18px;
            height: 18px;
            color: var(--text-gray);
        }

        .notif-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            border: 2px solid var(--bg-white);
        }

        /* ── CONTENT ─────────────────────────────── */
        .content {
            flex: 1;
            padding: 28px;
            overflow-y: auto;
        }

        /* ── PAGE ────────────────────────────────── */
        .page {
            display: none;
        }

        .page.active {
            display: block;
            animation: fadeUp .3s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ── HERO CARD ───────────────────────────── */
        .hero-card {
            background: var(--grad);
            border-radius: 20px;
            padding: 28px 32px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            right: -40px;
            top: -40px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .07);
        }

        .hero-card::after {
            content: '';
            position: absolute;
            right: 60px;
            bottom: -60px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .05);
        }

        .hero-greeting {
            font-size: 13px;
            opacity: .8;
            margin-bottom: 6px;
            font-weight: 400;
        }

        .hero-name {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .hero-msg {
            font-size: 13px;
            opacity: .75;
            max-width: 380px;
            line-height: 1.5;
        }

        .hero-ava {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            border: 3px solid rgba(255, 255, 255, .4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            color: #fff;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        /* ── STATS GRID ──────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--bg-white);
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
            transition: var(--trans);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon svg {
            width: 22px;
            height: 22px;
        }

        .si-blue {
            background: #eaf2ff;
            color: var(--primary);
        }

        .si-green {
            background: #d4f7e9;
            color: var(--secondary);
        }

        .si-orange {
            background: #fff0e8;
            color: var(--accent);
        }

        .stat-val {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1;
        }

        .stat-lbl {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 3px;
            font-weight: 500;
        }

        /* ── GRID 2 COL ──────────────────────────── */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        /* ── CARD ────────────────────────────────── */
        .card {
            background: var(--bg-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title .ct-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ct-icon svg {
            width: 14px;
            height: 14px;
        }

        .card-link {
            font-size: 12px;
            color: var(--primary);
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .card-link:hover {
            text-decoration: underline;
        }

        .card-body {
            padding: 16px 20px;
        }

        /* ── PRÓXIMA CONSULTA ────────────────────── */
        .proxima-card {
            background: linear-gradient(135deg, #eaf2ff, #f4f9ff);
            border: 1px solid rgba(0, 102, 204, .15);
            border-radius: var(--radius);
            padding: 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .proxima-date-box {
            background: var(--grad);
            border-radius: 12px;
            padding: 14px 18px;
            text-align: center;
            color: #fff;
            flex-shrink: 0;
            min-width: 70px;
        }

        .proxima-date-day {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 600;
            line-height: 1;
        }

        .proxima-date-mes {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .6px;
            opacity: .85;
        }

        .proxima-info {
            flex: 1;
        }

        .proxima-tipo {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .proxima-medico {
            font-size: 13px;
            color: var(--text-gray);
            margin-bottom: 8px;
        }

        .proxima-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .chip {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .chip-blue {
            background: #eaf2ff;
            color: var(--primary);
        }

        .chip-green {
            background: #d4f7e9;
            color: #007a4c;
        }

        .chip-orange {
            background: #fff0e8;
            color: var(--accent);
        }

        .chip-gray {
            background: var(--bg-light);
            color: var(--text-gray);
        }

        /* ── CONSULTAS LIST ──────────────────────── */
        .consulta-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: var(--trans);
            border-radius: 8px;
            padding: 10px 8px;
        }

        .consulta-row:last-child {
            border-bottom: none;
        }

        .consulta-row:hover {
            background: var(--bg-light);
        }

        .cr-date-box {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--bg-light);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cr-day {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1;
        }

        .cr-mon {
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-light);
        }

        .cr-info {
            flex: 1;
        }

        .cr-tipo {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .cr-medico {
            font-size: 11px;
            color: var(--text-gray);
            margin-top: 2px;
        }

        .cr-right {
            text-align: right;
            flex-shrink: 0;
        }

        .cr-hora {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-gray);
        }

        /* ── NOTIF LIST ──────────────────────────── */
        .notif-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            transition: var(--trans);
            cursor: pointer;
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-item:hover {
            opacity: .8;
        }

        .notif-dot-wrap {
            padding-top: 4px;
            flex-shrink: 0;
        }

        .notif-dot-big {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--primary);
        }

        .notif-dot-big.lida {
            background: var(--border);
        }

        .notif-titulo {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 2px;
        }

        .notif-msg {
            font-size: 12px;
            color: var(--text-gray);
            line-height: 1.4;
        }

        .notif-data {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 3px;
        }

        /* ── BADGE ───────────────────────────────── */
        .badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .badge-realizada {
            background: #d4f7e9;
            color: #007a4c;
        }

        .badge-agendada {
            background: #eaf2ff;
            color: var(--primary);
        }

        .badge-cancelada {
            background: #fde8e8;
            color: #c0392b;
        }

        .badge-pendente {
            background: #fff3cd;
            color: #856404;
        }

        .badge-pago {
            background: #d4f7e9;
            color: #007a4c;
        }

        /* ── PAGE CONSULTAS ──────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .page-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-white);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 13px;
            color: var(--text-gray);
            transition: var(--trans);
        }

        .search-bar:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, .1);
        }

        .search-bar svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        .search-bar input {
            border: none;
            outline: none;
            background: none;
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            width: 200px;
        }

        .filter-tabs {
            display: flex;
            gap: 6px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .ftab {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid var(--border);
            background: var(--bg-white);
            cursor: pointer;
            transition: var(--trans);
            color: var(--text-gray);
        }

        .ftab.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .ftab:hover:not(.active) {
            background: var(--bg-light);
        }

        .consultas-table-wrap {
            background: var(--bg-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .ct {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .ct th {
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--text-light);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--bg-light);
        }

        .ct td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-dark);
            vertical-align: middle;
        }

        .ct tr:last-child td {
            border-bottom: none;
        }

        .ct tr:hover td {
            background: #f8fbff;
        }

        .ct-doctor {
            font-weight: 600;
        }

        .ct-sub {
            font-size: 11px;
            color: var(--text-gray);
            margin-top: 2px;
        }

        .btn-detalhe {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 7px;
            background: #eaf2ff;
            color: var(--primary);
            border: none;
            cursor: pointer;
            transition: var(--trans);
        }

        .btn-detalhe:hover {
            background: var(--primary);
            color: #fff;
        }

        /* ── MODAL ───────────────────────────────── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .45);
            z-index: 500;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.open {
            display: flex;
            animation: fadeIn .2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .modal {
            background: var(--bg-white);
            border-radius: 20px;
            width: 90%;
            max-width: 680px;
            max-height: 88vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
            animation: slideUp .25s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0
            }

            to {
                transform: translateY(0);
                opacity: 1
            }
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            background: var(--grad);
            color: #fff;
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            font-weight: 600;
        }

        .modal-meta {
            font-size: 12px;
            opacity: .8;
            margin-top: 3px;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: rgba(255, 255, 255, .2);
            border: none;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--trans);
            flex-shrink: 0;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, .35);
        }

        .modal-close svg {
            width: 16px;
            height: 16px;
        }

        .modal-body {
            padding: 24px;
            overflow-y: auto;
        }

        .modal-section {
            margin-bottom: 20px;
        }

        .modal-section:last-child {
            margin-bottom: 0;
        }

        .modal-section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--text-light);
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }

        .diag-item {
            display: flex;
            gap: 8px;
            padding: 6px 0;
            font-size: 13px;
            color: var(--text-dark);
            align-items: flex-start;
        }

        .diag-bullet {
            width: 7px;
            height: 7px;
            min-width: 7px;
            background: var(--primary);
            border-radius: 50%;
            margin-top: 5px;
        }

        .exame-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            background: var(--bg-light);
            border-radius: 8px;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .exame-row:last-child {
            margin-bottom: 0;
        }

        .exame-nome {
            font-weight: 600;
            color: var(--text-dark);
        }

        .exame-res {
            font-size: 12px;
            color: var(--text-gray);
            margin-top: 2px;
        }

        .med-item {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 8px;
            padding: 12px;
            border-radius: 10px;
            background: var(--bg-light);
            margin-bottom: 8px;
        }

        .med-item:last-child {
            margin-bottom: 0;
        }

        .med-name {
            font-size: 13px;
            font-weight: 600;
            grid-column: 1/-1;
            margin-bottom: 4px;
        }

        .med-detail {
            font-size: 12px;
            color: var(--text-gray);
        }

        .med-detail span {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .obs-box {
            background: #fffbf0;
            border-left: 3px solid var(--accent);
            padding: 10px 14px;
            border-radius: 0 8px 8px 0;
            font-size: 13px;
            color: var(--text-gray);
            font-style: italic;
        }

        .pagamento-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            background: var(--bg-light);
            border-radius: 8px;
            font-size: 13px;
        }

        .pagamento-val {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: var(--text-light);
            font-size: 13px;
        }

        /* ── PAGE NOTIFICAÇÕES ───────────────────── */
        .notif-full-item {
            background: var(--bg-white);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 10px;
            display: flex;
            gap: 14px;
            cursor: pointer;
            transition: var(--trans);
        }

        .notif-full-item:hover {
            border-color: rgba(0, 102, 204, .25);
            box-shadow: var(--shadow-sm);
        }

        .notif-full-item.nao-lida {
            border-left: 4px solid var(--primary);
        }

        .nfi-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #eaf2ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nfi-icon svg {
            width: 18px;
            height: 18px;
        }

        .nfi-titulo {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .nfi-msg {
            font-size: 13px;
            color: var(--text-gray);
            line-height: 1.5;
        }

        .nfi-data {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 6px;
        }

        /* ── SKELETON ────────────────────────────── */
        .skel {
            background: linear-gradient(90deg, #f0f0f0 25%, #e4e4e4 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shim 1.4s infinite;
            border-radius: 6px;
        }

        @keyframes shim {
            0% {
                background-position: 200% 0
            }

            100% {
                background-position: -200% 0
            }
        }

        /* ── EMPTY ───────────────────────────────── */
        .empty {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }

        .empty svg {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            opacity: .3;
            display: block;
        }

        .empty p {
            font-size: 13px;
        }

        /* ── SCROLLBAR ───────────────────────────── */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #dde3ed;
            border-radius: 10px;
        }

        /* ── RESPONSIVE ──────────────────────────── */
        @media(max-width:900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }

            .proxima-card {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media(max-width:600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">C</div>
            <div>
                <div class="sidebar-logo-text">ClinicaPro</div>
                <div class="sidebar-logo-sub">Portal do Paciente</div>
            </div>
        </div>

        <div class="sidebar-patient">
            <div class="patient-ava" id="sidebarInitials">—</div>
            <div>
                <div class="patient-info-name" id="sidebarNome">Carregando...</div>
                <div class="patient-info-role">Paciente</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu</div>
            <a class="nav-item active" onclick="showPage('dashboard')" href="#">
                <div class="nav-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                </div>
                Visão Geral
            </a>
            <a class="nav-item" onclick="showPage('consultas')" href="#">
                <div class="nav-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                Minhas Consultas
            </a>
            <a class="nav-item" onclick="showPage('notificacoes')" href="#">
                <div class="nav-icon">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                Notificações
                <span class="nav-badge" id="navBadge" style="display:none">0</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <button class="logout-btn">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Terminar Sessão
            </button>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <header class="topbar">
            <div>
                <div class="topbar-title" id="topbarTitle">Visão Geral</div>
            </div>
            <div class="topbar-actions">
                <div class="notif-btn" onclick="showPage('notificacoes')" title="Notificações">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <div class="notif-dot" id="topbarDot" style="display:none"></div>
                </div>
            </div>
        </header>

        <div class="content">

            <!-- ══ PAGE: DASHBOARD ══════════════════ -->
            <div class="page active" id="page-dashboard">

                <div class="hero-card">
                    <div>
                        <div class="hero-greeting">Bem-vindo de volta 👋</div>
                        <div class="hero-name" id="heroNome">—</div>
                        <div class="hero-msg">Acompanhe as suas consultas, exames e histórico clínico num só lugar.</div>
                    </div>
                    <div class="hero-ava" id="heroAva">—</div>
                </div>

                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon si-blue">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <div class="stat-val" id="statTotal">—</div>
                            <div class="stat-lbl">Total de Consultas</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-green">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="stat-val" id="statRealizadas">—</div>
                            <div class="stat-lbl">Realizadas</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-orange">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="stat-val" id="statAgendadas">—</div>
                            <div class="stat-lbl">Agendadas</div>
                        </div>
                    </div>
                </div>

                <!-- Próxima consulta -->
                <div id="proximaWrap"></div>

                <!-- Consultas recentes + Notificações -->
                <div class="grid-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="ct-icon si-blue" style="background:#eaf2ff">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="#0066cc" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                                    </svg>
                                </div>
                                Consultas Recentes
                            </div>
                            <a class="card-link" onclick="showPage('consultas')">Ver todas</a>
                        </div>
                        <div class="card-body" id="dashConsultasRecentes">
                            <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;"></div>
                            <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;opacity:.7"></div>
                            <div class="skel" style="height:44px;border-radius:10px;opacity:.4"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="ct-icon" style="background:#fff0e8">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="#ff6b35" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                Notificações Recentes
                            </div>
                            <a class="card-link" onclick="showPage('notificacoes')">Ver todas</a>
                        </div>
                        <div class="card-body" id="dashNotificacoes">
                            <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;"></div>
                            <div class="skel" style="height:44px;margin-bottom:8px;border-radius:10px;opacity:.7"></div>
                            <div class="skel" style="height:44px;border-radius:10px;opacity:.4"></div>
                        </div>
                    </div>
                </div>

            </div><!-- /page-dashboard -->

            <!-- ══ PAGE: CONSULTAS ══════════════════ -->
            <div class="page" id="page-consultas">
                <div class="page-header">
                    <h2>Minhas Consultas</h2>
                    <div class="search-bar">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" id="searchInput" placeholder="Pesquisar consulta..." oninput="filtrarConsultas()">
                    </div>
                </div>

                <div class="filter-tabs">
                    <div class="ftab active" onclick="setFiltro('todos',this)">Todos</div>
                    <div class="ftab" onclick="setFiltro('agendada',this)">Agendadas</div>
                    <div class="ftab" onclick="setFiltro('concluida',this)">Concluídas</div>
                    <div class="ftab" onclick="setFiltro('cancelada',this)">Canceladas</div>
                </div>

                <div class="consultas-table-wrap">
                    <table class="ct">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Tipo / Serviço</th>
                                <th>Médico</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="consultasTableBody">
                            <tr>
                                <td colspan="5" class="no-data">A carregar...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /page-consultas -->

            <!-- ══ PAGE: NOTIFICAÇÕES ═══════════════ -->
            <div class="page" id="page-notificacoes">
                <div class="page-header">
                    <h2>Notificações</h2>
                    <button class="btn-detalhe" onclick="marcarTodasLidas()" style="padding:8px 16px;font-size:12px;">Marcar todas como lidas</button>
                </div>
                <div id="notificacoesLista">
                    <div class="skel" style="height:80px;margin-bottom:10px;border-radius:12px;"></div>
                    <div class="skel" style="height:80px;margin-bottom:10px;border-radius:12px;opacity:.7"></div>
                </div>
            </div><!-- /page-notificacoes -->

        </div><!-- /content -->
    </div><!-- /main -->

    <!-- MODAL DETALHES DA CONSULTA -->
    <div class="modal-overlay" id="modalOverlay" onclick="fecharModal(event)">
        <div class="modal" id="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-title" id="modalTitulo">Detalhes da Consulta</div>
                    <div class="modal-meta" id="modalMeta">—</div>
                </div>
                <button class="modal-close" onclick="fecharModalDireto()">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="modalBody"></div>
        </div>
    </div>

    <script>
        // ════════════════════════════════════════════════════════
        //  ⚙️  CONFIGURAÇÃO
        // ════════════════════════════════════════════════════════
        const API_BASE = 'https://SUA_URL_AQUI/api';
        const PACIENTE_ID = /* Ex: valor injectado pelo PHP: */ 1;
        //
        //  Endpoints esperados:
        //  GET {API_BASE}/paciente/{id}/dashboard
        //    → { paciente:{nome,...}, stats:{total,realizadas,agendadas},
        //        proxima_consulta:{...}, consultas:[...], notificacoes:[...] }
        //
        //  GET {API_BASE}/consulta/{id}
        //    → { ...consulta, diagnosticos:[...], exames:[...],
        //        receitas:[...], pagamento:{...} }
        //
        //  PATCH {API_BASE}/notificacao/{id}/lida  (marcar como lida)
        //  PATCH {API_BASE}/notificacoes/lidas     (marcar todas como lidas)
        // ════════════════════════════════════════════════════════

        // ── Estado global ─────────────────────────────────────
        let _todasConsultas = [];
        let _filtroAtual = 'todos';
        let _notificacoes = [];

        // ── Utilitários ───────────────────────────────────────
        const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        const mesesFull = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

        function fmtData(d) {
            if (!d) return '—';
            const [y, m, day] = d.split('-');
            return `${day}/${m}/${y}`;
        }

        function iniciais(nome = '') {
            return nome.split(' ').filter(Boolean).slice(0, 2).map(n => n[0].toUpperCase()).join('');
        }

        function badgeClass(e = '') {
            const v = e.toLowerCase();
            if (v === 'concluida' || v === 'realizada') return 'badge-realizada';
            if (v === 'cancelada') return 'badge-cancelada';
            if (v === 'pendente') return 'badge-pendente';
            return 'badge-agendada';
        }

        function badgeLabel(e = '') {
            const v = e.toLowerCase();
            if (v === 'concluida') return 'Concluída';
            if (v === 'cancelada') return 'Cancelada';
            if (v === 'agendada') return 'Agendada';
            return e;
        }

        // ── Navegação ─────────────────────────────────────────
        const pageTitles = {
            dashboard: 'Visão Geral',
            consultas: 'Minhas Consultas',
            notificacoes: 'Notificações',
        };

        function showPage(id) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            document.getElementById('page-' + id).classList.add('active');
            document.querySelector(`[onclick="showPage('${id}')"]`).classList.add('active');
            document.getElementById('topbarTitle').textContent = pageTitles[id];
            return false;
        }

        // ── Init principal ────────────────────────────────────
        async function init() {
            try {
                const res = await fetch(`${API_BASE}/paciente/${PACIENTE_ID}/dashboard`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const data = await res.json();

                renderPaciente(data.paciente);
                renderStats(data.stats);
                renderProximaConsulta(data.proxima_consulta);
                renderDashConsultasRecentes(data.consultas?.slice(0, 5) || []);
                renderDashNotificacoes(data.notificacoes?.slice(0, 4) || []);
                renderConsultasTabela(data.consultas || []);
                renderNotificacoesPage(data.notificacoes || []);

                _todasConsultas = data.consultas || [];
                _notificacoes = data.notificacoes || [];

                // Badge de notificações não lidas
                const naoLidas = (_notificacoes).filter(n => !n.lida).length;
                if (naoLidas > 0) {
                    document.getElementById('navBadge').textContent = naoLidas;
                    document.getElementById('navBadge').style.display = 'inline-block';
                    document.getElementById('topbarDot').style.display = 'block';
                }

            } catch (err) {
                console.error('Erro ao carregar dashboard:', err);
            }
        }

        // ── Render paciente ───────────────────────────────────
        function renderPaciente(p = {}) {
            const nome = p.nome || 'Paciente';
            document.getElementById('sidebarInitials').textContent = iniciais(nome);
            document.getElementById('sidebarNome').textContent = nome.split(' ')[0] + ' ' + (nome.split(' ').slice(-1)[0] || '');
            document.getElementById('heroNome').textContent = nome;
            document.getElementById('heroAva').textContent = iniciais(nome);
        }

        // ── Render stats ──────────────────────────────────────
        function renderStats(s = {}) {
            document.getElementById('statTotal').textContent = s.total ?? '0';
            document.getElementById('statRealizadas').textContent = s.realizadas ?? '0';
            document.getElementById('statAgendadas').textContent = s.agendadas ?? '0';
        }

        // ── Próxima consulta ──────────────────────────────────
        function renderProximaConsulta(c) {
            const wrap = document.getElementById('proximaWrap');
            if (!c) {
                wrap.innerHTML = '';
                return;
            }

            const d = c.data ? c.data.split('-') : ['?', '?', '?'];
            const dia = d[2] || '—';
            const mes = d[1] ? mesesFull[parseInt(d[1]) - 1] : '—';

            wrap.innerHTML = `
            <div class="proxima-card" style="margin-bottom:24px">
            <div class="proxima-date-box">
                <div class="proxima-date-day">${dia}</div>
                <div class="proxima-date-mes">${mes}</div>
            </div>
            <div class="proxima-info">
                <div class="proxima-tipo">Próxima Consulta: ${c.tipo_consulta || c.servico || '—'}</div>
                <div class="proxima-medico">Dr(a). ${c.medico || '—'}</div>
                <div class="proxima-chips">
                <span class="chip chip-blue">${c.hora || '—'}</span>
                <span class="chip chip-gray">${c.modalidade || 'Presencial'}</span>
                <span class="chip chip-green">Agendada</span>
                </div>
            </div>
            </div>`;
        }

        // ── Consultas recentes no dashboard ───────────────────
        function renderDashConsultasRecentes(lista) {
            const el = document.getElementById('dashConsultasRecentes');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem consultas registadas.</div>';
                return;
            }

            el.innerHTML = lista.map(c => {
                const partes = c.data ? c.data.split('-') : [];
                const dia = partes[2] || '—';
                const mon = partes[1] ? meses[parseInt(partes[1]) - 1] : '—';
                return `
                <div class="consulta-row" onclick="abrirModal(${c.id})">
                    <div class="cr-date-box">
                    <div class="cr-day">${dia}</div>
                    <div class="cr-mon">${mon}</div>
                    </div>
                    <div class="cr-info">
                    <div class="cr-tipo">${c.tipo_consulta || c.servico || '—'}</div>
                    <div class="cr-medico">${c.medico || '—'}</div>
                    </div>
                    <div class="cr-right">
                    <div class="cr-hora">${c.hora || ''}</div>
                    <div style="margin-top:4px"><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></div>
                    </div>
                </div>`;
                        }).join('');
        }

        // ── Notificações no dashboard ─────────────────────────
        function renderDashNotificacoes(lista) {
            const el = document.getElementById('dashNotificacoes');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem notificações.</div>';
                return;
            }

            el.innerHTML = lista.map(n => `
            <div class="notif-item" onclick="marcarLida(${n.id})">
            <div class="notif-dot-wrap">
                <div class="notif-dot-big ${n.lida ? 'lida' : ''}"></div>
            </div>
            <div>
                <div class="notif-titulo">${n.titulo || '—'}</div>
                <div class="notif-msg">${n.mensagem || ''}</div>
                <div class="notif-data">${fmtData(n.data)}</div>
            </div>
            </div>`).join('');
        }

        // ── Tabela de consultas ───────────────────────────────
        function renderConsultasTabela(lista) {
            _todasConsultas = lista;
            filtrarConsultas();
        }

        function filtrarConsultas() {
            const q = (document.getElementById('searchInput')?.value || '').toLowerCase();
            const lista = _todasConsultas.filter(c => {
                const matchFiltro = _filtroAtual === 'todos' || (c.estado || '').toLowerCase() === _filtroAtual;
                const matchSearch = !q ||
                    (c.medico || '').toLowerCase().includes(q) ||
                    (c.tipo_consulta || '').toLowerCase().includes(q) ||
                    (c.servico || '').toLowerCase().includes(q);
                return matchFiltro && matchSearch;
            });

            const tbody = document.getElementById('consultasTableBody');
            if (!lista.length) {
                tbody.innerHTML = `<tr><td colspan="5" class="no-data">Nenhuma consulta encontrada.</td></tr>`;
                return;
            }

            tbody.innerHTML = lista.map(c => `
            <tr>
            <td><strong>${fmtData(c.data)}</strong><div class="ct-sub">${c.hora || ''}</div></td>
            <td>
                <div class="ct-doctor">${c.tipo_consulta || '—'}</div>
                <div class="ct-sub">${c.servico || ''}</div>
            </td>
            <td>
                <div class="ct-doctor">${c.medico || '—'}</div>
                <div class="ct-sub">${c.modalidade || 'Presencial'}</div>
            </td>
            <td><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></td>
            <td><button class="btn-detalhe" onclick="abrirModal(${c.id})">Ver detalhes</button></td>
            </tr>`).join('');
        }

        function setFiltro(val, el) {
            _filtroAtual = val;
            document.querySelectorAll('.ftab').forEach(f => f.classList.remove('active'));
            el.classList.add('active');
            filtrarConsultas();
        }

        // ── Página de notificações ────────────────────────────
        function renderNotificacoesPage(lista) {
            _notificacoes = lista;
            const el = document.getElementById('notificacoesLista');
            if (!lista.length) {
                el.innerHTML = '<div class="empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg><p>Sem notificações por agora.</p></div>';
                return;
            }

            el.innerHTML = lista.map(n => `
            <div class="notif-full-item ${!n.lida ? 'nao-lida' : ''}" onclick="marcarLida(${n.id}, this)">
            <div class="nfi-icon">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
            <div style="flex:1">
                <div class="nfi-titulo">${n.titulo || '—'}</div>
                <div class="nfi-msg">${n.mensagem || ''}</div>
                <div class="nfi-data">${fmtData(n.data)}</div>
            </div>
            ${!n.lida ? '<span class="badge badge-agendada" style="flex-shrink:0;align-self:flex-start">Nova</span>' : ''}
            </div>`).join('');
        }

        // ── Marcar notificação como lida ──────────────────────
        async function marcarLida(id, el) {
            try {
                await fetch(`${API_BASE}/notificacao/${id}/lida`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (el) {
                    el.classList.remove('nao-lida');
                    el.querySelector('.badge')?.remove();
                }
                const n = _notificacoes.find(x => x.id === id);
                if (n) n.lida = true;
            } catch (e) {
                console.warn('Não foi possível marcar notificação:', e);
            }
        }

        async function marcarTodasLidas() {
            try {
                await fetch(`${API_BASE}/notificacoes/lidas`, {
                    method: 'PATCH',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                _notificacoes.forEach(n => n.lida = true);
                renderNotificacoesPage(_notificacoes);
                document.getElementById('navBadge').style.display = 'none';
                document.getElementById('topbarDot').style.display = 'none';
            } catch (e) {
                console.warn(e);
            }
        }

        // ── Modal de detalhes ─────────────────────────────────
        async function abrirModal(consultaId) {
            document.getElementById('modalBody').innerHTML = `
            <div class="skel" style="height:20px;width:50%;margin-bottom:12px;"></div>
            <div class="skel" style="height:14px;margin-bottom:8px;"></div>
            <div class="skel" style="height:14px;width:70%;margin-bottom:24px;"></div>
            <div class="skel" style="height:80px;border-radius:10px;"></div>`;
            document.getElementById('modalOverlay').classList.add('open');

            try {
                const res = await fetch(`${API_BASE}/consulta/${consultaId}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const c = await res.json();
                renderModalConteudo(c);
            } catch (e) {
                document.getElementById('modalBody').innerHTML = `<div class="no-data" style="color:#c0392b">Erro ao carregar detalhes.</div>`;
            }
        }

        function renderModalConteudo(c) {
            document.getElementById('modalTitulo').textContent = c.tipo_consulta || c.servico || 'Consulta';
            document.getElementById('modalMeta').textContent = `${fmtData(c.data)}${c.hora ? ' · ' + c.hora : ''} · Dr(a). ${c.medico || '—'}`;

            const diags = c.diagnosticos || [];
            const exames = c.exames || [];
            const receitas = c.receitas || [];
            const pag = c.pagamento;

            document.getElementById('modalBody').innerHTML = `
            ${c.observacao ? `
            <div class="modal-section">
            <div class="modal-section-title">Observação</div>
            <div class="obs-box">${c.observacao}</div>
            </div>` : ''}

            <div class="modal-section">
            <div class="modal-section-title">Diagnósticos</div>
            ${diags.length
                ? diags.map(d=>`<div class="diag-item"><div class="diag-bullet"></div><div>${d.descricao}</div></div>`).join('')
                : '<div class="no-data">Nenhum diagnóstico registado.</div>'}
            </div>

            <div class="modal-section">
            <div class="modal-section-title">Exames Solicitados</div>
            ${exames.length
                ? exames.map(e=>`
                    <div class="exame-row">
                    <div>
                        <div class="exame-nome">${e.servico_clinico || '—'}</div>
                        <div class="exame-res">${e.resultado || 'Aguarda resultado'}</div>
                    </div>
                    <span class="badge ${e.status?.toLowerCase().includes('conclu') ? 'badge-realizada' : 'badge-pendente'}">${e.status || '—'}</span>
                    </div>`).join('')
                : '<div class="no-data">Nenhum exame solicitado.</div>'}
            </div>

            <div class="modal-section">
            <div class="modal-section-title">Receita</div>
            ${receitas.length
                ? receitas.map(r=>`
                    ${r.observacoes ? `<div class="obs-box" style="margin-bottom:12px">${r.observacoes}</div>` : ''}
                    ${(r.itens||[]).map(i=>`
                    <div class="med-item">
                        <div class="med-name">💊 ${i.medicamento||'—'}</div>
                        <div class="med-detail"><span>Dosagem</span>${i.dosagem||'—'}</div>
                        <div class="med-detail"><span>Frequência</span>${i.frequencia||'—'}</div>
                        <div class="med-detail"><span>Duração</span>${i.duracao||'—'}</div>
                    </div>`).join('')}`).join('')
                : '<div class="no-data">Sem receita emitida.</div>'}
            </div>

            ${pag ? `
            <div class="modal-section">
            <div class="modal-section-title">Pagamento</div>
            <div class="pagamento-row">
                <div>
                <div style="font-size:12px;color:var(--text-gray)">Método</div>
                <div style="font-weight:600">${pag.metodo || '—'}</div>
                </div>
                <div style="text-align:right">
                <div class="pagamento-val">${Number(pag.total_pago||0).toLocaleString('pt-AO')} Kz</div>
                <span class="badge ${pag.estado?.toLowerCase()==='pago'?'badge-pago':'badge-pendente'}">${pag.estado||'—'}</span>
                </div>
            </div>
            </div>` : ''}
        `;
        }

        function fecharModal(e) {
            if (e.target === document.getElementById('modalOverlay')) fecharModalDireto();
        }

        function fecharModalDireto() {
            document.getElementById('modalOverlay').classList.remove('open');
        }

        // ── Arranque ──────────────────────────────────────────
        init();
    </script>
</body>

</html>
