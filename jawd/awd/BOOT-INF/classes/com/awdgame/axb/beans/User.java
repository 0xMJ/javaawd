/*    */ package com.awdgame.axb.beans;
/*    */ 
/*    */ import com.awdgame.axb.tools.Tool;
/*    */ import java.io.Serializable;
/*    */ 
/*    */ public class User implements Serializable
/*    */ {
/*    */   private static final long serialVersionUID = -8679843744107581001L;
/*    */   public String name;
/*    */   public int age;
/*    */   public String sex;
/*    */   
/*    */   public User(String name, int age, String sex)
/*    */   {
/* 15 */     this.name = name;
/* 16 */     this.age = age;
/* 17 */     this.sex = sex;
/*    */   }
/*    */   
/*    */   public String getName() {
/* 21 */     return this.name;
/*    */   }
/*    */   
/*    */   public void setName(String name) {
/* 25 */     this.name = name;
/*    */   }
/*    */   
/*    */   public int getAge() {
/* 29 */     return this.age;
/*    */   }
/*    */   
/*    */   public void setAge(int age) {
/* 33 */     this.age = age;
/*    */   }
/*    */   
/*    */   public String getSex() {
/* 37 */     return this.sex;
/*    */   }
/*    */   
/*    */   public void setSex(String sex) {
/* 41 */     this.sex = sex;
/*    */   }
/*    */   
/*    */   public String toString()
/*    */   {
/* 46 */     return "User{name='" + this.name + '\'' + ", age=" + this.age + ", sex='" + this.sex + '\'' + '}';
/*    */   }
/*    */   
/*    */ 
/*    */   public static void main(String[] args)
/*    */     throws Exception
/*    */   {
/* 53 */     User user = new User("Firebasky", 21, "boy");
/* 54 */     byte[] serialize = Tool.serialize(user);
/* 55 */     String s = Tool.base64Encode(serialize);
/* 56 */     System.out.println(s);
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\beans\User.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */