**REALTIME CHAT APP (WHATSAPP CLONE) WITH THE NEW UPDATE TO VIEW STATUS UPDATE FROM CHATS**
**AND ALSO YOU CAN UPLOAD STATUS AND YOU CAN ALSO CHAT**

***
_HERE"S A DEMO VIDEO_ 
[WATCH-DEMO-VIDEO](https://drive.google.com/file/d/1oxLxUEE50lHwmT2x0d2f2Xu42liDzpKX/view?usp=sharing "WATCH DEMO VIDEO")

***
_FIRST, Using Mysql, Create A Database perferrably name it chat (as it is in this project)_

***
CREATE FOUR TABLES IN DATABASE
***
1. users Table
    (**USERS TABLE SHOULD HAVE 8 COLUMNS**)
    * user_id INT(set user_id to Auto_increment) 
    * unique_id INT(unique identification for users using current time(), check Line 62 controllers/register.php)
    * fname VARCHAR(store first name of user)
    * lname VARCHAR(store last name of user)
    * email VARCHAR(store email of user)
    * password VARCHAR(store user's password)
    * img VARCHAR(store user's profile picture image path, check Line 56 controllers/register.php)
    * status VARCHAR(Keep track of user's status, Either Active or Offline, Line 70 controllers/register.php and Line 18 controllers/logout.php)

***
2. messages Table 
    (**messages table should have 4 columns**)
    * msg_id INT (set msg_id to Auto_increment)
    * incoming_id INT (hold the id of the user message is sent to)
    * outgoing_id INT (hold the id of the user sending the message)
    * message VARCHAR (hold the message sent)

*** 
3. status Table 
    (**Status table should have 5 columns**)
    * id INT (set Id to Auto_increment)
    * status_id INT (create a unique_id for status, check LINE 39 controllers/upload-status.php)
    * file VARCHAR (Hold file Path of status, Check Line 36 controllers/upload-status.php)
    * created_at DATETIME (hold status creation time, Check Line 38 controllers/upload-status.php)
    * postedBy INT (hold the Id of the user posting status, check LINE 47 controllers/upload-status.php)
***
4. views Table 
    (**views table should have 3 columns**)
    * count INT (set count to Auto_increment)
    * status_id INT (hold the status Id, check Line 40 controllers/view-status.php)
    * userId INT (hold the user Id, check line 41 controllers/view-status.php)

***

***START PHP LOCAL SERVER***
***REGISTER, LOGIN, CHAT, UPLOAD STATUS (ENJOY) ***
***TO SEE EFFECT, YOU HAVE TO CREATE AT LEAST TWO ACCOUNTS, OPEN URL IN TWO DIFFERENT BROWSERs AND CHAT***
