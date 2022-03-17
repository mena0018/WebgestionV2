# Pour lancer le projet

* La première fois : 

```bash
git clone https://iut-info.univ-reims.fr/gitlab/mena0018/webgestion.git
cd webgestion/
git branch tonPrenom 
git switch tonPrenom
c/c le .env en .env.local
composer install
composer start
http://localhost:8000/
git push -u origin tonPrenom
```

* Les autres fois : 

```bash
cd webgestion/
git switch master
git pull
composer install
git switch tonPrenom
git merge master
composer start
http://localhost:8000/
git push
```
