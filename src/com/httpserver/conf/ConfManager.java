package com.httpserver.conf;

import java.io.File;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;

public class ConfManager {

	/**
	 * the path of the configure file, server.conf is the default path
	 */
	private static String confFilePath = "server.conf.xml";
	
	/**
	 * configure instance
	 */
	private static Conf mConfInstance = null;
	
	/**
	 * conf class constructor, read the configure file, parse xml , and turn the file into properties
	 * @throws Exception 
	 */
	private static void initConf(){
		try{
			//get the configure file content
			DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
			DocumentBuilder db = dbf.newDocumentBuilder();
			Document doc = db.parse(confFilePath);
			
			//parse xml file and get properties
			NodeList serverList = doc.getElementsByTagName("server");
			Element server = (Element) serverList.item(0);
			String serverName = server.getElementsByTagName("name").item(0).getFirstChild().getNodeValue();
			String serverPort = server.getElementsByTagName("port").item(0).getFirstChild().getNodeValue();
			String serverRoot = server.getElementsByTagName("root").item(0).getFirstChild().getNodeValue();
			String accessLog = server.getElementsByTagName("accesslog").item(0).getFirstChild().getNodeValue();
			String errorLog = server.getElementsByTagName("errorlog").item(0).getFirstChild().getNodeValue();
			
			//check file and directory access
			File serverRootDir = new File(serverRoot);
			File accessLogFile = new File(accessLog);
			File errorLogFile = new File(errorLog);
			if(!( serverRootDir.isDirectory() && serverRootDir.isAbsolute() && serverRootDir.exists() )){
				throw new Exception("server root not found, server root must be an absolute directory : "+serverRoot);
			}
			if(! accessLogFile.exists()){
				throw new Exception("accesslog is not found : "+accessLog);
			}
			if(! errorLogFile.exists()){
				throw new Exception("errorlog is not found : "+errorLog);
			}
			
			//instance conf
			Conf conf = new Conf();
			conf.setServerName(serverName);
			conf.setServerPort(Integer.valueOf(serverPort));
			conf.setServerRoot(serverRoot);
			conf.setAccessLogPath(accessLog);
			conf.setErrorLogPath(errorLog);
			mConfInstance = conf;
		}catch(Exception e){
			
			//print the error and exit the program
			e.printStackTrace();
			System.exit(1);
		}finally{
			System.out.println("conf file ok");
		}
	}
	
	/**
	 * set the configure file path
	 * @param path  configure file path
	 */
	public static void setConfPath(String path){
		confFilePath = path;
	}
	
	/**
	 * get the configure instance
	 * @return the configure instance
	 * @throws Exception 
	 */
	public static Conf getConf(){
		if(mConfInstance == null){
			initConf();
		}
		return mConfInstance;
	}
	
}
