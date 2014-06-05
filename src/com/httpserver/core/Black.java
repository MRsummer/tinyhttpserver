package com.httpserver.core;

import java.io.File;

import com.httpserver.conf.ConfManager;

public class Black{

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		//set configure path
		if(args.length > 0) {
			File file = new File(args[0]);
			if(! file.exists()){
				System.out.println("config file " + args[0] + " not found");
				System.exit(1);
			}
			ConfManager.setConfPath(args[0]);
		}
		
		//start server
		Core core = new Core();
		core.start();
	}

}
