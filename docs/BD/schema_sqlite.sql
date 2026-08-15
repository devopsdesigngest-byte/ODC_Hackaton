PRAGMA foreign_keys = ON;

CREATE TABLE roles (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_role TEXT NOT NULL UNIQUE
);

CREATE TABLE utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom_complet TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL,
    adresse TEXT,
    numero_telephone TEXT,
    role_id INTEGER NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    email TEXT UNIQUE,
    numero_telephone TEXT,
    limite_credit NUMERIC NOT NULL DEFAULT 0,
    CHECK (limite_credit >= 0)
);

CREATE TABLE modes_paiement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL UNIQUE
);

CREATE TABLE produits (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL,
    prix_vente NUMERIC NOT NULL,
    stock_initial INTEGER NOT NULL DEFAULT 0,
    CHECK (prix_vente >= 0),
    CHECK (stock_initial >= 0)
);

CREATE TABLE commandes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date_commande TEXT NOT NULL DEFAULT (date('now')),
    montant_total NUMERIC NOT NULL DEFAULT 0,
    montant_avance NUMERIC NOT NULL DEFAULT 0,
    client_id INTEGER NOT NULL,
    utilisateur_id INTEGER NOT NULL,
    mode_paiement_id INTEGER NOT NULL,

    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (mode_paiement_id) REFERENCES modes_paiement(id),

    CHECK (montant_total >= 0),
    CHECK (montant_avance >= 0),
    CHECK (montant_avance <= montant_total)
);

CREATE TABLE lignes_commande (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quantite INTEGER NOT NULL,
    prix_unitaire NUMERIC NOT NULL,
    sous_total NUMERIC NOT NULL,
    commande_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,

    FOREIGN KEY (commande_id)
        REFERENCES commandes(id)
        ON DELETE CASCADE,

    FOREIGN KEY (produit_id)
        REFERENCES produits(id),

    CHECK (quantite > 0),
    CHECK (prix_unitaire >= 0),
    CHECK (sous_total >= 0)
);

CREATE TABLE dettes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    montant_initial NUMERIC NOT NULL,
    montant_restant NUMERIC NOT NULL,
    date_creation TEXT NOT NULL DEFAULT (date('now')),
    date_echeance TEXT,
    statut TEXT NOT NULL,
    commande_id INTEGER NOT NULL UNIQUE,

    FOREIGN KEY (commande_id)
        REFERENCES commandes(id)
        ON DELETE CASCADE,

    CHECK (montant_initial >= 0),
    CHECK (montant_restant >= 0),
    CHECK (montant_restant <= montant_initial)
);

CREATE TABLE reglements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date_reglement TEXT NOT NULL DEFAULT (date('now')),
    montant_verse NUMERIC NOT NULL,
    dette_id INTEGER NOT NULL,
    mode_paiement_id INTEGER NOT NULL,

    FOREIGN KEY (dette_id)
        REFERENCES dettes(id)
        ON DELETE CASCADE,

    FOREIGN KEY (mode_paiement_id)
        REFERENCES modes_paiement(id),

    CHECK (montant_verse > 0)
);

CREATE TABLE fournisseurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT UNIQUE,
    numero_telephone TEXT,
    adresse TEXT
);

CREATE TABLE statuts_appro (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL UNIQUE
);

CREATE TABLE approvisionnements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    reference_bon TEXT NOT NULL UNIQUE,
    date_approvisionnement TEXT NOT NULL DEFAULT (date('now')),
    fournisseur_id INTEGER NOT NULL,
    statut_appro_id INTEGER NOT NULL,
    utilisateur_id INTEGER NOT NULL,

    FOREIGN KEY (fournisseur_id)
        REFERENCES fournisseurs(id),

    FOREIGN KEY (statut_appro_id)
        REFERENCES statuts_appro(id),

    FOREIGN KEY (utilisateur_id)
        REFERENCES utilisateurs(id)
);

CREATE TABLE lignes_approvisionnement (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quantite_commandee INTEGER NOT NULL,
    quantite_recue INTEGER NOT NULL DEFAULT 0,
    prix_unitaire NUMERIC NOT NULL,
    approvisionnement_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,

    FOREIGN KEY (approvisionnement_id)
        REFERENCES approvisionnements(id)
        ON DELETE CASCADE,

    FOREIGN KEY (produit_id)
        REFERENCES produits(id),

    CHECK (quantite_commandee > 0),
    CHECK (quantite_recue >= 0),
    CHECK (quantite_recue <= quantite_commandee),
    CHECK (prix_unitaire >= 0)
);