/*    */ package org.springframework.boot.loader.jarmode;
/*    */ 
/*    */ import java.io.PrintStream;
/*    */ import java.util.Arrays;
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ class TestJarMode
/*    */   implements JarMode
/*    */ {
/*    */   public boolean accepts(String mode)
/*    */   {
/* 30 */     return "test".equals(mode);
/*    */   }
/*    */   
/*    */   public void run(String mode, String[] args)
/*    */   {
/* 35 */     System.out.println("running in " + mode + " jar mode " + Arrays.asList(args));
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\jarmode\TestJarMode.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */