package com.httpserver.test;


public class TestUri {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
//		URI uri = null;
//		try {
//			uri = new URI("index.php?c=5&b=4");
//			System.out.println(uri.getPath());
//			System.out.println(uri.getHost());
//			System.out.println(uri.getQuery());
//		} catch (URISyntaxException e) {
//			e.printStackTrace();
//		}
		
		int port = 80;
		String host = "1227.0.0.1:8000";
		int index = host.indexOf(":");
		if(index < 0){
			port = 80;
		}else{
			String p = host.substring(index+1);
			port = Integer.parseInt(p);
		}
		System.out.println(port);
	}

}
