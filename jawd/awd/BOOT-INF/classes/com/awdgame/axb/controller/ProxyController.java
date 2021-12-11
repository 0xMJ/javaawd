/*    */ package com.awdgame.axb.controller;
/*    */ 
/*    */ import java.io.PrintStream;
/*    */ import java.net.URL;
/*    */ import java.net.URLConnection;
/*    */ import java.util.regex.Matcher;
/*    */ import java.util.regex.Pattern;
/*    */ import org.apache.commons.io.IOUtils;
/*    */ import org.springframework.web.bind.annotation.GetMapping;
/*    */ 
/*    */ @org.springframework.web.bind.annotation.RestController
/*    */ @org.springframework.web.bind.annotation.RequestMapping({"/proxy"})
/*    */ public class ProxyController
/*    */ {
/* 15 */   public static final String[] BLACK_PROTOCOL_LIST = { "file", "ftp", "mailto", "jar", "netdoc" };
/* 16 */   public static final Pattern PATTERN = Pattern.compile("^[A-Za-z]+$");
/*    */   
/*    */   @GetMapping({"/test"})
/*    */   public String test() throws Exception
/*    */   {
/* 21 */     String url = "http://www.baidu.com";
/* 22 */     URL u = new URL(url);
/* 23 */     URLConnection urlConnection = u.openConnection();
/* 24 */     if (urlConnection != null) {
/* 25 */       System.out.println("success");
/* 26 */       return "success";
/*    */     }
/* 28 */     System.out.println("error");
/* 29 */     return "error";
/*    */   }
/*    */   
/*    */ 
/*    */   @GetMapping({"/http"})
/*    */   public byte[] proxy(String url)
/*    */     throws Exception
/*    */   {
/* 37 */     String protocol = url.split(":")[0];
/* 38 */     if (!PATTERN.matcher(protocol).find()) {
/* 39 */       return "Cannot have special characters".getBytes();
/*    */     }
/* 41 */     for (String blackProtocol : BLACK_PROTOCOL_LIST) {
/* 42 */       if (protocol.toLowerCase().contains(blackProtocol)) {
/* 43 */         return ("protocol" + protocol + "cannot be used").getBytes();
/*    */       }
/*    */     }
/* 46 */     if (!url.endsWith("com")) {
/* 47 */       return "Suffix must be com".getBytes();
/*    */     }
/* 49 */     URL u = new URL(url);
/* 50 */     URLConnection urlConnection = u.openConnection();
/* 51 */     return IOUtils.toByteArray(urlConnection.getInputStream());
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\controller\ProxyController.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */