package com.httpserver.eventhandler;

import java.io.File;
import java.io.IOException;

import com.httpserver.conf.Conf;
import com.httpserver.conf.ConfManager;
import com.httpserver.eventqueue.Event;
import com.httpserver.eventqueue.EventQueue;
import com.httpserver.http.HttpException;
import com.httpserver.http.HttpRequest;
import com.httpserver.http.Intent;
import com.httpserver.logger.Logger;

public class ReadClientHandler extends EventHandler{

	private HttpRequest httpRequest = null;
	
	public ReadClientHandler(Event event) {
		super(event);
	}
	
	/**
	 * handle the event
	 */
	@Override
	public void handleEvent(Event event) {
		super.handleEvent(event);
		try {
			httpRequest = new HttpRequest(socket);
			
		} catch (IOException e) {
			//io exception occurred, socket error
			Logger.getLogger().logError("read client handler, handler event error : "+e.toString());
			return;
			
		} catch (HttpException e) {
			//http exception occurred
			addHttpExceptionEvent(e.getCode());
			return;
			
		}
		
		//get the absolute filepath
		String uri = httpRequest.getUri();
		Conf conf = ConfManager.getInstance().getConf();
		String serverRoot = conf.getServerRoot();
		String filePath = serverRoot.endsWith("/") ? serverRoot.substring(0, -1) : serverRoot;
		
		//check path is ok
		if(!uri.startsWith("/")){
			addHttpExceptionEvent(404);//the uri is not found
			return;
		}
		filePath += uri;
		
		//check file exists
		File file = new File(filePath);
		if(!file.exists()){
			addHttpExceptionEvent(404);//the uri is not found
			return;
		}
		
		//check is directory
		if(file.isDirectory()){
			//list directory
			addListDirectoryEvent(filePath);
			return;
		}
		
		//check is script
		if(filePath.endsWith(".php")){
			//execute script
			return;
		}
		
		//get a static file
		addSendFileEvent(filePath);
		
	}
	
	/**
	 * add http exception event
	 * @param statusCode  http status
	 */
	private void addHttpExceptionEvent(int statusCode){
		Intent intent = new Intent();
		intent.setType(Intent.TYPE_HTTP_EXCEPTION);
		intent.putExtra("exceptioncode", statusCode);
		Event writeEvent = new Event(Event.TYPE_WRITE_CIENT, socket, intent);
		EventQueue.getInstance().addEvent(writeEvent);
	}
	
	/**
	 * add list directory event 
	 * @param dirPath  the directory to show
	 */
	private void addListDirectoryEvent(String dirPath){
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
	private void addSendFileEvent(String filePath){
		Intent intent = new Intent();
		intent.setType(Intent.TYPE_SEND_FILE);
		intent.putExtra("filePath", filePath);
		Event sendFileEvent = new Event(Event.TYPE_WRITE_CIENT, socket, intent);
		EventQueue.getInstance().addEvent(sendFileEvent);
	}
	
	@Override
	public void run() {
		handleEvent(event);
	}

}