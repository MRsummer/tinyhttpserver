package com.httpserver.logger;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Date;

import com.httpserver.conf.ConfManager;

public class Logger {

	private final PrintWriter errorLog;
	private final PrintWriter accessLog;

	private Logger() {
		final File eLog = new File(ConfManager.getConf().getErrorLogPath());
		final File aLog = new File(ConfManager.getConf().getAccessLogPath());
		try {
			errorLog = openLog(eLog);
			accessLog = openLog(aLog);
		} catch (final IOException e) {
			throw new RuntimeException(e.getMessage());
		}
	}
	
	/**
	 * get the print writer of a file
	 * @param logFile  the log file
	 * @return  the print writer
	 * @throws IOException
	 */
	private static PrintWriter openLog(File logFile) throws IOException {
		if (!logFile.exists()) {
			// create the directory tree, create the log file
			logFile.getParentFile().mkdirs();
			logFile.createNewFile();
		}
		// append to existing files, enable autoFlush
		final FileWriter log = new FileWriter(logFile.toString(), true);
		return new PrintWriter(log, true);
	}
	
	/**
	 * factory method : get logger instance
	 */
	private static Logger mInstance = null;
	public static Logger getLogger(){
		if(mInstance == null){
			mInstance = new Logger();
		}
		return mInstance;
	}

	/**
	 * Log a record of the transaction with the client. 
	 */
	/*
	public void logAccess(CommonLogMessage log) {
		final StringBuffer msg = new StringBuffer();
		msg.append(log.getRemoteHost());
		msg.append(" ");
		msg.append(log.getRemoteLogName());
		msg.append(" ");
		msg.append(log.getUserName());
		msg.append(" [");
		msg.append(log.getDate());
		msg.append("] \"");
		msg.append(log.getRawRequest());
		msg.append("\" ");
		msg.append(log.getStatusCode());
		msg.append(" ");
		msg.append(log.getBytesSent());

		accessLog.println(msg.toString());
	}
	*/
	
	/**
	 * log the error of the server
	 */
	public void logError(String message){
		errorLog.println(new Date().toString() + ": [" + message + "]");
	}

}

