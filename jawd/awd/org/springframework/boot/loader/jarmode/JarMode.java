package org.springframework.boot.loader.jarmode;

public abstract interface JarMode
{
  public abstract boolean accepts(String paramString);
  
  public abstract void run(String paramString, String[] paramArrayOfString);
}


/* Location:              C:\Users\Asus\Desktop\awd.jar!\org\springframework\boot\loader\jarmode\JarMode.class
 * Java compiler version: 8 (52.0)
 * JD-Core Version:       0.7.1
 */