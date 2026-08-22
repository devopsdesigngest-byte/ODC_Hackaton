<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debtrac | Dettes & Remboursements</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: #111827;
            --input-bg: #090d16;
            --border-color: rgba(255, 255, 255, 0.05);
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
            --accent-gold: #f59e0b;
            --accent-gold-hover: #d97706;
            --accent-green: #10b981;
            --accent-green-hover: #059669;
            --font-family: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            font-family: var(--font-family);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
        }

        /* Top Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 800;
            color: #fbbf24; /* Yellowish Gold */
        }

        .header .date {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* Metrics grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .metric-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
        }

        .metric-card.m-repayments::before { background-color: var(--accent-green); }
        .metric-card.m-remaining::before { background-color: var(--accent-gold); }
        .metric-card.m-overdue::before { background-color: var(--danger, #f43f5e); }
        .metric-card.m-count::before { background-color: #3b82f6; }

        .metric-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .metric-value {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .metric-sub {
            font-size: 11px;
            font-weight: 600;
        }
        .metric-sub.green { color: var(--accent-green); }
        .metric-sub.gold { color: var(--accent-gold); }
        .metric-sub.red { color: #f43f5e; }
        .metric-sub.blue { color: #3b82f6; }

        /* Forms Layout Grid */
        .forms-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        .form-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 32px;
        }

        .form-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 16px;
            color: white;
            font-family: var(--font-family);
            font-size: 14px;
            outline: none;
            width: 100%;
            transition: border-color 0.2s;
            appearance: none; /* Reset select default arrow */
        }

        .form-control:focus {
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Custom select arrow wrapper */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: '▼';
            font-size: 9px;
            color: var(--text-muted);
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Split inputs inside form */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        /* Calendar input styled */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }

        /* Submit Buttons styling */
        .btn-submit {
            color: #0b0f19;
            border: none;
            border-radius: 8px;
            padding: 14px 20px;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 0.5px;
            font-family: var(--font-family);
            cursor: pointer;
            width: 100%;
            text-transform: uppercase;
            transition: filter 0.2s, transform 0.1s;
            margin-top: 12px;
        }

        .btn-submit.btn-gold {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .btn-submit.btn-green {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .btn-submit:hover {
            filter: brightness(1.1);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        /* Table Card */
        .table-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 32px;
        }

        .table-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .debt-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .debt-table th {
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        .debt-table td {
            padding: 16px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.02);
            font-size: 14px;
        }

        .debt-table tr:last-child td {
            border-bottom: none;
        }

        /* Specific Table Column styling */
        .t-ref {
            color: var(--text-muted);
            font-weight: 500;
        }

        .t-client {
            font-weight: 700;
        }

        .val-orange {
            color: #f59e0b;
            font-weight: 700;
        }

        .val-green {
            color: #10b981;
            font-weight: 700;
        }

        /* Badges */
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge.b-partiel {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .badge.b-reglee {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Top Header -->
        <div class="header">
            <h1>Dettes & Remboursements</h1>
            <div class="date">Mise à jour : 05 Août 2026</div>
        </div>

        <!-- Metrics cards row -->
        <div class="metrics-grid">

            <div class="metric-card m-repayments">
                <div class="metric-title">Dettes Remboursées</div>
                <div class="metric-value"><?php echo $statistiques['totalrembourse']?>FCFA</div>
                <div class="metric-sub green">Taux : <?php echo $statistiques['tauxremboursement']?>% (Q1)</div>
            </div>
            <div class="metric-card m-remaining">
                <div class="metric-title">Dettes Restantes</div>
                <div class="metric-value"><?php echo $statistiques['totalrestant']?> FCFA</div>
                <div class="metric-sub gold">Encours total actif</div>
            </div>
            <div class="metric-card m-overdue">
                <div class="metric-title">Dettes en Retard</div>
                <div class="metric-value"><?php echo $statistiques['totalretard'] ?? 0 ?> FCFA</div>
                <div class="metric-sub red">Date d'échéance dépassée (Q2)</div>
            </div>
            <div class="metric-card m-count">
                <div class="metric-title">Nombre de Dettes</div>
                <div class="metric-value"><?php echo $statistiques['nbredettes']?> Dossiers</div>
                <div class="metric-sub blue">Enregistrements réels</div>
            </div>
        </div>

        <!-- Forms Grid Row -->
        <div class="forms-grid">
            <!-- Left Form: Enregistrer une Dette -->
            <div class="form-card">
                <div class="form-title">Enregistrer une Dette</div>
                <form method="POST" action="http://localhost:8000/save-dette">
                    <div class="form-group">
                        <label for="client-select">Sélectionner le Client</label>
                        <div class="select-wrapper">
                            <select name="client_id" id="client-select" class="form-control">
                                <?php foreach($allClients AS $client): ?>
                                <option value="<?= $client['id']?>"><?= $client['nomcomplet']?></option>  
                                <?php endforeach ?>                             
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="debt-amount">Montant Initial (FCFA)</label>
                        <input name="montant_initial" type="text" id="debt-amount" class="form-control" placeholder="Ex: 250000">
                    </div>
                    <div class="form-group">
                        <label for="debt-date">Date Échéance (Limite)</label>
                        <input name="date_echeance" type="date" id="debt-date" class="form-control">
                    </div>
                    <button type="submit" class="btn-submit btn-gold">Valider l'Emprunt (DML)</button>
                </form>
            </div>

            <!-- Right Form: Enregistrer un Règlement -->
            <div class="form-card">
                <div class="form-title">Enregistrer un Règlement</div>
                <form onsubmit="event.preventDefault()">
                    <div class="form-group">
                        <label for="debt-select">Sélectionner la Dette</label>
                        <div class="select-wrapper">
                            <select id="debt-select" class="form-control">
                                <?php foreach($dettesRestantes AS $detteRestante): ?>
                                <option value="<?= $detteRestante['id']?>"> 
                                    <?= $detteRestante['ref']. " - " .$detteRestante['nom']. " - " .$detteRestante['prenom']. " (Reste : ". $detteRestante['montantrestant']. "FCFA)"?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pay-amount">Montant Versé (FCFA)</label>
                            <input type="text" id="pay-amount" class="form-control" placeholder="Ex: 50000">
                        </div>
                        <div class="form-group">
                            <label for="pay-method">Méthode</label>
                            <div class="select-wrapper">
                                <select id="pay-method" class="form-control">
                                    <option value="wave">Wave</option>
                                    <option value="orange_money">Orange Money</option>
                                    <option value="cash">Espèces</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit btn-green">Enregistrer le Paiement (DML)</button>
                </form>
            </div>
        </div>

        <!-- Table Card Row -->
        <div class="table-card">
            <div class="table-title">Historique & Suivi des Dettes Actives</div>
            <table class="debt-table">
                <thead>
                    <tr>
                        <th>Réf</th>
                        <th>Client</th>
                        <th>Date Emprunt</th>
                        <th>Échéance</th>
                        <th>Montant Emprunté</th>
                        <th>Montant Restant</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($dettes as $dette): ?>
                    <tr>
                        <td class="t-ref"><?php echo $dette['ref']?></td>
                        <td class="t-client"><?php echo $dette['nom']." ".$dette['prenom'] ?></td>
                        <td><?php echo $dette['dateemprunt']?></td>
                        <td><?php echo $dette['dateecheance']?></td>
                        <td><?php echo $dette['montantemprunt']?></td>
                        <td class="<?php echo $dette['statut']== 'REGLEE' ?'val-green':'val-orange'?>"><?php echo $dette['montantrestant']?></td>
                        <td><span class="badge <?php echo $dette['statut']== 'REGLEE' ?'b-reglee':'b-partiel'?>"><?php echo $dette['statut']?></span></td>
                    </tr>
                    <?php endforeach?>
                   
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
