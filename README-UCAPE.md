Readme

Contexte : 

Ce projet est une application web, permettant de g�rer les cursus Ucape et Section europ�enne des �l�ves du lyc�e Saint-Vincent.
L�application cr�e une plateforme permettant de faire le lien entre l�administration, les �l�ves et les parents d��l�ves, afin de permettre le suivi des �changes scolaires. 
L�application offre un suivi des �valuations des �l�ves UCAPE. Elle est destin�e � madame Jullien (la responsable), aux consultants externes (exemple : un professeur) et aux �l�ves.


Guide d�installation : 

-	Ouvrir gitBash -> rentrer la commande suivante : 
git clone https://github.com/capliez/UcapeGRP4.git
-	Initialisez la base de donn�es en rentrant la commande : composer install et renseignez les valeurs demand�e (surtout le champ � mailer_user � qui est obligatoire)
-	Rentrer les commandes suivantes : 
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
-	Rentrer la commande : php bin/console d :f :l (il est possible qu�une erreur se produise auquel cas il faut relancer la commande ceci est du au caract�re unique des donn�es a produire)

Guide utilisation :
Pour acc�der au formulaire de connexion veuillez cliquer sur l�icone en haut a droite puis clicker sur le bouton � connexion �
Pour se connecter au compte admin, renseigner � technicien@lyceestvincent.fr� avec le mot de passe � admin �
Pour se connecter au compte consultant, renseigner � consultant@yahoo.fr � avec le mot de passe � consultant �
Pour se connecter au compte �l�ve, renseigner l�adresse mail d�un �l�ve avec pour mot de passe le nom de l��l�ve (situer dans la table user)

Contributeurs:
- Alexis
- Antonin
- Valentin
- Ludovic
