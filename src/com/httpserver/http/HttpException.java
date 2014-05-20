package com.httpserver.http;

public class HttpException extends Exception {
	
	private static final long serialVersionUID = 3164270024014404548L;
	
	private final int statusCode;

	public HttpException(int statusCode) {
		this.statusCode = statusCode;
	}

	public int getCode() {
		return statusCode;
	}

	public String getErrorPage() {
		final StringBuffer page = new StringBuffer(120);
		page.append("<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\"");
		page.append("<HTML><BODY><H1 ALIGN=CENTER>Error ");
		page.append(statusCode);
		page.append("   ");
		page.append(Http.getStatusStr(statusCode));
		page.append("</H1></BODY></HTML>");
		return page.toString();
	}

}
