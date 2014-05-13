package com.httpserver.test;

import com.httpserver.logger.Logger;

public class TestLog {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		Logger.getLogger().logError("an test error");

	}

}
