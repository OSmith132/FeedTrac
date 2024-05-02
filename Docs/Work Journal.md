# Work Journal
* Journal type doc to keep track of work done by group members to later add on to the report.
* Please include whatever you've worked one regardless if you've completed it or not. For example code work on something specific, research, report writing, etc.
* Write your updates between details block.
## Toby
<details>
<summary> 
  Log Of Tasks Completed:
</summary>

* ### _01/23:_
  * working on login screen
  * Added CSS styles
  * Added HTML
  * Deprecated due to being behind main branch
  * Created TODO
  * Created Code-Style Guide
  * Created Specification
  * Created work flow Chart


* ### _4/23:_
  * Implemented Profile picture upload
  * Implemented Profile Bio in db and profile page
  * Implemented new functions for retrieving user data from db

* ### _5/23:_
  * Edited settings page
  * Implemented profile page giving details of different users (help from Ollie)
  * Implemented LoginView with associated functions
  * Fixed password hiding/unhiding in change password
  * Fixed password change not changing password
  * 


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

* ### _29/04/2024:_
    * Fixed the homepage so it now displays feedback reports correctly.
    * Added a folder to assets where profile pictures can be stored.
    * header and homepage now display custom profile pictures rather than the default image
      
 * ### _30/04/2024:_
    * Homepage now allows for searching and filtering for feedback reports.
    * Homepage has new UI for searching, Filtering, and sorting feedback reports.
    * Feedback View class has many new methods for retrieving and formatting feedback and user data.
    * Fixed error in datbase class that incorrectly flagged 0s as empty variables.
    * Fixed footer on homepage to be in line with the rest of the page, and pushed to the bottom of the screen
    * Created new CSS classes to align homepage items correctly as it has been bugging me for a while

* ### _01/05/2024:_
    * Used AJAX to apply filters, sorting, and searching in real time.
    * Added file 'updateTable.php' to generate HTML script for table rows with posted information from the database.
    * Created 3 new listeners to update filters, process row clicks, and call AJAX when appropriate.
    * Added redirection for the table row (to the feedback.php page with the correct id tag in the url).
    * Added redirection for the username and profile picture in the feedback row (to the profile.php page with an id tag in the url).
    * Fixed the footer to make it always appear at the bottom of the page.
    * Fixed bug that required form resubmission when reloading or using the browser's back/forward buttons by allowing essential data to be cached. This makes website traversal much smoother.
    * Cleaned up commenting and formatting in multiple files including index, feedbackcontr, feedbackview, feedback, and database.
    * Fixed error in database.php where variables with values 0 or false were being flagged as empty and failing checks they should have passed.
    * Probably some other random tasks I found.


   
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

* ### _7/04/24:_
    * Implemented account soft deletion functionality.
    * Added get_username, delete_account and is_active functions to Login Controller
    * Added activeAccount column to user table in database.
    * Added Home button.
    * Updated CSS.

* ### _28/04/24:_
    * Recreated TODO list to ensure that everyone know what is left to do on the project.

* ### _30/04/24:_
    * Updated Footer so that it is positioned near the bottom of the page.
    * Created changePassword.php that can be accessed from the settings menu.
    * Updated CSS so that the dropdown menu now glows purple to make it stand out.

* ### _1/05/24:_
    * Updated Profile so that the information that is displayed is clearer.
    * Added "Show Characters" checkboxes to every password box so that the user can check what password they have typed.
    * Updated the light mode/dark mode scripts so that the current theme is stored and is retrieved when moving across webpages.

</details>

## Archie
<details>
<summary> 
  Log Of Tasks Completed:
</summary>

* ### _25/02/24:_
  * Created a new FeedTrac logo and added it to the website
  * Created an example feedback page
  * Replaced the old homepage stub (a page with no actual content) with an example homepage
  * Created main.js (inside of /scripts) for storing the website's JavaScript content
  * Created main.css (inside of /stylesheets) for storing the website's CSS styles
  * Applied the fully "open" Rubik font (https://fonts.google.com/specimen/Rubik) to all pages on the website
  * Declared CSS variables for storing the website's main colour palette (--a, --b, etc.)

* ### _29/03/24:_
  * Rewrote the project's README.md to be more accurate, up to date and descriptive (including a warning for contributors about foreign key checks)
  * Replaced the broken database files stored in the GitHub repo with the ones that Oliver and Marco were actually using

* ### _28/04/24:_
  * Tweaked various elements of the project's README.md
  * Licensed the entire project under the GNU General Public License v3

* ### _29/04/24:_
  * Tweaked various elements of the project's README.md again
  * Removed the redundant /.idea directory
  * Renamed the /.Documentation directory to /Docs
  * Renamed the /feedtrac directory to /Website
  * Temporarily removed the active user check from the login page as the feature is not yet fully implemented
  * Populated the profile page with actual user info
  * Tidied and refactored the profile page
  * Renamed and slightly refactored "protected function get_username_id($userID)"
  * Added new (and refactored existing) getters for retrieving current (or any) user info

* ### _30/04/24:_
  * Redesigned the sign up page
  * Prevented new users from providing invalid form data
  * Reimplemented Earl's password visibility toggle

* ### _01/05/24:_
  * Tweaked README.md titles to be more consistent with each other

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

* ### _17/03/24:_
    * DB troubleshooting, created new php page for password recovery basing it on login page.
    
* ### _18/03/24:_
    * I set an email server up to test the early version of password recovery by sending a unique token to email address associated with account it successfully sent emails upon request by website so it's a working            proof of concept, the server at some point stopped working, setting up mercury proved to be a very complex time consuming task so it's on hold for now, but it did work.
    * First half of password recovery system was concluded a new password recovery page was created with relevant forms.
 
* ### _20/03/24:_ 
  *  Finished the password recovery system, the whole recovery process works. Two new pages were created recovery password and reregister password.
  *  Created a new recovery table in database to store a temporary token and created a relation to user ID matching a specified email address.
 
* ### _26/03/24:_
  *  Lots of troubleshooting, lots of research.
  *  Finished the password recovery system again, this time it implements the new database and login classes.

* ### _30/04/2024:_
    * Created new feedback page functionality.
    * Started Observer development which involves both new feedback page and inbox page, users are now auto subscribed to their picked course and get updates on items published related to this course.
    * Added counter functionality to count newly created feedback items in inbox for display over inbox icon.
    * Updated many db tables to support said functionality.
    * Began Inbox functionality, had issues with some date fields, to be resolved.
    * Also added appropriate fields to relevant tables related to Inbox.
    
 
* ### _01/05/2024:_
    * Changed counter to only update if user is still subbed, and not alert for own feedback submissions.
    * Debugged issues with date time in database, with help from Toby.
    * Inbox now displays items newer than user account creation date, as intended, decisions made to change it to a dropdown menu displaying the same content as inbox page, with added alert counter on icon.
    * TODO - Button up inbox after the new format change.
    * Started work on commenting system.
 
* ### _02/05/2024:_
    * Changed new feedback input box to be a text box.
    * Implemented feedback items page.
    * Implemented commenting.
    * Implemented comment count.
    * Changed date to display datetime instead of how long ago posted.
    * Re-arranged page elements for feedback page, moved text box and submit button.
    * Implemented modifiedDate updates on comment added to feedback.
    * Completely reworked and fixed inbox to display items sorted by newest modified feedback item (comments), now fixed and redirecting to correct feedback item.
    * Fixed modified date to reflect our timezone.
    * Many database fixes and tweaks.
    

</details>






## Lorna
<details>
<summary> 
  Log Of Tasks Completed:
</summary>
</details>


## Harry
<details>
<summary> 
  Log Of Tasks Completed:
</summary>
</details>
