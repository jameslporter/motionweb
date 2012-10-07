Motion Web
===================
Powered by

Alloy Framework
http://alloyframework.org

Motion - a software motion detector
http://www.lavrsen.dk/foswiki/bin/view/Motion/WebHome
===================

To use this you will need motion setup and it's database logging setup.
http://www.lavrsen.dk/foswiki/bin/view/Motion/MotionGuideSpecialFeatures#Using_Databases

Basically you need to create a database for motion. All the examples to create the table that I found were broken so here is mine:

CREATE TABLE `security` (
  `camera` int(11) DEFAULT NULL,
  `filename` char(80) NOT NULL,
  `frame` int(11) DEFAULT NULL,
  `file_type` int(11) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_time_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9739 DEFAULT CHARSET=latin1

Then make sure your motion.conf file has your database credentials and you have the sql_query field enabled. Make sure the motion webcontrol_html_output configuration is set to off. In older versions of motion this will be called control_html_output. You can leave the (web)control_localhost directive on, only switch it to off if you are interested in using the motion http api remotely. Motionweb hits the motion http api locally.

Remember that motionweb is a web app. So make sure you have this checked out to the appropriate location for web serving. Set your document root to the root directory of this repo. Alloy will handle mapping of things to the app/www directory for file assets.

You will also want to set the target_dir to either app/www/captured/ for a single camera or app/www/capture/[cam#]/. Motionweb is designed to check the filename that was logged and try to guess the right http url using the directory structure i just described. Note that if you really want you can symlink motionweb's directory structure to where ever you want. The functionality should still work(check permissions so the your web user can delete files in the destination directory).

Once this is setup correctly you should start seeing entries in the security table and still/movie files in the capture directory when motion is detected.

The last major step is to configure the motionweb app to find your motion database. You will find the config file in app/config/app.php with $app['database']['master'] being the only relevant configuration. Only host/username/password/database fields are used.

You should new be able to load the motionweb app in your browser!

