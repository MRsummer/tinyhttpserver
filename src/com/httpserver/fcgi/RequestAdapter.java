/*
 * (c) 2009-2012 Julien Rialland, and the jFastCGI project developers.
 * Released under BSD License, see LICENSE_JRIALLAND.txt
 */
/*
 Copyright (c) 2013 - the jFastCGI project developers.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
*/
package com.httpserver.fcgi;

import java.io.IOException;
import java.io.InputStream;
import java.util.HashMap;

/**
 * part of the portlet / servlet request interface used by FastCGIHandler. Allows to use the same code
 * for both portlet and servlet environment.
 *
 * @author jrialland
 */
public interface RequestAdapter {

    public InputStream getInputStream() throws IOException;

    public String getRequestURI();

    public String getMethod();

    public String getServerName();

    public int getServerPort();

    public String getRemoteAddr();

    public String getRemoteUser();

    public String getAuthType();

    public String getProtocol();

    public String getQueryString();

    public String getServletPath();

    public String getRealPath(String relPath);

    public String getContextPath();

    public int getContentLength();

    public HashMap<String, String> getHeaderNames();

    public String getHeader(String key);

	public String getBody();
}
