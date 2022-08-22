This project (or rather example) is part of Chapter 9's 'CMS with OOP' and is from the book *PHP Advanced and Object-Oriented Programming* by Larry Ullman. 

This project focuses on two important ascpets of a CMS:
- Pages
- Users

Requisite Functionality:
- Pages can be added.
- The most recent pages are previewed on the home page.
- An individual page can be  seen in its entirety.  
- A user can log in.
- A user can log out.
- Only administrative users, or the author of the currently viewed page  of content, will be provided access to edit the page.
- Only administrative users or author users can create new pages. 

## Database Tables

Users Table |-
-|-
**Column** | **Type**
Id | INT 
userType | ENUM
username | VARCHAR(30)
email | VARCHAR(40)
pass | CHAR(40)
dateAdded | TIMESTAMP


Pages Table |-
-|-
**Column** | **Type**
Id | INT 
creatorId | INT
title | VARCHAR(100)
content | TEXT
dateUpdated | TIMESTAMP
dateAdded  | TIMESTAMP

## Utilities File
This file needs to fufill three needs:
- It defines a autloading function for classes
- It starts the session and checks for the presence of a User object previously stored in the session
- Opens the database conn, creating a PDO object in the process
