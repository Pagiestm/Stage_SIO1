# Installation du poste du développeur

## Prérequis Windows sur le poste

Dans la liste des applications installées sur le poste, vérifier la présence des composants windows suivant :

![](images/poste_dev/VC_Redis_2015-2019.png)

S'ils ne sont pas présents, installer :

```
    VC_redist.x64(2015-2019)

    VC_redist.x86(2015-2019)
```

Verifier aussi la présence des composants suivants : 

![](images/poste_dev/VC_Redis_2012.png)

S'ils ne sont pas présents, installer :

```
    vcredist_x64(2012)
    
    vcredist_x86(2012)
```

Un redémarrage du poste peu être nécessaire suite aux installations.


## Installation de WAMP

Wamp installera sur le poste le serveur Apache, différentes versions de Php ainsi que MariaDb, MySQL (non utilisés).

Utiliser l'installeur :

```
    wampserver3.2.6_x64.exe
```

Bien prêter attention aux étapes suivantes :

- En plus des prérequis windows validés à l'étape précédente, merci de bien vous assurer de valider les recommandations de cet écran.

![](images/poste_dev/Wamp-1.png)


- Par défaut l'installation se fera sous c:\wamp64.

![](images/poste_dev/Wamp-2.png)


- On choisira l'installation par défaut.

![](images/poste_dev/Wamp-3.png)


- Ne pas utiliser Internet Explorer, mais utiliser un autre navigateur.

![](images/poste_dev/Wamp-4.png)


- Le chemin de Microsoft Edge :

```
    C:\Program Files (x86)\Microsoft\Edge\Application
```

![](images/poste_dev/Wamp-5.png)


- Ne pas utiliser le bloc note de Windows

![](images/poste_dev/Wamp-6.png)


- Le chemin de Notepad ++ : 

```
    C:\Program Files (x86)\Notepad++
```

![](images/poste_dev/Wamp-7.png)

- Merci de prendre connaissance des informations suivantes :

![](images/poste_dev/Wamp-8.png)


## Installation de Node.JS

A l'aide de l'executable :

```
    node-v16.13.2-x64.msi
```

Laisser les options par défaut proposées par l'installeur.

Après l'installation, créer le fichier **.npmrc** sous :

```
C:\Users\%username%\ 
```

**Bien vous assurer, sur votre PC sous Windows, à la présence du «.» (point) devant le nom du fichier.**

Y copier le contenu :

```
    registry=http://nexus.intra.cnaf/repository/npm-public/
```

## Installation de PostgreSQL

A l'aide de l'executable :

```
    postgresql-14.1-1-windows-x64.exe
```

Laisser les options proposées par défaut.

- Saisir le mot de passe suivant : **postgres**

![](images/poste_dev/PostgreSQL-1.png)


- Renseigner le port **50000** (pour plus de simplicité dans la configuration de l'application initiale, correspond au port utilisé sur les VM du Datacenter)

![](images/poste_dev/PostgreSQL-2.png)


- Laisser l'option par défaut

![](images/poste_dev/PostgreSQL-3.png)


- A la fin de l'installation, décocher l'option suivante

![](images/poste_dev/PostgreSQL-4.png)


## Installation YARN

A l'aide de l'executable :

```
    yarn-1.22.15.msi
```

Laisser les options par défaut. 

## Installation de composer

A l'aide de l'executable :

```
    Composer-Setup.exe
```

- Choisir la version de Php (Php 8.0.13) et cocher la case pour ajouter PHP au path

![](images/poste_dev/Composer-1.png)

- Cocher la case pour utiliser un proxy et ajouter le paramétrage suivant (attention à l'encodage des caractères spéciaux pour le mot de passe)
- en ancienne forêt : **http://prenom.nom%40nomcaf.cnafmail.fr:motdepasse@proxyintracsn.cnaf:3128/**
- en nouvelle forêt : **http://prenom.nom%40cafxx.caf.fr:motdepasse@proxyintracsn.cnaf:3128/**

![](images/poste_dev/Composer-2.png)

Modifier le fichier composer.bat sous ce répertoire à créer C:\\ProgramData\\ComposerSetup\\bin en ajoutant **-d memory_limit=-1** comme suit:

```
    php -d memory_limit=-1 "%~dp0composer.phar" %*
```

## Installation de git

A l'aide de l'executable :

```
    Git-2.34.1-64-bit.exe
```

- Dans l'écran suivant, choisir Notepad++ comme éditeur par défaut :

![](images/poste_dev/Git-1.png)

Laisser toutes les autres options par défaut dans les écrans qui suivent.

De façon générale, préférez l'utilisation de **gitbash** comme interface de ligne de commande.

### Configuration du php.ini

Copier le fichier dans le repertoire d'installation de wamp **C:\wamp64** :

```
    cacert.pem
```

Dans le fichier php.ini qui se trouve dans le repertoire :

```
    C:\wamp64\bin\php\php8.0.13 
```

modifier les parametres suivants : 

```
    realpath_cache_size=5M
    
    curl.cainfo = C:\\wamp64\\cacert.pem
    
    openssl.cafile= C:\\wamp64\\cacert.pem
    
    extension=pdo_pgsql
    extension=sodium
```

Ces paramètres seront pris en compte pour la version en ligne de commande de PHP

Pour la configuration en lien avec Apache de Php : 

- S'assurer que la version de PHP utilisée est bien la 8.0 :

![](images/poste_dev/Php-1.png)

- activer l'extension PHP pdo_pgsql depuis Wamp :

![](images/poste_dev/Php-2.png)

### Verification de l'installation

Si les différentes installations se sont déroulées correctement, l'url **http://localhost** doit répondre :

![](images/poste_dev/Localhost-ok.png)

## Installation de l'IDE

Installation au choix d'un IDE : 

### Installation de VSCode

VScode est un très bon éditeur qui intègres des plugins pour faciliter le développement.
A l'aide de l'executable :

```
    VSCodeUserSetup-x64-1.63.2
```

On vous conseille les modules suivants:

 - Auto Rename Tag
 - Auto Close Tag
 - Bracket Pair Colorizer
 - ESLint
 - Format in context menus
 - GitLens
 - Import Cost
 - Sass
 - Sass Lint
 - npm
 - npm Intellisense
 - Prettier
 - Sorting HTML and Jade attributes
 - TODO Highlight
 - Vetur
 - Vue Peek
 - VS Code Icons


### Installation de Netbeans

Netbeans est un autre IDE maintenu par la fondation Apache. Il n'a pas de pluging pour le Vue.js. 
A l'aide de l'executable :

```
    jdk-17_windows-x64_bin.msi 
    Apache-NetBeans-12.6-bin-windows-x64
```


### Phpstorm

Cet IDE est payant, mais très complet. Il est utilisé par certains organismes (Caf du Nord et du Finistère)

Une version d'évaluation est disponible à l'adresse : https://www.jetbrains.com/phpstorm/download/#section=windows

## Facultatif : L'utilisation de la commande symfony

Pour installer le client Symfony, extraire le fichier

```
    symfony-cli_windows_amd64.zip
```

dans le répertoire 

```
C:\Program Files\Symfony 
```

et ajouter ce répertoire dans le path.

La commande **symfony** fournit également un outil pour vérifier si votre ordinateur répond à toutes les exigences. Ouvrez votre console et exécutez cette commande :

```
    symfony check:requirements
```

## Facultatif : L'utilisation de Vuejs

Pour installer le client Vuejs en ligne de commande

```
    npm install vue-cli -g
```

## Facultatif : L'utilisation de Quasar

Pour installer le client Quasar en ligne de commande

```
    npm install @quasar/cli -g
```
