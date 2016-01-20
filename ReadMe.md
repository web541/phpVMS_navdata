-------------------------------
How To Update phpVMS Navdata
-------------------------------

	----> Original Code Copyright (c) 2014 Nabeel Shahzad
						All rights reserved.
	----> Originally modified by airhaul (phpVMS Forums)
	----> Modified Again by Web541 (phpVMS Forums)

NOTE: This script requires the table phpvms_navdata to be in your sql database, if it's not there, create it.

Local Servers recommended are:

XAMPP: https://www.apachefriends.org/index.html
WAMP: http://www.wampserver.com/en/

Because the ints.txt file is so large and the mysql_query was having issues with my server, I have updated that one query in fsbuildparseints.php on line 128 to mysqli_query which seemed to fix the issue I was having. 
(Could not modify header's set or something like that)

-Would recommend backing up navdata table in database before running

-Program deletes all previous data in phpvms_navdata table before updating

-Also program will not work if the table phpvms_navdata is not present. If it isnt go to DBadmin and copy structure only from navdata table to phpvms_navdata

-Inserts into phpvms_navdata table. If prefix is different rename phpvms_navdata to navdata for example when complete

-Use at your own risk. Works great with me but can't say it will with everyone.

-------------------------------

	-All intersections uploaded with a lat/lng
	-All VOR / NDB correctly labeled
	-Intersections all go in instead of hanging up

-------------------------------

Installation (On Web Server):
	1.	Go to phpMyAdmin or similar and enter your database
	2.	Find the table phpVMS_navdata
	3.	Go to the operations tab
	4.	Rename Table To `vms_navdata` (without the `)
	5.	Obtain the latest fsbuild AIRAC
	6.	Rename it FSBUILD2.exe
	7.	Place this .exe file in the navdata/fsbuild folder
	8.	Run the installer
	9. 	You should now have three (3) files
			awys.txt
	    		navs.txt
	    		ints.txt
		
	    Move all other files to another folder
	10. Search for CMD (or Terminal on Mac) and run it as administrator
	11. Copy and paste the following (assuming that your phpvms installation is in C://xampp/htdocs/phpvms or C://wamp/www/phpvms)
				
				[XAMPP] 
				cd C:\xampp\phpvms\navdata
					then run this
				C:\xampp\php\php.exe -f "C:\xampp\htdocs\phpvms\navdata\fsbuildparse.php" -- -arg1 -arg2 -arg3
					then run this
				C:\xampp\php\php.exe -f "C:\xampp\htdocs\phpvms\navdata\fsbuildparseints.php" -- -arg1 -arg2 -arg3	
				
				[WAMP] 
				cd C:\wamp\www\phpvms\navdata
					then run this
				C:\wamp\bin\php\php5.3.5\php.exe -f "C:\wamp\www\phpvms\navdata\fsbuildparse.php" -- -arg1 -arg2 -arg3
					then run this
				C:\wamp\bin\php\php5.3.5\php.exe -f "C:\wamp\www\phpvms\navdata\fsbuildparseints.php" -- -arg1 -arg2 -arg3
				
		of course changing the 5.3.5 to your php version
		
	12.	Wait about 5 minutes and you should get something like this (after the first file)
	
	            Loading airways segments...91220 airway segments loaded...
	            Loading VORs...965 VORs added, 2834 updated
	            Loading NDBs...2202 NDBs added, 1800 updated
	            Completed!
				
		Then this after the second file
		
	            Loading INTs...93944 INTs added, 54743 bypassed already in DB
	            Completed!
			
	For changing the navdata locally, I have separated the ints.txt from the other two files to avoid the "MySQL Server Has Gone Away" error as the ints.txt file is significantly larger than the other two therefore clogging up server execution time. 
	(I have tried the php.ini file, it didn't find that it worked, but your welcome to try it here:
		http://forum.phpvms.net/topic/19993-navdata-update/#entry110090
	)
	If that doesn't work, then google is your best friend!
    
-------------------------------      
13. It should've been successfully updated.
