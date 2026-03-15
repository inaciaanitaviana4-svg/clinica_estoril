<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal da Recepcionista</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004999;
            --secondary: #00a86b;
            --accent: #ff6b35;
            --purple: #7c3aed;
            --purple-light: #8b5cf6;
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
            --grad-purple: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
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
            box-shadow: 4px 0 24px rgba(124, 58, 237, .06);
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
        }

        .sidebar-user {
            margin: 16px 12px;
            padding: 14px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, rgba(124, 58, 237, .08), rgba(91, 33, 182, .04));
            border: 1px solid rgba(124, 58, 237, .15);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-ava {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--grad-purple);
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
            color: var(--purple);
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
            background: linear-gradient(135deg, rgba(124, 58, 237, .10), rgba(124, 58, 237, .04));
            color: var(--purple);
            font-weight: 600;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 3px;
            background: var(--purple);
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
            background: rgba(124, 58, 237, .12);
        }

        .nav-icon svg {
            width: 16px;
            height: 16px;
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
            background: var(--grad-purple);
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
            margin-bottom: 8px;
        }

        .hero-msg {
            font-size: 13px;
            opacity: .75;
            max-width: 400px;
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

        .si-purple {
            background: #ede9fe;
            color: var(--purple);
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

        .stat-sub {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 2px;
        }

        /* ── GRID ──────────────────────────────── */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
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
            color: var(--purple);
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
        .consulta-hoje-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--trans);
            border: 1px solid transparent;
            margin-bottom: 4px;
        }

        .consulta-hoje-item:hover {
            background: var(--bg-light);
            border-color: var(--border);
        }

        .chi-hora {
            width: 44px;
            text-align: center;
            flex-shrink: 0;
        }

        .chi-hora-val {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1;
        }

        .chi-hora-lbl {
            font-size: 10px;
            color: var(--text-light);
        }

        .chi-divider {
            width: 2px;
            height: 34px;
            background: var(--border);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .chi-info {
            flex: 1;
        }

        .chi-paciente {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .chi-tipo {
            font-size: 11px;
            color: var(--text-gray);
            margin-top: 2px;
        }

        .chi-right {
            flex-shrink: 0;
            text-align: right;
        }

        /* ── PAGAMENTOS RECENTES ───────────────── */
        .pag-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
        }

        .pag-item:last-child {
            border-bottom: none;
        }

        .pag-left {
            flex: 1;
        }

        .pag-paciente {
            font-weight: 600;
            color: var(--text-dark);
        }

        .pag-meta {
            font-size: 11px;
            color: var(--text-gray);
            margin-top: 2px;
        }

        .pag-right {
            text-align: right;
            flex-shrink: 0;
        }

        .pag-val {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-dark);
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

        .toolbar {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
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
            border-color: var(--purple);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, .1);
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
            background: var(--purple);
            color: #fff;
            border-color: var(--purple);
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
            background: #faf8ff;
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

        .btn-purple {
            background: #ede9fe;
            color: var(--purple);
        }

        .btn-purple:hover {
            background: var(--purple);
            color: #fff;
        }

        .btn-green {
            background: #d4f7e9;
            color: var(--secondary);
        }

        .btn-green:hover {
            background: var(--secondary);
            color: #fff;
        }

        .btn-orange {
            background: #fff0e8;
            color: var(--accent);
        }

        .btn-orange:hover {
            background: var(--accent);
            color: #fff;
        }

        .sem-recep {
            font-size: 11px;
            background: #fff3cd;
            color: #856404;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
            margin-left: 6px;
        }

        /* ── PAGE PAGAMENTOS ───────────────────── */
        .pag-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
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
            background: var(--grad-purple);
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

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .info-item label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--text-light);
            margin-bottom: 3px;
        }

        .info-item span {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
        }

        .info-item.full {
            grid-column: 1/-1;
        }

        .item-pag-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            background: var(--bg-light);
            border-radius: 8px;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .item-pag-row:last-child {
            margin-bottom: 0;
        }

        .total-pag-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            background: linear-gradient(135deg, rgba(124, 58, 237, .08), rgba(124, 58, 237, .04));
            border: 1px solid rgba(124, 58, 237, .2);
            border-radius: 10px;
            margin-top: 12px;
        }

        .total-pag-lbl {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .total-pag-val {
            font-size: 20px;
            font-weight: 700;
            color: var(--purple);
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

        .badge-pago {
            background: #d4f7e9;
            color: #007a4c;
        }

        .badge-nao-pago {
            background: #fde8e8;
            color: #c0392b;
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
            padding: 40px;
            color: var(--text-light);
        }

        .empty svg {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            opacity: .25;
            display: block;
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

            .grid-2 {
                grid-template-columns: 1fr;
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
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">C</div>
            <div>
                <div class="sidebar-logo-text">ClinicaPro</div>
                <div class="sidebar-logo-sub">Portal da Recepcionista</div>
            </div>
        </div>
        <div class="sidebar-user">
            <div class="user-ava" id="sidebarInitials">—</div>
            <div>
                <div class="user-name" id="sidebarNome">Carregando...</div>
                <div class="user-role">Recepcionista</div>
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
                Consultas
            </a>
            <a class="nav-item" onclick="showPage('pagamentos');return false;" href="#">
                <div class="nav-icon"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg></div>
                Pagamentos
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
                        <div class="hero-greeting">Bem-vindo(a) 👋</div>
                        <div class="hero-name" id="heroNome">—</div>
                        <div class="hero-msg">Gerencie as consultas agendadas e os pagamentos da clínica num só lugar.</div>
                    </div>
                    <div class="hero-ava" id="heroAva">—</div>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statHoje">—</div>
                            <div class="stat-lbl">Consultas Hoje</div>
                            <div class="stat-sub" id="statHojeSub">—</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-blue"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statMes">—</div>
                            <div class="stat-lbl">Consultas no Mês</div>
                            <div class="stat-sub" id="statMesSub">—</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statReceitaMes">—</div>
                            <div class="stat-lbl">Receita do Mês (Kz)</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                            </svg></div>
                        <div>
                            <div class="stat-val" id="statSemRecep">—</div>
                            <div class="stat-lbl">Sem Recepcionista</div>
                        </div>
                    </div>
                </div>

                <div class="grid-2">
                    <!-- Consultas de hoje -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="ct-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg></div>
                                Consultas de Hoje
                            </div>
                            <a class="card-link" onclick="showPage('consultas');return false;">Ver todas</a>
                        </div>
                        <div class="card-body" id="consultasHojeList">
                            <div class="skel" style="height:50px;border-radius:10px;margin-bottom:6px;"></div>
                            <div class="skel" style="height:50px;border-radius:10px;margin-bottom:6px;opacity:.7"></div>
                            <div class="skel" style="height:50px;border-radius:10px;opacity:.4"></div>
                        </div>
                    </div>

                    <!-- Pagamentos recentes -->
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="ct-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg></div>
                                Pagamentos Recentes
                            </div>
                            <a class="card-link" onclick="showPage('pagamentos');return false;">Ver todos</a>
                        </div>
                        <div class="card-body" id="pagamentosRecentesList">
                            <div class="skel" style="height:42px;margin-bottom:8px;border-radius:8px;"></div>
                            <div class="skel" style="height:42px;margin-bottom:8px;border-radius:8px;opacity:.7"></div>
                            <div class="skel" style="height:42px;border-radius:8px;opacity:.4"></div>
                        </div>
                    </div>
                </div>

            </div><!-- /page-dashboard -->

            <!-- ══ CONSULTAS ══════════════════════ -->
            <div class="page" id="page-consultas">
                <div class="page-header">
                    <h2>Consultas</h2>
                    <div class="toolbar">
                        <div class="search-bar">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" id="consultaSearch" placeholder="Pesquisar paciente/médico..." oninput="filtrarConsultas()">
                        </div>
                    </div>
                </div>
                <div class="filter-tabs">
                    <div class="ftab active" onclick="setFiltroC('todos',this)">Todas</div>
                    <div class="ftab" onclick="setFiltroC('agendada',this)">Agendadas</div>
                    <div class="ftab" onclick="setFiltroC('concluida',this)">Concluídas</div>
                    <div class="ftab" onclick="setFiltroC('cancelada',this)">Canceladas</div>
                    <div class="ftab" onclick="setFiltroC('sem_recepcionista',this)">Sem Recepcionista</div>
                </div>
                <div class="table-wrap">
                    <table class="ct-table">
                        <thead>
                            <tr>
                                <th>Data / Hora</th>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Tipo / Serviço</th>
                                <th>Estado</th>
                                <th>Recepcionista</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="consultasTbody">
                            <tr>
                                <td colspan="7" class="no-data">A carregar...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /page-consultas -->

            <!-- ══ PAGAMENTOS ═════════════════════ -->
            <div class="page" id="page-pagamentos">
                <div class="page-header">
                    <h2>Pagamentos</h2>
                    <div class="toolbar">
                        <div class="search-bar">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35" />
                            </svg>
                            <input type="text" id="pagSearch" placeholder="Pesquisar paciente..." oninput="filtrarPagamentos()">
                        </div>
                    </div>
                </div>
                <div class="pag-stats" id="pagStats">
                    <div class="skel" style="height:80px;border-radius:14px;"></div>
                    <div class="skel" style="height:80px;border-radius:14px;opacity:.7"></div>
                    <div class="skel" style="height:80px;border-radius:14px;opacity:.4"></div>
                </div>
                <div class="filter-tabs">
                    <div class="ftab active" onclick="setFiltroP('todos',this)">Todos</div>
                    <div class="ftab" onclick="setFiltroP('pago',this)">Pagos</div>
                    <div class="ftab" onclick="setFiltroP('pendente',this)">Pendentes</div>
                </div>
                <div class="table-wrap">
                    <table class="ct-table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Paciente</th>
                                <th>Método</th>
                                <th>Itens</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="pagamentosTbody">
                            <tr>
                                <td colspan="7" class="no-data">A carregar...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!-- /page-pagamentos -->

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
        const RECEPCIONISTA_ID = /* ID injectado pelo PHP */ 1;
        //
        //  Endpoints esperados:
        //  GET {API_BASE}/recepcionista/{id}/dashboard
        //    → { recepcionista:{nome},
        //        stats:{hoje, mes, receita_mes, sem_recepcionista,
        //               hoje_agendadas, mes_agendadas},
        //        consultas_hoje:[{id,paciente,medico,tipo_consulta,servico,hora,estado,id_recepcionista}],
        //        pagamentos_recentes:[{id,paciente,data,metodo_pagamento,total_pago,estado}] }
        //
        //  GET {API_BASE}/recepcionista/{id}/consultas
        //    → lista de consultas (próprias + sem recepcionista)
        //      cada item: {id,paciente,medico,tipo_consulta,servico,data,hora,estado,modalidade,id_recepcionista,recepcionista}
        //
        //  GET {API_BASE}/recepcionista/{id}/pagamentos
        //    → lista de pagamentos com itens
        //      cada item: {id,paciente,data,metodo_pagamento,recepcionista,total_pago,estado,itens:[{servico,quantidade,valor,total}]}
        //
        //  GET {API_BASE}/recepcionista/{id}/pagamentos/stats
        //    → {total_mes, total_pago, total_pendente}
        // ════════════════════════════════════════════════════════

        const MESES_PT = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        let _consultas = [];
        let _pagamentos = [];
        let _filtroC = 'todos';
        let _filtroP = 'todos';

        // ── Helpers ───────────────────────────────────────────
        const fmt = d => {
            if (!d) return '—';
            const [y, m, day] = d.split('-');
            return `${day}/${m}/${y}`;
        };
        const iniciais = n => n?.split(' ').filter(Boolean).slice(0, 2).map(x => x[0].toUpperCase()).join('') || '?';
        const numFmt = v => Number(v || 0).toLocaleString('pt-AO');

        function badgeClass(e = '') {
            const v = e.toLowerCase();
            if (v.includes('conclu') || v === 'realizada') return 'badge-realizada';
            if (v === 'cancelada') return 'badge-cancelada';
            if (v === 'pago') return 'badge-pago';
            if (v === 'pendente') return 'badge-pendente';
            return 'badge-agendada';
        }

        function badgeLabel(e = '') {
            const v = e.toLowerCase();
            if (v === 'concluida') return 'Concluída';
            if (v === 'cancelada') return 'Cancelada';
            if (v === 'agendada') return 'Agendada';
            if (v === 'pago') return 'Pago';
            if (v === 'pendente') return 'Pendente';
            return e;
        }

        // ── Navegação ─────────────────────────────────────────
        const titles = {
            dashboard: 'Visão Geral',
            consultas: 'Consultas',
            pagamentos: 'Pagamentos'
        };

        function showPage(id) {
            document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            document.getElementById('page-' + id).classList.add('active');
            document.querySelector(`[onclick="showPage('${id}');return false;"]`).classList.add('active');
            document.getElementById('topbarTitle').textContent = titles[id];
        }

        // ── Data ──────────────────────────────────────────────
        (function() {
            const n = new Date();
            document.getElementById('topbarDate').textContent =
                `${['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'][n.getDay()]}, ${n.getDate()} de ${MESES_PT[n.getMonth()]} de ${n.getFullYear()}`;
        })();

        // ── Init ──────────────────────────────────────────────
        async function init() {
            try {
                const res = await fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/dashboard`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                const d = await res.json();
                renderRecepcionista(d.recepcionista || {});
                renderStats(d.stats || {});
                renderConsultasHoje(d.consultas_hoje || []);
                renderPagamentosRecentes(d.pagamentos_recentes || []);
            } catch (e) {
                console.error(e);
            }
            carregarConsultas();
            carregarPagamentos();
        }

        function renderRecepcionista(r) {
            const nome = r.nome || 'Recepcionista';
            document.getElementById('sidebarInitials').textContent = iniciais(nome);
            document.getElementById('sidebarNome').textContent = nome;
            document.getElementById('heroNome').textContent = nome;
            document.getElementById('heroAva').textContent = iniciais(nome);
        }

        function renderStats(s) {
            document.getElementById('statHoje').textContent = s.hoje ?? '0';
            document.getElementById('statHojeSub').textContent = `${s.hoje_agendadas??'0'} agendadas`;
            document.getElementById('statMes').textContent = s.mes ?? '0';
            document.getElementById('statMesSub').textContent = `${s.mes_agendadas??'0'} agendadas`;
            document.getElementById('statReceitaMes').textContent = numFmt(s.receita_mes);
            document.getElementById('statSemRecep').textContent = s.sem_recepcionista ?? '0';
        }

        function renderConsultasHoje(lista) {
            const el = document.getElementById('consultasHojeList');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem consultas para hoje.</div>';
                return;
            }
            el.innerHTML = lista.map(c => `
            <div class="consulta-hoje-item" onclick="abrirModalConsulta(${c.id})">
            <div class="chi-hora"><div class="chi-hora-val">${c.hora||'—'}</div><div class="chi-hora-lbl">horas</div></div>
            <div class="chi-divider"></div>
            <div class="chi-info">
                <div class="chi-paciente">${c.paciente||'—'}${!c.id_recepcionista?'<span class="sem-recep">Sem recep.</span>':''}</div>
                <div class="chi-tipo">${c.medico||'—'} · ${c.tipo_consulta||c.servico||'—'}</div>
            </div>
            <div class="chi-right"><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></div>
            </div>`).join('');
        }

        function renderPagamentosRecentes(lista) {
            const el = document.getElementById('pagamentosRecentesList');
            if (!lista.length) {
                el.innerHTML = '<div class="no-data">Sem pagamentos recentes.</div>';
                return;
            }
            el.innerHTML = lista.map(p => `
            <div class="pag-item" style="cursor:pointer" onclick="abrirModalPagamento(${p.id})">
            <div class="pag-left">
                <div class="pag-paciente">${p.paciente||'—'}</div>
                <div class="pag-meta">${fmt(p.data)} · ${p.metodo_pagamento||'—'}</div>
            </div>
            <div class="pag-right">
                <div class="pag-val">${numFmt(p.total_pago)} Kz</div>
                <span class="badge ${badgeClass(p.estado)}" style="margin-top:3px;display:inline-block">${badgeLabel(p.estado)}</span>
            </div>
            </div>`).join('');
        }

        // ── Consultas tabela ──────────────────────────────────
        async function carregarConsultas() {
            try {
                const res = await fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/consultas`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error();
                _consultas = await res.json();
                filtrarConsultas();
            } catch (e) {
                document.getElementById('consultasTbody').innerHTML = '<tr><td colspan="7" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
            }
        }

        function filtrarConsultas() {
            const q = (document.getElementById('consultaSearch')?.value || '').toLowerCase();
            const lista = _consultas.filter(c => {
                let mF = true;
                if (_filtroC === 'sem_recepcionista') mF = !c.id_recepcionista;
                else if (_filtroC !== 'todos') mF = (c.estado || '').toLowerCase() === _filtroC;
                const mS = !q || (c.paciente || '').toLowerCase().includes(q) || (c.medico || '').toLowerCase().includes(q) || (c.tipo_consulta || '').toLowerCase().includes(q);
                return mF && mS;
            });
            const tbody = document.getElementById('consultasTbody');
            if (!lista.length) {
                tbody.innerHTML = '<tr><td colspan="7" class="no-data">Nenhuma consulta encontrada.</td></tr>';
                return;
            }
            tbody.innerHTML = lista.map(c => `
            <tr>
            <td><strong>${fmt(c.data)}</strong><div style="font-size:11px;color:var(--text-gray)">${c.hora||''}</div></td>
            <td><strong>${c.paciente||'—'}</strong></td>
            <td>${c.medico||'—'}</td>
            <td>${c.tipo_consulta||'—'}<div style="font-size:11px;color:var(--text-gray)">${c.servico||''}</div></td>
            <td><span class="badge ${badgeClass(c.estado)}">${badgeLabel(c.estado)}</span></td>
            <td>${c.recepcionista||'<span style="color:var(--accent);font-size:12px;font-weight:600">Não atribuído</span>'}</td>
            <td><button class="btn-sm btn-purple" onclick="abrirModalConsulta(${c.id})">Detalhes</button></td>
            </tr>`).join('');
        }

        function setFiltroC(v, el) {
            _filtroC = v;
            document.querySelectorAll('#page-consultas .ftab').forEach(f => f.classList.remove('active'));
            el.classList.add('active');
            filtrarConsultas();
        }

        // ── Pagamentos tabela ─────────────────────────────────
        async function carregarPagamentos() {
            try {
                const [resP, resS] = await Promise.all([
                    fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/pagamentos`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }),
                    fetch(`${API_BASE}/recepcionista/${RECEPCIONISTA_ID}/pagamentos/stats`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }),
                ]);
                if (resP.ok) {
                    _pagamentos = await resP.json();
                    filtrarPagamentos();
                }
                if (resS.ok) {
                    const s = await resS.json();
                    renderPagStats(s);
                }
            } catch (e) {
                document.getElementById('pagamentosTbody').innerHTML = '<tr><td colspan="7" class="no-data" style="color:#c0392b">Erro ao carregar.</td></tr>';
            }
        }

        function renderPagStats(s) {
            document.getElementById('pagStats').innerHTML = `
            <div class="stat-card"><div class="stat-icon si-purple"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"/></svg></div><div><div class="stat-val">${numFmt(s.total_mes)} Kz</div><div class="stat-lbl">Receita do Mês</div></div></div>
            <div class="stat-card"><div class="stat-icon si-green"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div><div class="stat-val">${numFmt(s.total_pago)} Kz</div><div class="stat-lbl">Total Pago</div></div></div>
            <div class="stat-card"><div class="stat-icon si-orange"><svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div><div class="stat-val">${numFmt(s.total_pendente)} Kz</div><div class="stat-lbl">Total Pendente</div></div></div>`;
        }

        function filtrarPagamentos() {
            const q = (document.getElementById('pagSearch')?.value || '').toLowerCase();
            const lista = _pagamentos.filter(p => {
                const mF = _filtroP === 'todos' || (p.estado || '').toLowerCase() === _filtroP;
                const mS = !q || (p.paciente || '').toLowerCase().includes(q) || (p.metodo_pagamento || '').toLowerCase().includes(q);
                return mF && mS;
            });
            const tbody = document.getElementById('pagamentosTbody');
            if (!lista.length) {
                tbody.innerHTML = '<tr><td colspan="7" class="no-data">Nenhum pagamento encontrado.</td></tr>';
                return;
            }
            tbody.innerHTML = lista.map(p => `
            <tr>
            <td><strong>${fmt(p.data)}</strong></td>
            <td><strong>${p.paciente||'—'}</strong></td>
            <td>${p.metodo_pagamento||'—'}</td>
            <td>${(p.itens||[]).length} item${(p.itens||[]).length!==1?'s':''}</td>
            <td><strong>${numFmt(p.total_pago)} Kz</strong></td>
            <td><span class="badge ${badgeClass(p.estado)}">${badgeLabel(p.estado)}</span></td>
            <td><button class="btn-sm btn-purple" onclick="abrirModalPagamento(${p.id})">Detalhes</button></td>
            </tr>`).join('');
        }

        function setFiltroP(v, el) {
            _filtroP = v;
            document.querySelectorAll('#page-pagamentos .ftab').forEach(f => f.classList.remove('active'));
            el.classList.add('active');
            filtrarPagamentos();
        }

        // ── Modal consulta ────────────────────────────────────
        async function abrirModalConsulta(id) {
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
                document.getElementById('modalBody').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">Informações</div>
                    <div class="info-grid">
                    <div class="info-item"><label>Paciente</label><span>${c.paciente||'—'}</span></div>
                    <div class="info-item"><label>Médico</label><span>${c.medico||'—'}</span></div>
                    <div class="info-item"><label>Data</label><span>${fmt(c.data)}</span></div>
                    <div class="info-item"><label>Hora</label><span>${c.hora||'—'}</span></div>
                    <div class="info-item"><label>Modalidade</label><span>${c.modalidade||'Presencial'}</span></div>
                    <div class="info-item"><label>Recepcionista</label><span>${c.recepcionista||'<span style="color:var(--accent)">Não atribuído</span>'}</span></div>
                    ${c.observacao?`<div class="info-item full"><label>Observação</label><span>${c.observacao}</span></div>`:''}
                    </div>
                </div>
                <div class="modal-section">
                    <div class="modal-section-title">Estado</div>
                    <span class="badge ${badgeClass(c.estado)}" style="font-size:13px;padding:4px 14px">${badgeLabel(c.estado)}</span>
                </div>`;
            } catch (e) {
                document.getElementById('modalBody').innerHTML = '<div class="no-data" style="color:#c0392b">Erro ao carregar.</div>';
            }
        }

        // ── Modal pagamento ───────────────────────────────────
        async function abrirModalPagamento(id) {
            const pag = _pagamentos.find(p => p.id === id);
            document.getElementById('modalTitulo').textContent = 'Detalhes do Pagamento';
            document.getElementById('modalMeta').textContent = pag ? `${fmt(pag.data)} · ${pag.paciente||'—'}` : '—';
            document.getElementById('modalOverlay').classList.add('open');
            if (!pag) {
                document.getElementById('modalBody').innerHTML = '<div class="no-data">Dados não encontrados.</div>';
                return;
            }
            const itens = pag.itens || [];
            document.getElementById('modalBody').innerHTML = `
            <div class="modal-section">
            <div class="modal-section-title">Informações do Pagamento</div>
            <div class="info-grid">
                <div class="info-item"><label>Paciente</label><span>${pag.paciente||'—'}</span></div>
                <div class="info-item"><label>Data</label><span>${fmt(pag.data)}</span></div>
                <div class="info-item"><label>Método</label><span>${pag.metodo_pagamento||'—'}</span></div>
                <div class="info-item"><label>Recepcionista</label><span>${pag.recepcionista||'—'}</span></div>
                <div class="info-item"><label>Estado</label><span><span class="badge ${badgeClass(pag.estado)}">${badgeLabel(pag.estado)}</span></span></div>
            </div>
            </div>
            <div class="modal-section">
            <div class="modal-section-title">Itens (${itens.length})</div>
            ${itens.length?itens.map(i=>`
                <div class="item-pag-row">
                <div><strong style="font-size:13px">${i.servico||'—'}</strong><div style="font-size:11px;color:var(--text-gray);margin-top:2px">Qtd: ${i.quantidade||1} · ${numFmt(i.valor)} Kz/un.</div></div>
                <strong>${numFmt(i.total)} Kz</strong>
                </div>`).join(''):'<div class="no-data">Sem itens.</div>'}
            <div class="total-pag-row">
                <div class="total-pag-lbl">Total Pago</div>
                <div class="total-pag-val">${numFmt(pag.total_pago)} Kz</div>
            </div>
            </div>`;
        }

        function fecharModal(e) {
            if (e.target === document.getElementById('modalOverlay')) fecharModalDireto();
        }

        function fecharModalDireto() {
            document.getElementById('modalOverlay').classList.remove('open');
        }

        init();
    </script>
</body>

</html>