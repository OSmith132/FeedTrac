# Journal type doc to keep track of work done by group members to later add on to the report.
* Please include whatever you've worked one regardless if you've completed it or not. For example code work on something specific, research, report writing, etc.
* Write your updates between details block.
## Toby
<details>
<summary> 
  Work
</summary>
  * working on login screen
</details>

## Oliver
<details>
<summary> 
Log Of Tasks Completed:
</summary>

* ### _8/11/23:_
    * Created server and database through XAMPP to test usability with this project.
    * Created crude databse design using MyPhpAdmin and MySQLWorkbench.
    * Created Github Repo to share with group.

*  ### _7/2/24:_
    * Revised database schema to allign more with the project scope.
    * Developed basic web pages for use as homepage, login, and signup interfaces.
    * Implemented basic web functionality (using PHP) to connect website to database, manage session data post-login, and handle redirections as needed.

* ### _17/02/24:_
    * Added new constraints and tables to database. It is now better suited for a working model of the website. although will require some more work to make it suitable for deployment.
    * Changed the way the database is stored to two .sql files (for schema and data). This should streamline the process of building and uploading different versions of the database.
    * Created the 'Features and pages' file to list the needed pages and features that we need to discuss in our weekly meetings.
    * Reorganised the repo to make it easier to work with.
 
* ### _10/03/2024:_
    * The able on the homepage table now reads directly from the database. This code can be used elsewhere with a little modification
    * Added the associative arrays 'get_urgency_string' and 'get_resolved_status' to return the level of urgency / resolved status in a string format
    * Added the 'shorten' php function
    * Updated the style guides with some provisional rules
 
* ### _13/03/2024:_
    * Reorganised the file structure for ease of use
    * Added the scripts to give the light / dark mode bulb functionality. the scripts and CSS for this are located in the _main.js_ and _main.css_ respectively so the button can remain functional when copy & pasted
    * Changed the way we connect to the database by creating a wrapper class for mysqli
    * Changed the way the _POST is handeled in _login.php_ and _signup.php_

* ### _14/03/2024:_
    * Started work on the PHP handler, controller and View classess for the feedback reports. This can be used for getting, updating and creating enw feedback reports.
    * Started work on making a clickable-row class that will link to the relevant feedback report page when clicked on. This is currently only implemented in index.php.
    * Added the protected connect() function to the Database class. This can be used by child classes to establish a conection with the database
    * Changed some databas table structures and renamed all occurrences (in both the database and codebase) of the word _report_ with _feedback_ for continuity throughout the app and documentation.

* ### _17/03/2024:_
    * Reorganised Github repo with hopes for others to start work
    * Made some minor changes to the database schema to fix some issues Marco was having with using the new code
    * Fixed some minor bugs relating to database table names and connection. Planning to fix this my implementing a login and signup class
 
* ### _18/03/2024:_
    * Finished the first version of the feedback model and controller classes. Planning to work on view class when frontend has caught up.
    * Started and finished the first version of the model and controller classes for Login.
    * Organised all classes into namespaces and tried unsuccessfully to set up an autoloader.
    * Fully redesigned all previous PHP in the login and index pages to utilize the new classes
    * Overall a very long day (~10 hours total work)

* ### _24/03/2024:_
    * Had a meeting where we went over how we are going to incorperate the MVC design pattern and how to use the new classes. Me and Marco also updated his password recovery code to be used by the Login class.
    * Added the recovery table to the database to work with Marco's code.
   
</details>

## Earl
<details>
<summary> 
  Work
</summary>
  
</details>

## Archie
<details>
<summary> 
  Work
</summary>
  
</details>

## Lorna
<details>
<summary> 
  Work
</summary>
  
</details>

## Marco
<details>
<summary> 
  Log
</summary>


* ### _17/02/24:_
    * Researched PHP and PHP encryption, created a branch.
    * Database troubleshooting with Oliver, changed password field to varchar 255 datatype.
    * Implemented password hashing encryption, tested successfully.
 
* ### _14/03/24:_
    * Started work on forgot password implementation. Going with a simple memorable word prompt as a first attempt.
    * Researching into doing email verification.

* ### _17/03/24:_
    * DB troubleshooting, created new php page for password recovery basing it on login page.
    
* ### _18/03/24:_
    * I set an email server up to test the early version of password recovery by sending a unique token to email address associated with account it successfully sent emails upon request by website so it's a working            proof of concept, the server at some point stopped working, setting up mercury proved to be a very complex time consuming task so it's on hold for now, but it did work.
    * First half of password recovery system was concluded a new password recovery page was created with relevant forms.
 
* ### _20/03/24:_ 
  *  Finished the password recovery system, the whole recovery process works. Two new pages were created recovery password and reregister password.
  *  Created a new recovery table in database to store a temporary token and created a relation to user ID matching a specified email address.


      
</details>

## Harry
<details>
<summary> 
  Work
</summary>
  
</details>
