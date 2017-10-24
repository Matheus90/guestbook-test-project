# guestbook-test-project
It's just a [test project](http://matemoto.com:8083/guestbook) made for a job application, using PHP, JQuery, Bootstrap. Built from bottom to top by Máté Simon.


List of To Dos to set up the project:
- setup apache use this project folder as **webroot** (do it on a custom port like :8080 if you want)
- install **mysql**
- create database **morgens** (utf8_general) 
- add user **morgens**/**morgenspass** and add it to the database above
- create **tbl_review** <br/>
```
CREATE TABLE tbl_review (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	email VARCHAR(128) NOT NULL,
	rating INT(1) DEFAULT 5,
	review TEXT,
	create_time TIMESTAMP DEFAULT NOW(),
	update_time TIMESTAMP
);
```
