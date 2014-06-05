package com.httpserver.http;

import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.Socket;
import java.util.Date;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Map.Entry;

import com.httpserver.conf.ConfManager;

public class HttpResponse {
	
	/**
	 * response socket
	 */
	private Socket socket = null;
	
	/**
	 * output stream
	 */
	private OutputStream out = null;
	
	/**
	 * the stream writer of the socket
	 */
	private OutputStreamWriter writer = null;
	
	/**
	 * http status code
	 */
	private int responseCode = 200;
	
	/**
	 * constructor
	 * @throws IOException
	 */
	public HttpResponse(Socket socket) throws IOException{
		this.socket = socket;
		out = socket.getOutputStream();
		writer = new OutputStreamWriter(new BufferedOutputStream(out));
	}
	
	/**
	 * set the http response code
	 * @param code  status code
	 */
	public void setResponseCode(int code){
		responseCode = code;
	}
	
	public int getResponseCode(){
		return responseCode;
	}
	
	public OutputStream getOutputStream(){
		return out;
	}
	
	/**
	 * send http status
	 * @param code
	 * @throws IOException
	 */
	public void sendStatus() throws IOException {
		final StringBuffer status = new StringBuffer(16);
		status.append("HTTP/1.1 ");
		status.append(responseCode);
		status.append(" ");
		status.append(Http.getStatusStr(responseCode));
		status.append("\r\n");
		writer.write(status.toString());
	}
	
	/**
	 * finish http headers
	 * @throws IOException
	 */
	public void finishHeaders() throws IOException {
		writer.write("\r\n");
		writer.flush();
	}
	
	/**
	 * finish http response
	 * @throws IOException
	 */
	public void finishResponse() throws IOException {
		writer.flush();
		socket.close();
	}
	
	/**
	 * write a http header
	 * @param header  the http header
	 * @throws IOException
	 */
	private void sendHeaderEntry(String header) throws IOException {
		writer.write(header);
		if (!header.endsWith("\r\n")) {
			writer.write("\r\n");
		}
	}
	
	/**
	 * set the basic headers
	 * @throws IOException
	 */
	public void sendBasicHeaders() throws IOException {
		sendHeaderEntry("Date: " + Http.formatDate(new Date()));
		sendHeaderEntry("Server: " + ConfManager.getInstance().getConf().getServerVersion());
		sendHeaderEntry("Connection: close");
	}
	
	/**
	 * send all the headers
	 * 	//sendHeaderEntry("Content-Length: " + request.getRequestFile().length());
	 *	//sendHeaderEntry("Last-Modified: " + Http.formatDate(new Date(request.getRequestFile().lastModified())));
	 *	//sendHeaderEntry("Content-Type: " + request.getMimeType());
	 */
	public void sendHeaders() {
		try {
			Iterator<Entry<String, String>> iter = headerMap.entrySet().iterator(); 
			while (iter.hasNext()) { 
			    Map.Entry<String,String> entry = (Map.Entry<String,String>) iter.next(); 
			    sendHeaderEntry(entry.getKey() + ": "+entry.getValue());
			} 
		} catch (final IOException e) {
			e.printStackTrace();
		}
	}
	
	/**
	 * http header map
	 */
	private HashMap<String,String> headerMap = new HashMap<String, String>();
	
	/**
	 * set the http header
	 * @param headerName
	 * @param headerContent
	 */
	public void setHeader(String headerName, String headerContent){
		headerMap.put(headerName, headerContent);
	}
	
	/**
	 * send a file to client
	 * @param filePath  file path
	 * @throws IOException   socket error
	 */
	public void sendFile(String filePath) throws IOException{
		System.out.println("send file called");
		//send http response status
		sendStatus();
		//send the common headers
		sendBasicHeaders();
		//send your own headers defined in header map
		sendHeaders();
		//finish headers
		finishHeaders();
		//send file
		File file = new File(filePath);
		char[] chars = new char[4096];
		int readNum = 0;
		BufferedReader reader = new BufferedReader(new InputStreamReader(new FileInputStream(file)));
		while( (readNum = reader.read(chars)) != -1){
			writer.write(chars, 0, readNum);
		}
		reader.close();
		//finish response
		finishResponse();
	}
	
	/**
	 * send a text string (generated dynamically)
	 * @param text  the text to send
	 * @throws IOException 
	 */
	public void sendText(String text) throws IOException{
		//send http response status
		sendStatus();
		//send the common headers
		sendBasicHeaders();
		//send your own headers defined in header map
		sendHeaders();
		//finish headers
		finishHeaders();
		//send text
		writer.write(text);
		//finish response
		finishResponse();
	}
	
	public void sendVoid() throws IOException{
		sendStatus();
		sendBasicHeaders();
		sendHeaders();
		finishHeaders();
		finishResponse();
	}
	
	
	
}
