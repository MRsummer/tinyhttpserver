package com.httpserver.conf;

public class Server{
	/**
	 * server's name
	 */
	private String serverName;
	
	/**
	 * server's tcp port
	 */
	private int serverPort;
	
	/**
	 * server root file path
	 */
	private String serverRoot;
	
	public String getServerName() {
		return serverName;
	}

	public void setServerName(String serverName) {
		this.serverName = serverName;
	}

	public int getServerPort() {
		return serverPort;
	}

	public void setServerPort(int serverPort) {
		this.serverPort = serverPort;
	}
	
	public String getServerRoot() {
		return serverRoot;
	}

	public void setServerRoot(String serverRoot) {
		this.serverRoot = serverRoot;
	}

}

