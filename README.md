Linden DocLibrary
=======

This test was developed using the framework CakePHP 2.3

Basic functionality is as follows:


1. The user can upload files individually.
2. Each file can have multiple versions, generated when the user uploads a new version for the file.
3. These files and versions can be edited an deleted.
4. The current version is the last version updated for a specific file.
5. Any version of the file can be restored to the current in the history view for each file.


Setup instructions

1. Download the project zip package and uncompress it in your www folder.
2. Create a database schema and execute the linden_doclibrary.sql script.
3. Update the app/Config/Database.php file with the settings of your database.
4. Open the proyect url folder in your browser.
5. Open the app/Config/core.php file and set the debug configuration variable to 0(zero).
6. Enjoy!