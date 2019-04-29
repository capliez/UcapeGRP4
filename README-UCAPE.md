Readme

Contexte : 

Ce projet est une application web, permettant de gérer les cursus Ucape et Section européenne des élèves du lycée Saint-Vincent.
L’application crée une plateforme permettant de faire le lien entre l’administration, les élèves et les parents d’élèves, afin de permettre le suivi des échanges scolaires. 
L’application offre un suivi des évaluations des élèves UCAPE. Elle est destinée à madame Jullien (la responsable), aux consultants externes (exemple : un professeur) et aux élèves.


Guide d’installation : 

-	Ouvrir gitBash -> rentrer la commande suivante : 
git clone https://github.com/capliez/UcapeGRP4.git
-	Initialisez la base de données en rentrant la commande : composer install et renseignez les valeurs demandée (surtout le champ « mailer_user » qui est obligatoire)
-	Rentrer les commandes suivantes : 
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
-	Rentrer la commande : php bin/console d :f :l (il est possible qu’une erreur se produise auquel cas il faut relancer la commande ceci est du au caractère unique des données a produire)

Guide utilisation :
Pour accéder au formulaire de connexion veuillez cliquer sur l’icone en haut a droite puis clicker sur le bouton « connexion »
Pour se connecter au compte admin, renseigner « technicien@lyceestvincent.fr» avec le mot de passe « admin »
Pour se connecter au compte consultant, renseigner « consultant@yahoo.fr » avec le mot de passe « consultant »
Pour se connecter au compte élève, renseigner l’adresse mail d’un élève avec pour mot de passe le nom de l’élève (situer dans la table user)

Contributeurs:
- Alexis
- Antonin
- Valentin
- Ludovic
