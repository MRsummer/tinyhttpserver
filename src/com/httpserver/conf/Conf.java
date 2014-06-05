package com.httpserver.conf;

import java.util.Vector;

public class Conf {
	
	/**
	 * servers
	 */
	private Vector<Server> servers = new Vector<Server>();
	
	/**
	 * path of the access log 
	 */
	private String accessLogPath;
	
	/**
	 * path of the error log
	 */
	private String errorLogPath;
	
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
	
	public void addServer(Server server){
		servers.add(server);
	}
	
	public Vector<Server> getServers(){
		return servers;
	}
	
	public Server getServerByPort(int port){
		for(int i=0;i < servers.size();i ++){
			if(servers.get(i).getServerPort() == port) return servers.get(i);
		}
		return null;
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
	
}
