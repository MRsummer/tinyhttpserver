package com.httpserver.eventhandler;

import java.io.IOException;
import java.io.InputStream;
import java.util.Enumeration;

import com.httpserver.conf.ConfManager;
import com.httpserver.eventqueue.Event;
import com.httpserver.fcgi.FastCGIHandler;
import com.httpserver.fcgi.RequestAdapter;
import com.httpserver.fcgi.SingleConnectionFactory;
import com.httpserver.http.HttpRequest;
import com.httpserver.http.Intent;
import com.httpserver.logger.Logger;

public class WriteFcgiHandler extends EventHandler{

	public WriteFcgiHandler(Event event) {
		super(event);
	}

	@Override
	public void handleEvent() {
		final Intent intent = (Intent)extra;
		final HttpRequest request = (HttpRequest)intent.getExtra("httprequest");
		
		RequestAdapter fcgiRequest = new RequestAdapter(){

			@Override
			public String getBody(){
				return request.getBody();
			}
			
			@Override
			public InputStream getInputStream() throws IOException {
//				return socket.getInputStream();
				return null;
			}
			
			@Override
			public String getRequestURI() {
				return request.getUri();
			}

			@Override
			public String getMethod() {
				return request.getMethodStr();
			}

			@Override
			public String getServerName() {
				return ConfManager.getInstance().getConf().getServerName();
			}

			@Override
			public int getServerPort() {
				return ConfManager.getInstance().getConf().getServerPort();
			}

			@Override
			public String getRemoteAddr() {
				return request.getHostAddress();
			}

			@Override
			public String getRemoteUser() {
				return "tinyjavahttpd";
			}

			@Override
			public String getAuthType() {
				return null;
			}

			@Override
			public String getProtocol() {
				return request.getHttpVersion() == HttpRequest.HTTP_1_0 ? "HTTP/1.0" : "HTTP/1.1";
			}

			@Override
			public String getQueryString() {
				return request.getQueryString();
			}

			@Override
			public String getServletPath() {
				return (String)intent.getExtra("scriptpath");
			}

			@Override
			public String getRealPath(String relPath) {
				return relPath;
			}

			@Override
			public String getContextPath() {
				return "";
			}

			@Override
			public int getContentLength() {
				return request.getContentLength();
//				return 0;
			}

			@Override
			public Enumeration<String> getHeaderNames() {
				return new Enumeration<String>(){
					@Override
					public boolean hasMoreElements() {
						return false;
					}
					@Override
					public String nextElement() {
						return null;
					}
				};
			}

			@Override
			public String getHeader(String key) {
				return null;
			}};
			
		FastCGIHandler fcgiHandler = new FastCGIHandler();
		fcgiHandler.setConnectionFactory(new SingleConnectionFactory("127.0.0.1:9000"));//get from configure file
		try {
			fcgiHandler.sendRequest(fcgiRequest);
			
			//write fcgi ok , add read fcgi event
			addReadFcgiEvent(fcgiHandler);
			
		} catch (IOException e) {
			Logger.getLogger().logError("error on fcgi handler : "+e.toString());
		}
	}

}
