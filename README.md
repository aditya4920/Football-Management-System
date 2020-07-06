                                                Football Database Management System


About:

This football database management system is a hub accessing and analyzing player and club data. Here users can create their profile and view player data but will have to visit the site regularly to earn enough points to upgrade to a premium membership. The premium membership has its own perks as it gives the user detailed and extensive information about clubs players. This project is developed using HTML,JavaScript and CSS for front-end, where as PHP and MYSQL were used to implement the back-end part. This web application is user friendly,interactive and this combined with fast and accurate execution of queries keep the users glued for a long time.



Software Requirement
1.Windows 7 or higher version OS
2.Google chrome v70.0.3538 or greater
3.XAMPP web server


Procedure:
1.Install xampp on your system.

2. After installing wamp (Default directory : c:/xampp/) , download the project and unzip it in directory : (c:/xampp/htdocs/).

3. Select Xampp-control in directory : (c:/xampp/) and Start MySQl and Apache.Open google chrome and type the following url without quotes: "http://localhost/phpmyadmin/" and enter root as username and press Go.

4. Now first you have to Load the database in your local server and then you can run the project.

To load the database :

  - Click on +New on the left hand column
  - Give database name as "dbms" (without quotes and small case) and set character encoding to "utf8mb4_unicode_ci"
  - After creating the database successfully, on the upper main menu panel, click on Import and then click "choose file" from file to import menu. Now browse to directory where you saved the project and click on dbms.sql and then go down and click Go.
 
 Run the project :

    - Open new tab in chrome
    - type the following url : http://localhost/dbms_package/login.php
  
Possible Errors :  

If you face a problem that the image is not loading in the web page then please follow these steps:

1. Add the referer control extension to your google chrome browser. This is the link : (https://chrome.google.com/webstore/detail/referer-control/hnkcfpcejkafcihlgbojoidoihckciin)

2. Scroll down to the default referer for for all sites option.

3.  Select referer setting as custom and choose the option as target host.

4. Save changes and reload the web page.
