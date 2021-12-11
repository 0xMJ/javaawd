/*    */ package com.awdgame.axb.tools;
/*    */ 
/*    */ import java.io.BufferedReader;
/*    */ import java.io.ObjectOutputStream;
/*    */ 
/*    */ public class Tool
/*    */ {
/*  8 */   private static String cs = "UTF-8";
/*    */   
/*    */ 
/*    */ 
/*    */   public static byte[] base64Decode(String base64)
/*    */   {
/* 14 */     java.util.Base64.Decoder decoder = java.util.Base64.getDecoder();
/* 15 */     return decoder.decode(base64);
/*    */   }
/*    */   
/*    */   public static String base64Encode(byte[] bytes) {
/* 19 */     java.util.Base64.Encoder encoder = java.util.Base64.getEncoder();
/* 20 */     return encoder.encodeToString(bytes);
/*    */   }
/*    */   
/*    */   public static byte[] serialize(Object obj) throws Exception {
/* 24 */     java.io.ByteArrayOutputStream btout = new java.io.ByteArrayOutputStream();
/* 25 */     ObjectOutputStream objOut = new ObjectOutputStream(btout);
/* 26 */     objOut.writeObject(obj);
/* 27 */     return btout.toByteArray();
/*    */   }
/*    */   
/*    */   public static Object deserialize(byte[] serialized) throws Exception {
/* 31 */     java.io.ByteArrayInputStream btin = new java.io.ByteArrayInputStream(serialized);
/* 32 */     java.io.ObjectInputStream objIn = new java.io.ObjectInputStream(btin);
/* 33 */     return objIn.readObject();
/*    */   }
/*    */   
/*    */   public static String compile(String scriptText) throws javax.script.ScriptException, java.io.IOException {
/* 37 */     javax.script.ScriptEngine engine = new javax.script.ScriptEngineManager().getEngineByName("nashorn");
/* 38 */     if ((engine instanceof javax.script.Compilable)) {
/* 39 */       javax.script.CompiledScript script = ((javax.script.Compilable)engine).compile(scriptText);
/* 40 */       BufferedReader object = (BufferedReader)script.eval();
/* 41 */       String line = "";
/* 42 */       String result = "";
/* 43 */       while ((line = object.readLine()) != null)
/*    */       {
/* 45 */         result = result + line;
/*    */       }
/* 47 */       return result;
/*    */     }
/* 49 */     return null;
/*    */   }
/*    */   
/*    */   public static void CopyInputStream(java.io.InputStream is, StringBuffer sb) throws Exception
/*    */   {
/* 54 */     BufferedReader br = new BufferedReader(new java.io.InputStreamReader(is, cs));
/* 55 */     String l; while ((l = br.readLine()) != null) {
/* 56 */       sb.append(l + "\r\n");
/*    */     }
/* 58 */     br.close();
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\BOOT-INF\classes\com\awdgame\axb\tools\Tool.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */