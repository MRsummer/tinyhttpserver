package com.httpserver.http;

import java.io.BufferedInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.Reader;
import java.net.Socket;
import java.util.HashMap;
import java.util.StringTokenizer;

public class HttpRequest {
	/**
	 * http methods (some methods are not supported in this server)
	 */
	private static final int METHOD_GET = 1;
	private static final int METHOD_POST = 2;
	//private static final int METHOD_HEAD = 3;
	//private static final int METHOD_PUT = 4;
	//private static final int METHOD_DELETE = 5;
	//private static final int METHOD_TRACE = 6;
	
	/**
	 * http version enumeration
	 */
	public static final int HTTP_1_0 = 1;
	public static final int HTTP_1_1 = 2;
	
	/**
	 * buffer size of the read buffer
	 */
	private static final int BUFFER_SIZE = 4096;
	
	/**
	 * header length (length of the first request line)
	 */
	private static final int HEADER_LENGTH = 20;
	
	/**
	 * client socket
	 */
	private Socket socket;
	
	/**
	 * request method
	 */
	private int method;
	
	/**
	 * request uri
	 */
	private String uri;
	
	/**
	 * http version (1.0 or 1.1)
	 */
	private int httpVersion;
	
	/**
	 * http headers
	 */
	private HashMap<String, String> header = new HashMap<String, String>();
	
	//private String formData;
	
	//private HashMap<String,String> postFields;
	
	/**
	 * constructor
	 * @param client  the client socket
	 * @throws IOException  when socket error occurred
	 * @throws HttpException  when http error occurred
	 */
	public HttpRequest(Socket client) throws IOException, HttpException{
		//get input stream reader of the socket 
		socket = client;
		BufferedInputStream in = new BufferedInputStream(socket.getInputStream(), BUFFER_SIZE);
		InputStreamReader input = new InputStreamReader(in, "ASCII");
		boolean enterBody = false;
		
		//get the first line of header
		parseHeader(input);
		
		//get header and body information
		while(! streamEnd){
			
			System.out.println("start read");
			String line = readLine(input, false);
			System.out.println("read end");
			
			//comes to the end of the header of the request
			if(line.equals("")){
				enterBody = true;
				break;//TODO come to the end of the header
			}
			
			//comes to the body of the request
			if(enterBody){
				//read body data
				
			}else{
				//get headers
				final int split = line.indexOf(':');
				if (split == -1) continue;
				header.put(line.substring(0, split), line.substring(split));
			}
			
			System.out.println(line+"<<<");
		}
		
		System.out.println("read over");
	}
	
	/**
	 * read the socket and parse the http header information
	 * @param input   the input stream reader
	 * @throws IOException  when socket error occurred
	 * @throws HttpException  when an http error is occurred
	 */
	private void parseHeader(InputStreamReader input) throws IOException, HttpException{
		String firstLine = readLine(input, false);
		StringTokenizer st = new StringTokenizer(firstLine);
		
		String method = "";
		String uri = "";
		String httpVersion = "";
		try{
			method = st.nextToken().toUpperCase();
			uri = st.nextToken();
			httpVersion = st.nextToken().toUpperCase();
		}catch(Exception e){
			throw new HttpException(400);//invalid http request
		}
		
		if(method.equals("GET")){
			this.method = METHOD_GET; 
			this.methodStr = "GET";
		}else if(method.equals("POST")){
			this.method = METHOD_POST;
			this.methodStr = "POST";
		}else{
			throw new HttpException(405);//unsupported http method
		}
		
		this.uri = uri;
		
		if(httpVersion.equals("HTTP/1.0")){
			this.httpVersion = HTTP_1_0;
		}else if(httpVersion.equals("HTTP/1.1")){
			this.httpVersion = HTTP_1_1;
		}else{
			throw new HttpException(505);//bad http version
		}
	}
	
	/**
	 * method string presentation
	 */
	private String methodStr = null;
	
	/**
	 * return method string
	 */
	public String getMethodStr(){
		return this.methodStr;
	}
	
	/**
	 * stream has reached the end
	 */
	private boolean streamEnd = false;
	
	/**
	 * read a line of the stream
	 * @param r  stream reader
	 * @param multiLine  multiple line
	 * @return   the string
	 * @throws IOException
	 */
	private String readLine(Reader r, boolean multiLine) throws IOException {
		final StringBuffer buffer = new StringBuffer(HEADER_LENGTH);
		while (true) {
			final char c = (char) r.read();
			if (c == '\r') {
				continue;
			} else if (c == '\n') {
				if (buffer.length() == 0 && multiLine) {
					continue;
				} else {
					return buffer.toString();
				}
			} else if (c == -1) {
				streamEnd = true;
				return buffer.toString();
			} else {
				buffer.append(c);
			}
		}
	}
	
	/**
	 * get the http method
	 * @return  http method (int)
	 */
	public int getMethod(){
		return this.method;
	}
	
	/**
	 * get the request uri
	 * @return
	 */
	public String getUri(){
		return this.uri;
	}
	
	/**
	 * get http version
	 * @return  http version (int)
	 */
	public int getHttpVersion(){
		return this.httpVersion;
	}
	
	/**
	 * get the remote ip address
	 * @return the remote ip address
	 */
	public String getHostAddress(){
		return socket.getInetAddress().getHostAddress();
	}
	
	/**
	 * get the remote port number
	 * @return  the remote port number
	 */
	public int getPort(){
		return socket.getPort();
	}

}
