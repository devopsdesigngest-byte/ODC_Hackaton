<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OrderPro | Espace Vente & Commandes</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #060913;
            --panel-bg: rgba(17, 24, 43, 0.45);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-main: #f1f5f9;
            --text-muted: #64748b;
            --accent: #3b82f6; /* Soft Blue */
            --accent-glow: rgba(59, 130, 246, 0.15);
            --success: #10b981;
            --danger: #f43f5e;
            --warning: #f59e0b;
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
            padding: 0;
            margin: 0;
            overflow-x: hidden;
        }

        .app-container {
            width: 100%;
            max-width: 100%;
            padding: 24px;
        }

        /* Top Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(11, 17, 32, 0.6);
            border: 1px solid var(--border-color);
            padding: 16px 24px;
            border-radius: 16px;
            margin-bottom: 32px;
            backdrop-filter: blur(10px);
        }

        .nav-logo {
            font-size: 20px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-logo span { color: var(--accent); }

        .system-status {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 12px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-color);
            padding: 6px 12px;
            border-radius: 20px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .status-pill.online::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--success);
        }

        /* Grid Tier Layouts */
        .panel-card {
            background: var(--panel-bg);
            border: 1px solid var(--border-color);
            backdrop-filter: blur(16px);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            margin-bottom: 32px;
        }

        .panel-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 24px;
            border-left: 3px solid var(--accent);
            padding-left: 12px;
        }

        /* Forms Layout */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-control {
            background: rgba(10, 15, 30, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 14px 18px;
            color: white;
            font-family: var(--font-family);
            outline: none;
            font-size: 14px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.1);
        }

        /* Submit Buttons */
        .btn-submit {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-family: var(--font-family);
            cursor: pointer;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
            filter: brightness(1.1);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit.btn-success {
            background: linear-gradient(135deg, #34d399 0%, #10b981 100%);
            color: #060913;
        }

        .btn-submit.btn-success:hover {
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.35);
        }

        /* Tables */
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
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .debt-table td {
            padding: 14px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            font-size: 13px;
        }

        /* Badges */
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge.non-payee { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .badge.payee { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .badge.danger { background: rgba(244, 63, 94, 0.1); color: var(--danger); }

        .btn-quick-action {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-quick-action:hover {
            background: var(--accent-glow);
            border-color: var(--accent);
            color: var(--accent);
        }

        .details-drawer {
            display: none;
            background: rgba(255,255,255,0.015);
            border: 1px solid rgba(255,255,255,0.03);
            border-radius: 12px;
            padding: 16px;
            margin-top: 10px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="app-container">
        
        <!-- Top Navbar -->
        <div class="navbar">
            <div class="nav-logo">
                <span>📦</span> OrderPro Pro
            </div>
            <div class="system-status">
                <div class="status-pill online">Terminal Active</div>
                <div class="status-pill">Statut : Client En Caisse</div>
            </div>
        </div>

        <!-- ================= WORKSPACE (NEW ORDER TAB OVERVIEW) ================= -->
        <div>
            
            <!-- Tier 1: 700px POS & General Registry Table -->
            <div style="display: grid; grid-template-columns: 700px 1fr; gap: 32px; align-items: start; margin-bottom: 32px;">
                
                <!-- 700px POS Form -->
                <div class="panel-card" style="margin-bottom: 0; padding: 24px; border: 1px solid rgba(59, 130, 246, 0.2); background: linear-gradient(180deg, rgba(17, 24, 43, 0.5) 0%, rgba(10, 15, 30, 0.3) 100%);">
                    <div class="panel-title" style="border-left-color: var(--accent); display: flex; justify-content: space-between; align-items: center;">
                        <span>🛒 Nouvelle Vente</span>
                        <span style="font-size: 11px; font-weight: 600; color: var(--text-muted); background: rgba(255,255,255,0.03); padding: 4px 8px; border-radius: 6px;">Terminal POS</span>
                    </div>
                    <form id="pos-mock-form" onsubmit="event.preventDefault(); alert('Commande simulée créée avec succès !');">
                        
                        <div class="form-group">
                            <label for="client_id">Client Acheteur</label>
                            <div style="position: relative;">
                                <select id="client_id" class="form-control" style="width: 100%; appearance: none; padding-right: 30px;">
                                    <option value="1">Abdou Ndiaye (77 654 32 10)</option>
                                    <option value="2">Fama Diouf (78 123 45 67)</option>
                                    <option value="3">Moussa Sarr (76 987 65 43)</option>
                                </select>
                                <span style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); pointer-events: none; color: var(--text-muted); font-size: 12px;">▼</span>
                            </div>
                        </div>

                        <!-- Articles Dynamic add -->
                        <div style="border-top: 1px dashed var(--border-color); padding-top: 16px; margin-top: 16px; margin-bottom: 16px;">
                            <label style="font-size: 12px; font-weight: 700; color: var(--accent); display: block; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Sélection des Articles</label>
                            <div style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 12px; align-items: flex-end; margin-bottom: 16px;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="pos-item-select">Article</label>
                                    <select id="pos-item-select" class="form-control" style="background-color: #0b0f1a; color: white;">
                                        <option value="25000" data-name="Sac de riz 50kg" data-stock="100">Sac de riz 50kg (Stock : 100) - 25 000 F</option>
                                        <option value="8000" data-name="Bidon d'huile 5L" data-stock="5">Bidon d'huile 5L (Stock : 5) - 8 000 F</option>
                                        <option value="12000" data-name="Carton de savon" data-stock="4">Carton de savon (Stock : 4) - 12 000 F</option>
                                        <option value="1500" data-name="Paquet de sucre 1kg" data-stock="200">Paquet de sucre 1kg (Stock : 200) - 1 500 F</option>
                                        <option value="15000" data-name="Carton de lait" data-stock="3">Carton de lait (Stock : 3) - 15 000 F</option>
                                        <option value="2000" data-name="Huile de palme 1L" data-stock="0">Huile de palme 1L (Stock : 0) - 2 000 F</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label for="pos-qty">Quantité</label>
                                    <input type="number" id="pos-qty" class="form-control" value="1" min="1" style="padding: 12px 10px;">
                                </div>
                                <button type="button" class="btn-submit" onclick="addToCart(event)" style="height: 46px; width: 46px; font-size: 18px; display: flex; justify-content: center; align-items: center; background: linear-gradient(135deg, var(--accent) 0%, #1d4ed8 100%); font-weight: bold; border-radius: 10px;">+</button>
                            </div>

                            <!-- Cart Items list table -->
                            <table class="debt-table" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th style="padding-bottom: 8px;">Produit</th>
                                        <th style="padding-bottom: 8px;">Qté</th>
                                        <th style="padding-bottom: 8px;">Total</th>
                                        <th style="padding-bottom: 8px;"></th>
                                    </tr>
                                </thead>
                                <tbody id="cart-rows">
                                    <tr id="empty-cart-row">
                                        <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 16px 0; border-bottom: none;">Panier vide. Ajoutez des articles.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Ecran de Caisse Digital -->
                        <div style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.08) 0%, rgba(30, 41, 59, 0.4) 100%); border: 1px solid rgba(59, 130, 246, 0.15); border-radius: 16px; padding: 18px; text-align: center; margin-bottom: 20px; box-shadow: inset 0 0 15px rgba(59, 130, 246, 0.08);">
                            <span style="font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 1px; display: block; margin-bottom: 4px;">Montant Total Net à Payer</span>
                            <div style="font-size: 28px; font-weight: 900; color: #60a5fa; letter-spacing: -0.5px; font-family: monospace; text-shadow: 0 0 10px rgba(96, 165, 250, 0.3);">
                                <span id="montant_total_display_text">0</span> <span style="font-size: 16px; font-weight: 700;">FCFA</span>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 24px;">
                            <label for="mode_reglement">Mode de Règlement</label>
                            <select id="mode_reglement" class="form-control">
                                <option value="Wave">Wave</option>
                                <option value="Orange Money">Orange Money</option>
                                <option value="Especes">Espèces (Cash)</option>
                                <option value="Virement">Virement bancaire</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-submit btn-success" style="padding: 16px 24px; font-weight: 800; font-size: 14px;">Valider la Vente (DML Simulation)</button>
                    </form>
                </div>

                <!-- Right Side: Registry Table & Critical Stocks -->
                <div>
                    <!-- Orders Registry Table -->
                    <div class="panel-card" style="margin-bottom: 24px;">
                        <div class="panel-title">Registre Général des Commandes</div>
                        <table class="debt-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Total Facture</th>
                                    <th>Règlement</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Command Row 1 -->
                                <tr>
                                    <td style="font-weight:700; color:var(--text-muted);">#CMD-01</td>
                                    <td>2026-08-01 10:30</td>
                                    <td style="font-weight:700;">
                                        Abdou Ndiaye
                                        <div style="font-size:11px; color:var(--text-muted); font-weight:normal;">Tél : 776543210</div>
                                    </td>
                                    <td style="font-weight:800; color:var(--accent);">58 000 F</td>
                                    <td><span style="font-size:11px; font-weight:700; color:var(--info);">Wave</span></td>
                                    <td><span class="badge payee">LIVRÉE</span></td>
                                    <td>
                                        <button class="btn-quick-action" onclick="toggleDetails('order-details-1')">Lignes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding:0; border:none;">
                                        <div class="details-drawer" id="order-details-1">
                                            <div style="font-weight:700; font-size:12px; color:var(--accent); margin-bottom:10px;">Lignes de Commande (Détail Facture) :</div>
                                            <table class="debt-table" style="font-size:11px;">
                                                <thead>
                                                    <tr>
                                                        <th style="padding-bottom:6px;">Produit</th>
                                                        <th style="padding-bottom:6px;">Quantité</th>
                                                        <th style="padding-bottom:6px;">Prix Vente</th>
                                                        <th style="padding-bottom:6px;">Sous-total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="font-weight:700;">Sac de riz 50kg</td>
                                                        <td>2</td>
                                                        <td>25 000 F</td>
                                                        <td style="font-weight:700; color:var(--accent);">50 000 F</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight:700;">Bidon d'huile 5L</td>
                                                        <td>1</td>
                                                        <td>8 000 F</td>
                                                        <td style="font-weight:700; color:var(--accent);">8 000 F</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Command Row 2 -->
                                <tr>
                                    <td style="font-weight:700; color:var(--text-muted);">#CMD-02</td>
                                    <td>2026-08-05 14:15</td>
                                    <td style="font-weight:700;">
                                        Fama Diouf
                                        <div style="font-size:11px; color:var(--text-muted); font-weight:normal;">Tél : 781234567</div>
                                    </td>
                                    <td style="font-weight:800; color:var(--accent);">20 000 F</td>
                                    <td><span style="font-size:11px; font-weight:700; color:var(--info);">Orange Money</span></td>
                                    <td><span class="badge non-payee">EN ATTENTE</span></td>
                                    <td>
                                        <button class="btn-quick-action" onclick="toggleDetails('order-details-2')">Lignes</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="padding:0; border:none;">
                                        <div class="details-drawer" id="order-details-2">
                                            <div style="font-weight:700; font-size:12px; color:var(--accent); margin-bottom:10px;">Lignes de Commande (Détail Facture) :</div>
                                            <table class="debt-table" style="font-size:11px;">
                                                <thead>
                                                    <tr>
                                                        <th style="padding-bottom:6px;">Produit</th>
                                                        <th style="padding-bottom:6px;">Quantité</th>
                                                        <th style="padding-bottom:6px;">Prix Vente</th>
                                                        <th style="padding-bottom:6px;">Sous-total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="font-weight:700;">Bidon d'huile 5L</td>
                                                        <td>1</td>
                                                        <td>8 000 F</td>
                                                        <td style="font-weight:700; color:var(--accent);">8 000 F</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight:700;">Paquet de sucre 1kg</td>
                                                        <td>8</td>
                                                        <td>1 500 F</td>
                                                        <td style="font-weight:700; color:var(--accent);">12 000 F</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Critical Stocks list -->
                    <div class="panel-card" style="margin-bottom: 0;">
                        <div class="panel-title" style="border-left-color: var(--danger);">⚠️ Niveaux de Stocks Critiques</div>
                        <div style="display:flex; flex-direction:column; gap:12px;">

                            <?php $ProduitStockCritique=$ProduitStockCritique??[];
                            foreach ($ProduitStockCritique as $ProduitStockCritique):?>
                            <div style="display:flex; justify-content:space-between; font-size:13px; border-bottom:1px solid rgba(255,255,255,0.03); padding-bottom:8px;">
                                <span style="font-weight:700;"><?php echo $ProduitStockCritique['libelle']?></span>
                                <span 
                                style="color:var(--<?php echo $ProduitStockCritique['color'] ?>); font-weight:800;"><?php echo $ProduitStockCritique['qtestock']?> en stock</span>
                            </div>
                            <?php endforeach?>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Tier 2: Catalog additions & Client Additions -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; align-items: start;">
                
                <!-- Left: Catalog add product -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <div class="panel-title">Créer un Produit</div>
                    <form onsubmit="event.preventDefault(); alert('Produit simulé créé avec succès !');">
                        <div class="form-group">
                            <label for="nom">Nom de l'Article</label>
                            <input type="text" id="nom" class="form-control" placeholder="Ex: Carton de savon" required>
                        </div>
                        <div class="form-group">
                            <label for="prix_unitaire">Prix Unitaire (FCFA)</label>
                            <input type="number" id="prix_unitaire" class="form-control" placeholder="Ex: 12000" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="quantite_stock">Quantité en Stock Initial</label>
                            <input type="number" id="quantite_stock" class="form-control" placeholder="Ex: 50" min="0" required>
                        </div>
                        <button type="submit" class="btn-submit">Enregistrer l'Article (DML)</button>
                    </form>
                </div>

                <!-- Right: Add Client Panel -->
                <div class="panel-card" style="margin-bottom: 0;">
                    <div class="panel-title">Enregistrer un Client</div>
                    <form onsubmit="event.preventDefault(); alert('Client simulé enregistré avec succès !');">
                        <div class="form-row" style="display:flex; gap:16px;">
                            <div class="form-group" style="flex:1;">
                                <label for="prenom">Prénom</label>
                                <input type="text" id="prenom" class="form-control" placeholder="Ex: Abdou" required>
                            </div>
                            <div class="form-group" style="flex:1;">
                                <label for="nom-client">Nom</label>
                                <input type="text" id="nom-client" class="form-control" placeholder="Ex: Ndiaye" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" id="telephone" class="form-control" placeholder="Ex: 776543210" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail (Optionnel)</label>
                            <input type="email" id="email" class="form-control" placeholder="Ex: abdou.ndiaye@email.sn">
                        </div>
                        <button type="submit" class="btn-submit btn-success">Enregistrer le Client (DML)</button>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <!-- JavaScript Single Page Cart Simulator & drawer toggle -->
    <script>
        function toggleDetails(panelId) {
            const panel = document.getElementById(panelId);
            const isVisible = window.getComputedStyle(panel).display !== 'none';
            panel.style.display = isVisible ? 'none' : 'block';
        }

        // Live Order Shopping Cart Logic
        const cart = [];

        function addToCart(event) {
            event.preventDefault();
            const select = document.getElementById("pos-item-select");
            const value = select.value;
            const price = parseFloat(value);
            const name = select.options[select.selectedIndex].getAttribute("data-name");
            const stock = parseInt(select.options[select.selectedIndex].getAttribute("data-stock"));
            const qty = parseInt(document.getElementById("pos-qty").value);

            if (qty <= 0) return;

            // Check if quantity is higher than stock
            if (qty > stock) {
                alert("Erreur : La quantité demandée (" + qty + ") dépasse le stock disponible (" + stock + ") !");
                return;
            }

            // Check if already in cart
            const existing = cart.find(item => item.name === name);
            if (existing) {
                if (existing.qty + qty > stock) {
                    alert("Erreur : La quantité cumulée dépasse le stock disponible (" + stock + ") !");
                    return;
                }
                existing.qty += qty;
                existing.total = existing.qty * price;
            } else {
                cart.push({ name, price, qty, total: qty * price });
            }

            renderCart();
        }

        function removeCartItem(index) {
            cart.splice(index, 1);
            renderCart();
        }

        function renderCart() {
            const body = document.getElementById("cart-rows");
            const textDisplay = document.getElementById("montant_total_display_text");

            if (cart.length === 0) {
                body.innerHTML = `
                    <tr id="empty-cart-row">
                        <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 16px 0; border-bottom: none;">Panier vide. Ajoutez des articles.</td>
                    </tr>
                `;
                textDisplay.innerText = "0";
                return;
            }

            body.innerHTML = "";
            let overallTotal = 0;

            cart.forEach((item, index) => {
                overallTotal += item.total;
                body.innerHTML += `
                    <tr>
                        <td style="padding: 8px 0; font-weight:700;">${item.name}</td>
                        <td style="padding: 8px 0;">${item.qty}</td>
                        <td style="padding: 8px 0; font-weight:800; color:var(--accent);">${new Intl.NumberFormat('fr-FR').format(item.total)} F</td>
                        <td style="padding: 8px 0; text-align:right;">
                            <button type="button" onclick="removeCartItem(${index})" style="background:none; border:none; color:var(--danger); cursor:pointer; font-size:14px;">🗑️</button>
                        </td>
                    </tr>
                `;
            });

            textDisplay.innerText = new Intl.NumberFormat('fr-FR').format(overallTotal);
        }
    </script>
</body>
</html>
