CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    nom_role VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE utilisateurs (
    id SERIAL PRIMARY KEY,
    nom_complet VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    adresse VARCHAR(255),
    numero_telephone VARCHAR(30),
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE clients (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE,
    numero_telephone VARCHAR(30),
    limite_credit NUMERIC(12,2) NOT NULL DEFAULT 0,
    CHECK (limite_credit >= 0)
);

CREATE TABLE modes_paiement (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE produits (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(150) NOT NULL,
    prix_vente NUMERIC(12,2) NOT NULL,
    stock_initial INT NOT NULL DEFAULT 0,
    CHECK (prix_vente >= 0),
    CHECK (stock_initial >= 0)
);

CREATE TABLE commandes (
    id SERIAL PRIMARY KEY,
    date_commande DATE NOT NULL DEFAULT CURRENT_DATE,
    montant_total NUMERIC(12,2) NOT NULL DEFAULT 0,
    montant_avance NUMERIC(12,2) NOT NULL DEFAULT 0,
    client_id INT NOT NULL,
    utilisateur_id INT NOT NULL,
    mode_paiement_id INT NOT NULL,

    FOREIGN KEY (client_id) REFERENCES clients(id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (mode_paiement_id) REFERENCES modes_paiement(id),

    CHECK (montant_total >= 0),
    CHECK (montant_avance >= 0),
    CHECK (montant_avance <= montant_total)
);

CREATE TABLE lignes_commande (
    id SERIAL PRIMARY KEY,
    quantite INT NOT NULL,
    prix_unitaire NUMERIC(12,2) NOT NULL,
    sous_total NUMERIC(12,2) NOT NULL,
    commande_id INT NOT NULL,
    produit_id INT NOT NULL,

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
    id SERIAL PRIMARY KEY,
    montant_initial NUMERIC(12,2) NOT NULL,
    montant_restant NUMERIC(12,2) NOT NULL,
    date_creation DATE NOT NULL DEFAULT CURRENT_DATE,
    date_echeance DATE,
    statut VARCHAR(30) NOT NULL,
    commande_id INT NOT NULL UNIQUE,

    FOREIGN KEY (commande_id)
        REFERENCES commandes(id)
        ON DELETE CASCADE,

    CHECK (montant_initial >= 0),
    CHECK (montant_restant >= 0),
    CHECK (montant_restant <= montant_initial)
);

CREATE TABLE reglements (
    id SERIAL PRIMARY KEY,
    date_reglement DATE NOT NULL DEFAULT CURRENT_DATE,
    montant_verse NUMERIC(12,2) NOT NULL,
    dette_id INT NOT NULL,
    mode_paiement_id INT NOT NULL,

    FOREIGN KEY (dette_id)
        REFERENCES dettes(id)
        ON DELETE CASCADE,

    FOREIGN KEY (mode_paiement_id)
        REFERENCES modes_paiement(id),

    CHECK (montant_verse > 0)
);

CREATE TABLE fournisseurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE,
    numero_telephone VARCHAR(30),
    adresse VARCHAR(255)
);

CREATE TABLE statuts_appro (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE approvisionnements (
    id SERIAL PRIMARY KEY,
    reference_bon VARCHAR(100) NOT NULL UNIQUE,
    date_approvisionnement DATE NOT NULL DEFAULT CURRENT_DATE,
    fournisseur_id INT NOT NULL,
    statut_appro_id INT NOT NULL,
    utilisateur_id INT NOT NULL,

    FOREIGN KEY (fournisseur_id)
        REFERENCES fournisseurs(id),

    FOREIGN KEY (statut_appro_id)
        REFERENCES statuts_appro(id),

    FOREIGN KEY (utilisateur_id)
        REFERENCES utilisateurs(id)
);

CREATE TABLE lignes_approvisionnement (
    id SERIAL PRIMARY KEY,
    quantite_commandee INT NOT NULL,
    quantite_recue INT NOT NULL DEFAULT 0,
    prix_unitaire NUMERIC(12,2) NOT NULL,
    approvisionnement_id INT NOT NULL,
    produit_id INT NOT NULL,

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


ALTER TABLE statuts_appro
ADD CONSTRAINT check_statut_appro
CHECK (libelle IN ('En cours', 'Réceptionné'));

ALTER TABLE dettes
ADD CONSTRAINT check_statut_dette
CHECK (statut IN ('Solde', 'Non solde'));