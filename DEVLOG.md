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







  

