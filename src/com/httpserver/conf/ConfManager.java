package com.httpserver.conf;

import java.io.File;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;

public class ConfManager {

	/**
	 * the path of the configure file, server.conf.xml is the default path
	 */
	private static String confFilePath = "server.conf.xml";
	
	/**
	 * conf manager instance
	 */
	private static ConfManager mConfManagerInstance = null;
	
	/**
	 * set conf file path (call on server start)
	 */
	public static void setConfPath(String path){
		confFilePath = path;
	}
	
	/**
	 * get the configure instance
	 * @return the configure instance
	 * @throws Exception 
	 */
	public Conf getConf(){
		return mConf;
	}
	
	/**
	 * conf manager constructor
	 */
	private ConfManager(){
		initConf();
	}
		
	/**
	 * get instance
	 */
	public static ConfManager getInstance(){
		if(mConfManagerInstance == null){
			mConfManagerInstance = new ConfManager();
		}
		return mConfManagerInstance;
	}
	
	/**
	 * configure instance
	 */
	private static Conf mConf = null;
	
	/**
	 * read the configure file, parse xml , and turn the file into properties
	 * @throws Exception 
	 */
	private static void initConf(){
		try{
			//instance conf
			Conf conf = new Conf();
			
			//get the configure file content
			DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
			DocumentBuilder db = dbf.newDocumentBuilder();
			Document doc = db.parse(confFilePath);
			
			//parse xml file and get properties
			NodeList config = doc.getElementsByTagName("config");
			Element server = (Element) config.item(0);
			
			NodeList serverList = server.getElementsByTagName("server");
			for(int i=0;i < serverList.getLength();i++){
				Element serverInstance = (Element)serverList.item(i);
				String serverName = serverInstance.getElementsByTagName("name").item(0).getFirstChild().getNodeValue();
				String serverPort = serverInstance.getElementsByTagName("port").item(0).getFirstChild().getNodeValue();
				String serverRoot = serverInstance.getElementsByTagName("root").item(0).getFirstChild().getNodeValue();
				//check file and directory access
				File serverRootDir = new File(serverRoot);
				if(!( serverRootDir.isDirectory() && serverRootDir.isAbsolute() && serverRootDir.exists() )){
					throw new Exception("server root not found, server root must be an absolute directory : "+serverRoot);
				}
				
				//add server instance to conf
				Server s = new Server();
				s.setServerName(serverName);
				s.setServerPort(Integer.valueOf(serverPort));
				s.setServerRoot(serverRoot);
				conf.addServer(s);
				
			}
			
			String accessLog = server.getElementsByTagName("accesslog").item(0).getFirstChild().getNodeValue();
			String errorLog = server.getElementsByTagName("errorlog").item(0).getFirstChild().getNodeValue();
			
			File accessLogFile = new File(accessLog);
			File errorLogFile = new File(errorLog);
			if(! accessLogFile.exists()){
				throw new Exception("accesslog is not found : "+accessLog);
			}
			if(! errorLogFile.exists()){
				throw new Exception("errorlog is not found : "+errorLog);
			}
			
			conf.setAccessLogPath(accessLog);
			conf.setErrorLogPath(errorLog);
			mConf = conf;
		}catch(Exception e){
			//print the error and exit the program
			e.printStackTrace();
			System.exit(1);
		}finally{
			System.out.println("conf file ok");
		}
	}
	
}
