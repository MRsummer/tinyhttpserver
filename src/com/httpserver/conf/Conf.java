package com.httpserver.conf;

public class Conf {

	/**
	 * server's name
	 */
	private String serverName;
	
	/**
	 * server's tcp port
	 */
	private int serverPort;
	
	/**
	 * path of the access log 
	 */
	private String accessLogPath;
	
	/**
	 * path of the error log
	 */
	private String errorLogPath;
	
	/**
	 * server root file path
	 */
	private String serverRoot;
	
	/**
	 * server version
	 * @return version string
	 */
	private String serverVersion = "1.0";
	
	public String getServerVersion() {
		return serverVersion;
	}

	public void setServerVersion(String serverVersion) {
		this.serverVersion = serverVersion;
	}

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

	public String getAccessLogPath() {
		return accessLogPath;
	}

	public void setAccessLogPath(String accessLogPath) {
		this.accessLogPath = accessLogPath;
	}

	public String getErrorLogPath() {
		return errorLogPath;
	}

	public void setErrorLogPath(String errorLogPath) {
		this.errorLogPath = errorLogPath;
	}

	public String getServerRoot() {
		return serverRoot;
	}

	public void setServerRoot(String serverRoot) {
		this.serverRoot = serverRoot;
	}

}
