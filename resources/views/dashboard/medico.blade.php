<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Médico</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004999;
            --primary-light: #3385d6;
            --secondary: #00a86b;
            --accent: #ff6b35;
            --teal: #0891b2;
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
            --grad-teal: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
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

        /* ── SIDEBAR ───────────────────────────── */
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

        .sidebar-user {
            margin: 16px 12px;
            padding: 14px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, rgba(8, 145, 178, .08), rgba(14, 116, 144, .04));
            border: 1px solid rgba(8, 145, 178, .15);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-ava {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--grad-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            flex-shrink: 0;
            font-family: 'Playfair Display', serif;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .user-role {
            font-size: 11px;
            color: var(--teal);
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
            background: linear-gradient(135deg, rgba(8, 145, 178, .12), rgba(8, 145, 178, .05));
            color: var(--teal);
            font-weight: 600;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 3px;
            background: var(--teal);
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
        }

        .nav-item.active .nav-icon {
            background: rgba(8, 145, 178, .15);
        }

        .nav-icon svg {
            width: 16px;
            height: 16px;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--accent);
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

        /* ── MAIN ──────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        .topbar-date {
            font-size: 12px;
            color: var(--text-light);
        }

        .content {
            flex: 1;
            padding: 28px;
            overflow-y: auto;
        }

        /* ── PAGE ──────────────────────────────── */
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
                transform: translateY(10px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* ── HERO ──────────────────────────────── */
        .hero-card {
            background: var(--grad-teal);
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
        }

        .hero-name {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .hero-espec {
            font-size: 13px;
            opacity: .7;
            margin-bottom: 8px;
        }

        .hero-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .hero-chip {
            background: rgba(255, 255, 255, .2);
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            color: #fff;
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

        /* ── STATS ─────────────────────────────── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--bg-white);
            border-radius: var(--radius);
            padding: 18px 20px;
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

        .si-teal {
            background: #e0f7fa;
            color: var(--teal);
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

        /* ── GRID ──────────────────────────────── */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .grid-3-1 {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        /* ── CARD ──────────────────────────────── */
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

        .ct-icon {
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
            color: var(--teal);
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

        /* ── CONSULTAS DO DIA ──────────────────── */
        .consulta-dia-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--trans);
            margin-bottom: 4px;
            border: 1px solid transparent;
        }

        .consulta-dia-item:hover {
            background: var(--bg-light);
            border-color: var(--border);
        }

        .consulta-dia-item.proxima {
            background: linear-gradient(135deg, rgba(8, 145, 178, .06), rgba(8, 145, 178, .02));
            border-color: rgba(8, 145, 178, .2);
        }

        .cdi-hora {
            width: 46px;
            text-align: center;
            flex-shrink: 0;
        }

        .cdi-hora-val {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .cdi-hora-lbl {
            font-size: 10px;
            color: var(--text-light);
            font-weight: 500;
        }

        .cdi-divider {
            width: 2px;
            height: 36px;
            background: var(--border);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .cdi-divider.teal {
            background: var(--teal);
        }

        .cdi-info {
            flex: 1;
        }

        .cdi-nome {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .cdi-tipo {
            font-size: 11px;
            color: var(--text-gray);
            margin-top: 2px;
        }

        .cdi-right {
            flex-shrink: 0;
            text-align: right;
        }

        /* ── HORÁRIOS ──────────────────────────── */
        .horario-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
        }

        .dia-col {
            text-align: center;
        }

        .dia-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-light);
            margin-bottom: 6px;
            letter-spacing: .4px;
        }

        .dia-slot {
            padding: 6px 4px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 4px;
        }

        .slot-active {
            background: linear-gradient(135deg, rgba(8, 145, 178, .15), rgba(8, 145, 178, .08));
            color: var(--teal);
            border: 1px solid rgba(8, 145, 178, .2);
        }

        .slot-inactive {
            background: var(--bg-light);
            color: var(--text-light);
            border: 1px solid var(--border);
        }

        .dia-col.hoje .dia-label {
            color: var(--teal);
        }

        .dia-col.hoje .dia-label span {
            display: inline-block;
            background: var(--teal);
            color: #fff;
            border-radius: 4px;
            padding: 1px 5px;
        }

        /* ── PACIENTES RECENTES (prontuários) ──── */
        .paciente-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: var(--trans);
        }

        .paciente-row:last-child {
            border-bottom: none;
        }

        .paciente-row:hover {
            opacity: .8;
        }

        .pac-ava {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--grad);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .pac-nome {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .pac-sub {
            font-size: 11px;
            color: var(--text-gray);
            margin-top: 1px;
        }

        .pac-data {
            font-size: 11px;
            color: var(--text-light);
            margin-left: auto;
            flex-shrink: 0;
        }

        /* ── PAGE CONSULTAS ────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
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
            transition: var(--trans);
        }

        .search-bar:focus-within {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(8, 145, 178, .1);
        }

        .search-bar svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            color: var(--text-light);
        }

        .search-bar input {
            border: none;
            outline: none;
            background: none;
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            width: 180px;
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
            background: var(--teal);
            color: #fff;
            border-color: var(--teal);
        }

        .ftab:hover:not(.active) {
            background: var(--bg-light);
        }

        .table-wrap {
            background: var(--bg-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .ct-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .ct-table th {
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

        .ct-table td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .ct-table tr:last-child td {
            border-bottom: none;
        }

        .ct-table tr:hover td {
            background: #f5fbfd;
        }

        .btn-sm {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            transition: var(--trans);
        }

        .btn-teal {
            background: #e0f7fa;
            color: var(--teal);
        }

        .btn-teal:hover {
            background: var(--teal);
            color: #fff;
        }

        .btn-blue {
            background: #eaf2ff;
            color: var(--primary);
        }

        .btn-blue:hover {
            background: var(--primary);
            color: #fff;
        }

        /* ── PAGE HORÁRIOS ─────────────────────── */
        .horarios-full-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .hfg-col {
            background: var(--bg-white);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .hfg-col.hoje-col {
            border-color: var(--teal);
            box-shadow: 0 0 0 2px rgba(8, 145, 178, .15);
        }

        .hfg-dia-header {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid var(--border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--text-light);
        }

        .hfg-col.hoje-col .hfg-dia-header {
            background: var(--grad-teal);
            color: #fff;
        }

        .hfg-slots {
            padding: 8px;
        }

        .hfg-slot {
            padding: 8px 10px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .hfg-slot:last-child {
            margin-bottom: 0;
        }

        .hfg-slot.activo {
            background: linear-gradient(135deg, rgba(8, 145, 178, .12), rgba(8, 145, 178, .06));
            color: var(--teal);
            border: 1px solid rgba(8, 145, 178, .2);
        }

        .hfg-slot.inactivo {
            background: var(--bg-light);
            color: var(--text-light);
            border: 1px solid var(--border);
        }

        .hfg-empty {
            padding: 16px;
            text-align: center;
            color: var(--text-light);
            font-size: 12px;
        }

        /* ── MODAL ─────────────────────────────── */
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
            max-width: 700px;
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
            background: var(--grad-teal);
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
            background: var(--teal);
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

        .pac-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 16px;
        }

        .pac-info-item label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--text-light);
            margin-bottom: 3px;
        }

        .pac-info-item span {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
        }

        /* ── BADGES ────────────────────────────── */
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

        .badge-activo {
            background: #d4f7e9;
            color: #007a4c;
        }

        .badge-inactivo {
            background: var(--bg-light);
            color: var(--text-light);
        }

        /* ── SKELETON / EMPTY ──────────────────── */
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

        .no-data {
            text-align: center;
            padding: 20px;
            color: var(--text-light);
            font-size: 13px;
        }

        .empty {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-light);
        }

        .empty svg {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            opacity: .25;
            display: block;
        }

        .empty p {
            font-size: 13px;
        }

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

        @media(max-width:1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main {
                margin-left: 0;
            }

            .grid-2,
            .grid-3-1 {
                grid-template-columns: 1fr;
            }

            .horarios-full-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media(max-width:600px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .horarios-full-grid {
                grid-template-columns: repeat(2, 1fr);
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
                <div class="sidebar-logo-sub">Portal do Médico</div>
            </div>
        </div>
        <div class="sidebar-user">
            <div class="user-ava" id="sidebarInitials">—</div>
            <div>
                <div class="user-name" id="sidebarNome">Carregando...</div>
                <div class="user-role" id="sidebarEspec">Médico</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu</div>
            <a class="nav-item active" onclick="showPage('dashboard');return false;" href="#">
                <div class="nav-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg></div>
                Visão Geral
            </a>
            <a class="nav-item" onclick="showPage('consultas');return false;" href="#">
                <div class="nav-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg></div>
                Minhas Consultas
            </a>
            <a class="nav-item" onclick="showPage('prontuarios');return false;" href="#">
                <div class="nav-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                    </svg></div>
                Prontuários
            </a>
            <a class="nav-item" onclick="showPage('horarios');return false;" href="#">
                <div class="nav-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg></div>
                Meus Horários
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
            <div class="topbar-title" id="topbarTitle">Visão Geral</div>
            <div class="topbar-date" id="topbarDate"></div>
        </header>

        <div class="content">

            <!-- ══ DASHBOARD ══════════════════════ -->
            <div class="page active" id="page-dashboard">

                <div class="hero-card">
                    <div>
                        <div class="hero-greeting">Bom dia 👨‍⚕️</div>
                        <div class="hero-name" id="heroNome">—</div>
                        <div class="hero-espec" id="heroEspec">—</div>
                        <div class="hero-chips">
                            <span class="hero-chip" id="heroExp">— anos de experiência</span>
                            <span class="hero-chip" id="heroConsultasHoje">— consultas hoje</span>
                        </div>
                    </div>
                    <div class="hero-ava" id="heroAva">—</div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon si-teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statHoje">—</div>
                            <div class="stat-lbl">Consultas Hoje</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statMes">—</div>
                            <div class="stat-lbl">Consultas no Mês</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statPacientes">—</div>
                            <div class="stat-lbl">Pacientes Atendidos</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statConcluidas">—</div>
                            <div class="stat-lbl">Concluídas (Mês)</div>
                        </div>
                    </div>
                </div>

                <div class="grid-3-1">
                    <!-- Consultas do dia -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="ct-icon si-teal"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg></div>
                                Agenda de Hoje
                            </div>
                            <a class="card-link" onclick="showPage('consultas');return false;">Ver todas</a>
                        </div>
                        <div class="card-body" id="agendaHoje">
                            <div class="skel" style="height:52px;border-radius:10px;margin-bottom:6px;"></div>
                            <div class="skel" style="height:52px;border-radius:10px;margin-bottom:6px;opacity:.7"></div>
                            <div class="skel" style="height:52px;border-radius:10px;opacity:.4"></div>
                        </div>
                    </div>

                    <!-- Horário resumo -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="ct-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg></div>
                                Esta Semana
                            </div>
                            <a class="card-link" onclick="showPage('horarios');return false;">Detalhe</a>
                        </div>
                        <div class="card-body" id="horarioResumo">
                            <div class="horario-grid" id="horarioMini"></div>
                        </div>
                    </div>
                </div>

                <!-- Prontuários recentes -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="ct-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0" />
                                </svg></div>
                            Pacientes Recentes
                        </div>
                        <a class="card-link" onclick="showPage('prontuarios');return false;">Ver prontuários</a>
                    </div>
                    <div class="card-body" id="pacientesRecentes">
                        <div class="skel" style="height:36px;margin-bottom:8px;border-radius:8px;"></div>
                        <div class="skel" style="height:36px;margin-bottom:8px;border-radius:8px;opacity:.7"></div>
                        <div class="skel" style="height:36px;border-radius:8px;opacity:.4"></div>
                    </div>
                </div>
            </div>

            <!-- ══ CONSULTAS ══════════════════════ -->
            <div class="page" id="page-consultas">
                <div class="page-header">
                    <h2>Minhas Consultas</h2>
                    <div class="search-bar">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" id="consultaSearch" placeholder="Pesquisar paciente..." oninput="filtrarConsultas()">
                    </div>
                </div>
                <div class="filter-tabs">
                    <div class="ftab active" onclick="setFiltroConsulta('todos',this)">Todas</div>
                    <div class="ftab" onclick="setFiltroConsulta('agendada',this)">Agendadas</div>
                    <div class="ftab" onclick="setFiltroConsulta('concluida',this)">Concluídas</div>
                    <div class="ftab" onclick="setFiltroConsulta('cancelada',this)">Canceladas</div>
                </div>
                <div class="table-wrap">
                    <table class="ct-table">
                        <thead>
                            <tr>
                                <th>Data / Hora</th>
                                <th>Paciente</th>
                                <th>Tipo / Serviço</th>
                                <th>Modalidade</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="consultasTbody">
                            <tr>
                                <td colspan="6" class="no-data">A carregar...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ══ PRONTUÁRIOS ════════════════════ -->
            <div class="page" id="page-prontuarios">
                <div class="page-header">
                    <h2>Prontuários dos Pacientes</h2>
                    <div class="search-bar">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                        </svg>
                        <input type="text" id="prontuarioSearch" placeholder="Pesquisar paciente..." oninput="filtrarProntuarios()">
                    </div>
                </div>
                <div class="table-wrap">
                    <table class="ct-table">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Idade</th>
                                <th>Género</th>
                                <th>Última Consulta</th>
                                <th>Total Consultas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="prontuariosTbody">
                            <tr>
                                <td colspan="6" class="no-data">A carregar...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ══ HORÁRIOS ═══════════════════════ -->
            <div class="page" id="page-horarios">
                <div class="page-header">
                    <h2>Meus Horários</h2>
                </div>
                <div class="horarios-full-grid" id="horariosGrid">
                    <div class="skel" style="height:200px;border-radius:14px;"></div>
                    <div class="skel" style="height:200px;border-radius:14px;opacity:.8"></div>
                    <div class="skel" style="height:200px;border-radius:14px;opacity:.6"></div>
                    <div class="skel" style="height:200px;border-radius:14px;opacity:.4"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL -->
    <div class="modal-overlay" id="modalOverlay" onclick="fecharModal(event)">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <div class="modal-title" id="modalTitulo">Detalhes</div>
                    <div class="modal-meta" id="modalMeta">—</div>
                </div>
                <button class="modal-close" onclick="fecharModalDireto()"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg></button>
            </div>
            <div class="modal-body" id="modalBody"></div>
        </div>
    </div>

    <script>
        // ════════════════════════════════════════════════════════
        //  ⚙️  CONFIGURAÇÃO
        // ════════════════════════════════════════════════════════
        const API_BASE = 'https://SUA_URL_AQUI/api';
        const MEDICO_ID = /* ID injectado pelo PHP */ 1;
        //
        //  Endpoints esperados:
        //  GET {API_BASE}/medico/{id}/dashboard
        //    → { medico:{nome,especialidade,ano_experiencia},
        //        stats:{hoje,mes,pacientes_atendidos,concluidas_mes},
        //        agenda_hoje:[{id,paciente,tipo_consulta,servico,hora,estado,modalidade}],
        //        horarios:[{dia_semana,hora,activo}],
        //        pacientes_recentes:[{id,paciente:{id,nome,data_nascimento,genero},ultima_data,total_consultas}] }
        //
        //  GET {API_BASE}/medico/{id}/consultas   → lista completa de consultas
        //  GET {API_BASE}/medico/{id}/prontuarios → lista de pacientes únicos com resumo
        //  GET {API_BASE}/consulta/{id}           → detalhes (diags, exames, receitas)
        //  GET {API_BASE}/paciente/{id}/prontuario → histórico completo do paciente
        // ════════════════════════════════════════════════════════

        const DIAS = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
        const DIAS_FULL = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
        const MESES = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        let _consultas = [];
        let _prontuarios = [];
        let _filtroC = 'todos';
        let _modalType = null;

        // ── Helpers ───────────────────────────────────────────
        const fmt = d => {
            if (!d) return '—';
            const [y, m, day] = d.split('-');
            return `${day}/${m}/${y}`;
        };
        const iniciais = n => n?.split(' ').filter(Boolean).slice(0, 2).map(x => x[0].toUpperCase()).join('') || '?';

        function badgeClass(e = '') {
            const v = e.toLowerCase();
            if (v.includes('conclu') || v === 'realizada') return 'badge-realizada';
            if (v === 'cancelada') return 'badge-cancelada';
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
        const titles = {
            dashboard: 'Visão Geral',
            consultas: 'Minhas Consultas',
            prontuarios: 'Prontuários',
            horarios: 'Meus Horários'
        };

        function showPage(id) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            document.getElementById('page-' + id).classList.add('active');
            document.querySelector(`[onclick="showPage('${id}');return false;"]`).classList.add('active');
            document.getElementById('topbarTitle').textContent = titles[id];
        }

        // ── Data actual ───────────────────────────────────────
        (function() {
            const now = new Date();
            document.getElementById('topbarDate').textContent =
                `${DIAS_FULL[now.getDay()]}, ${now.getDate()} de ${['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'][now.getMonth()]} de ${now.getFullYear()}`;
        })();

        // ── Init ──────────────────────────────────────────────
        async function init() {
            try {
                const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/dashboard`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const d = await res.json();
                renderMedico(d.medico || {});
                renderStats(d.stats || {});
                renderAgendaHoje(d.agenda_hoje || []);
                renderHorarioMini(d.horarios || []);
                renderPacientesRecentes(d.pacientes_recentes || []);
            } catch (e) {
                console.error(e);
            }

            // Carregar tabelas em paralelo
            carregarConsultas();
            carregarProntuarios();
        }

        function renderMedico(m) {
            const nome = m.nome || 'Médico';
            document.getElementById('sidebarInitials').textContent = iniciais(nome);
            document.getElementById('sidebarNome').textContent = nome;
            document.getElementById('sidebarEspec').textContent = m.especialidade || 'Médico';
            document.getElementById('heroNome').textContent = 'Dr(a). ' + nome;
            document.getElementById('heroEspec').textContent = m.especialidade || '—';
            document.getElementById('heroExp').textContent = (m.ano_experiencia || '—') + ' anos de experiência';
            document.getElementById('heroAva').textContent = iniciais(nome);
        }

        function renderStats(s) {
            document.getElementById('statHoje').textContent = s.hoje ?? '0';
            document.getElementById('statMes').textContent = s.mes ?? '0';
            document.getElementById('statPacientes').textContent = s.pacientes_atendidos ?? '0';
            document.getElementById('statConcluidas').textContent = s.concluidas_mes ?? '0';
            document.getElementById('heroConsultasHoje').textContent = (s.hoje ?? '0') + ' consultas hoje';
        }

        function renderAgendaHoje(lista) {
            const el = document.getElementById('agendaHoje');
            if (!lista.length) {
                el.innerHTML = '<div class="empty"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg><p>Sem consultas para hoje.</p></div>';
                return;
            }
            const agora = new Date();
            el.innerHTML = lista.map((c, i) => {
                const [h, min] = (c.hora || '00:00').split(':');
                const horaC = new Date();
                horaC.setHours(+h, +min, 0);
                const proxima = horaC > agora && (i === 0 || (() => {
                    const [ph, pm] = (lista[i - 1]?.hora || '00:00').split(':');
                    const prev = new Date();
                    prev.setHours(+ph, +pm, 0);
                    return prev <= agora;
                })());
                return `<div class="consulta-dia-item ${proxima?'proxima':''}" onclick="abrirModalConsulta(${c.id})">
                <div class="cdi-hora"><div class="cdi-hora-val">${c.hora||'—'}</div><div class="cdi-hora-lbl">horas</div></div>
                <div class="cdi-divider ${proxima?'teal':''}"></div>
                <div class="cdi-info">
                    <div class="cdi-nome">${c.paciente||'—'}</div>
                    <div class="cdi-tipo">${c.tipo_consulta||c.servico||'—'} · ${c.modalidade||'Presencial'}</div>
                </div>
                <div class="cdi-right"><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></div>
                </div>`;
                        }).join('');
        }

        function renderHorarioMini(horarios) {
            const el = document.getElementById('horarioMini');
            const hoje = new Date().getDay();
            const porDia = {};
            horarios.forEach(h => {
                const d = parseInt(h.dia_semana);
                if (!porDia[d]) porDia[d] = [];
                porDia[d].push(h);
            });
            el.innerHTML = DIAS.map((d, i) => `
            <div class="dia-col ${i===hoje?'hoje':''}">
            <div class="dia-label">${i===hoje?`<span>${d}</span>`:d}</div>
            ${(porDia[i]||[]).map(h=>`<div class="dia-slot ${h.activo?'slot-active':'slot-inactive'}">${h.hora?.slice(0,5)||'—'}</div>`).join('')||'<div style="font-size:10px;color:var(--text-light);text-align:center">—</div>'}
            </div>`).join('');
        }

        function renderPacientesRecentes(lista) {
            const el = document.getElementById('pacientesRecentes');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem pacientes recentes.</div>';
                return;
            }
            el.innerHTML = lista.map(p => `
            <div class="paciente-row" onclick="abrirModalProntuario(${p.paciente?.id||p.id})">
            <div class="pac-ava">${iniciais(p.paciente?.nome||p.nome||'?')}</div>
            <div>
                <div class="pac-nome">${p.paciente?.nome||p.nome||'—'}</div>
                <div class="pac-sub">${p.total_consultas||0} consulta${p.total_consultas!==1?'s':''}</div>
            </div>
            <div class="pac-data">${fmt(p.ultima_data)}</div>
            </div>`).join('');
        }

        // ── Consultas tabela ──────────────────────────────────
        async function carregarConsultas() {
            try {
                const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/consultas`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                _consultas = await res.json();
                filtrarConsultas();
            } catch (e) {
                document.getElementById('consultasTbody').innerHTML = '<tr><td colspan="6" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
            }
        }

        function filtrarConsultas() {
            const q = (document.getElementById('consultaSearch')?.value || '').toLowerCase();
            const lista = _consultas.filter(c => {
                const mF = _filtroC === 'todos' || (c.estado || '').toLowerCase() === _filtroC;
                const mS = !q || (c.paciente || '').toLowerCase().includes(q) || (c.tipo_consulta || '').toLowerCase().includes(q);
                return mF && mS;
            });
            const tbody = document.getElementById('consultasTbody');
            if (!lista.length) {
                tbody.innerHTML = '<tr><td colspan="6" class="no-data">Nenhuma consulta encontrada.</td></tr>';
                return;
            }
            tbody.innerHTML = lista.map(c => `
            <tr>
            <td><strong>${fmt(c.data)}</strong><div style="font-size:11px;color:var(--text-gray)">${c.hora||''}</div></td>
            <td><strong>${c.paciente||'—'}</strong></td>
            <td>${c.tipo_consulta||'—'}<div style="font-size:11px;color:var(--text-gray)">${c.servico||''}</div></td>
            <td>${c.modalidade||'Presencial'}</td>
            <td><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></td>
            <td><button class="btn-sm btn-teal" onclick="abrirModalConsulta(${c.id})">Detalhes</button></td>
            </tr>`).join('');
        }

        function setFiltroConsulta(v, el) {
            _filtroC = v;
            document.querySelectorAll('.ftab').forEach(f => f.classList.remove('active'));
            el.classList.add('active');
            filtrarConsultas();
        }

        // ── Prontuários tabela ────────────────────────────────
        async function carregarProntuarios() {
            try {
                const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/prontuarios`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                _prontuarios = await res.json();
                renderProntuariosTabela(_prontuarios);
            } catch (e) {
                document.getElementById('prontuariosTbody').innerHTML = '<tr><td colspan="6" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
            }
        }

        function renderProntuariosTabela(lista) {
            const tbody = document.getElementById('prontuariosTbody');
            if (!lista.length) {
                tbody.innerHTML = '<tr><td colspan="6" class="no-data">Nenhum prontuário encontrado.</td></tr>';
                return;
            }
            tbody.innerHTML = lista.map(p => `
            <tr>
            <td><div style="display:flex;align-items:center;gap:10px"><div class="pac-ava" style="width:32px;height:32px;font-size:11px">${iniciais(p.nome)}</div><strong>${p.nome||'—'}</strong></div></td>
            <td>${p.idade||'—'}</td>
            <td>${p.genero||'—'}</td>
            <td>${fmt(p.ultima_consulta)}</td>
            <td>${p.total_consultas||0}</td>
            <td>
                <button class="btn-sm btn-teal" onclick="abrirModalProntuario(${p.id})" style="margin-right:4px">Prontuário</button>
            </td>
            </tr>`).join('');
        }

        function filtrarProntuarios() {
            const q = (document.getElementById('prontuarioSearch')?.value || '').toLowerCase();
            renderProntuariosTabela(q ? _prontuarios.filter(p => (p.nome || '').toLowerCase().includes(q)) : _prontuarios);
        }

        // ── Horários página ───────────────────────────────────
        async function carregarHorarios() {
            try {
                const res = await fetch(`${API_BASE}/medico/${MEDICO_ID}/dashboard`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                const d = await res.json();
                renderHorariosGrid(d.horarios || []);
            } catch (e) {}
        }

        function renderHorariosGrid(horarios) {
            const hoje = new Date().getDay();
            const porDia = {};
            horarios.forEach(h => {
                const d = parseInt(h.dia_semana);
                if (!porDia[d]) porDia[d] = [];
                porDia[d].push(h);
            });
            document.getElementById('horariosGrid').innerHTML = DIAS_FULL.map((d, i) => `
            <div class="hfg-col ${i===hoje?'hoje-col':''}">
            <div class="hfg-dia-header">${d}</div>
            <div class="hfg-slots">
                ${(porDia[i]||[]).length
                ? (porDia[i]||[]).map(h=>`<div class="hfg-slot ${h.activo?'activo':'inactivo'}">${h.hora?.slice(0,5)||'—'}</div>`).join('')
                : `<div class="hfg-empty">Sem horário</div>`}
            </div>
            </div>`).join('');
        }

        // ── Modais ────────────────────────────────────────────
        async function abrirModalConsulta(id) {
            _modalType = 'consulta';
            document.getElementById('modalTitulo').textContent = 'Detalhes da Consulta';
            document.getElementById('modalMeta').textContent = '—';
            document.getElementById('modalBody').innerHTML = '<div class="skel" style="height:16px;width:50%;margin-bottom:10px"></div><div class="skel" style="height:80px;border-radius:10px"></div>';
            document.getElementById('modalOverlay').classList.add('open');
            try {
                const res = await fetch(`${API_BASE}/consulta/${id}`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                const c = await res.json();
                document.getElementById('modalTitulo').textContent = c.tipo_consulta || c.servico || 'Consulta';
                document.getElementById('modalMeta').textContent = `${fmt(c.data)}${c.hora?' · '+c.hora:''} · ${c.paciente||'—'}`;
                renderModalConsulta(c);
            } catch (e) {
                document.getElementById('modalBody').innerHTML = '<div class="no-data" style="color:#c0392b">Erro ao carregar.</div>';
            }
        }

        function renderModalConsulta(c) {
            const diags = (c.diagnosticos || []);
            const exames = (c.exames || []);
            const receitas = (c.receitas || []);
            document.getElementById('modalBody').innerHTML = `
            ${c.observacao?`<div class="modal-section"><div class="modal-section-title">Observação</div><div class="obs-box">${c.observacao}</div></div>`:''}
            <div class="modal-section"><div class="modal-section-title">Diagnósticos</div>
            ${diags.length?diags.map(d=>`<div class="diag-item"><div class="diag-bullet"></div><div>${d.descricao}</div></div>`).join(''):'<div class="no-data">Nenhum diagnóstico.</div>'}
            </div>
            <div class="modal-section"><div class="modal-section-title">Exames Solicitados</div>
            ${exames.length?exames.map(e=>`<div class="exame-row"><div><strong style="font-size:13px">${e.servico_clinico||'—'}</strong><div style="font-size:11px;color:var(--text-gray);margin-top:2px">${e.resultado||'Aguarda resultado'}</div></div><span class="badge ${e.status?.toLowerCase().includes('conclu')?'badge-realizada':'badge-pendente'}">${e.status||'—'}</span></div>`).join(''):'<div class="no-data">Nenhum exame.</div>'}
            </div>
            <div class="modal-section"><div class="modal-section-title">Receita</div>
            ${receitas.length?receitas.map(r=>`${r.observacoes?`<div class="obs-box" style="margin-bottom:10px">${r.observacoes}</div>`:''}`+(r.itens||[]).map(i=>`<div class="med-item"><div class="med-name">💊 ${i.medicamento||'—'}</div><div class="med-detail"><span>Dosagem</span>${i.dosagem||'—'}</div><div class="med-detail"><span>Frequência</span>${i.frequencia||'—'}</div><div class="med-detail"><span>Duração</span>${i.duracao||'—'}</div></div>`).join('')).join(''):'<div class="no-data">Sem receita.</div>'}
            </div>`;
        }

        async function abrirModalProntuario(pacienteId) {
            _modalType = 'prontuario';
            document.getElementById('modalTitulo').textContent = 'Prontuário do Paciente';
            document.getElementById('modalMeta').textContent = 'Carregando...';
            document.getElementById('modalBody').innerHTML = '<div class="skel" style="height:16px;width:50%;margin-bottom:10px"></div><div class="skel" style="height:80px;border-radius:10px"></div>';
            document.getElementById('modalOverlay').classList.add('open');
            try {
                const res = await fetch(`${API_BASE}/paciente/${pacienteId}/prontuario`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                const d = await res.json();
                document.getElementById('modalTitulo').textContent = d.paciente?.nome || 'Prontuário';
                document.getElementById('modalMeta').textContent = `${d.paciente?.idade||'—'} anos · ${d.paciente?.genero||'—'}`;
                renderModalProntuario(d);
            } catch (e) {
                document.getElementById('modalBody').innerHTML = '<div class="no-data" style="color:#c0392b">Erro ao carregar prontuário.</div>';
            }
        }

        function renderModalProntuario(d) {
            const p = d.paciente || {};
            const consultas = d.consultas || [];
            document.getElementById('modalBody').innerHTML = `
            <div class="modal-section">
            <div class="modal-section-title">Dados do Paciente</div>
            <div class="pac-info-grid">
                <div class="pac-info-item"><label>Telefone</label><span>${p.num_telefone||'—'}</span></div>
                <div class="pac-info-item"><label>Email</label><span>${p.email||'—'}</span></div>
                <div class="pac-info-item"><label>Data Nasc.</label><span>${fmt(p.data_nascimento)}</span></div>
                <div class="pac-info-item"><label>Nº BI</label><span>${p.num_bi||'—'}</span></div>
            </div>
            </div>
            <div class="modal-section">
            <div class="modal-section-title">Histórico de Consultas (${consultas.length})</div>
            ${consultas.length?consultas.map(c=>`
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;background:var(--bg-light);border-radius:8px;margin-bottom:6px;font-size:13px;cursor:pointer" onclick="fecharModalDireto();setTimeout(()=>abrirModalConsulta(${c.id}),300)">
                <div><strong>${fmt(c.data)}</strong> · ${c.hora||'—'}<div style="font-size:11px;color:var(--text-gray);margin-top:2px">${c.tipo_consulta||c.servico||'—'}</div></div>
                <span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span>
                </div>`).join(''):'<div class="no-data">Sem consultas registadas.</div>'}
            </div>`;
        }

        function fecharModal(e) {
            if (e.target === document.getElementById('modalOverlay')) fecharModalDireto();
        }

        function fecharModalDireto() {
            document.getElementById('modalOverlay').classList.remove('open');
        }

        // Carregar horários quando mudar de página
        document.querySelector(`[onclick="showPage('horarios');return false;"]`).addEventListener('click', () => {
            if (!document.getElementById('horariosGrid').querySelector('.hfg-col')) carregarHorarios();
        });

        init();
    </script>
</body>

</html>