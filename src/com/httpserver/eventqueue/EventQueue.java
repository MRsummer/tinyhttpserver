package com.httpserver.eventqueue;

import java.util.concurrent.LinkedBlockingQueue;

import com.httpserver.logger.Logger;

public class EventQueue {
	
	/**
	 * the max size of event queue
	 */
	private static final int QUEUE_MAX_SIZE = 1000;
	
	/**
	 * event queue (thread safe)
	 */
	private LinkedBlockingQueue<Event> eventQueue = null;
	
	/**
	 * private constructor
	 */
	private EventQueue(){
		eventQueue = new LinkedBlockingQueue<Event>(QUEUE_MAX_SIZE);
	}
	
	/**
	 * static instance of the event queue (singleton)
	 */
	private static EventQueue mInstance = null;
	
	/**
	 * get event queue instance 
	 * @return  event queue instance
	 */
	public static EventQueue getInstance(){
		if(mInstance == null){
				mInstance = new EventQueue();
		}
		return mInstance;
	}
	
	/**
	 * add an event to event queue (blocking method)
	 */
	public void addEvent(Event event){
		try {
			eventQueue.put(event);
		} catch (InterruptedException e) {
			Logger.getLogger().logError("thread interrupted : "+e.toString());
		}
	}
	
	/**
	 * consume the event (blocking method)
	 */
	public Event getEvent(){
		Event event = null;
		try {
			event = eventQueue.take();
		} catch (InterruptedException e) {
			Logger.getLogger().logError("thread interrupted : "+e.toString());
		}
		return event;
	}
}

