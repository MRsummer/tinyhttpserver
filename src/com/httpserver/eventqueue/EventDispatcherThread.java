package com.httpserver.eventqueue;

import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

import com.httpserver.eventhandler.ReadClientHandler;
import com.httpserver.eventhandler.ReadFcgiHandler;
import com.httpserver.eventhandler.WriteClientHandler;
import com.httpserver.eventhandler.WriteFcgiHandler;
import com.httpserver.logger.Logger;

public class EventDispatcherThread extends Thread{
	
	private EventQueue eventQueue = null;

	ExecutorService executorService = null;
	
	private final int MAX_HANDLER_THREAD_NUM = 20;
	
	public EventDispatcherThread(){
		eventQueue = EventQueue.getInstance();
		executorService = Executors.newFixedThreadPool(MAX_HANDLER_THREAD_NUM);
	}
	
	/**
	 * the status of the dispatcher thread
	 */
	private boolean running = true;
	
	/**
	 * stop dispatcher thread
	 */
	public void stopDispatcherThread(){
		running = false;
		//wait for all the threads to finish 
		executorService.shutdown();
	}
	
	@Override
	public void run(){
		while(running){
			
			//get event
			Event event = eventQueue.getEvent();
			int eventType = event.getEventType();
			
			//dispatch event
			switch(eventType){
			case Event.TYPE_READ_CLIENT:
				executorService.execute(new ReadClientHandler(event));
				break;
				
			case Event.TYPE_WRITE_CIENT:
				executorService.execute(new WriteClientHandler(event));
				break;
				
			case Event.TYPE_READ_FCGI:
				executorService.execute(new ReadFcgiHandler(event));
				break;
				
			case Event.TYPE_WRITE_FCGI:
				executorService.execute(new WriteFcgiHandler(event));
				break;
				
			default:
				Logger.getLogger().logError("wrong event type : "+eventType);
			}
			
		}
	}
	
}
