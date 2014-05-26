package com.httpserver.test;

import java.io.File;

public class TestFile {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		String fileName = "/home/hehe/aaa.txt";
		int index = fileName.lastIndexOf("/");
		String dirPath = fileName.substring(0, index);
		String shortFilePath = fileName.substring(index+1);
		System.out.println(dirPath);
		System.out.println(shortFilePath);
		
		File dir = new File(dirPath);
		if(! dir.exists()) dir.mkdirs();
		new File(dir, shortFilePath);

	}

}
