# TODO List
* #### Feel free to add more tasks to the list.
* #### Add your name to what you are working on.
* #### Remove task from the list when complete.
* #### Remember to add what you completed to the work journal.

---

## GitHub:

* Update Flowchart (can put directly in report)

---

## Website and Database:

* All pages
  * ~~Light/dark mode~~ - _Archie (03/05/24)_
  * ~~Header buttons need to hide when not logged in~~ - _Archie (04/05/24)_
  * ~~Remove weird whitespace under header profile button~~ - _Archie (04/05/24)_
  * Alert badge on inbox button needs to be connected to the database
  * There is still some "hardcoded" CSS styling going on that isn't compatible with the dark/light mode toggle (see the "unsorted" section of main.css)
  * Ensure entire project is actually compliant with our style guide (style guide may also need updating)
  * Ensure .php files are organised into suitable subdirectories
  * < head > should be moved into its own file and then reused like header.php and footer.php because it's bad to keep duplicating it (I assume this is possible?)
  * (OPTIONAL) Add fancy CSS transitions

* New Feedback page - Marco - Done
  * ~~Create page~~_Marco (30/04/24)_
  * ~~Add feedback creation functionality~~_Marco (30/04/24)_
  * ~~Link with database~~ _Marco (30/04/24)_
  ~~* (OPTIONAL) Add extra options such as anonymous posting or the ability to disable comments~~ - (anonymous posting = trolling, so we're not doing it, disable comments done by closing item in feedback.php) _Marco (04/05/24)_

* Home/Index page
  * ~~Display feedback data on the home/index page~~               _- Oliver (29/04/24)_
  * Add filters for:
      *  ~~resolved~~                                              _-Oliver (30/04/24)_
      *  ~~urgency~~                                               _-Oliver (30/04/24)_
      *  ~~date range (1 hour, 1 day, 1 week, 1 month, All time)~~ _-Oliver (30/04/24)_
      *  tags (Might add this as an optional task later)
  * Add sorting for:
      * ~~Date Ranges~~                                            _-Oliver (30/04/24)_
      * ~~RatingPoints~~                                           _-Oliver (30/04/24)_
  * ~~Search bar for feedback titles~~                             _-Oliver (30/04/24)_
  * ~~Allow the user to press on row and redirect to feedback~~    _-Oliver (01/5/24)_
  

* Feedback page - Marco - In progress, mostly done.
  * Implement feedback rating system
  * Page title in < head > should reflect the title of the feedback
  * ~~Implement commenting system < prioritizing this~~ _Marco (30/04/24)_
  * ~~get avatars on comments to work~~ _Toby (02/05/24)_
  * Maybe add Photos / files to report
  * ~~Link with database~~ _Marco (30/04/24)_
  * ~~TODO STRETCH - Assign correct student ID to feedback item, assign correct course.~~ _Marco (30/04/24)_

* Course page (Deprecated by committee)
  * ~~Create page (Contains posts relevant to a specific course)~~ 
  * ~~Allow for individual course pages by linking with database~~
 
* Inbox page - Marco - Done?
  * ~~Create page (Contains user notifications on updates to their personal and subscribed posts)~~_Marco (03/05/24)_
  * ~~Display feedback data on the inbox page~~_Marco (03/05/24)_
  * ~~Add an observer to subscribe and get updates to courses and comments (Design Pattern)~~_Marco (03/05/24)_
  * ~~Convert page into dropdown menu, with alert counter on corner of the icon.~~ _Deprecated by committee_

* Profile page
  * ~~Need to be able to see other users profile when clicking on their names~~ _Toby (02/05/24)_
  * ~~Allow for individual profile pages per account to replace the template~~
  * ~~Add edit profile functionality~~ 
  * ~~Upload profile picture~~  (only supports png upload) _Toby (30/04/24)_
  * ~~Edit about section~~ _Toby (01/05/24)_

* Settings page
  * ~~changePassword.php has now been created, but the form to change the password isn't functional~~ _Toby (02/05/24)_
  * Need to check old password before allowing change
  * ~~(OPTIONAL) Add additional user settings~~ _Toby (01/05/24)_
  * ~~Edit personal information~~ _Toby (01/05/24)_

* Admin/Moderation page
  * Create page
  * Moderation Tool (for admins to remove content)
  * Staff could resolve / force close issues as well as reply - (close feedback implemented in feedback.php) - _Marco (04/05/24)_
  * (OPTIONAL) Only the relevant staff to recieve the feedback

* Database
  * ~~Ensure that the database includes tables for all necessary data and add fake data to help with testing~~   _-Oliver (01/5/24)_
  * ~~Add ability to store profile pictures on the database~~                                                    _-Oliver (29/04/24)_

---

## Report:

* Software Engineering and Planning (max 1000 words) 
  * Software Engineering Strategy 
  * Version Control 
  * Software Development Approach 
  * Diagrams 
  * Dependency/Library References
  * Detailed Plan

* Implementation (max 2000 words)
  * Explanation
  * Justification
  * Chosen Toolsets
  * Implementation Challenges
  * Code Snippets

* Testing Strategy (max 1500 words)
  * Explanation
  * Evidence of Testing throughout the development cycle
  * Test Results
  * Issue Discussion and Management

* Evaluation (max 1500 words)
  * Detailed Evaluation
  * Internal Testing
  * External Testing
  * Future Development Discussion

* Group Work Conclusion (max 800 words)
  * Co-authored Reflection
  * Individual Contributions

* References (No limit)
