package com.httpserver.http;

import java.io.BufferedInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.Reader;
import java.net.Socket;
import java.net.URI;
import java.net.URISyntaxException;
import java.util.HashMap;
import java.util.StringTokenizer;

import com.httpserver.logger.Logger;

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
	private String uri = null;
	
	/**
	 * request query string
	 */
	private String queryString = null;
	
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
		
		//get the first line of header
		parseHeader(input);
		
		//get header and body information
		while(! streamEnd){
			
			System.out.println("start read");
			String line = readLine(input, false);
			System.out.println();
			System.out.println("read end");
			
			//comes to the end of the header of the request
			if(line.trim().equals("")){
				//comes to the body of the request
				if(getContentLength() > 0){
					readBody(input);
				}
				break;//come to the end of the header
			}
			
			//get headers
			final int split = line.indexOf(':');
			if (split == -1) continue;
			header.put(line.substring(0, split), line.substring(split+2));
			
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
		String uriStr = "";
		String httpVersion = "";
		try{
			method = st.nextToken().toUpperCase();
			uriStr = st.nextToken();
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
		
		try {
			URI uri = new URI(uriStr);
			this.uri = uri.getPath();//get uri path
			this.queryString = uri.getQuery();//get query string
		} catch (URISyntaxException e) {
			Logger.getLogger().logError("error on new uri : "+e.toString());
		}
		
		if(httpVersion.equals("HTTP/1.0")){
			this.httpVersion = HTTP_1_0;
		}else if(httpVersion.equals("HTTP/1.1")){
			this.httpVersion = HTTP_1_1;
		}else{
			throw new HttpException(505);//bad http version
		}
	}
	
	/**
	 * request body
	 */
	private String body = null;
	
	/**
	 * get body  (write fcgi)
	 */
	public String getBody(){
		return body;
	}
	
	/**
	 * read the body of the http request
	 * @param r  stream reader
	 * @throws IOException  occurred when socket comes to an error
	 */
	private void readBody(Reader r) throws IOException{
		int length = getContentLength();
		if(length == 0) return;
		char[] bytes = new char[length];
		r.read(bytes);
		body = new String(bytes);
		System.out.println("body-->"+body);
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
	 * get request body length
	 * @return  the length of request body
	 */
	public int getContentLength(){
		if(header.get("Content-Length") != null){
			return Integer.parseInt(header.get("Content-Length").trim());
		}else if(header.get("content-length") != null){
			return Integer.parseInt(header.get("content-length").trim());
		}else{
			return 0;
		}
	}
	
	/**
	 * get the http request host (host is a must)
	 * @return the request host
	 */
	public String getHost(){
		if(header.get("Host") != null){
			return header.get("Host").trim();
		}else{
			return "localhost";
		}
	}
	
	/**
	 * get the port in the host
	 * @return the request server port
	 */
	public int getHostPort(){
		String host = getHost();
		int index = host.indexOf(":");
		if(index < 0){
			return 80;
		}else{
			String port = host.substring(index+1);
			return Integer.parseInt(port);
		}
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
		System.out.println("start read line");
		while (true) {
			final char c = (char) r.read();
			System.out.print(c);
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
	 * @return  the request uri like "/index.php"
	 */
	public String getUri(){
		return this.uri;
	}
	
	/**
	 * get query string
	 * @return  the query string like "a=4&b=5"
	 */
	public String getQueryString(){
		return this.queryString;
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
	public String getRemoteAddress(){
		return socket.getInetAddress().getHostAddress();
	}
	
	/**
	 * get the remote port number
	 * @return  the remote port number
	 */
	public int getRemotePort(){
		return socket.getPort();
	}
	
	/**
	 * get the http request headers
	 * @return  http request headers
	 */
	public HashMap<String, String> getHeaders(){
		return header;
	}

}
