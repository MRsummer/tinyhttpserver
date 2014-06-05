package com.httpserver.test;

import com.httpserver.conf.Conf;
import com.httpserver.conf.ConfManager;
import com.httpserver.conf.Server;

public class TestConf {
	public static void main(String arg[]){
		try {
			Conf conf = ConfManager.getInstance().getConf();
			for(int i=0;i < conf.getServers().size();i++){
				Server server = conf.getServers().get(i);
				System.out.println(server.getServerName());
				System.out.println(server.getServerPort());
				System.out.println(server.getServerRoot());
			}
			System.out.println(conf.getAccessLogPath());
			System.out.println(conf.getErrorLogPath());
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		
	}
}
