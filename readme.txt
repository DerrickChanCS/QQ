Installation Guide

For the installation, whenever [SCU Username] is written, replace that with your SCU Username. For example 
	cd /webpages/[SCU Username]
becomes 
	cd /webpages/dchan1 

Yes, the files are on the usb, you can copy the files or you can just use git clone to copy the files for you.
  
1) Obtain and run an Oracle database account through Santa Clara University. For full instructions, refer to the SCU help page at 
	http://wiki.helpme.engr.scu.edu/index.php/Oracle
 	a) Send an e-mail to support@engr.scu.edu requesting an Oracle account be created for you with your name and campus ID number. 
  	b) After receiving e-mail confirmation of account creation setup the Oracle environment on one of the Design Center Linux computers.
  	c) Open terminal and type "setup oracle".
  	d) Next, type "sqlplus 'yourUserName'@db11g" without the ' ' symbols. This will prompt you to change your Oracle password.
  	e) Follow the on-screen instructions (your old password will be your ACCESS card ID number with all the leading zeros). Make sure not to include the "@" symbol within your new password.

2) Open a new terminal window on the SCU Linux system. If you do not already have a webpage associated with your SCU username follow these instructions. If you do have a webpage, continue onto the next step.
	a) To create a webpage, run the command 

		webpage

	   and wait up to 15 minutes for the server to process your request.

	b) If you need additional help, refer to 

	   	http://wiki.helpme.engr.scu.edu/index.php/Webpage

3) Navigate to your SCU webpages file server. By default, the file path is /webpages/[SCU username]

    cd /webpages/[SCU username]

4) Run the following command to copy the files from the Github repository

    git clone  https://github.com/DerrickChanCS/QQ.git

5) Run the following commands to setup CGI

    mkdir cgi-bin
    chmod 755 cgi-bin
    cd cgi-bin
    touch php-cgi.cgi
    chmod 755 php-cgi.cgi

6) Edit the php-cgi.cgi file to contain the following script

    #! /bin/sh
    exec $HTTP_SERVER_DIR/php-cgi "$@"

7) Run the following commands to setup the environment

    cd /webpages/[SCU Username]/
    chmod 755 -R QQ
    cd QQ
    chmod 644 .htaccess

8) Edit the contents of the .htaccess. In the file, there is a section on line two that says [SCU Username]. Replace that with your SCU username. The .htaccess file should be located at /webpages/[SCU username]/QQ

9) Mount the webpage directory and follow these commands: 
    cd webpage
    touch password.php
    find . -type f -name '*.php' -not -name 'QueueTARoomSetUpPage.php' -exec chmod 711 {} \;

10) Edit the password.php file to include the following code. The username and password information should match the credentials of your SCU Oracle account

    <?php
        $username = "username";
        $password = "password";
    ?>

11) Login to your SCU Oracle account

    setup oracle
    sqlplus [SCU Username]@db11g

12)Execute the maketables.sql file in the Oracle Database terminal. If the terminal cannot find the maketables.sql file, make sure your working directory contains the file.

    @maketables.sql

13) Now you should be able to access the project by going to:
    http://students.engr.scu.edu/[SCU Username]/QQ/webpage/QueueHomepage.html
    