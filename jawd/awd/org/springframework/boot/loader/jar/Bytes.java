/*    */ package org.springframework.boot.loader.jar;
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
/*    */ 
/*    */ 
/*    */ 
/*    */ 
/*    */ final class Bytes
/*    */ {
/*    */   static long littleEndianValue(byte[] bytes, int offset, int length)
/*    */   {
/* 30 */     long value = 0L;
/* 31 */     for (int i = length - 1; i >= 0; i--) {
/* 32 */       value = value << 8 | bytes[(offset + i)] & 0xFF;
/*    */     }
/* 34 */     return value;
/*    */   }
/*    */ }


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\jar\Bytes.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */