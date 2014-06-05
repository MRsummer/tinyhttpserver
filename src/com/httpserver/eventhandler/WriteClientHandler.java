package com.httpserver.eventhandler;

import java.io.IOException;

import com.httpserver.eventqueue.Event;
import com.httpserver.http.HttpException;
import com.httpserver.http.HttpResponse;
import com.httpserver.http.Intent;
import com.httpserver.logger.Logger;

public class WriteClientHandler extends EventHandler{

	public WriteClientHandler(Event event) {
		super(event);
	}

	@Override
	public void handleEvent() {
		//judge the event type
		Intent intent = (Intent)event.getExtra();
		switch(intent.getType()){
		case Intent.TYPE_HTTP_EXCEPTION:
			int statusCode = (Integer)intent.getExtra("exceptioncode");
			String data = (String)intent.getExtra("data");
			try {
				HttpResponse response = new HttpResponse(socket);
				
				//some special status to handle
				if(statusCode == 302){
					//redirect
					response.setResponseCode(302);
					response.setHeader("Location", data);
					response.sendVoid();
				}else if(statusCode == 304){
					//not modified
					
				}else{
					response.sendText(new HttpException(statusCode).getErrorPage());
				}
				
			} catch (IOException e2) {
				Logger.getLogger().logError("send http exception error : "+e2.toString());
			}
			break;
			
		case Intent.TYPE_LIST_DIRECTORY:
			break;
			
		case Intent.TYPE_SEND_FILE:
			String filePath = (String)intent.getExtra("filePath");
			try {
				HttpResponse response2 = new HttpResponse(socket);
				response2.sendFile(filePath);
			} catch (IOException e) {
				Logger.getLogger().logError("send file error : "+e.toString());
				try {
					socket.close();
				} catch (IOException e1) {
					Logger.getLogger().logError("socket close error : "+e1.toString());
				}
			}
			break;
		}
	}

}
