#!/bin/bash

if [ $# -ne 1 ];then 
	echo "Usage : $0 start|stop|restart|status"
fi

DIR="/Users/zhuguangwen/Work/java/tinyhttpserver"

start() {
	cd $DIR"/bin"
	java com/httpserver/core/Black $DIR"/server.conf.xml" > /dev/null &
	cd -
	echo "finish start !"
}

stop() {
	PID="`ps -ef|grep [B]lack| awk -F ' ' '{print $2}'`"
	kill $PID
	echo "finish stop !"
}

status() {
	echo "`ps -ef|grep [B]lack`"	
}

case "$1" in
    start)
	start
	;;
    stop)
        stop
	;;
    restart)
    	stop
	start
	;;
    status)
    	status
	;;
esac
