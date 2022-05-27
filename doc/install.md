# Installation du projet sur le poste de développement

Dans notre installation, les projets sont dans `c:\wamp64\www`

## Récupérer le projet:

### Recuperation du projet sans git

Telecharger le depuis Gitlab : http://git.intra.cnaf/cnaf/initials/initial-api-plateform/-/archive/master/initial-api-plateform-master.zip

Puis decompresser l'archive dans le repertoire www, et renommer eventuellement le repertoire (initial-api-platform pour la suite de la documentation)


### Récupération du projet avec git

Pour commencer à travailler "proprement" sur un nouveau projet en utilisant git, il est nécessaire de "forker" le projet depuis l'interface de Gitlab.

Le Fork creera un nouveau projet dont vous serez le proprietaire avec le contenu du projet initial.
C'est l'ideal pour démarrer un nouveau projet et utiliser Git pour le versionnage.

Cela necessite d'avoir confiquré une clé ssh pour lier votre compte au poste de developpement (voir FAQ)

Une fois le nouveau projet créé, il suffira de le cloner localement. (voir l'interface de Gitlab pour recuperer le detail de la commande git clone ...)


## Configurer le projet:

### Configuration du fichier .env pour le mode développement

Copier le fichier `.env` en `.env.dev.local`. 

- Configuration de la base de données

```
    DATABASE_URL=pgsql://postgres:postgres@127.0.0.1:50000/initial-api-plateform?serverVersion=14&charset=utf8
```
Par defaut, le nom de la base de donnée sera initial-api-platform

- Configuration du securityBundle

```
    ###> cnaf/security-bundle ###
    # CODE_APPLI : le code application habnims.
    # CODE_ORGA_APPLI : le code organisme de l'application
    # CODE_ORGA : Le code organisme
    # CODE_ENV : L'environement d'execution de l'application
    CODE_APPLI=LXXX
    CODE_ORGA_APPLI=YYY
    CODE_ORGA=ZZZ
    # Valeur pour le dev du serveur OAuth
    CLIENT_ID=dev
    CLIENT_SECRET=M47nrMR9iMfJyFe6eB62
    URL_OAUTH=https://auth-qualif.si.cnaf.info/oauth
    ###< cnaf/security-bundle ###
```

On peux utiliser un code application existant pour récupérer un profil.

Ou on peux on utiliser l'émulation de l'authentification (voir plus bas).

- Configuration Cors

```
    ###> nelmio/cors-bundle ###
    CORS_ALLOW_ORIGIN=^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$
    # CORS_ALLOW_ORIGIN=http://localhost:8080
    ###< nelmio/cors-bundle ###
```


#### Emulation de l'authentification (facultatif)

A l'aide de la commande suivante :

```
    php bin/console cnaf:dumpWSGetInfoUtilisateurREST
```

Il vous sera demandé l'utilisateur, qui correspond au login windows de l'agent concerné.

La commande va générer un fichier dans le repertoire **WSEmulate/** du projet.

Ce fichier correspond a un dump au format Json de l'appel au webservice Habnims. Il faudra éditer ce fichier
pour y ajouter un code application et un profil dans le tableau **applications** : 

```
         "LTEST.ADM000.598",
```

Le code appli (ici LTEST) doit correspondre au code appli declaré dans la configuration du securityBundle.

Il faudra ensuite modifier le fichier **config/packages/dev/cnaf_security.yaml**, passer le parametre **bypass_web_service** a true :
```
cnaf_security:
  # Éviter l'appel au webservice et charger les valeurs depuis un xml
  bypass_web_service: true
  # Accès à l'application si la personne n'a pas d'habilitations
  access_open: false
  # Type d'authentification pour shibboleth : local*(remote_user) ou reverseproxy(http_remote_user)
  authentication_mode: local
  # Whitelist de reverse proxy
  reverseproxy_ip_list: [ "10.192.9.1","10.192.9.2","10.177.0.1","10.177.0.2","127.0.0.1","::1" ]
  # Autorise le changement d'utilisateur
  changement_profil: true
```

### Configuration du virtual host pour le serveur apache

Le fichier **httpd-vhosts.conf** a modifier se trouve dans le repertoire **C:\wamp64\bin\apache\apache2.4.51\conf\extra**

Configurer votre vhost via le menu comme suit:

```
    <VirtualHost *:80>
        ServerName initial-api-plateform.local.cnaf
        DocumentRoot "c:/wamp64/www/initial-api-plateform/public"
        <Directory  "c:/wamp64/www/initial-api-plateform/public/">
            setEnv REMOTE_USER nom_utilisateur
            Options +Indexes +Includes +FollowSymLinks +MultiViews
            AllowOverride All
            Require local
        </Directory>
    </VirtualHost>
```

Ajouter cette ligne dans le fichier **hosts** dans le repertoire **C:\Windows\System32\drivers\etc**

    127.0.0.1 initial-api-plateform.local.cnaf

Redémarrer le serveur Apache

## Lancer l'installation:

Depuis le repertoire du projet, lancer la commande

    composer install


Aller a l'url : http://initial-api-plateform.local.cnaf/

Si la page suivante apparait, le projet a été correctement installé.

![](images/install/projet-ok.png)

Dans le cas contraire, merci de vous référer a la [FAQ](faq.md)
