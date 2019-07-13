Description 
===

Le plugin OFoehn permet de récupérer les informations et de contrôler une pompe à chaleur (PAC) pour piscine de la marque O'Foehn.

Configuration du plugin 
===

La configuration du plugin est très simple.
Une fois installé, il suffit de créer un nouvel équipement et de le configurer de la manière suivantes:

![OFoehn](https://sattaz.github.io/Jeedom_OFoehn/pictures/OFoehn_2.jpg)

Comme pour chaque plugin Jeedom, il faudra indiquer le 'Nom de l'équipement', un 'Objet parent' et une 'Catégorie'.
Ne pas oublier de cocher les cases 'Activer' et 'Visible'.

Puis viennent aussi quelques paramètres dédiés aux spécification de la PAC OFoehn:

-   IP de la PAC : veuillez renseigner l'adresse IP de l'interface web de la PAC.

-   Port : veuillez renseigner le port à utiliser pour se connecter à l'interface web de la PAC. (par défaut = 80)

-   Utilisateur : veuillez renseigner le nom d'utilisateur de l'interface web de la PAC. (par défaut = user)

-   Mot de passe : veuillez renseigner le mot de passe de l'interface web de la PAC.

-> Veuillez dès à présent appuyer sur le bouton 'Sauvegarder' afin d'enregistrer la configuration.
-> Cette action va automatiquement créer les commandes de l'équipement.

Commandes de l'équipement 
===

Comme énoncé dans le précédent chapitre, les commandes de l'équipement sont automatiquement crées dès lors que la configuration est sauvegardée.

![OFoehn](https://sattaz.github.io/Jeedom_OFoehn/pictures/OFoehn_3.jpg)



Le widget 
===

Le widget arrive comme montré sur la photo ci-après et vous permet de contrôler les fonctions basiques de votre PAC.

![OFoehn](https://sattaz.github.io/Jeedom_OFoehn/pictures/OFoehn_1.jpg)

Libre à vous de modifier le widget afin de l'adapter à votre style de présentation.



Autres informations 
===

* Le plugin rafraîchi les données toutes les minutes.
