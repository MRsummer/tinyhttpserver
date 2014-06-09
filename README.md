Black
==============

this is a http server written in java
and i call it Black

#Features : 
1. static file serving
2. get and post method
3. common http status code
4. fastCGI
5. virtual host based on port
6. access log and error log
7. configuration
8. shell scripts management

#Performance : 
              static file serving |  script file serving(using php-fpm)
       nginx         15000        |          9000
       Black         2300         |          1200

#Install : 
1. make sure you have the java environment 
2. download the source code from github
3. modify the configuration file server.conf.xml
   set the server directory and log file , notice that you
   must create the log file first and make sure they have 
   the right access. 
4. make sure your web site file is in the right directory
   that you have configured
5. modify the script script/server.sh , change the DIR 
   variable to your own dir, and the run 
   <code>./server.sh start</code>
   to start your server


#Why choose Black : 
<br> if you want to build a high performance web site , obviously,
  Black is not what you want. but Black is suitable for two use :

1. embeded in android apps
<br>  cause Black is light-weight , and has totally 3000+ lines of 
   code , and can serve relatively fast and stable. so if your 
   android app needs a small server on it, Black will be ok.
2. study the priciple of http server
<br>  the original purpose of me to write this server is to study 
   the priciple of web server , so if you have just the same 
   purpose with me , Black wont let you down .
   


