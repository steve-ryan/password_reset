# Password Reset

This repository contains a ready to use login,register and password reset in php using PHPMailer but you can improve on it by using prepared statements to prevent SQL injections.

### Database

use the below code to create the database for your project,but you can call it any name of your choice,but you have to change to your preferred name under `db_connection.php` file on the project root.

`CREATE DATABASE oop_db`

```
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `firstname` varchar(255)  NOT NULL,
  `lastname` varchar(255)  NOT NULL,
  `user_email` varchar(255)  NOT NULL,
  `user_password` varchar(255)  NOT NULL,
  `reset_link_token` varchar(255) DEFAULT NULL,
  `exp_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
```

Below is the event table `event.sql`

```
CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `name` varchar(255)  NOT NULL,
  `venue` varchar(255)  NOT NULL,
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
```

The table code can also be copied from a file named `users.sql` in the project

### PHPMailer Configuration

For this project you need PHPMailer,which is a code library to send emails safely and easily via PHP code from a web server. Sending emails directly by PHP code requires a high-level familiarity to SMTP protocol standards and related issues and vulnerabilities about Email injection for spamming. [Wikipedia](https://en.wikipedia.org/wiki/PHPMailer)

Have already downloaded it and pushed it for you it's under `vendor` folder of the project

But if you want to do a fresh installation delete `vendor` folder and using composer, run the below command on the terminal one you are inside your project root directory.
It will install the lastest stable version of `phpmailer`

You can read more about this library on their official github account [phpmailer](https://github.com/PHPMailer/PHPMailer) has got a great community

```bash
composer require phpmailer/phpmailer
```

## Areas to edit

All this is under `password-reset-token.php` file

```
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['password-reset-token']) && $_POST['user_email'])
{
.... omitted lines of code

//change the link based on your project directory
 $link = "
    <a href='http://localhost/password_reset/reset-password.php?key=".$emailId."
&token=".$token."'> Click To Reset password</a>";

...omitted lines of code

Check on commented areas under $mail = new PHPMailer();
and change accordingly

```

Secondly, under `update-forget-password.php` file, edit following lines based on your project directory

```
...omitted lines of code

$loginpage = 'http://localhost/password_reset/index.php';
$reset = 'http://localhost/password_reset/reset-password.php';

...omitted lines of code
```

### React version of the same

Follow this link ![React.js version](https://github.com/steve-ryan/Event-Manager)

## NB (Outdated)

~~If you are testing it locally, you must go to `gmail->account-> security -> (scroll down to less secure app access and turn it to on)` This enable sending and receiving your emails but don't try that on production.~~

## NB (Updated version)

If you are testing it locally, we have to enable 2-step authentication on the account.

Here are the steps to follow to generate the app password:

1. Sign in to your Gmail account.
2. Go to "Manage account."
3. In the search bar, type "app password" (select the one under security).
4. You will be directed to app passwords, go to select app and choose "Other" (custom name).
5. Give it a name (e.g., mailapp) and click on "Generate."
6. You will see your password (mainly on a pale yellow background and 16 digits in number). Copy it and paste it safely; we will use it to set up our app.

## For any enquires

Just whatsapp/sms/call me on `+254756949393`
Enjoy playing around with the codes to meet your requirements

Email `devsteveryan@gmail.com`
