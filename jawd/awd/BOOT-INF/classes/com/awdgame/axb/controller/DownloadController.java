/*    */ package com.awdgame.axb.controller;
/*    */ 
/*    */ import java.io.BufferedReader;
/*    */ import java.io.FileInputStream;
/*    */ import java.io.InputStreamReader;
/*    */ import java.util.regex.Matcher;
/*    */ import java.util.regex.Pattern;
/*    */ import org.springframework.stereotype.Controller;
/*    */ import org.springframework.web.bind.annotation.GetMapping;
/*    */ import org.springframework.web.bind.annotation.ResponseBody;
/*    */ 
/*    */ @Controller
/*    */ public class DownloadController
/*    */ {
/* 15 */   private static String cs = "UTF-8";
/* 16 */   public static final Pattern PATTERN = Pattern.compile("\\.\\./\\.\\./");
/*    */   
/*    */   @GetMapping({"/download"})
/*    */   @ResponseBody
/*    */   public String ReadFileCode(String filePath) throws Exception {
/* 21 */     if (PATTERN.matcher(filePath).find()) {
/* 22 */       return "hacker....";
/*    */     }
/* 24 */     String RfilePath = "/proc/self/" + filePath;
/* 25 */     String l = "";String s = "";
/* 26 */     BufferedReader br = new BufferedReader(new InputStreamReader(new FileInputStream(new java.io.File(RfilePath)), cs));
/*    */     
/* 28 */     while ((l = br.readLine()) != null) {
/* 29 */       s = s + l + "\r\n";
/*    */     }
/* 31 */     br.close();
/* 32 */     return s;
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\controller\DownloadController.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */