# ASimpleBlog

This is a coding practice to show how my programming is. This repository only focuses on the **PHP-Backend**. So please do not expect it to look anything near nice.

## Assignment

The assignment is to create a small blogging application. Hence the name of this repository. The task is to focus on the backend, a well designed frontend is nice but not neccessary. The tasks are as follows:

* No use of a pre-existing framework (no MVC-Framework)
* Usage of libraries is allowed
* The PHP-Code has to be object oriented
* All class names, variables, database objects have to be named in English.
* The frontend has to be in German.
* The date format has to be German independently of the server or client settings

Implicit assumtions:
* There should not be an XSS attack vector
* There should not be an SQL-Injecion attack vector

The features are as follows:
* Use a MySQL-Database
* There has to be a startpage.
	* On the top of the page there has to be an image, linking to the start page
	* Below the image, there have to bee some links
		* Startseite -> linking to the start page
		* Login -> linging to the login page (only if not logged in)
		* Eintrag hinzufügen -> linking to the add entry page (only if logged in)
		* Logout (only if logged in)
* Overview
	* It has to display the newest 3 blog entries on default.
	* It has to show the title of each blog posting as Date, Title, Number of Comments
	* The date part has to be "Heute" if the posting is from today
	* Each posting should show a maximum of 1'000 Characters. If the post is longer, that print the 1'000 Characters and add a link to read more.
	* Display the author's name below each posting. Use either the display name or the full name
	* The name has to be clickable. The link has to go to the author's page.
	* If there are older entries than displayed, include a link to the next batch. If there are no older postings, don't show the link
	* The user should get to the detail page by clicking one of the following: Headline, Read more link
* Author's page
	* Same as the Overview page, but only display entries by the selected author
* Detail page
	* Display the complete post
	* Show the number of comments below
	* Display ALL comments to that article
	* Display each comment in this format: Name [URL if entered] (am [Date] um [Time]) meinte \n [Comment]
	* All comments have to be numbered using sequential numbers starting with 1
	* Display a form to add a comment (see Definition of Comments)
	* On Form Validation errors show an error message and prefill all form fields with their previuos values
* Definition of Comments:
	* The user may enter the following fields: `Name`, `URL`, `Email`, `Comment`
	* `Name` and `Comment` are required fields
	* All other fields are optional
	* Additionally save the comment auhores IP Address
	* Think about a solution to stop comment spam
	* On saving of a comment, send an email to the author of the article
	* This email has to show all the recorded fields in a human readable format
	* The subject has to be "Neuer Kommentar zu [Article title] von [Name]"
* Login
	* While logged in, the article title on the detail page has to also show the author's IP address
	* While logged in as the author of the article, there has to be a link to the edit page
	* Under the same condition there also has to be a button to delete the currently visible entry. Before the actual deletion there has to be a JavaScript confirmation dialog. Only on pressing *Yes* should the article be deleted
* Impressum
	* Display all authores with name and address (Street, City + ZIP Code)

## Solution

To start the solution, you need to setup the database from the schema located in the `schema` folder. The DocRoot Folder is `/public`. Please also update the database settings in `config.php`.

## TODO
* [ ] Make a well designed frontend (perhaps with Bootstrap)
* [ ] Add visual database schema

## License
This is a showcase project. Therefore it is licensed under AGPL. For more see [the LICENSE FILE](LICENSE)