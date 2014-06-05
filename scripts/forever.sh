#!/bin/bash

SERVER_NAME="Black"

PROCESS="`ps -ef | grep $SERVER_NAME | grep -v grep`"

if [ "$PROCESS" = "" ];then
	/Users/zhuguangwen/Work/java/tinyhttpserver/scripts/server.sh start
fi
