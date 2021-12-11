package org.springframework.boot.loader.jar;

abstract interface FileHeader
{
  public abstract boolean hasName(CharSequence paramCharSequence, char paramChar);
  
  public abstract long getLocalHeaderOffset();
  
  public abstract long getCompressedSize();
  
  public abstract long getSize();
  
  public abstract int getMethod();
}


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\jar\FileHeader.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */