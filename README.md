Stan's plan:

Github, make a place to put things
Set up the db with tables
Make php pages for the admin side
learn the json stuffs
ravamp the app

Get it done in a month.

We can do this.



Pages we need for the provider side:
Login
First time - Make your classes, clubs, sports, etc.
View of all announcements
Make new announcements/edit announcements
Settings (make same as first time)

Magic admin powers:
Above +
-View all users
-Make/Change/Delete users
-Edit all classes, clubs, sports, etc.
-Access to all announcements



My (Dustin) job:

//Done//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///DONE///
make a settings screen
remember: value to fill in inputs

///DONE///
What the settings should do:
have:
-username
-password
-email
-names, first and last
-subtypes

///DONE///
I think there need to be to forms of this:
The first one is for when the user is first being created (so this is for the admin) (uses INSERT, for insert creates a new row)
The second is for what the user sees, so they actually UPDATE their stats

///DONE///
Lets make the admin one first.

///DONE///
How about there be a checkbox at top that says "new" or "edit"
It'll appear depending on if the person is an admin or user
that way, it differenciates between making a new user and editing an existing one

///DONE///
No there should probably just be two different pages. The new user page only exists for the admin. The actual settings page will only be an edit thing.

///DONE///
Perhaps for the sake of simplicity right now, we only make the adding user part first.
This needs to grab all the variables from the form and insert them into the users table.


///DONE///
Now the fun stuff, make a way for the users to edit themselves.
This requires getting the user data from the database and echoing them back into the text inputs as the values
It also needs a way to read the user_id, which will be determined by the session.

///DONE///
Figure out how the mysql_fetch_array works. It appears to take the row data in the form of an array.
I'll need to get that data and store it inside some sort of array.
Look at db.class.php for more info.

///DONE///
BIGGEST THING TO DO: Figure out what kind of data is returned by the mysql_fetch_array and how to manipulate it into a php array.

///DONE///
Session variables:
user_id
permissions

///DONE///
BIG QUESTION:
Do we set the empty subtypes when creating the user, or do we create the subtypes at the settings page?

///DONE///
NOTE TO MENTION:
Removed the periods from the users table.

///DONE///
add the links to the main.php

///DONE///
Add a way to prevent duplicates. 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

To do still:
add a reset option to settings.php //Might not be necessary
add redirects at the top as headers to prevent accessing the page if not logged in (involves session variables and cookies) (really more of a Griffin thing to do)
figure out the adding clubs and sports for the settings.php --> Next meeting

Plan for the rest of the month:
This week: Sort out the settings and new user pages.
Next week and a half or so: should be spent on the main page and create pages. Make create first, then the main, then the edit functionality of create.
Last week of Aug: should be spent on the client side, making it accept the json variables that we'll have to figure out how to do.
After that: Work on improving the client side to it's v2 status, with the fancy 8 period slots, real-time schedule, and other design implementations that are sketched out somewhere.

Look at this for the rich text editor for the announcement. We'll use a normal textarea for now.
http://stackoverflow.com/questions/8806673/html-how-to-retain-formatting-in-textarea
http://www.tinymce.com/
http://ckeditor.com/

Making create page:
hardcode inputs
use SELECT query to find the categories (subtypes)
Generate the checkboxes for the categories
Figure out the date input as well

More stuff:
The main page is gonna need some sorting functionality.
-Oldest to newest - This can easily be done by changing the order by statement.
-1 - 20, 21 - 40... - Gonna have to change all the beautiful "foreach" loops into "for" loops probably, then add some 
	variables that'll get parsed out from the browser or something that give it a min/max range.
-Something to routinely clear out and archive old announcements that have reached their expiration date
	-Do by grabbing the date that it's set to expire, converting it to a timestamp, checking it against the current
	timestamp, and seeing if it fits. We'll also make a box with the archive of everything, which simply won't
	include the timestamp checking functionality.
-Searching? (AAAAAAAAAAAAAHHHHHHHHH)