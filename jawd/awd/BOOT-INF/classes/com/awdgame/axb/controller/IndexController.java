/*    */ package com.awdgame.axb.controller;
/*    */ 
/*    */ import org.slf4j.Logger;
/*    */ import org.springframework.stereotype.Controller;
/*    */ import org.springframework.ui.Model;
/*    */ import org.springframework.web.bind.annotation.GetMapping;
/*    */ import org.springframework.web.bind.annotation.PathVariable;
/*    */ import org.springframework.web.bind.annotation.RequestParam;
/*    */ import org.springframework.web.bind.annotation.ResponseBody;
/*    */ 
/*    */ @Controller
/*    */ public class IndexController
/*    */ {
/* 14 */   Logger log = org.slf4j.LoggerFactory.getLogger(IndexController.class);
/*    */   
/*    */   @GetMapping({"/"})
/* 17 */   public String index(Model model) { model.addAttribute("message", "CTFers");
/* 18 */     return "index";
/*    */   }
/*    */   
/*    */   @GetMapping({"/test"})
/*    */   @ResponseBody
/*    */   public String test() {
/* 24 */     return "This is test demo";
/*    */   }
/*    */   
/*    */   @GetMapping({"/path"})
/*    */   @ResponseBody
/*    */   public String fragment(@RequestParam String path) {
/* 30 */     return "welcome :: " + path;
/*    */   }
/*    */   
/*    */   @GetMapping({"/doc/{data}"})
/*    */   public void getData(@PathVariable String data) {
/* 35 */     this.log.info("info: " + data);
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\controller\IndexController.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */