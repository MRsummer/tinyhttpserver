package com.httpserver.logger;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Date;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

import com.httpserver.conf.ConfManager;
import com.httpserver.http.HttpRequest;

public class Logger {

	private final PrintWriter errorLog;
	private final PrintWriter accessLog;
	private ExecutorService service = null;

	private Logger() {
		final File eLog = new File(ConfManager.getInstance().getConf().getErrorLogPath());
		final File aLog = new File(ConfManager.getInstance().getConf().getAccessLogPath());
		service = Executors.newSingleThreadExecutor();
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
	public void logAccess(HttpRequest request) {
		final StringBuffer msg = new StringBuffer();
		msg.append(" [");
		msg.append(new Date().toString());
		msg.append("] \n ");
		
		msg.append(request.getRemoteAddress());
		msg.append("\n");
		
		msg.append(request.getHost());
		msg.append("\n");
		
		msg.append(request.getUri());
		msg.append("\n");
		
		service.submit(new Runnable(){
			@Override
			public void run() {
				accessLog.println(msg.toString());
			}
		});
	}
	
	/**
	 * log the error of the server
	 */
	public void logError(final String message){
		service.submit(new Runnable(){
			@Override
			public void run() {
				errorLog.println(new Date().toString() + ": [" + message + "]");
			}
		});
	}

}

