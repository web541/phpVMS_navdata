-------------------------------
How To Update phpVMS Navdata
-------------------------------

----> Original Code Copyright (c) 2014 Nabeel Shahzad
					All rights reserved.
----> Originally modified by airhaul (phpVMS Forums)
----> Modified Again by Web541 (phpVMS Forums)

NOTE: This script requires the table phpvms_navdata to be in your sql database, if it's not there, create it.

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
10. Upload the navdata folder to your website via FTP (root directory where you see admin, core, lib)
11. Connect to your server via an ssh application (e.g. Putty)
12. cd to navdata
13.	When prompt, run
			php -f fsbuildparse.php
14.	Wait about 5 minutes and you should get something like this

            Loading airways segments...91220 airway segments loaded...
            Loading VORs...965 VORs added, 2834 updated
            Loading NDBs...2202 NDBs added, 1800 updated
            Loading INTs...93944 INTs added, 54743 bypassed already in DB
            Completed!
            
15. It should've been successfully updated.
-------------------------------

If you get an issue that states "MySQL Server Has Gone Away"
try looking at this post http://forum.phpvms.net/topic/19993-navdata-update/#entry110090
If there is no fix there, then google is your best friend.

-------------------------------