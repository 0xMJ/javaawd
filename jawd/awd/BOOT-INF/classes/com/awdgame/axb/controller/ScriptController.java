/*    */ package com.awdgame.axb.controller;
/*    */ 
/*    */ import com.awdgame.axb.tools.Tool;
/*    */ import javax.script.ScriptException;
/*    */ import org.springframework.stereotype.Controller;
/*    */ import org.springframework.web.bind.annotation.GetMapping;
/*    */ import org.springframework.web.bind.annotation.RequestParam;
/*    */ import org.springframework.web.bind.annotation.ResponseBody;
/*    */ 
/*    */ @Controller
/*    */ public class ScriptController
/*    */ {
/*    */   @GetMapping({"/cmd"})
/*    */   public String cmd(@RequestParam String command) throws Exception
/*    */   {
/* 16 */     StringBuffer sb = new StringBuffer("");
/* 17 */     String[] c = { "/bin/bash", "-c", "hacker " + command };
/* 18 */     Process p = Runtime.getRuntime().exec(c);
/* 19 */     Tool.CopyInputStream(p.getInputStream(), sb);
/* 20 */     Tool.CopyInputStream(p.getErrorStream(), sb);
/* 21 */     return sb.toString();
/*    */   }
/*    */   
/*    */   @GetMapping({"/script"})
/*    */   @ResponseBody
/*    */   public String scriptEval(@RequestParam String script) throws ScriptException {
/*    */     try {
/* 28 */       return Tool.compile(script);
/*    */     } catch (Exception e) {}
/* 30 */     return "error";
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\controller\ScriptController.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */