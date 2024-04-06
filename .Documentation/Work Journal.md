# Work Journal
* Journal type doc to keep track of work done by group members to later add on to the report.
* Please include whatever you've worked one regardless if you've completed it or not. For example code work on something specific, research, report writing, etc.
* Write your updates between details block.
## Toby
<details>
<summary> 
  Log Of Tasks Completed:
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
 
* ### _18/03/2024:_
    * Finished working on the PHP handler class for feedback reports.
    * Fixed some minor bugs within the signup and login pages
    * Added the _'comment_user_rating'_ and _'feedback_user_rating'_tables to track if a user has liked / disliked a coment or feedback report before
    * Changed the Database class to make it static and changed the _'connect()'_ function to establish and return a connection to the database
   
</details>

## Earl
<details>
<summary> 
  Log Of Tasks Completed:
</summary>
  

* ### _14/02/24:_
    * Created a shared document to be used as the basis for our summary report.
    * Added structure to the summary report with headings to outline the required sections as detailed on the 	  assignment brief.

* ### _25/03/24:_
    * Completed Lecture notes and extracted keywords.

* ### _31/03/24:_
    * Researched PHP, HTML, CSS and JavaScript.
    * Added Header and Footer HTML files.
    * Applied CSS consistently across all pages and centered main content.
    * Code restructuring.

* ### _1/04/24:_
    * Header buttons hidden depending on the current page.
    * Implemented logout button.
    * Improved CSS styling for forms featured on login.php, recoverPassword.php, reregisterPassword.php and signup.php.
    * Created dropdown menu for when hovering over the profile badge.
    * Added Profile and Settings buttons to hover menu.
    * Moved Logout button to hover menu.

* ### _3/04/24:_
    * Added the example content from feedback.php to index.php and linked the pages.
    * Improved styling of index.php and feedback.php.
    * Implemented "heart" button to feedback.php.
    * Added and linked empty pages for inbox, new feedback, profile and settings.
    * Linked recoverPassword.php from settings page.
    * Added colour transition for light-mode/dark-mode.
    * Improved CSS styling.
    * Moved PHP warning messages to the form box and changed colour to red.
    * Implemented requirements for the text input on the forms.
    * Added JavaScript to detect login status.

* ### _4/04/24:_
    * Added example content to profile.php.
    * Added empty profile pictures next to usernames.

* ### _5/04/24:_
    * Implemented hidden form popup to be used for account deletion.
    * Updated logout.php so that it detects the correct file path when stored in the script folder.
    * Added and linked accountDeleted.php and course.php files.
    * Organized main.css into page-specific sections and adjusted CSS class names accordingly.


</details>

## Archie
<details>
<summary> 
  Log Of Tasks Completed:
</summary>
  
</details>

## Lorna
<details>
<summary> 
  Log Of Tasks Completed:
</summary>
  
</details>

## Marco
<details>
<summary> 
  Log Of Tasks Completed:
</summary>


* ### _17/02/24:_
    * Researched PHP and PHP encryption, created a branch.
    * Database troubleshooting with Oliver, changed password field to varchar 255 datatype.
    * Implemented password hashing encryption, tested successfully.
 
* ### _14/03/24:_
    * Started work on forgot password implementation. Going with a simple memorable word prompt as a first attempt.
    * Researching into doing email verification.
    

</details>

## Harry
<details>
<summary> 
  Log Of Tasks Completed:
</summary>
  
</details>
