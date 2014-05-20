package com.httpserver.http;

import java.util.HashMap;

public class Intent {
	/**
	 * intent type enumeration
	 */
	public static final int TYPE_HTTP_EXCEPTION = 1;
	public static final int TYPE_LIST_DIRECTORY = 2;
	public static final int TYPE_SEND_FILE = 3;
	
	/**
	 * intent type
	 */
	private int type = -1;
	
	/**
	 * intent data
	 */
	private HashMap<String, Object> extraMap = null;
	
	/**
	 * get intent type
	 * @return intent type
	 */
	public int getType() {
		return type;
	}
	
	/**
	 * set intent type
	 * @param type
	 */
	public void setType(int type) {
		this.type = type;
	}

	/**
	 * put extra data
	 * @param key  data key
	 * @param value  data value
	 */
	public void putExtra(String key, Object value){
		if(extraMap == null) extraMap = new HashMap<String, Object>();
		extraMap.put(key, value);
	}
	
	/**
	 * get extra data
	 * @param key  data key
	 * @return
	 */
	public Object getExtra(String key){
		if(extraMap == null) return null;
		return extraMap.get(key);
	}
	
}
