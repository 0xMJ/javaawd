package org.springframework.boot.loader.data;

import java.io.IOException;
import java.io.InputStream;

public abstract interface RandomAccessData
{
  public abstract InputStream getInputStream()
    throws IOException;
  
  public abstract RandomAccessData getSubsection(long paramLong1, long paramLong2);
  
  public abstract byte[] read()
    throws IOException;
  
  public abstract byte[] read(long paramLong1, long paramLong2)
    throws IOException;
  
  public abstract long getSize();
}


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\data\RandomAccessData.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */