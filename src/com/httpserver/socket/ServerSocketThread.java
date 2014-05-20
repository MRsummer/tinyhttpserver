package com.httpserver.socket;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;

import com.httpserver.eventqueue.Event;
import com.httpserver.eventqueue.EventQueue;
import com.httpserver.logger.Logger;

public class ServerSocketThread extends Thread {
	/**
	 * server socket port number
	 */
	private int mPort = 80;
	
	/**
	 * server socket
	 */
	private ServerSocket serverSocket = null;
	
	/**
	 * constructor
	 */
	public ServerSocketThread(int port){
		mPort = port; 
	}
	
	/**
	 * running status of the thread
	 */
	private boolean running = true;
	
	/**
	 * stop the server thread
	 */
	public void stopServerThread(){
		running = false;
	}
	
	@Override 
	public void run(){
		try {
			bindPort();
		} catch (IOException e) {
			System.out.println("server bind error : "+e.toString());
			System.exit(1);
		}
		while(running){
			//accept connection
			Socket socket = acceptConnection();
			//create read event
			Event event = new Event(Event.TYPE_READ_CLIENT, socket, null);
			//add event to event queue
			EventQueue.getInstance().addEvent(event);
		}
	}
	
	/**
	 * bind server socket
	 * @throws IOException 
	 */
	private void bindPort() throws IOException{
		serverSocket = new ServerSocket(mPort);
	}
	
	/**
	 * accept a connection request
	 */
	private Socket acceptConnection(){
		Socket conn = null;
		try {
			conn = serverSocket.accept();
		} catch (IOException e) {
			Logger.getLogger().logError("accept error :"+e.toString());
		}
		return conn;
	}
	
	
}
