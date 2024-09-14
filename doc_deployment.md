# Documentation déploymemnt 

Site du zoo arcadia pour les visités et le personnel du zoo. Les visiteurs peuvent avoir un apperçu du zoo pour les persuadé d'y aller. Le personnel peut actualé des services du zoo et s'occuper des animaux. 

## Required

- **heroku**: pour déployer l'app

## Deployement 

- crée un compte heroku 
- heroku login 
- heroku create arcadia-zoo
- heroku git:remote -a arcadia-zoo
- heroku config:set APP_ENV=PRODUCTION
- heroku buildpacks:add heroku/php
- heroku addons:create jawsdb:kitefin
- heroku config:set DATABASE_URL = "JAWSDB_URL": On l'obtient avec la commande heroku config
- heroku config:set MONGODB_URL = "Votre url mongondb: mongodb+srv://username:password@cluster0.mongodb.net/mydatabase?retryWrites=true&w=majority"
- git add .
- git commit -am "commit_name"
- git push heroku main
- heroku open