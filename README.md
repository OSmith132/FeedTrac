# FeedTrac
FeedTrac is a **feed**back **trac**king tool for universities. It was originally designed by second-year UoL Computer Science students for their Team Software Engineering module.

## Setting up the website locally
1) Download and install XAMPP (https://www.apachefriends.org/download.html)<br>
2) Download the `feedtrac` folder from this repo<br>
3) Copy the contents of the `feedtrac` folder to your local `..\xampp\htdocs` directory<br>

## Setting up the database 
1) Download the `feedtracdb.sql` and `data.sql` files from this repo<br>
2) Open phpMyAdmin (http://localhost/phpmyadmin) and create a new database called "feedtracdb"
3) Import the `feedtracdb.sql` file (the Import button can be found at the top of the page)
4) (Optionally) Import the database data from `data.sql` file. You must **disable** foreign key checks. **(WARNING: THIS WILL TRUNCATE ALL DATA IN YOUR LOCAL DATABASE)**<br>

## Viewing the website
http://localhost/feedtrac (You many need to clear cache and site data after downloading new versions)

## Viewing the database
**phpMyAdmin:** http://localhost/phpmyadmin/<br>
**MySql Workbench:** Go to 'Database' -> 'Connect to database' and select localhost (127.0.0.1:3306)<br>

_https://www.freecodecamp.org/news/how-to-use-git-and-github-in-a-team-like-a-pro/_
