# Pour l'installation de la partie Back

1. Se placer dans le dossier back dans le terminal et faire :
```bash 
composer install
````

2. Créer un fichier `.env.local` à la racine du dossier back
```bash
touch .env.local
````

3. Remplir ce fichier avec : `DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"`

4. Et renseigner selon les informations de votre BDD et remplacer `db_name` par le nom de table de votre choix, exemple : `humansix_test_technique`

5. **IMPORTANT:** Vous devez lancer votre serveur avant de poursuivre

6. Dans le terminal, afin de créer la base :
```bash
bin/console doctrine:database:create
````

7. Puis pour préparer la migration :
```bash
bin/console make:migration
```` 

8. Et pour envoyer la migration dans la BDD, finir par :
```bash
bin/console doctrine:migrations:migrate
````

9. Dans le dossier `docs`, ouvrir le fichier `database.sql` et importer directement dans la BDD

<br>

# Pour l'installation de la partie Front

1. Se placer dans le dossier `app` du dossier `front` dans le terminal et faire :
```bash
npm install
````

2. Copier le fichier `.env.local.example` en `.env.local` avec la commande :
```bash
cp -n .env.local.example .env.local
````

3. Compléter le fichier de configuration `.env.local`

4. Lancer le serveur front :
```bash
npm run serve
````

5. L\'application est maintenant disponible via l\'adresse : http://localhost:8080/