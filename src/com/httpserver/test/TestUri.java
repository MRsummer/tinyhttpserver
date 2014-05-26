package com.httpserver.test;

import java.net.URI;
import java.net.URISyntaxException;

public class TestUri {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		URI uri = null;
		try {
			uri = new URI("index.php?c=5&b=4");
			System.out.println(uri.getPath());
			System.out.println(uri.getHost());
			System.out.println(uri.getQuery());
		} catch (URISyntaxException e) {
			e.printStackTrace();
		}
	}

}
