package org.springframework.boot.loader.jar;

import org.springframework.boot.loader.data.RandomAccessData;

abstract interface CentralDirectoryVisitor
{
  public abstract void visitStart(CentralDirectoryEndRecord paramCentralDirectoryEndRecord, RandomAccessData paramRandomAccessData);
  
  public abstract void visitFileHeader(CentralDirectoryFileHeader paramCentralDirectoryFileHeader, long paramLong);
  
  public abstract void visitEnd();
}


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\jar\CentralDirectoryVisitor.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */