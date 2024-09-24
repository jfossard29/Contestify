# Contestify

Dans ce projet individuel réalisé dans le cadre d'une mise en situation professionnelle en Licence 3 *Conception et Développement d'Applications, nous avions dû conceptualiser et développer un site internet.
Cela en ayant réalisé le schéma relationnel de la base de données (visionner avec MySQL Workbench ou disponible en format PNG)

> Mon_Contestify_relationnel -> Mon schéma utilisé.

> V1_Contestify_relationnel -> Schéma initial (travaillé au début du projet.)

> Quelques_comptes.txt -> De quoi jouer avec le site.

## Installation

> La base de données est accessible et applicable depuis BDD.sql

### Étape :

1. Créez une nouvelle base de donnée : zdl3-zfossarje_1 (UTF8_general_ci)
2. Importez BDD.sql dans cette BDD. Elle comporte aussi tous les jeux de données nécessaires
3. Créez un nouveau compte utilisateur BDD : zfossarje (MDP : 3qi92blz)

> Le compte utilisateur zfossarje est le compte utilisé pour interagir avec la base de donnée dans le code.

Le projet utilise une version de CodeIgniter déjà établit et configuré pour faire fonctionner ce site internet, aucune modification n'est nécessaire.

Visionnez en local (XAMPP...) pour éviter tout problème.

## Cas d'utilisation

> Dans cette V2, je vous explique ce que peut effectuer comme tâche les 3 acteurs de ce site internet.

### Côté utilisateur :

Sur la page d'accueil du site, l'utilisateur peut voir les 5 dernières actualités du moment.

Il dispose aussi d'un lien aux concours, un bouton de connexion s'il est Jury ou Organisateur d'un concours, mais aussi un accès au suivi de candidatures, s'il s'est inscrit.

S'il va dans la rubrique des concours, il aura devant lui une liste de concours qui viendront, qui sont terminées, ou en phase de sélection, avec cela les dates de début et de fins. Il peut voir l'organisateur du concours ainsi que les membres du jury, et accéder à la galerie des candidats pour chaque concours.

La galerie des candidats est une page simple, une liste de tout candidat accepté pour un concours, et leur catégorie.

> (l'accès à la description du concours, au palmarès des gagnants, au profil des jurys, n'est pas implémenté pour cette version.)

Si l'utilisateur veut suivre sa candidature, il peut y accéder grâce au bouton de navigation "suivi de candidature". Il lui faudra renseigner son code d'inscription et son code d'identification.

Le candidat peut donc accéder à son profil de candidat d'un concours. Son profil peut avoir 3 phases : "Inscrit", "Accepté", "Refusé". A noter que le candidat doit systématiquement donner des documents, et peu importe le format (les liens YouTube sont autorisés.). Il peut aussi supprimer sa candidature.

### Côté Jury :

Un jury peut accéder aux côté Back du site depuis le bouton de connexion. Il devra renseigner son login et son mot de passe.

Le jury accédant à son environnement, ne peut avoir qu'accès à la liste des concours auquel il est affilié depuis le bouton "Concours".

Il peut chercher un concours particulier depuis une zone d'écriture, trier les concours, ou encore visualiser la liste des candidats.

> (La visualisation des profils des candidats n'est pas implémentée dans cette version.)

Le jury peut accéder à son profil à tout moment depuis le bouton de navigation dédié, et y modifier son mot de passe.

> (La modification d'autres champs du profil n'est pas implémentée dans cette version.)

Et enfin, il peut se déconnecter à tout moment depuis le bouton de navigation dédié.

### Côté Organisateur :

Un organisateur peut accéder aux côtés du Back du site depuis le bouton de connexion. Il devra renseigner son login et son mot de passe.

L'organisateur accédant à son environnement, à accès à deux rubriques : Concours et Comptes.

La rubrique Concours est une liste de tous les concours du site. L'Organisateur peut accéder à la galerie des candidatures afin de visualiser certains profils, et de supprimer d'autres.

> (Le bouton Supprimer n'est pas implémenté dans cette version.)

Mais sur la page des concours, il peut aussi modifier ce concours, accéder au palmarès, ou encore le supprimer.

> (les boutons Modifier, Supprimer, Palmarès ne sont pas implémentés dans cette version.)

L'Organisateur peut aussi accéder à la liste des comptes du site. Il y peut modifier, supprimer, ou désactiver un compte inactif.

> (les boutons Supprimer, Désactiver, Modifier ne sont pas implémentés dans cette version)

L'Organisateur peut aussi créer un compte Jury ou Administrateur (organisateur). Pour cela, il devra remplir un formulaire différent.

Comme le jury, l'organisateur peut modifier le mot de passe de son compte.
