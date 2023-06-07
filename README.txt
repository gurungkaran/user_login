# Register and Login  
This project demonstrates how to register and login system page using PHP.

I've updated the register and login system more security.
1) allow multiple user login
2) validation of password strength
3) get user password as hash password
4) check user for the verification status
 
Features
This user interface has the following features:

Login form: users can enter their email and password to access the system
Registration form: new users can create an account by providing their firstname, lastname, username, email, password, confirm password and captcha
Welcome page: once logged in, users are directed to a welcome page where they can view and logout their information

A simple Login System:
User can register an account, before login user need to verify his/her account. user will received a OTP code send by PHPMailer.
User can reset his/her password, user will received a new url link send by PHPMailer to reset his/her new password.

How to use this source code:
requirement:
1) install xampp
here is the link to install xampp
apachefriends.org/index.html

First step:
1) download this repo 
2) create a folder name as ismt -> extract to your xampp folder -> htdocs -> on folder ismt
3) go to phpmyadmin -> create database sunderland
4) copy all the query command from students.sql -> paste it under the database ismt sql.
5) copy the path of register.html -> paste the link -> before C:\xampp\htdocs\ismt\register.php -> modify to http://localhost:4433/ismt/register.php
7) modify the register and login under two file -> register.php and login.php
8) now you are ready to run your ismt project !
9) Happy Coding

For email verification and more details refer to this youtube video with clear explanation
https://www.youtube.com/watch?v=w43LAiVV-cM

