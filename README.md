######### How to install the project #########

1. clone the project from 

2. run "cd /you_project_path/" in your terminal

3. run "composer install" in your terminal

4. run "npm install" in your terminal

5. run "npm run dev" in your terminal

6. inside the project open .env file and set the DB_DATABASE to the absolute path to the database file in your machine "/you_project_path/database/database.sqlite"

7. run "php artisan migrate" in your terminal 

8. run "php artisan serve" in your terminal

9. you can now access the app in the browser at "http://localhost:8000"

######### How does it work #########

1. after you open the browser hit the Register link at the top right corner and add a new user.

2. you will be redirected to the Home page where you see random trending GIFs .  

3. write some search pattern in the search box and hit search , the results will be paginated (go to the bottom to see how many pages are there for your search) and switch between pages .

4. please wait for the GIFs to load it might be slow depending on your network connection .

5. hit the Logout button at the top and try to login again . 

6. php unit tests have been added for :
                                        -login
                                        -register
                                        -browse gifs
                                        -search gifs

    - the tests are in tests/Feature/Auth/LoginTest.php & tests/Feature/Gifs/GifTest.php

    - you can run the tests by running this command "./vendor/bin/phpunit" inside the project path.

######### About the project #########

- the project was built as a SPA using Laravel, Vue and Bootstrap frameworks.

- the used GIF API is https://api.giphy.com .

- the main controller for the GIFs is "/your_project_path/app/Http/Controllers/API/GifsController.php" .

- "/your_project_path/app/Services/GifsService.php" is a Service class which includes all the calls to the external GIFs API so that if we wanna change the API provider we need to make changes to this class only .

- For the front-end , we have one vue component "/your_project_path/resources/js/components/GifsComponent.vue"

- I haven't set an API authentication mechanism (token, JWT,..) because i didn't see it necessary . 