#!/bin/bash
	#index
	INDEX=0

	#run with test data
    	while [ 1 ] ; do

		#get test out data
		INDEX=`expr $INDEX + 1`
		TEST_IN=`cat in | sed -n $INDEX"p"`
		TEST_OUT=`cat out | sed -n $INDEX"p"`
		#echo "test out : $TEST_OUT"

		if [ "$TEST_IN" = "" ];then
			break
		fi

		echo $TEST_IN"--->"$TEST_OUT

	done

