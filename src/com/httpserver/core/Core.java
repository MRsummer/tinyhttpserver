package com.httpserver.core;

import java.util.Vector;

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
	private Vector<ServerSocketThread> serverSocketThreads = null;
	
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
		serverSocketThreads = new Vector<ServerSocketThread>();
		for(int i=0;i < mConf.getServers().size();i++){
			ServerSocketThread serverSocketThread = new ServerSocketThread(mConf.getServers().get(i).getServerPort());
			serverSocketThreads.add(serverSocketThread);
			serverSocketThread.start();
		}
		
		//start event dispatcher thread
		dispatcherThread = new EventDispatcherThread();
		dispatcherThread.start();
		
	}
	
	/**
	 * stop the server
	 */
	public void stop(){
		for(int i=0;i < serverSocketThreads.size();i++){
			serverSocketThreads.get(i).stopServerThread();
		}
		dispatcherThread.stopDispatcherThread();
	}
	
	/**
	 * get the configure from the xml file
	 * @return  the conf object
	 */
	private Conf getConf(){
		return ConfManager.getInstance().getConf();
	}

}
