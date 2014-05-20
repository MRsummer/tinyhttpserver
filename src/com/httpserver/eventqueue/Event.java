package com.httpserver.eventqueue;

import java.net.Socket;

public class Event {
	/**
	 * event type
	 */
	private int eventType = -1;
	
	/**
	 * event socket (generally , an event is related with a socket)
	 */
	private Socket socket = null;
	
	/**
	 * something else
	 */
	private Object extra = null;

	/**
	 * read client socket
	 */
	public static final int TYPE_READ_CLIENT = 1;
	
	/**
	 * write client socket
	 */
	public static final int TYPE_WRITE_CIENT = 2;
	
	/**
	 * read fast cgi socket
	 */
	public static final int TYPE_READ_FCGI = 3;
	
	/**
	 * write fast cgi socket
	 */
	public static final int TYPE_WRITE_FCGI = 4;
	
	/**
	 * constructor
	 * @param type  the type of event to handle
	 * @param sock	the socket of the event
	 * @param eh  	the handler of the event
	 * @param obj	extra object
	 */
	public Event(int type, Socket sock, Object obj){
		this.eventType = type;
		this.socket = sock;
		this.extra = obj;
	}

	public int getEventType() {
		return eventType;
	}
	public void setEventType(int eventType) {
		this.eventType = eventType;
	}
	public Socket getSocket() {
		return socket;
	}
	public void setSocket(Socket socket) {
		this.socket = socket;
	}
	public Object getExtra() {
		return extra;
	}
	public void setExtra(Object extra) {
		this.extra = extra;
	}
	
}
