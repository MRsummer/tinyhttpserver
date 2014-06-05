package com.httpserver.eventhandler;

import java.net.Socket;

import com.httpserver.eventqueue.Event;
import com.httpserver.eventqueue.EventQueue;
import com.httpserver.fcgi.FastCGIHandler;
import com.httpserver.http.HttpRequest;
import com.httpserver.http.Intent;

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
		this.eventType = event.getEventType();
		this.socket = event.getSocket();
		this.extra = event.getExtra();
	}
	
	/**
	 * an event handler must be able to handle an event
	 * @param event
	 */
	public abstract void handleEvent();
	
	@Override
	public void run(){
		handleEvent();
	}
	
	/**
	 * add http exception event
	 * @param statusCode  http status
	 */
	protected void addHttpExceptionEvent(int statusCode, String data){
		Intent intent = new Intent();
		intent.setType(Intent.TYPE_HTTP_EXCEPTION);
		intent.putExtra("exceptioncode", statusCode);
		intent.putExtra("data", data);
		Event writeEvent = new Event(Event.TYPE_WRITE_CIENT, socket, intent);
		EventQueue.getInstance().addEvent(writeEvent);
	}
	protected void addHttpExceptionEvent(int statusCode){
		addHttpExceptionEvent(statusCode, "");
	}
	
	/**
	 * add list directory event 
	 * @param dirPath  the directory to show
	 */
	protected void addListDirectoryEvent(String dirPath){
		Intent intent = new Intent();
		intent.setType(Intent.TYPE_LIST_DIRECTORY);
		intent.putExtra("dirPath", dirPath);
		Event listDirEvent = new Event(Event.TYPE_WRITE_CIENT, socket, intent);
		EventQueue.getInstance().addEvent(listDirEvent);
	}
	
	/**
	 * add send file event
	 * @param filePath   the file to send
	 */
	protected void addSendFileEvent(String filePath){
		Intent intent = new Intent();
		intent.setType(Intent.TYPE_SEND_FILE);
		intent.putExtra("filePath", filePath);
		Event sendFileEvent = new Event(Event.TYPE_WRITE_CIENT, socket, intent);
		EventQueue.getInstance().addEvent(sendFileEvent);
	}
	
	/**
	 * add request fast cgi event
	 * @param filePath  the cgi script file path
	 */
	protected void addWriteFcgiEvent(String filePath, HttpRequest httpRequest){
		Intent intent = new Intent();
		intent.setType(Intent.TYPE_WRITE_FCGI);
		intent.putExtra("httprequest", httpRequest);
		intent.putExtra("scriptpath", filePath);
		Event requestFcgiEvent = new Event(Event.TYPE_WRITE_FCGI, socket, intent);
		EventQueue.getInstance().addEvent(requestFcgiEvent);
	}
	
	/**
	 * add read fcgi event
	 * @param fcgiHandler
	 */
	protected void addReadFcgiEvent(FastCGIHandler fcgiHandler){
		Intent readFcigIntent = new Intent();
		readFcigIntent.setType(Intent.TYPE_READ_FCGI);
		readFcigIntent.putExtra("fcgihandler", fcgiHandler);
		Event event = new Event(Event.TYPE_READ_FCGI, socket, readFcigIntent);
		EventQueue.getInstance().addEvent(event);
	}
	
}
