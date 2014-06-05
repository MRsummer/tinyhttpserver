#!/bin/bash

#this file is to check whether a c program is right
#there are test data and gcc compiler

#compiler
COMPILER="gcc"

#program must take 4 params
if [ $# -ne 4 ];then
	#echo "usage : $0 dir cfile testinfile testoutfile";
	exit 4;
fi

#file dir
DIR="$1"

#program file
C_FILE="$1$2"

#test in file
TEST_IN_FILE="$1$3"

#test out file
TEST_OUT_FILE="$1$4"

#compile out 
COMPILE_OUT="$1""compile_out"

#compile err
COMPILE_ERR="$1""compile_err"

#run err
RUN_ERR="$1""run_err"

#runnable
RUN="$1""run"

#status file
STATUS="$1""status"

#logic err
LOGIC_ERR="$1""logic_err"

#first call gcc compiler to compile the program
$COMPILER $C_FILE -o $RUN 1>$COMPILE_OUT 2>$COMPILE_ERR

#run the binary executable file with test data
if [ -f $RUN ]; then

	#index
	INDEX=0

	#run with test data
    	while [ 1 ] ; do

		#get test out data
		INDEX=`expr $INDEX + 1`
		TEST_IN=`cat $TEST_IN_FILE | sed -n $INDEX"p"`
		TEST_OUT=`cat $TEST_OUT_FILE | sed -n $INDEX"p"`
		#echo "test out : $TEST_OUT"

		if [ "$TEST_IN" = "" ];then
			break
		fi

		#get program out data
		PROGRAM_OUT="` echo $TEST_IN | $RUN 2>$RUN_ERR`"
		#echo "program out : $PROGRAM_OUT"
		
		#judge if error exists
		RUN_ERR_DATA=`cat $RUN_ERR`
		if [ "$RUN_ERR_DATA" != "" ]; then
			#run error
			#echo "run error"
			echo "2" > $STATUS
			exit 2
		fi
		
		#judge result 
		if [ "$PROGRAM_OUT" != "$TEST_OUT" ];then
			#proram logic error
			#echo "test error"
			echo "输入："$TEST_IN"<br>" >> $LOGIC_ERR
			echo "实际输出："$PROGRAM_OUT"<br>" >> $LOGIC_ERR
			echo "期望输出："$TEST_OUT"<br>" >> $LOGIC_ERR
			echo "3" > $STATUS
			exit 3
		fi

    	done

	#exit normaly
	#echo "test ok !!!";
	echo "0" > $STATUS
	exit 0
else
	#complile error
	echo "1" > $STATUS
	exit 1
fi
