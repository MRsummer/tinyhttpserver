package com.httpserver.eventhandler;

import java.net.Socket;

import com.httpserver.eventqueue.Event;

public abstract class EventHandler implements Runnable{
	
	protected int eventType = -1;
	protected Socket socket = null;
	protected Object extra = null;
	protected Event event = null;
	
	/**
	 * constructor
	 * @param event  the event to handle
	 */
	public EventHandler(Event event){
		this.event = event;
	}
	
	/**
	 * an event handler must be able to handle an event
	 * @param event
	 */
	public void handleEvent(Event event){
		eventType = event.getEventType();
		socket = event.getSocket();
		extra = event.getExtra();
	}
	
}
