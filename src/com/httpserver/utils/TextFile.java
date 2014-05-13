package com.httpserver.utils;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.IOException;

public class TextFile {
	
	private String path;
	private File file;
	
	public TextFile(String p){
		path = p;
		file = new File(path);
	}
		
	public String getContent() throws IOException{
		BufferedReader reader = new BufferedReader(new FileReader(file));
		String content = "";
		String line = reader.readLine();
		while(line != null){
			content += line;
			line = reader.readLine();
		}
		reader.close();
		return content;
	}
	
}
