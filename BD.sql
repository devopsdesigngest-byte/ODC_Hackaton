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

SELECT c.nom || ' ' || c.prenom as nomcomplet, c.numero_telephone, c.limite_credit FROM clients c ORDER BY c.id DESC;

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
SELECT p.libelle, p.prix_vente, p.stock_initial From produits p ORDER BY p.id DESC; 


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
SELECT f.nom, f.numero_telephone, f.adresse From fournisseurs f ORDER BY f.id DESC; 

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



-- =====================================================
-- ROLES
-- =====================================================

INSERT INTO roles (nom_role) VALUES
('Administrateur'),
('Vendeur'),
('Stock'),
('Inventaire');


-- =====================================================
-- UTILISATEURS
-- =====================================================

INSERT INTO utilisateurs
(nom_complet, email, mot_de_passe, adresse, numero_telephone, role_id)
VALUES
('Lamine Mbowe', 'lamine@gmail.com', '123456', 'Dakar', '771234567', 1),
('Moussa Diop', 'moussa@gmail.com', '123456', 'Dakar', '772345678', 2),
('Awa Cissé', 'awa@gmail.com', '123456', 'Pikine', '773456789', 3);


-- =====================================================
-- CLIENTS
-- =====================================================

INSERT INTO clients
(nom, prenom, email, numero_telephone, limite_credit)
VALUES
('Diop', 'Moussa', 'moussa.diop@gmail.com', '771111111', 500000),
('Cissé', 'Awa', 'awa.cisse@gmail.com', '772222222', 300000),
('Diallo', 'Maimouna', 'maimouna.diallo@gmail.com', '773333333', 120000),
('Diouf', 'Fama', 'fama.diouf@gmail.com', '774444444', 200000),
('Ndiaye', 'Ousmane', 'ousmane.ndiaye@gmail.com', '775555555', 150000);


-- =====================================================
-- MODES DE PAIEMENT
-- =====================================================

INSERT INTO modes_paiement (libelle) VALUES
('Espèces'),
('Wave'),
('Orange Money'),
('Carte bancaire');


-- =====================================================
-- PRODUITS
-- =====================================================

INSERT INTO produits
(libelle, prix_vente, stock_initial)
VALUES
('Bidon d''huile 5L', 8000, 5),
('Carton de lait', 15000, 40),
('Carton de savon', 12000, 3),
('Huile de palme 1L', 2000, 0),
('Paquet de sucre 1kg', 1500, 200),
('Sac de riz 50kg', 25000, 100),
('Carton de tomate', 10000, 30),
('Bidon d''eau 20L', 3000, 50);


-- =====================================================
-- COMMANDES
-- =====================================================

INSERT INTO commandes
(date_commande, montant_total, montant_avance,
 client_id, utilisateur_id, mode_paiement_id)
VALUES
('2026-08-20', 23000, 23000, 1, 2, 1),
('2026-08-21', 27000, 15000, 2, 2, 2),
('2026-08-21', 25000, 25000, 3, 1, 3),
('2026-08-22', 30000, 10000, 4, 2, 1);


-- =====================================================
-- LIGNES DE COMMANDES
-- =====================================================

INSERT INTO lignes_commande
(quantite, prix_unitaire, sous_total, commande_id, produit_id)
VALUES
(1, 8000, 8000, 1, 1),
(1, 15000, 15000, 1, 2),

(1, 12000, 12000, 2, 3),
(1, 15000, 15000, 2, 6),

(1, 25000, 25000, 3, 6),

(2, 15000, 30000, 4, 2);


-- =====================================================
-- DETTES
-- =====================================================

INSERT INTO dettes
(montant_initial, montant_restant, date_creation,
 date_echeance, statut, commande_id)
VALUES
(12000, 12000, '2026-08-21', '2026-09-21', 'Non solde', 2),
(20000, 20000, '2026-08-22', '2026-09-22', 'Non solde', 4);


-- =====================================================
-- REGLEMENTS
-- =====================================================

INSERT INTO reglements
(date_reglement, montant_verse, dette_id, mode_paiement_id)
VALUES
('2026-08-22', 5000, 1, 2),
('2026-08-23', 5000, 2, 3);


-- =====================================================
-- FOURNISSEURS
-- =====================================================

INSERT INTO fournisseurs
(nom, email, numero_telephone, adresse)
VALUES
('SEN Distribution', 'contact@sendistribution.com', '771111222', 'Dakar'),
('Africa Commerce', 'contact@africacommerce.com', '772222333', 'Pikine'),
('Sunu Fournitures', 'contact@sunufournitures.com', '773333444', 'Guédiawaye');


-- =====================================================
-- STATUTS APPROVISIONNEMENT
-- =====================================================

INSERT INTO statuts_appro (libelle) VALUES
('En cours'),
('Réceptionné');


-- =====================================================
-- APPROVISIONNEMENTS
-- =====================================================

INSERT INTO approvisionnements
(reference_bon, date_approvisionnement,
 fournisseur_id, statut_appro_id, utilisateur_id)
VALUES
('BON-2026-001', '2026-08-20', 1, 2, 3),
('BON-2026-002', '2026-08-21', 2, 2, 3),
('BON-2026-003', '2026-08-23', 3, 1, 1);


-- =====================================================
-- LIGNES APPROVISIONNEMENT
-- =====================================================

INSERT INTO lignes_approvisionnement
(quantite_commandee, quantite_recue, prix_unitaire,
 approvisionnement_id, produit_id)
VALUES
(20, 20, 6500, 1, 1),
(50, 50, 12000, 1, 2),

(10, 10, 9000, 2, 3),
(100, 100, 1000, 2, 5),

(30, 0, 2000, 3, 4),
(50, 0, 22000, 3, 6);









































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
    CHECK (montant_restant <= montant_initial),
    CHECK (statut IN ('Solde', 'Non solde'))
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
    libelle TEXT NOT NULL UNIQUE,
    CHECK (libelle IN ('En cours', 'Réceptionné'))
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











Client(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL UNIQUE,
    adresse VARCHAR(255)
)

ModePaiement(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (AVANCE(CREDIT), CREDITTOTAL, COMPTANT(WAVE))
)

ModeReglement(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (WAVE, OM)
)

Statut(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE CHECK (NON SOLDEE, SOLDE)
)

Article(
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(150) NOT NULL,
    prixVente NUMERIC(12,2) NOT NULL CHECK (prixVente > 100),
    qteStock INTEGER NOT NULL CHECK (qteStock >= 0)
)

LigneVente(
    id SERIAL PRIMARY KEY,
    prixReel NUMERIC(12,2) NOT NULL CHECK (prixReel >= 100),
    qte INTEGER NOT NULL CHECK (qte > 0),
    vente_id INTEGER, 
    article_id INTEGER 
)

Vente(
    id SERIAL PRIMARY KEY,
    dat TIMESTAMP NOT NULL DEFAULT CURRENT_DATE,
    montantInit NUMERIC(12,2) NOT NULL CHECK (montantInit >= 0),
    montantPaye NUMERIC(12,2) NOT NULL DEFAULT 0 CHECK (montantPaye <= montantInit and montantPaye >=0),
    client_id INTEGER,
    statut_id INTEGER,
    modePaiement_id INTEGER,
    modeReglement_id INTEGER
)

Versement(
    id SERIAL PRIMARY KEY,
    montant NUMERIC(12,2) NOT NULL CHECK (montant > 0),
    dat TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    vente_id INTEGER NOT NULL REFERENCES Vente(id),
    modeReglement_id INTEGER NOT NULL REFERENCES ModeReglement(id)
)














CREATE TABLE fournisseur (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) UNIQUE NOT NULL,
    telephone VARCHAR(20) UNIQUE NOT NULL,
    adresse VARCHAR(255) NOT NULL
);

INSERT INTO fournisseur (nom, telephone, adresse) VALUES
('Sonacos', '771111111', 'Dakar'),
('Nestlé Sénégal', '772222222', 'Thiès'),
('CFAO', '773333333', 'Saint-Louis');

CREATE TABLE statut (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) UNIQUE NOT NULL
);

INSERT INTO statut (nom) VALUES
('EN_ATTENTE'),
('RECEPTIONNÉE'),
('ECART');

CREATE TABLE article (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(100) UNIQUE NOT NULL,
    prixAchat NUMERIC(10,2) NOT NULL CHECK (prixAchat >= 0),
    qteStock INTEGER NOT NULL CHECK (qteStock >= 0),
    fournisseur_id INTEGER NOT NULL REFERENCES fournisseur(id)    
);

INSERT INTO article (libelle, prixAchat, qteStock, fournisseur_id) VALUES
('Sucre 1Kg', 550.00, 100, 1),
('Lait en poudre', 3200.00, 80, 2),
('Huile 5L', 6500.00, 50, 1),
('Riz 25Kg', 13500.00, 30, 3),
('Savon', 450.00, 200, 2);

CREATE TABLE approvisionnement (
    id SERIAL PRIMARY KEY,
    refBL VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    fournisseur_id INTEGER NOT NULL REFERENCES fournisseur(id),
    statut_id INTEGER NOT NULL REFERENCES statut(id)
);

CREATE TABLE ligne_appro (
    id SERIAL PRIMARY KEY,
    prixAchatReel NUMERIC(10,2) NOT NULL CHECK (prixAchatReel >= 0),
    qteAppro INTEGER NOT NULL CHECK (qteAppro > 0),
    qteRecue INTEGER NOT NULL DEFAULT 0 CHECK (qteRecue >= 0),
    approvisionnement_id INTEGER NOT NULL REFERENCES approvisionnement(id),
    article_id INTEGER NOT NULL REFERENCES article(id)
);






















BEGIN;

WITH nouvel_appro AS (
    INSERT INTO approvisionnement (
        refBL,
        date,
        fournisseur_id,
        statut_id
    )
    VALUES (
        '#BL-SON-001',
        NOW(),
        1,
        3
    )
    RETURNING id
)
INSERT INTO ligne_appro (
    prixAchatReel,
    qteAppro,
    qteRecue,
    approvisionnement_id,
    article_id
)

SELECT 550.00, 25, 20, id, 1
FROM nouvel_appro

UNION ALL

SELECT 13200.00, 10, 9, id, 3
FROM nouvel_appro;

COMMIT;






try {
    $pdo->beginTransaction();

    $sql = "
        WITH nouvel_appro AS (
            INSERT INTO approvisionnement (
                refBL,
                date,
                fournisseur_id,
                statut_id
            )
            VALUES (
                :refBL,
                NOW(),
                :fournisseur_id,
                :statut_id
            )
            RETURNING id
        )
        INSERT INTO ligne_appro (
            prixAchatReel,
            qteAppro,
            qteRecue,
            approvisionnement_id,
            article_id
        )
        SELECT :prix1, :qteAppro1, :qteRecue1, id, :article1
        FROM nouvel_appro

        UNION ALL

        SELECT :prix2, :qteAppro2, :qteRecue2, id, :article2
        FROM nouvel_appro
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'refBL' => '#BL-SON-001',
        'fournisseur_id' => 1,
        'statut_id' => 3,

        'prix1' => 550.00,
        'qteAppro1' => 25,
        'qteRecue1' => 20,
        'article1' => 1,

        'prix2' => 13200.00,
        'qteAppro2' => 10,
        'qteRecue2' => 9,
        'article2' => 3
    ]);

    $pdo->commit();

} catch (PDOException $e) {

    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    throw $e;
}






BEGIN;

WITH nouvel_appro AS (
    INSERT INTO approvisionnement (
        refBL,
        date,
        fournisseur_id,
        statut_id
    )
    VALUES (
        '#BL-SON-001',
        NOW(),
        1,
        2
    )
    RETURNING id
)
INSERT INTO ligne_appro (
    prixAchatReel,
    qteAppro,
    qteRecue,
    approvisionnement_id,
    article_id
)

SELECT 550.00, 25, 25, id, 1
FROM nouvel_appro

UNION ALL

SELECT 6400.00, 15, 15, id, 3
FROM nouvel_appro


COMMIT;






DELETE FROM ligne_appro;
DELETE FROM approvisionnement;

SELECT * FROM approvisionnement;
SELECT * FROM article;
SELECT * FROM statut;
SELECT * FROM ligne_appro;
SELECT * FROM fournisseur;







CREATE TABLE fournisseurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    telephone VARCHAR(50) NOT NULL UNIQUE,
    adresse VARCHAR(100) NOT NULL
);

CREATE TABLE statuts (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    CONSTRAINT ck_statut_nom
        CHECK (nom IN ('En cours', 'Receptionnes'))
);

CREATE TABLE articles (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL,
    prixAchat NUMERIC(10,2) NOT NULL CHECK (prixAchat >= 0),
    qteStock INTEGER NOT NULL DEFAULT 0 CHECK (qteStock >= 0),
    qteSeuil INTEGER NOT NULL DEFAULT 5 CHECK (qteSeuil >= 0),
    fournisseurs_id INT NOT NULL,
    CONSTRAINT fk_article_fournisseur
        FOREIGN KEY (fournisseurs_id)
        REFERENCES fournisseurs(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE approvisionnements (
    id SERIAL PRIMARY KEY,
    refBL VARCHAR(50) NOT NULL UNIQUE,
    dat DATE NOT NULL DEFAULT CURRENT_DATE,
    statut_id INT NOT NULL,
    fournisseur_id INT NOT NULL,

    CONSTRAINT fk_approvisionnement_statut
        FOREIGN KEY (statut_id)
        REFERENCES statuts(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT fk_approvisionnement_fournisseur
        FOREIGN KEY (fournisseur_id)
        REFERENCES fournisseurs(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE ligneAppros (
    id SERIAL PRIMARY KEY,
    prixAchatReel NUMERIC(10,2) NOT NULL
        CHECK (prixAchatReel >= 0),
    qteAppro INTEGER NOT NULL
        CHECK (qteAppro > 0),
    qteRecue INTEGER NOT NULL DEFAULT 0
        CHECK (qteRecue >= 0),
    article_id INT NOT NULL,
    approvisionnement_id INT NOT NULL,
    CONSTRAINT fk_ligne_article
        FOREIGN KEY (article_id)
        REFERENCES articles(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    CONSTRAINT fk_ligne_approvisionnement
        FOREIGN KEY (approvisionnement_id)
        REFERENCES approvisionnements(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT ck_quantite_recue
        CHECK (qteRecue <= qteAppro)
);






INSERT INTO fournisseurs
    (nom, telephone, adresse)
VALUES
    ('Fournisseur ABC', '771234567', 'Dakar'),
    ('Fournisseur XYZ', '781234567', 'Thies'),
    ('Fournisseur DEF', '761234567', 'Rufisque');

INSERT INTO statuts (nom)
VALUES
    ('En cours'),
    ('Receptionnes');

INSERT INTO articles
    (libelle, prixAchat, qteStock, qteSeuil, fournisseurs_id)
VALUES
    ('Ordinateur HP', 290000, 10, 5, 1),
    ('Souris Logitech', 4500, 3, 5, 1),
    ('Clavier Logitech', 8000, 8, 5, 2),
    ('Ecran Samsung', 150000, 2, 5, 2),
    ('Imprimante Canon', 120000, 6, 3, 3);

INSERT INTO approvisionnements
    (refBL, dat, statut_id, fournisseur_id)
VALUES
    ('BL-001', '2026-08-01', 2, 1),
    ('BL-002', '2026-08-03', 1, 2),
    ('BL-003', '2026-08-05', 2, 3);

INSERT INTO ligneAppros
    (prixAchatReel, qteAppro, qteRecue, article_id, approvisionnement_id)
VALUES
    (290000, 5, 5, 1, 1),
    (4500,   10, 10, 2, 1);

INSERT INTO ligneAppros
    (prixAchatReel, qteAppro, qteRecue, article_id, approvisionnement_id)
VALUES
    (8000, 8, 5, 3, 2),
    (150000, 3, 2, 4, 2);

INSERT INTO ligneAppros
    (prixAchatReel, qteAppro, qteRecue, article_id, approvisionnement_id)
VALUES
    (120000, 4, 4, 5, 3);

INSERT INTO approvisionnements
    (refBL, dat, statut_id, fournisseur_id)
VALUES
    ('BL-004', '2026-08-07', 1, 1);









    select * from approvisionnements;
select * from ligneAppros;



SELECT
    a.refBL, f.nom,
    COALESCE(SUM(l.prixAchatReel * l.qteAppro), 0) AS valeurFacturee,
    COALESCE(SUM(l.prixAchatReel * l.qteRecue), 0) AS valeurReceptionnee,
    CASE
        WHEN COALESCE(SUM(l.prixAchatReel * l.qteAppro), 0) = COALESCE(SUM(l.prixAchatReel * l.qteRecue), 0)
        AND s.nom = 'Receptionnes' 
        THEN 'concorde'
        WHEN COALESCE(SUM(l.prixAchatReel * l.qteAppro), 0) = COALESCE(SUM(l.prixAchatReel * l.qteRecue), 0)
        AND s.nom = 'En cours'
        THEN 'en attente'
        ELSE 'ECART: ' || (COALESCE(SUM(l.prixAchatReel * l.qteRecue), 0) - COALESCE(SUM(l.prixAchatReel * l.qteAppro), 0))
    END AS diagnostic,
    s.nom AS statut
FROM approvisionnements a INNER JOIN fournisseurs f ON a.fournisseur_id = f.id
INNER JOIN ligneAppros l ON l.approvisionnement_id = a.id
INNER JOIN statuts s ON a.statut_id = s.id
GROUP BY a.id, a.refBL, f.nom, s.nom;


SELECT a.libelle, a.qteStock, 
    CASE
        WHEN a.qteStock = 0 
        THEN 'Rupture total : ' || a.qteStock || ' en stock' 
        ELSE
            'Alerte : ' || a.qteStock || ' en stock'
    END AS statut
FROM articles a 
WHERE a.qteStock <= a.qteSeuil;



SELECT a.id, a.libelle, a.prixAchat, a.qteStock, a.qteSeuil, f.nom AS fournisseur FROM articles a
INNER JOIN fournisseurs f ON a.fournisseurs_id = f.id 
ORDER BY a.id;

SELECT a.id, a.refBL, f.nom AS fournisseur, a.dat, s.nom AS statut
FROM approvisionnements a 
INNER JOIN fournisseurs f ON a.fournisseur_id = f.id
INNER JOIN statuts s ON a.statut_id = s.id
ORDER BY a.id;

SELECT a.id, a.refBL, la.qteRecue, la.qteAppro, ar.libelle, la.prixAchatReel,
    COALESCE(la.qteRecue * la.prixAchatReel, 0) AS montant,
    TO_CHAR(a.dat, 'DD-MM-YYYY') AS dat
FROM ligneAppros la
INNER JOIN articles ar ON la.article_id = ar.id
INNER JOIN approvisionnements a ON la.approvisionnement_id = a.id
ORDER BY a.id, la.id;

SELECT f.nom AS fournisseur, a.libelle AS article FROM fournisseurs f
INNER JOIN articles a ON a.fournisseurs_id = f.id
ORDER BY f.id, a.id;

SELECT f.nom, f.id FROM fournisseurs f;

SELECT ar.libelle, ar.id, la.prixAchatReel 
FROM articles ar 
INNER JOIN ligneAppros la 
ON ar.id = la.article_id;



-- BEGIN TRANSACTION;
--         $sql = "
--             UPDATE ligneAppros
--             SET qteRecue = :qteRecue,
--                 prixAchatReel = :prixAchatReel
--             WHERE id = :id
--         ";
--             UPDATE approvisionnements
--             SET statut_id = (
--                 SELECT id
--                 FROM statuts
--                 WHERE nom = 'Receptionnes'
--             )
--             WHERE id = :id
--         ";
-- COMMIT;

-- BEGIN TRANSACTION;
-- WITH saveAppro AS (
--     INSERT INTO approvisionnements
--         (refBL, fournisseur_id, statut_id)
--     VALUES
--         ('BL-001', 1, 1)
--     RETURNING id
-- ),
-- saveLigneAppro AS (
--     INSERT INTO ligneAppros
--         (prixAchatReel, qteAppro, qteRecue, article_id, approvisionnements_id)
--     VALUES
--         (290000, 5, 5, 1, (SELECT id FROM saveAppro)),
--         (4500, 10, 10, 2, (SELECT id FROM saveAppro))
-- )
-- UPDATE articles
-- SET qteStock = qteStock + 5
-- WHERE id = 1;
-- UPDATE articles
-- SET qteStock = qteStock + 10
-- WHERE id = 2;



<?php 
// composer 
// Transaction 
// truncate et les contraintes

// Les relations du tout et partie
// Maison ◆── Pièce : composition transaction est la consequence
// Équipe ◇── Joueur : agregation
// controller ..> model : dependency

// mode connexio
// throw new exception// die et throw
// pagination un seul function deux requete le dire pagine ou pas filter nom adapate pagination plus donne pas de pagination
// joker 
// PDO vs PG_connect 

// les elements html quon peut mettre en diseable
// URL SESSION RECALCULER 
?>




CREATE DATABASE gestionvente;

--clients(id SERIAL, nom VARCHAR NOT NULL, prenom VARCHAR NOT NULL,
--telephone VARCHAR UNIQUE NOT NULL, mail UNIQUE); 

CREATE TABLE clients (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    telephone VARCHAR(30) UNIQUE NOT NULL,
    mail VARCHAR(30) UNIQUE
);

--paiementModes(id SERIAL, nomMode VARCHAR NOT NULL UNIQUE);

CREATE TABLE paiementMode(
    id SERIAL PRIMARY KEY,
    nomMode VARCHAR(30) UNIQUE NOT NULL
);

ALTER TABLE paiementMode
 ADD CONSTRAINT chk_nomMode CHECK (nomMode in('OrangeMoney', 'Wave', 'Cash'));

--produits(id SERIAL, libelle VARCHAR UNIQUE NOT NULL, prixUnitaire NUMERIC(10,2), qteStock INTEGER )

CREATE TABLE produits(
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(30) UNIQUE NOT NULL, 
    prixUnitaire NUMERIC(10,2),
    qteStock INTEGER
);

--ligneVentes(id SERIAL, quantiteVente INTEGER, prixVente NUMERIC(10,2),
 --vente_id INT REFERENCES ventes(id), produit_id INT REFERENCES produits(id))

CREATE TABLE ligneVente(
    id SERIAL PRIMARY KEY,
    quantiteVente INTEGER,
    prixVente NUMERIC(10,2),
    vente_id INT REFERENCES ventes(id),
    produit_id INT REFERENCES produits(id)
);

--ventes(id SERIAL, montantTotal NUMERIC(10,2), client_id INT REFERENCES clients(id),
 --paiementMode_id INT REFERENCES paiementMode(id) );
CREATE TABLE ventes(
    id SERIAL PRIMARY KEY,
    montantTotal NUMERIC(10,2),
    client_id INT REFERENCES clients(id),
    paiementMode_id INT REFERENCES paiementMode(id) ,
    statut VARCHAR(30) CHECK(statut IN ('livree','en attente', 'annulee')) DEFAULT 'en attente',
    dateVente DATE DEFAULT CURRENT_DATE
);




INSERT INTO clients (nom,prenom,telephone,mail) 
VALUES
('Samba','Lena','771001010','lena@gmail.com'),
('Diop','Khadija','771234537','khadija@gmail.com'),
('Diouf','Mbagnik','771234567','Mbagnik@gmail.com'),
('Sall','Youssou','771234561','Youssou@gmail.com');

INSERT INTO paiementMode (nomMode) 
VALUES
('OrangeMoney'),
('Wave'),
('Cash');

INSERT INTO produits (libelle,prixUnitaire,qteStock)
VALUES 
('riz',600,20),
('savon',500,10),
('Lait',100,10),
('Ikram',125,1),
('Tempo',250,0),
('Deodorant',2000,5);



BEGIN TRANSACTION ;
WITH saveVente AS(
INSERT INTO ventes (montantTotal,client_id,paiementMode_id) 
VALUES 
(9500,1,1)
RETURNING id
),

saveLigneVente AS (INSERT INTO ligneVente (quantiteVente,prixVente,vente_id,produit_id)
VALUES
 (1,8000,(SELECT id FROM saveVente),1),
 (1,1500,(SELECT id FROM saveVente),3)
)

UPDATE produits SET qteStock = qteStock-1 WHERE id=1;
UPDATE produits SET qteStock = qteStock-1 WHERE id=3;

COMMIT;




TRUNCATE ventes RESTART IDENTITY CASCADE;

DELETE FROM ventes;
SELECT * FROM ventes;




SELECT 
CASE
WHEN v.id <= 9 THEN '#CMD-0' || id 
ELSE v.id 
END AS id, 
v.dateVente, cl.nom || ' ' || cl.prenom || ' ' || cl.telephone, v.montantTotal, p.nomMode, v.statut
FROM ventes v INNER JOIN  paiementMode p
ON v.paiementMode_id = p.id 
INNER JOIN  client cl 
ON c.client_id = cl.id;



SELECT p.libelle, p.qteStock, 
CASE 
WHEN p.qteStock BETWEEN 3 AND 5 THEN 'En stock' 
ELSE 'Rupture' 
END critique
FROM produits p WHERE p.qteStock <= 5;











--clients (id SERIAL, nom VARCHAR, prenom VARCHAR),

CREATE TABLE clients(
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL
);

INSERT INTO clients(
    nom, prenom
)
VALUES('Wane', 'Modou'),
('Mobutu', 'Moussa'),
('Sane','Abdou');

--dettes (id SERIAL, client_id INTEGER, montant_initial NUMERIC, montant_restant NUMERIC)

CREATE TABLE dettes(
    id SERIAL PRIMARY KEY,
    client_id INT REFERENCES clients(id),
    montant_initial NUMERIC(12,2),
    montant_restant NUMERIC(10,2)
);

SELECT * FROM clients;

INSERT INTO dettes(
   client_id, montant_initial, montant_restant, ref, date_echeance
)
VALUES(1, 100000,0,'D01','2026-06-20'),
(1, 200000,100000,'D02','2026-08-02');

INSERT INTO dettes(
   client_id, montant_initial, montant_restant, ref, date_echeance
)
VALUES(2, 200000,50000,'D03','2026-08-10'),
(2, 150000,100000,'D04','2026-07-20');


ALTER TABLE dettes 
ADD COLUMN date_echeance DATE ;

ALTER TABLE dettes
ADD COLUMN ref VARCHAR (40) UNIQUE ;

ALTER TABLE dettes
ADD COLUMN dateEmprunt DATE DEFAULT CURRENT_DATE ;




UPDATE dettes
SET date_echeance = '2026-06-20';

UPDATE dettes
SET date_echeance = '2026-08-07'
WHERE id = 8;

UPDATE dettes
SET date_echeance = '2026-08-04'
WHERE id = 8;

UPDATE dettes
SET date_echeance = '2026-08-02'
WHERE id = 6;















CREATE TABLE paiement(
    id SERIAL PRIMARY KEY,
    dette_id INT REFERENCES dettes(id),
    montantVersee NUMERIC(12,2),
    datePaiement DATE
);

INSERT INTO paiement(dette_id, montantVersee, datePaiement)
VALUES
-- D01 : 100000 versés
(1, 40000, '2026-05-10'),
(1, 60000, '2026-06-15'),

(2, 50000, '2026-07-10'),
(2, 50000, '2026-07-25'),

(3, 100000, '2026-07-20'),
(3, 50000, '2026-08-01'),

(4, 50000, '2026-07-15');





-- Vérification
SELECT * FROM dettes;

-- Statistiques globales de remboursement
SELECT COALESCE(SUM(montant_initial - montant_restant),0) AS totalRembourse,
COALESCE(SUM(montant_restant),0) AS totalRestant,
COUNT(id) AS nbreDettes,
ROUND(SUM(montant_initial - montant_restant) / NULLIF(SUM (montant_initial),0) * 100
) AS tauxRemboursement
FROM dettes ;

-- Total en retard (échéance dépassée)
SELECT SUM(montant_restant) AS totalRetard
FROM dettes 
WHERE date_echeance < CURRENT_DATE;

-- Fiche détaillée par dette, avec statut calculé
SELECT d.ref, c.nom, c.prenom,
to_char(d.dateEmprunt,'DD-MM-YYYY') AS dateEmprunt,
to_char(d.date_echeance,'DD-MM-YYYY') AS dateEcheance,
COALESCE(SUM(d.montant_initial),0) AS montantEmprunt, 
COALESCE(SUM(d.montant_restant),0) AS montantRestant ,
CASE 
WHEN d.montant_restant = 0 THEN 'REGLEE'
ELSE 'PARTIEL'
END AS statut
FROM dettes d 
INNER JOIN clients c  ON c.id = d.client_id
GROUP BY  d.ref,c.nom,c.prenom,d.dateEmprunt,d.date_echeance ,d.montant_restant;

-- Total remboursé / emprunté par client, avec taux
SELECT c.nom, c.prenom, SUM(d.montant_initial-d.montant_restant), SUM(d.montant_initial),
ROUND(SUM(montant_initial- montant_restant)/ NULLIF(SUM (montant_initial),0)* 100
)
FROM dettes d RIGHT JOIN clients c ON c.id = d.client_id 
GROUP BY c.nom,c.prenom ;

-- Dettes non soldées, par client
SELECT d.ref, c.nom, c.prenom, SUM(d.montant_restant) AS montantRestant
FROM clients c INNER JOIN dettes d 
ON c.id = d.client_id 
WHERE d.montant_restant <> 0
GROUP BY d.ref, c.nom, c.prenom;

-- Liste des clients (id + nom complet)
SELECT c.id, c.nom || ' ' || c.prenom AS nomComplet 
FROM clients c;

-- Historique des paiements par dette/client, avec mode déduit (logique à revoir :
-- teste si montantVersee = 0, ce qui ne peut jamais matcher vu la contrainte > 0)
SELECT p.datePaiement, d.ref, c.nom, c.prenom, ROUND(p.montantVersee, 0), 
CASE 
WHEN P.montantVersee = 0 THEN 'WAVE'
ELSE 'OM'
END AS modes
FROM dettes d 
INNER JOIN clients c ON c.id = d.client_id 
INNER JOIN paiement p ON d.id = p.dette_id;










TRUNCATE dettes;









CREATE DATABASE p5_StoreManagerPro;

CREATE TABLE Client (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL UNIQUE,
    adresse VARCHAR(255)
);

CREATE TABLE ModePaiement (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    CHECK (nom IN ('AVANCE', 'CREDIT_TOTAL', 'COMPTANT'))
);

CREATE TABLE ModeReglement (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    CHECK (nom IN ('WAVE', 'OM'))
);

CREATE TABLE Statut (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE,
    CHECK (nom IN ('NON_SOLDEE', 'SOLDE'))
);

CREATE TABLE Article (
    id SERIAL PRIMARY KEY,
    libelle VARCHAR(150) NOT NULL,
    prixVente NUMERIC(12,2) NOT NULL CHECK (prixVente > 100),
    qteStock INTEGER NOT NULL CHECK (qteStock >= 0)
);

CREATE TABLE Vente (
    id SERIAL PRIMARY KEY,
    dat TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montantInit NUMERIC(12,2) NOT NULL
        CHECK (montantInit >= 0),
    montantPaye NUMERIC(12,2) NOT NULL DEFAULT 0
        CHECK (
            montantPaye >= 0
            AND montantPaye <= montantInit
        ),
    client_id INTEGER NOT NULL,
    statut_id INTEGER NOT NULL,
    modePaiement_id INTEGER NOT NULL,
    modeReglement_id INTEGER,
    CONSTRAINT fk_vente_client
        FOREIGN KEY (client_id)
        REFERENCES Client(id),
    CONSTRAINT fk_vente_statut
        FOREIGN KEY (statut_id)
        REFERENCES Statut(id),
    CONSTRAINT fk_vente_mode_paiement
        FOREIGN KEY (modePaiement_id)
        REFERENCES ModePaiement(id),
    CONSTRAINT fk_vente_mode_reglement
        FOREIGN KEY (modeReglement_id)
        REFERENCES ModeReglement(id)
);

CREATE TABLE LigneVente (
    id SERIAL PRIMARY KEY,
    prixReel NUMERIC(12,2) NOT NULL
        CHECK (prixReel >= 100),
    qte INTEGER NOT NULL
        CHECK (qte > 0),
    vente_id INTEGER NOT NULL,
    article_id INTEGER NOT NULL,
    CONSTRAINT fk_ligne_vente
        FOREIGN KEY (vente_id)
        REFERENCES Vente(id),
    CONSTRAINT fk_ligne_article
        FOREIGN KEY (article_id)
        REFERENCES Article(id)
);

CREATE TABLE Versement (
    id SERIAL PRIMARY KEY,
    montant NUMERIC(12,2) NOT NULL CHECK (montant > 0),
    dat TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    vente_id INTEGER NOT NULL REFERENCES Vente(id),
    modeReglement_id INTEGER NOT NULL REFERENCES ModeReglement(id)
);


INSERT INTO Client (nom, prenom, telephone, adresse)
VALUES
('Diop', 'Moussa', '771111111', 'Dakar'),
('Ndiaye', 'Fatou', '772222222', 'Pikine'),
('Fall', 'Ibrahima', '773333333', 'Guediawaye'),
('Sow', 'Aminata', '774444444', 'Parcelles'),
('Ba', 'Cheikh', '775555555', 'Rufisque');

INSERT INTO ModePaiement (nom)
VALUES
('AVANCE'),
('CREDIT_TOTAL'),
('COMPTANT');

INSERT INTO ModeReglement (nom)
VALUES
('WAVE'),
('OM');

INSERT INTO Statut (nom)
VALUES
('NON_SOLDEE'),
('SOLDE');

INSERT INTO Article (libelle, prixVente, qteStock)
VALUES
('Ordinateur HP', 350000, 10),
('Ecran Samsung', 180000, 15),
('Clavier Logitech', 15000, 30),
('Souris Logitech', 8000, 40),
('Imprimante Canon', 220000, 8),
('Sac de riz 50kg', 25000, 50),
('Telephone Samsung', 150000, 20),
('Casque Bluetooth', 30000, 25);



INSERT INTO Vente (dat, montantInit, montantPaye, client_id, statut_id, modePaiement_id, modeReglement_id)
VALUES ('2026-08-01 10:30:00', 365000, 365000, 1, 2, 3, 1);

INSERT INTO Vente (dat, montantInit, montantPaye, client_id, statut_id, modePaiement_id, modeReglement_id)
VALUES ('2026-08-02 14:20:00', 230000, 100000, 2, 1, 1, 2);

INSERT INTO Vente (dat, montantInit, montantPaye, client_id, statut_id, modePaiement_id, modeReglement_id)
VALUES ('2026-08-03 09:15:00', 220000, 0, 3, 1, 2, NULL);

INSERT INTO Vente (dat, montantInit, montantPaye, client_id, statut_id, modePaiement_id, modeReglement_id)
VALUES ('2026-08-04 16:45:00', 166000, 166000, 4, 2, 3, 2);

INSERT INTO Vente (dat, montantInit, montantPaye, client_id, statut_id, modePaiement_id, modeReglement_id)
VALUES ('2026-08-05 11:00:00', 350000, 150000, 5, 1, 1, 1);

-- Vente 1
UPDATE Vente SET montantInit = 358000, montantPaye = 358000 WHERE id = 1;

INSERT INTO LigneVente (prixReel, qte, vente_id, article_id)
VALUES
(350000, 1, 1, 1),
(8000, 1, 1, 4);

-- Vente 2
UPDATE Vente SET montantInit = 195000 WHERE id = 2;

INSERT INTO LigneVente (prixReel, qte, vente_id, article_id)
VALUES
(180000, 1, 2, 2),
(15000, 1, 2, 3);

-- Vente 3
INSERT INTO LigneVente (prixReel, qte, vente_id, article_id)
VALUES (220000, 1, 3, 5);

-- Vente 4
UPDATE Vente SET montantInit = 173000, montantPaye = 173000 WHERE id = 4;

INSERT INTO LigneVente (prixReel, qte, vente_id, article_id)
VALUES
(150000, 1, 4, 7),
(8000, 1, 4, 4),
(15000, 1, 4, 3);

-- Vente 5
INSERT INTO LigneVente (prixReel, qte, vente_id, article_id)
VALUES (350000, 1, 5, 1);



INSERT INTO Versement (montant, vente_id, modeReglement_id)
VALUES
(10000, 1, 1),
(15000, 1, 2),
(5000, 2, 1),
(20000, 3, 2),
(10000, 3, 1);

SELECT * FROM Client;
SELECT * FROM ModePaiement;
SELECT * FROM ModeReglement;
SELECT * FROM Statut;
SELECT * FROM Article;
SELECT * FROM Vente;
SELECT * FROM LigneVente;
SELECT * FROM Versement;




-- 3 requetes pour stats ventes
SELECT COALESCE(SUM(v.montant), 0) AS CA FROM Versement v;

SELECT COALESCE(SUM(v.montant), 0) AS en_cours FROM Versement v
INNER JOIN Vente vt ON v.vente_id = vt.id
INNER JOIN Statut s ON vt.statut_id = s.id
WHERE s.nom LIKE 'NON_SOLDEE';

SELECT COUNT(v.id) AS nbr_vente FROM Vente v;

-- en une seule 
SELECT
    (SELECT COALESCE(SUM(v.montant), 0)
     FROM Versement v) AS ca,

    (SELECT COALESCE(SUM(v.montant), 0)
     FROM Versement v
     INNER JOIN Vente vt ON v.vente_id = vt.id
     INNER JOIN Statut s ON vt.statut_id = s.id
     WHERE s.nom = 'NON_SOLDEE') AS en_cours,

    (SELECT COUNT(v.id)
     FROM Vente v) AS nbr_vente;




     SELECT v.id, c.nom, c.prenom, c.telephone, 
COALESCE(SUM(v.montantInit), 0) AS totale_facture, 
mp.nom AS reglement
FROM Client c 
INNER JOIN Vente v ON c.id = v.client_id
INNER JOIN ModePaiement mp ON mp.id = v.modePaiement_id
WHERE v.montantPaye = v.montantInit -- WHERE s.nom = SOLDE;
GROUP BY v.id, c.nom, c.prenom, c.telephone, mp.nom;

SELECT a.libelle, lp.prixReel, lp.qte, 
COALESCE(lp.prixReel * lp.qte, 0) AS somme_ligne 
FROM Vente v 
INNER JOIN LigneVente lp ON v.id = lp.vente_id
INNER JOIN Article a ON lp.article_id = a.id
WHERE v.id = 1 AND v.montantPaye = v.montantInit;







SELECT c.nom, c.prenom, c.telephone, c.id FROM Client c;

SELECT DISTINCT ar.libelle, ar.id, lp.prixReel
FROM Article ar 
INNER JOIN LigneVente lp ON lp.article_id = ar.id;

SELECT mr.nom, mr.id FROM ModeReglement mr;


