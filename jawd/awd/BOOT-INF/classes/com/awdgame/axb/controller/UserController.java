/*    */ package com.awdgame.axb.controller;
/*    */ 
/*    */ import com.awdgame.axb.beans.User;
/*    */ import com.awdgame.axb.tools.Tool;
/*    */ import org.springframework.stereotype.Controller;
/*    */ import org.springframework.web.bind.annotation.PostMapping;
/*    */ import org.springframework.web.bind.annotation.ResponseBody;
/*    */ 
/*    */ @Controller
/*    */ public class UserController
/*    */ {
/*    */   @PostMapping({"/serialize"})
/*    */   @ResponseBody
/*    */   public String serialize(String name, int age, String sex) throws Exception
/*    */   {
/* 16 */     User user = new User(name, age, sex);
/* 17 */     byte[] serialize = Tool.serialize(user);
/* 18 */     return Tool.base64Encode(serialize);
/*    */   }
/*    */   
/*    */   @PostMapping({"/deserialize"})
/*    */   @ResponseBody
/*    */   public String deserialize(String data) throws Exception
/*    */   {
/* 25 */     String str = "rO0ABXNyABpjb20uYXdkZ2FtZS5heGIuYmVhbnMuVXNlcoeLABo+kjG3AgADSQADYWdlTAAEbmFtZXQAEkxqYXZhL2xhbmcvU3RyaW5nO0wAA3NleHEAfgABeHAAAAAVdAAFY3l6Y2N0AANib3k=";
/*    */     try {
/* 27 */       byte[] bytes = Tool.base64Decode(data);
/* 28 */       Object user = (User)Tool.deserialize(bytes);
/* 29 */       return user.toString();
/*    */     } catch (Exception e) {
/* 31 */       byte[] byte1 = Tool.base64Decode(str);
/* 32 */       Object deserialize = null;
/*    */       try {
/* 34 */         deserialize = Tool.deserialize(byte1);
/*    */       } catch (Exception exception) {
/* 36 */         return "serialVersionUID error";
/*    */       }
/* 38 */       return deserialize.toString();
/*    */     }
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\controller\UserController.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */