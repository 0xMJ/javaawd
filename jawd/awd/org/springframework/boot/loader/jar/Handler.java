/*     */ package org.springframework.boot.loader.jar;
/*     */ 
/*     */ import java.io.File;
/*     */ import java.io.IOException;
/*     */ import java.io.InputStream;
/*     */ import java.io.PrintStream;
/*     */ import java.lang.ref.SoftReference;
/*     */ import java.lang.reflect.Constructor;
/*     */ import java.net.MalformedURLException;
/*     */ import java.net.URI;
/*     */ import java.net.URL;
/*     */ import java.net.URLConnection;
/*     */ import java.net.URLStreamHandler;
/*     */ import java.util.Map;
/*     */ import java.util.concurrent.ConcurrentHashMap;
/*     */ import java.util.logging.Level;
/*     */ import java.util.logging.Logger;
/*     */ import java.util.regex.Matcher;
/*     */ import java.util.regex.Pattern;
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ public class Handler
/*     */   extends URLStreamHandler
/*     */ {
/*     */   private static final String JAR_PROTOCOL = "jar:";
/*     */   private static final String FILE_PROTOCOL = "file:";
/*     */   private static final String TOMCAT_WARFILE_PROTOCOL = "war:file:";
/*     */   private static final String SEPARATOR = "!/";
/*  54 */   private static final Pattern SEPARATOR_PATTERN = Pattern.compile("!/", 16);
/*     */   
/*     */   private static final String CURRENT_DIR = "/./";
/*     */   
/*  58 */   private static final Pattern CURRENT_DIR_PATTERN = Pattern.compile("/./", 16);
/*     */   
/*     */   private static final String PARENT_DIR = "/../";
/*     */   
/*     */   private static final String PROTOCOL_HANDLER = "java.protocol.handler.pkgs";
/*     */   
/*  64 */   private static final String[] FALLBACK_HANDLERS = { "sun.net.www.protocol.jar.Handler" };
/*     */   
/*     */ 
/*     */ 
/*     */   private static URL jarContextUrl;
/*     */   
/*     */ 
/*  71 */   private static SoftReference<Map<File, JarFile>> rootFileCache = new SoftReference(null);
/*     */   
/*     */   private final JarFile jarFile;
/*     */   
/*     */   private URLStreamHandler fallbackHandler;
/*     */   
/*     */   public Handler()
/*     */   {
/*  79 */     this(null);
/*     */   }
/*     */   
/*     */   public Handler(JarFile jarFile) {
/*  83 */     this.jarFile = jarFile;
/*     */   }
/*     */   
/*     */   protected URLConnection openConnection(URL url) throws IOException
/*     */   {
/*  88 */     if ((this.jarFile != null) && (isUrlInJarFile(url, this.jarFile))) {
/*  89 */       return JarURLConnection.get(url, this.jarFile);
/*     */     }
/*     */     try {
/*  92 */       return JarURLConnection.get(url, getRootJarFileFromUrl(url));
/*     */     }
/*     */     catch (Exception ex) {
/*  95 */       return openFallbackConnection(url, ex);
/*     */     }
/*     */   }
/*     */   
/*     */   private boolean isUrlInJarFile(URL url, JarFile jarFile) throws MalformedURLException
/*     */   {
/* 101 */     return (url.getPath().startsWith(jarFile.getUrl().getPath())) && 
/* 102 */       (url.toString().startsWith(jarFile.getUrlString()));
/*     */   }
/*     */   
/*     */   private URLConnection openFallbackConnection(URL url, Exception reason) throws IOException {
/*     */     try {
/* 107 */       URLConnection connection = openFallbackTomcatConnection(url);
/* 108 */       connection = connection != null ? connection : openFallbackContextConnection(url);
/* 109 */       return connection != null ? connection : openFallbackHandlerConnection(url);
/*     */     }
/*     */     catch (Exception ex) {
/* 112 */       if ((reason instanceof IOException)) {
/* 113 */         log(false, "Unable to open fallback handler", ex);
/* 114 */         throw ((IOException)reason);
/*     */       }
/* 116 */       log(true, "Unable to open fallback handler", ex);
/* 117 */       if ((reason instanceof RuntimeException)) {
/* 118 */         throw ((RuntimeException)reason);
/*     */       }
/* 120 */       throw new IllegalStateException(reason);
/*     */     }
/*     */   }
/*     */   
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */   private URLConnection openFallbackTomcatConnection(URL url)
/*     */   {
/* 133 */     String file = url.getFile();
/* 134 */     if (isTomcatWarUrl(file)) {
/* 135 */       file = file.substring("war:file:".length());
/* 136 */       file = file.replaceFirst("\\*/", "!/");
/*     */       try {
/* 138 */         URLConnection connection = openConnection(new URL("jar:file:" + file));
/* 139 */         connection.getInputStream().close();
/* 140 */         return connection;
/*     */       }
/*     */       catch (IOException localIOException) {}
/*     */     }
/*     */     
/* 145 */     return null;
/*     */   }
/*     */   
/*     */   private boolean isTomcatWarUrl(String file) {
/* 149 */     if ((file.startsWith("war:file:")) || (!file.contains("*/"))) {
/*     */       try {
/* 151 */         URLConnection connection = new URL(file).openConnection();
/* 152 */         if (connection.getClass().getName().startsWith("org.apache.catalina")) {
/* 153 */           return true;
/*     */         }
/*     */       }
/*     */       catch (Exception localException) {}
/*     */     }
/*     */     
/* 159 */     return false;
/*     */   }
/*     */   
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */   private URLConnection openFallbackContextConnection(URL url)
/*     */   {
/*     */     try
/*     */     {
/* 172 */       if (jarContextUrl != null) {
/* 173 */         return new URL(jarContextUrl, url.toExternalForm()).openConnection();
/*     */       }
/*     */     }
/*     */     catch (Exception localException) {}
/*     */     
/* 178 */     return null;
/*     */   }
/*     */   
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */   private URLConnection openFallbackHandlerConnection(URL url)
/*     */     throws Exception
/*     */   {
/* 189 */     URLStreamHandler fallbackHandler = getFallbackHandler();
/* 190 */     return new URL(null, url.toExternalForm(), fallbackHandler).openConnection();
/*     */   }
/*     */   
/*     */   private URLStreamHandler getFallbackHandler() {
/* 194 */     if (this.fallbackHandler != null) {
/* 195 */       return this.fallbackHandler;
/*     */     }
/* 197 */     for (String handlerClassName : FALLBACK_HANDLERS) {
/*     */       try {
/* 199 */         Class<?> handlerClass = Class.forName(handlerClassName);
/* 200 */         this.fallbackHandler = ((URLStreamHandler)handlerClass.getDeclaredConstructor(new Class[0]).newInstance(new Object[0]));
/* 201 */         return this.fallbackHandler;
/*     */       }
/*     */       catch (Exception localException) {}
/*     */     }
/*     */     
/*     */ 
/* 207 */     throw new IllegalStateException("Unable to find fallback handler");
/*     */   }
/*     */   
/*     */   private void log(boolean warning, String message, Exception cause) {
/*     */     try {
/* 212 */       Level level = warning ? Level.WARNING : Level.FINEST;
/* 213 */       Logger.getLogger(getClass().getName()).log(level, message, cause);
/*     */     }
/*     */     catch (Exception ex) {
/* 216 */       if (warning) {
/* 217 */         System.err.println("WARNING: " + message);
/*     */       }
/*     */     }
/*     */   }
/*     */   
/*     */   protected void parseURL(URL context, String spec, int start, int limit)
/*     */   {
/* 224 */     if (spec.regionMatches(true, 0, "jar:", 0, "jar:".length())) {
/* 225 */       setFile(context, getFileFromSpec(spec.substring(start, limit)));
/*     */     }
/*     */     else {
/* 228 */       setFile(context, getFileFromContext(context, spec.substring(start, limit)));
/*     */     }
/*     */   }
/*     */   
/*     */   private String getFileFromSpec(String spec) {
/* 233 */     int separatorIndex = spec.lastIndexOf("!/");
/* 234 */     if (separatorIndex == -1) {
/* 235 */       throw new IllegalArgumentException("No !/ in spec '" + spec + "'");
/*     */     }
/*     */     try {
/* 238 */       new URL(spec.substring(0, separatorIndex));
/* 239 */       return spec;
/*     */     }
/*     */     catch (MalformedURLException ex) {
/* 242 */       throw new IllegalArgumentException("Invalid spec URL '" + spec + "'", ex);
/*     */     }
/*     */   }
/*     */   
/*     */   private String getFileFromContext(URL context, String spec) {
/* 247 */     String file = context.getFile();
/* 248 */     if (spec.startsWith("/")) {
/* 249 */       return trimToJarRoot(file) + "!/" + spec.substring(1);
/*     */     }
/* 251 */     if (file.endsWith("/")) {
/* 252 */       return file + spec;
/*     */     }
/* 254 */     int lastSlashIndex = file.lastIndexOf('/');
/* 255 */     if (lastSlashIndex == -1) {
/* 256 */       throw new IllegalArgumentException("No / found in context URL's file '" + file + "'");
/*     */     }
/* 258 */     return file.substring(0, lastSlashIndex + 1) + spec;
/*     */   }
/*     */   
/*     */   private String trimToJarRoot(String file) {
/* 262 */     int lastSeparatorIndex = file.lastIndexOf("!/");
/* 263 */     if (lastSeparatorIndex == -1) {
/* 264 */       throw new IllegalArgumentException("No !/ found in context URL's file '" + file + "'");
/*     */     }
/* 266 */     return file.substring(0, lastSeparatorIndex);
/*     */   }
/*     */   
/*     */   private void setFile(URL context, String file) {
/* 270 */     String path = normalize(file);
/* 271 */     String query = null;
/* 272 */     int queryIndex = path.lastIndexOf('?');
/* 273 */     if (queryIndex != -1) {
/* 274 */       query = path.substring(queryIndex + 1);
/* 275 */       path = path.substring(0, queryIndex);
/*     */     }
/* 277 */     setURL(context, "jar:", null, -1, null, null, path, query, context.getRef());
/*     */   }
/*     */   
/*     */   private String normalize(String file) {
/* 281 */     if ((!file.contains("/./")) && (!file.contains("/../"))) {
/* 282 */       return file;
/*     */     }
/* 284 */     int afterLastSeparatorIndex = file.lastIndexOf("!/") + "!/".length();
/* 285 */     String afterSeparator = file.substring(afterLastSeparatorIndex);
/* 286 */     afterSeparator = replaceParentDir(afterSeparator);
/* 287 */     afterSeparator = replaceCurrentDir(afterSeparator);
/* 288 */     return file.substring(0, afterLastSeparatorIndex) + afterSeparator;
/*     */   }
/*     */   
/*     */   private String replaceParentDir(String file) {
/*     */     int parentDirIndex;
/* 293 */     while ((parentDirIndex = file.indexOf("/../")) >= 0) {
/* 294 */       int precedingSlashIndex = file.lastIndexOf('/', parentDirIndex - 1);
/* 295 */       if (precedingSlashIndex >= 0) {
/* 296 */         file = file.substring(0, precedingSlashIndex) + file.substring(parentDirIndex + 3);
/*     */       }
/*     */       else {
/* 299 */         file = file.substring(parentDirIndex + 4);
/*     */       }
/*     */     }
/* 302 */     return file;
/*     */   }
/*     */   
/*     */   private String replaceCurrentDir(String file) {
/* 306 */     return CURRENT_DIR_PATTERN.matcher(file).replaceAll("/");
/*     */   }
/*     */   
/*     */   protected int hashCode(URL u)
/*     */   {
/* 311 */     return hashCode(u.getProtocol(), u.getFile());
/*     */   }
/*     */   
/*     */   private int hashCode(String protocol, String file) {
/* 315 */     int result = protocol != null ? protocol.hashCode() : 0;
/* 316 */     int separatorIndex = file.indexOf("!/");
/* 317 */     if (separatorIndex == -1) {
/* 318 */       return result + file.hashCode();
/*     */     }
/* 320 */     String source = file.substring(0, separatorIndex);
/* 321 */     String entry = canonicalize(file.substring(separatorIndex + 2));
/*     */     try {
/* 323 */       result += new URL(source).hashCode();
/*     */     }
/*     */     catch (MalformedURLException ex) {
/* 326 */       result += source.hashCode();
/*     */     }
/* 328 */     result += entry.hashCode();
/* 329 */     return result;
/*     */   }
/*     */   
/*     */   protected boolean sameFile(URL u1, URL u2)
/*     */   {
/* 334 */     if ((!u1.getProtocol().equals("jar")) || (!u2.getProtocol().equals("jar"))) {
/* 335 */       return false;
/*     */     }
/* 337 */     int separator1 = u1.getFile().indexOf("!/");
/* 338 */     int separator2 = u2.getFile().indexOf("!/");
/* 339 */     if ((separator1 == -1) || (separator2 == -1)) {
/* 340 */       return super.sameFile(u1, u2);
/*     */     }
/* 342 */     String nested1 = u1.getFile().substring(separator1 + "!/".length());
/* 343 */     String nested2 = u2.getFile().substring(separator2 + "!/".length());
/* 344 */     if (!nested1.equals(nested2)) {
/* 345 */       String canonical1 = canonicalize(nested1);
/* 346 */       String canonical2 = canonicalize(nested2);
/* 347 */       if (!canonical1.equals(canonical2)) {
/* 348 */         return false;
/*     */       }
/*     */     }
/* 351 */     String root1 = u1.getFile().substring(0, separator1);
/* 352 */     String root2 = u2.getFile().substring(0, separator2);
/*     */     try {
/* 354 */       return super.sameFile(new URL(root1), new URL(root2));
/*     */     }
/*     */     catch (MalformedURLException localMalformedURLException) {}
/*     */     
/*     */ 
/* 359 */     return super.sameFile(u1, u2);
/*     */   }
/*     */   
/*     */   private String canonicalize(String path) {
/* 363 */     return SEPARATOR_PATTERN.matcher(path).replaceAll("/");
/*     */   }
/*     */   
/*     */   public JarFile getRootJarFileFromUrl(URL url) throws IOException {
/* 367 */     String spec = url.getFile();
/* 368 */     int separatorIndex = spec.indexOf("!/");
/* 369 */     if (separatorIndex == -1) {
/* 370 */       throw new MalformedURLException("Jar URL does not contain !/ separator");
/*     */     }
/* 372 */     String name = spec.substring(0, separatorIndex);
/* 373 */     return getRootJarFile(name);
/*     */   }
/*     */   
/*     */   private JarFile getRootJarFile(String name) throws IOException {
/*     */     try {
/* 378 */       if (!name.startsWith("file:")) {
/* 379 */         throw new IllegalStateException("Not a file URL");
/*     */       }
/* 381 */       File file = new File(URI.create(name));
/* 382 */       Map<File, JarFile> cache = (Map)rootFileCache.get();
/* 383 */       JarFile result = cache != null ? (JarFile)cache.get(file) : null;
/* 384 */       if (result == null) {
/* 385 */         result = new JarFile(file);
/* 386 */         addToRootFileCache(file, result);
/*     */       }
/* 388 */       return result;
/*     */     }
/*     */     catch (Exception ex) {
/* 391 */       throw new IOException("Unable to open root Jar file '" + name + "'", ex);
/*     */     }
/*     */   }
/*     */   
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */   static void addToRootFileCache(File sourceFile, JarFile jarFile)
/*     */   {
/* 401 */     Map<File, JarFile> cache = (Map)rootFileCache.get();
/* 402 */     if (cache == null) {
/* 403 */       cache = new ConcurrentHashMap();
/* 404 */       rootFileCache = new SoftReference(cache);
/*     */     }
/* 406 */     cache.put(sourceFile, jarFile);
/*     */   }
/*     */   
/*     */   /* Error */
/*     */   static void captureJarContextUrl()
/*     */   {
/*     */     // Byte code:
/*     */     //   0: invokestatic 133	org/springframework/boot/loader/jar/Handler:canResetCachedUrlHandlers	()Z
/*     */     //   3: ifeq +103 -> 106
/*     */     //   6: ldc -122
/*     */     //   8: ldc -121
/*     */     //   10: invokestatic 136	java/lang/System:getProperty	(Ljava/lang/String;Ljava/lang/String;)Ljava/lang/String;
/*     */     //   13: astore_0
/*     */     //   14: ldc -122
/*     */     //   16: invokestatic 137	java/lang/System:clearProperty	(Ljava/lang/String;)Ljava/lang/String;
/*     */     //   19: pop
/*     */     //   20: invokestatic 138	org/springframework/boot/loader/jar/Handler:resetCachedUrlHandlers	()V
/*     */     //   23: new 32	java/net/URL
/*     */     //   26: dup
/*     */     //   27: ldc -117
/*     */     //   29: invokespecial 38	java/net/URL:<init>	(Ljava/lang/String;)V
/*     */     //   32: putstatic 48	org/springframework/boot/loader/jar/Handler:jarContextUrl	Ljava/net/URL;
/*     */     //   35: getstatic 48	org/springframework/boot/loader/jar/Handler:jarContextUrl	Ljava/net/URL;
/*     */     //   38: invokevirtual 44	java/net/URL:openConnection	()Ljava/net/URLConnection;
/*     */     //   41: astore_1
/*     */     //   42: aload_1
/*     */     //   43: instanceof 140
/*     */     //   46: ifeq +7 -> 53
/*     */     //   49: aconst_null
/*     */     //   50: putstatic 48	org/springframework/boot/loader/jar/Handler:jarContextUrl	Ljava/net/URL;
/*     */     //   53: goto +4 -> 57
/*     */     //   56: astore_1
/*     */     //   57: aload_0
/*     */     //   58: ifnonnull +12 -> 70
/*     */     //   61: ldc -122
/*     */     //   63: invokestatic 137	java/lang/System:clearProperty	(Ljava/lang/String;)Ljava/lang/String;
/*     */     //   66: pop
/*     */     //   67: goto +36 -> 103
/*     */     //   70: ldc -122
/*     */     //   72: aload_0
/*     */     //   73: invokestatic 141	java/lang/System:setProperty	(Ljava/lang/String;Ljava/lang/String;)Ljava/lang/String;
/*     */     //   76: pop
/*     */     //   77: goto +26 -> 103
/*     */     //   80: astore_2
/*     */     //   81: aload_0
/*     */     //   82: ifnonnull +12 -> 94
/*     */     //   85: ldc -122
/*     */     //   87: invokestatic 137	java/lang/System:clearProperty	(Ljava/lang/String;)Ljava/lang/String;
/*     */     //   90: pop
/*     */     //   91: goto +10 -> 101
/*     */     //   94: ldc -122
/*     */     //   96: aload_0
/*     */     //   97: invokestatic 141	java/lang/System:setProperty	(Ljava/lang/String;Ljava/lang/String;)Ljava/lang/String;
/*     */     //   100: pop
/*     */     //   101: aload_2
/*     */     //   102: athrow
/*     */     //   103: invokestatic 138	org/springframework/boot/loader/jar/Handler:resetCachedUrlHandlers	()V
/*     */     //   106: return
/*     */     // Line number table:
/*     */     //   Java source line #415	-> byte code offset #0
/*     */     //   Java source line #416	-> byte code offset #6
/*     */     //   Java source line #418	-> byte code offset #14
/*     */     //   Java source line #420	-> byte code offset #20
/*     */     //   Java source line #421	-> byte code offset #23
/*     */     //   Java source line #422	-> byte code offset #35
/*     */     //   Java source line #423	-> byte code offset #42
/*     */     //   Java source line #424	-> byte code offset #49
/*     */     //   Java source line #428	-> byte code offset #53
/*     */     //   Java source line #427	-> byte code offset #56
/*     */     //   Java source line #431	-> byte code offset #57
/*     */     //   Java source line #432	-> byte code offset #61
/*     */     //   Java source line #435	-> byte code offset #70
/*     */     //   Java source line #437	-> byte code offset #77
/*     */     //   Java source line #431	-> byte code offset #80
/*     */     //   Java source line #432	-> byte code offset #85
/*     */     //   Java source line #435	-> byte code offset #94
/*     */     //   Java source line #437	-> byte code offset #101
/*     */     //   Java source line #438	-> byte code offset #103
/*     */     //   Java source line #440	-> byte code offset #106
/*     */     // Local variable table:
/*     */     //   start	length	slot	name	signature
/*     */     //   13	84	0	handlers	String
/*     */     //   41	2	1	connection	URLConnection
/*     */     //   56	1	1	localException	Exception
/*     */     //   80	22	2	localObject	Object
/*     */     // Exception table:
/*     */     //   from	to	target	type
/*     */     //   20	53	56	java/lang/Exception
/*     */     //   14	57	80	finally
/*     */   }
/*     */   
/*     */   private static boolean canResetCachedUrlHandlers()
/*     */   {
/*     */     try
/*     */     {
/* 444 */       resetCachedUrlHandlers();
/* 445 */       return true;
/*     */     }
/*     */     catch (Error ex) {}
/* 448 */     return false;
/*     */   }
/*     */   
/*     */   private static void resetCachedUrlHandlers()
/*     */   {
/* 453 */     URL.setURLStreamHandlerFactory(null);
/*     */   }
/*     */   
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */ 
/*     */   public static void setUseFastConnectionExceptions(boolean useFastConnectionExceptions)
/*     */   {
/* 463 */     JarURLConnection.setUseFastExceptions(useFastConnectionExceptions);
/*     */   }
/*     */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\jar\Handler.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */