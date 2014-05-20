package com.httpserver.core;

import com.httpserver.conf.Conf;
import com.httpserver.conf.ConfManager;
import com.httpserver.eventqueue.EventDispatcherThread;
import com.httpserver.socket.ServerSocketThread;

public class Core {
	
	/**
	 * configure object
	 */
	private Conf mConf = null;
	
	/**
	 * server thread (will be used to stop the server)
	 */
	private ServerSocketThread serverSocketThread = null;
	
	/**
	 * dispatcher thread (will be used to stop the server)
	 */
	private EventDispatcherThread dispatcherThread = null;
	
	/**
	 * start the server
	 */
	public void start(){
		//get the configure path from command line and set configure path
		mConf = getConf(); 
		
		//start server socket thread
		serverSocketThread = new ServerSocketThread(mConf.getServerPort());
		serverSocketThread.start();
		
		//start event dispatcher thread
		dispatcherThread = new EventDispatcherThread();
		dispatcherThread.start();
		
	}
	
	/**
	 * stop the server
	 */
	public void stop(){
		serverSocketThread.stopServerThread();
		dispatcherThread.stopDispatcherThread();
	}
	
	/**
	 * get the configure from the xml file
	 * @return  the conf object
	 */
	private Conf getConf(){
//		OptionParser optionParser = new OptionParser();
//		OptionSet optionSet = optionParser.parse("-c");
//		if(optionSet.hasArgument("-c")){
//			String filePath =  (String)optionSet.valueOf("c");
//			ConfManager.setConfPath(filePath);
//		}
		return ConfManager.getInstance().getConf();
	}

}
