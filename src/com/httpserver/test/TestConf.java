package com.httpserver.test;

import com.httpserver.conf.Conf;
import com.httpserver.conf.ConfManager;

public class TestConf {
	public static void main(String arg[]){
		try {
			Conf conf = ConfManager.getInstance().getConf();
			System.out.println(conf.getServerName());
			System.out.println(conf.getServerPort());
			System.out.println(conf.getServerRoot());
			System.out.println(conf.getAccessLogPath());
			System.out.println(conf.getErrorLogPath());
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		
	}
}
