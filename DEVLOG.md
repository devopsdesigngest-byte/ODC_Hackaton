# 📓 Journal de Développement (DEVLOG)
**Nom & Prénom** : [MBOW & Ndiasse]  
**Projet** : StoreManager Pro (ERP PHP/POO)  

---

## 1. Suivi Chronologique des Phases


### 🌃 [Vendredi - Phase 1] : Conception & BDD Fallback
- **Heure de réalisation** : 20 H 30 mais vous avez demandeez des corrections que j'ai vu tardivement donc 02 h 14
- **Ce qui a été fait** : Use case et Diagramme de classe
- **Difficultés / Obstacles** : 
La distinction entre les classes Dette et Vente était un peu ambiguë au début. 
Il fallait comprendre quels attributs appartenaient à chaque classe et pourquoi.

J'ai également eu des difficultés à comprendre l'utilisation de l'héritage dans les diagrammes de use case. Comme nous ne l'avons pas encore étudié en profondeur pour le code, j'ai pris du temps pour comprendre son rôle. Finalement, nous avons choisi de l'utiliser pour simplifier les diagrammes de use case et éviter de répéter certaines fonctionnalités.

J'ai aussi mis du temps à comprendre que l'administrateur avait une vision globale des différentes fonctionnalités du système. Je n'avais pas encore une vision globale du projet au début.

La prochaine fois, je prendrai le temps de lire et de comprendre l'ensemble des consignes et du projet avant de commencer la conception. Cela me permettra d'avoir une meilleure vision globale et d'éviter certaines corrections tardives.

je me perdais aussi au milieu de beaucoup de classes









### 🌃 [Vendredi - Phase 1] : Conception & BDD Fallback
- **Heure de réalisation** : 02 h 47
- **Ce qui a été fait** : Les shemas (sqllite, postgres)
- **Difficultés / Obstacles** : 
J'ai remarqué que PostgreSQL et SQLite sont assez similaires dans la manière de créer les tables et les relations. La principale différence que j'ai remarquée concerne la gestion des identifiants auto-incrémentés.
Au début, je n'avais pas compris qu'il fallait également établir une connexion avec SQLite comme on le fait avec PostgreSQL, puisque ce sont toutes les deux des bases de données.
Cette partie m'a permis de mieux comprendre le principe du fallback entre PostgreSQL et SQLite et pourquoi l'application doit pouvoir utiliser l'une ou l'autre.





### 🌃 [Vendredi - Phase 1] : Conception & BDD Fallback
- **Heure de réalisation** : 03 h 00
- **Ce qui a été fait** : Mise en place du Singleton Database avec connexion PostgreSQL et fallback automatique vers SQLite
- **Difficultés / Obstacles** : 
J’ai eu du mal à comprendre le fonctionnement du Singleton au début.
J’ai également dû comprendre comment utiliser PDO pour se connecter à PostgreSQL(deja connu) et SQLite.




### ☀️ [Samedi - Phase 2] : POO, Repositories & Ventes POS
- **Heure de réalisation** : 08h 25
- **Ce qui a été fait** : Deplacer les fichiers importants comme les shemas et le dossier src 
- **Difficultés / Obstacles** : Pas obstacle mais j'ai un peu de soucis à savoir comment git se comportera



### ☀️ [Samedi - Phase 2] : POO, Repositories & Ventes POS
- **Heure de réalisation** : 08h 25
- **Ce qui a été fait** : Création des Entités POO Pure
- **Difficultés / Obstacles** : 
Je ne savais pas toujours si une méthode aurait réellement un impact dans le projet, car je n’ai pas encore une vision complète du fonctionnement final.
J’ai donc commencé par créer mes 13 Entities en suivant mon diagramme de classes, avec leurs attributs et leurs clés étrangères. Cela m’a permis d’avancer rapidement et de garder une base claire. Pour les méthodes, j’en ai défini seulement quelques-unes pour le moment et je pourrai en ajouter ou modifier selon les besoins du projet.


### ☀️ [Samedi - Phase 2] : POO, Repositories & Ventes POS
- **Heure de réalisation** : 14h 15
- **Ce qui a été fait** : Refactoring
- **Difficultés / Obstacles** : 
Difficultés / Obstacles :
Le principal problème rencontré concernait l’emplacement du fichier SQLite et le chemin utilisé par le fallback. J’ai également dû corriger la configuration de la connexion PostgreSQL après le changement de nom de la base.
Tests réalisés :
J’ai effectué plusieurs tests de connexion. La connexion PostgreSQL fonctionne correctement. J’ai également testé le fallback SQLite et vérifié que la connexion bascule bien vers SQLite lorsque PostgreSQL n’est pas disponible.



### ☀️ [Samedi - Phase 2] : POO, Repositories & Ventes POS
- **Heure de réalisation** : Dimanche 10h 00
- **Ce qui a été fait** : 
Mise en place des Repositories et des requêtes SQL sécurisées.
Ajout des getters et setters(produits, fournisseurs et clients) pour accéder aux attributs private.
Analyse de la vue pour identifier tout ce qui concerne les produits, fournisseurs et clients.
Adaptation de ces éléments dans les Repositories avec succès.
Première utilisation de fetchClass, puis suppression afin d'utiliser une méthode de transformation manuelle des données en objets.
- **Difficultés / Obstacles** : 
Difficulté à choisir la meilleure approche et à faire une étude comparative entre les différentes solutions.
Ma compréhension du code objet est encore à ameliorer.
j'ai fait plusieurs erreurs liées à l'oubli de $this.
je pense toujours à l'approche procédurale alors que le projet est orienté objet.





### ☀️ [Samedi - Phase 2] : Refactoring pour comprendre et tester
- **Heure de réalisation** : Dimanche 15h 00
- **Ce qui a été fait** : 
J’avais besoin de réécrire tout le code pour mieux comprendre son fonctionnement et de tester toutes mes fonctions avant d’avancer. J’ai également ajouté les getters et setters afin de mieux visualiser et manipuler les propriétés private.
- **Difficultés / Obstacles** : 
Nous avions déjà réalisé une grande partie du travail en classe de manière procédurale, mais le passage à la programmation orientée objet était parfois abstrait pour moi. Par exemple, j’avais du mal à comprendre concrètement comment faire communiquer toutes les notions abordées en classe. Le fait de réécrire et de tester chaque partie m’a permis de mieux comprendre ces concepts.






### ☀️ [Samedi - Phase 2] : Service Métier Vente POS & Transaction SQL
- **Heure de réalisation** : Dimanche 17h 15
- **Ce qui a été fait** : 
J’ai mis en place le service métier de vente POS avec la gestion d’une transaction SQL.
J’ai fait en sorte que le service puisse enregistrer une commande, ses lignes, diminuer le stock et créer une dette lorsque le montant n’est pas entièrement payé.
Mais j'ai pas encore tester
- **Difficultés / Obstacles** : 
J’ai eu des difficultés à bien comprendre la séparation des responsabilités entre la vue, le service et les repositories.
J’ai dû comprendre quelles informations devaient être préparées par la vue et lesquelles devaient être traitées par le service.
J’ai également eu besoin de mieux comprendre le fonctionnement d’une transaction SQL, notamment beginTransaction(), commit() et rollback(), pour que toutes les opérations de la vente soient validées ou annulées ensemble.




### ☀️ [Samedi - Phase 2] : Controller POS & Vue Caisse
- **Heure de réalisation** : Dimanche 20h 15
- **Ce qui a été fait** : 
Depuis le debut je tester via console mon fichier test_database.php
la on touche au controller et vue donc il se peut je retouche plusieurs fichiers je les ferai notifie ici
il se peut pour des raison de comprenhsio n je cherche des alternatives au methode deja redige ou je le recrivent pour comprendre le concept objet:

jai touche a tout les fichiers
src/Model/Entity pour avoir la main
src/Database/Repository pour avoir la main
src/Model/Repository pour avoir la main

jai realise 
index 
router 
Controller POS
Vue Caisse
jai charge mes trois methodes dans la vue getAllClient() getAllProduit() getAllModePaiement()Depuis le début, je testais mon application principalement via la console avec mon fichier test_database.php.
Avec cette phase, j'ai commencé à travailler directement sur le Controller POS et la Vue Caisse, ce qui m'a amené à relier les différentes couches de mon application.
J'ai touché à plusieurs fichiers afin de mieux comprendre leur rôle et leur fonctionnement :
src/Model/Entity pour mieux maîtriser mes entités et leurs getters/setters.
src/Database/Repository pour mieux comprendre la connexion et les requêtes vers la base de données.
src/Model/Repository pour mieux comprendre la récupération et la manipulation des données.
J'ai réalisé et/ou mis en place :
index
router
POSController
Vue Caisse / POS
J'ai réussi à charger dans la Vue les données provenant de mes repositories avec :
getAllClient()
getAllProduit()
getAllModePaiement()
J'ai commencé à gérer le fonctionnement de la caisse avec le formulaire de vente.
J'ai travaillé sur la récupération des données envoyées par la Vue vers le Controller.
J'ai commencé à mettre en place la gestion du panier avec $_SESSION['panier'].
J'ai commencé à distinguer les deux actions principales de la caisse :
ajouter un produit au panier avec le bouton +
enregistrer la vente avec le bouton Valider la Vente
J'ai également fait le lien entre le panier et VenteService::enregistrerVente() pour préparer l'enregistrement de la commande, des lignes de commande et la diminution du stock.
Pour faciliter ma compréhension de la programmation orientée objet et de l'architecture du projet, j'ai pu réécrire ou modifier certaines méthodes déjà réalisées afin de tester différentes approches.
Je peux donc être amené à modifier plusieurs fichiers pendant cette phase. Je les noterai au fur et à mesure dans le DEVLOG.

- **Difficultés / Obstacles** : 
ca a été deja fait en classe

