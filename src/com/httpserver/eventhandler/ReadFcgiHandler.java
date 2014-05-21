package com.httpserver.eventhandler;

import java.io.IOException;
import java.io.OutputStream;

import com.httpserver.eventqueue.Event;
import com.httpserver.fcgi.FastCGIHandler;
import com.httpserver.fcgi.ResponseAdapter;
import com.httpserver.http.HttpResponse;
import com.httpserver.http.Intent;
import com.httpserver.logger.Logger;

public class ReadFcgiHandler extends EventHandler{

	public ReadFcgiHandler(Event event) {
		super(event);
	}

	@Override
	public void handleEvent() {
		Intent intent = (Intent)extra;
		FastCGIHandler fcgiHandler = (FastCGIHandler)intent.getExtra("fcgihandler");
		
		try {
			final HttpResponse httpResponse = new HttpResponse(socket);
			
			ResponseAdapter response = new ResponseAdapter(){

				@Override
				public void sendError(int errorCode) {
					addHttpExceptionEvent(errorCode);
				}

				@Override
				public void sendRedirect(String targetUrl) {
					addHttpExceptionEvent(302);
				}
				
				@Override
				public void setStatus(int statusCode) throws IOException {
					httpResponse.setResponseCode(statusCode);
				}

				@Override
				public void addHeader(String key, String value) {
					//httpResponse.setHeader(key, value);
				}
				
				@Override
				public void onFinishHeader() throws IOException{
					httpResponse.sendStatus();
					httpResponse.sendBasicHeaders();
					httpResponse.sendHeaders();
					httpResponse.finishHeaders();
				}

				@Override
				public OutputStream getOutputStream() {
					return httpResponse.getOutputStream();
				}

				@Override
				public void onWriteFinish() throws IOException {
					httpResponse.finishResponse();
				}
			};
			
			fcgiHandler.getResponse(response);
			
		} catch (IOException e) {
			Logger.getLogger().logError("read fcgi error : "+e.toString());
		}
		
	}


}
