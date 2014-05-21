package com.httpserver.eventhandler;

import java.io.File;
import java.io.IOException;

import com.httpserver.conf.Conf;
import com.httpserver.conf.ConfManager;
import com.httpserver.eventqueue.Event;
import com.httpserver.http.HttpException;
import com.httpserver.http.HttpRequest;
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
	public void handleEvent() {
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
			addWriteFcgiEvent(filePath, httpRequest);
			return;
		}
		
		//get a static file
		addSendFileEvent(filePath);
		
	}

}
